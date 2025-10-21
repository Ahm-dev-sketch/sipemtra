<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Booking;
use App\Models\Rute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function step1()
    {
        return view('booking.step1');
    }

    public function processStep1(Request $request)
    {
        $request->validate([
            'kota_asal' => 'required|string',
            'kota_tujuan' => 'required|string',
            'tanggal' => 'required|date|after_or_equal:today',
        ]);

        session(['booking_step1' => [
            'kota_asal' => $request->kota_asal,
            'kota_tujuan' => $request->kota_tujuan,
            'tanggal' => $request->tanggal,
        ]]);

        return redirect('/pesan-tiket/step2');
    }

    public function step2()
    {
        $step1 = session('booking_step1');
        if (!$step1) {
            return redirect('/pesan-tiket');
        }

        $jadwals = Jadwal::with('rute')
            ->whereHas('rute', function ($query) use ($step1) {
                $query->where('kota_asal', $step1['kota_asal'])
                    ->where('kota_tujuan', $step1['kota_tujuan']);
            })
            ->where('tanggal', $step1['tanggal'])
            ->get();

        return view('booking.step2', compact('jadwals'));
    }

    public function processStep2(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwals,id',
        ]);

        $jadwal = Jadwal::find($request->jadwal_id);
        session(['booking_step2' => ['jadwal' => $jadwal]]);

        return redirect('/pesan-tiket/step3');
    }

    public function step3()
    {
        $step1 = session('booking_step1');
        $step2 = session('booking_step2');
        if (!$step1 || !$step2) {
            return redirect('/pesan-tiket');
        }

        $jadwal = $step2['jadwal'];
        return view('booking.step3', compact('jadwal'));
    }

    public function processStep3(Request $request)
    {
        $request->validate([
            'seats' => 'required|array|min:1|max:7',
            'seats.*' => 'string',
        ]);

        $step1 = session('booking_step1');
        $step2 = session('booking_step2');
        if (!$step1 || !$step2) {
            return redirect('/pesan-tiket');
        }

        $jadwal = $step2['jadwal'];
        $user = Auth::user();

        // Check if departure is too close
        $departureTime = Carbon::parse($jadwal->tanggal . ' ' . $jadwal->jam);
        if ($departureTime->diffInMinutes(now()) < 60) {
            return redirect()->back()->with('error', 'Pemesanan tidak dapat dilakukan karena waktu keberangkatan terlalu dekat.');
        }

        // Check booked seats
        $bookedSeats = Booking::where('jadwal_id', $jadwal->id)
            ->where(function ($query) {
                $query->where('status', 'setuju')
                    ->orWhere(function ($q) {
                        $q->where('status', 'pending')
                            ->where('created_at', '>=', now()->subMinutes(30));
                    });
            })
            ->pluck('seat_number')
            ->toArray();

        foreach ($request->seats as $seat) {
            if (in_array($seat, $bookedSeats)) {
                return redirect()->back()->withErrors(['seat' => 'Kursi ' . $seat . ' sudah dipesan.']);
            }
        }

        // Create bookings
        foreach ($request->seats as $seat) {
            Booking::create([
                'user_id' => $user->id,
                'jadwal_id' => $jadwal->id,
                'seat_number' => $seat,
                'status' => 'pending',
                'jadwal_snapshot' => json_encode($jadwal->toArray()),
            ]);
        }

        // Clear session
        session()->forget(['booking_step1', 'booking_step2']);

        // Send WhatsApp notification (mock)
        Http::post('https://api.whatsapp.com/send', [
            'to' => $user->phone ?? '081234567890',
            'message' => 'Pemesanan tiket berhasil. Silakan lakukan pembayaran.',
        ]);

        return redirect('/riwayat')->with('success', 'Pemesanan berhasil! Silakan lakukan pembayaran.');
    }

    public function riwayat()
    {
        $user = Auth::user();
        $bookings = Booking::where('user_id', $user->id)->with('jadwal.rute')->paginate(10);

        return view('user.riwayat', compact('bookings'));
    }

    public function updateBookingStatus(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:pending,setuju,tolak',
        ]);

        $booking->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status booking berhasil diperbarui.');
    }
}

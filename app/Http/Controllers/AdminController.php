<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Log; // Import Log facade
use App\Models\Jadwal;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingStatusUpdated;

class AdminController extends Controller
{
    public function updateBooking(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,setuju,batal'
        ]);

        $oldStatus = $booking->status;
        $booking->update(['status' => $request->status]);

        // Kirim notifikasi email jika status berubah
        if ($oldStatus !== $request->status) {
            try {
                Mail::to($booking->user->email)->send(new BookingStatusUpdated($booking));
            } catch (\Exception $e) {
                // Log error jika email gagal dikirim, tapi tetap lanjutkan proses
                Log::error('Gagal mengirim email notifikasi: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Status booking diperbarui!');
    }
}
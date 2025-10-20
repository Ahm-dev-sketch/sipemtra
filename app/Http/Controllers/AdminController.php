<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Log;
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


    // Kelola Pelanggan
    public function pelanggan(Request $request)
    {
        $search = $request->input('search');

        $customers = User::when($search, function($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('role', 'like', "%{$search}%");
        })->paginate(10);

        return view('admin.pelanggan', compact('customers', 'search'));
    }

    // Form edit pelanggan
    public function editPelanggan(User $customer)
    {
        return view('admin.pelanggan.edit', compact('customer'));
    }

    // Update pelanggan
    public function updatePelanggan(Request $request, User $customer)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $customer->id,
            'role' => 'required|in:user,admin'
        ]);

        $customer->update($request->only(['name', 'email', 'role']));

        return redirect()->route('admin.pelanggan')->with('success', 'Data pelanggan berhasil diperbarui');
    }

    // Form tambah pelanggan
    public function createPelanggan()
    {
        return view('admin.pelanggan.create');
    }

    // Simpan pelanggan baru
    public function storePelanggan(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:user,admin'
        ]);

        $userData = $request->only(['name', 'email', 'role']);
        $userData['password'] = bcrypt($request->password);

        User::create($userData);

        return redirect()->route('admin.pelanggan')->with('success', 'Berhasil Menambahkan');
    }

    // Hapus pelanggan
    public function destroyPelanggan(User $customer)
    {
        $customer->delete();
        return back()->with('success', 'Pelanggan berhasil dihapus');
    }
}
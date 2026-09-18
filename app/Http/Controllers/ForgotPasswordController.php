<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    // Menampilkan halaman lupa password
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    // Memproses permintaan lupa password
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Cek email pada tb_user
        $user = DB::table('tb_user')
            ->where('email', $request->email)
            ->first();

        if (!$user) {
            return back()
                ->withInput()
                ->withErrors([
                    'email' => 'Email tidak terdaftar pada sistem E-Farming.'
                ]);
        }

        // Token asli yang akan dikirim melalui email
        $token = Str::random(64);

        // Hapus token lama milik email tersebut
        DB::table('tb_password_reset')
            ->where('email', $request->email)
            ->delete();

        // Simpan HASH token ke database
        DB::table('tb_password_reset')->insert([
            'email' => $request->email,
            'token' => hash('sha256', $token),
            'created_at' => now(),
        ]);

        // Buat URL reset password
        $resetUrl = url('/reset-password/' . $token)
            . '?email=' . urlencode($request->email);

        // Kirim email
        Mail::raw(
            "Halo {$user->nama_user},\n\n"
            . "Kami menerima permintaan untuk mengatur ulang password akun E-Farming Anda.\n\n"
            . "Silakan klik link berikut untuk membuat password baru:\n\n"
            . $resetUrl . "\n\n"
            . "Jika Anda tidak meminta reset password, abaikan email ini.\n\n"
            . "Salam,\n"
            . "E-Farming System",
            function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Reset Password E-Farming');
            }
        );

        return back()->with(
            'success',
            'Link reset password telah dikirim ke email Anda.'
        );
    }
    public function showResetForm(Request $request, $token)
{
    $reset = DB::table('tb_password_reset')
        ->where('email', $request->email)
        ->where('token', hash('sha256', $token))
        ->first();

    if (!$reset) {
        return redirect()
            ->route('password.request')
            ->withErrors([
                'email' => 'Link reset password tidak valid atau sudah digunakan.'
            ]);
    }

    return view('auth.reset-password', [
        'token' => $token,
        'email' => $request->email,
    ]);
}

        public function resetPassword(Request $request)
{
    // Validasi input
    $request->validate([
        'email' => 'required|email',
        'token' => 'required',
        'password' => 'required|min:8|confirmed',
    ]);

    // Cari token reset berdasarkan email
    $reset = DB::table('tb_password_reset')
        ->where('email', $request->email)
        ->first();

    if (!$reset) {
        return back()->withErrors([
            'email' => 'Permintaan reset password tidak ditemukan.'
        ]);
    }

    // Cocokkan token dari email dengan hash token di database
    if (!hash_equals(
        $reset->token,
        hash('sha256', $request->token)
    )) {
        return back()->withErrors([
            'token' => 'Token reset password tidak valid.'
        ]);
    }

    // Token berlaku maksimal 60 menit
    if (
        now()->diffInMinutes($reset->created_at) > 60
    ) {
        DB::table('tb_password_reset')
            ->where('email', $request->email)
            ->delete();

        return redirect()
            ->route('password.request')
            ->withErrors([
                'email' => 'Link reset password sudah kedaluwarsa. Silakan minta link baru.'
            ]);
    }

    // Update password user
    DB::table('tb_user')
        ->where('email', $request->email)
        ->update([
            'password' => Hash::make($request->password)
        ]);

    // Hapus token setelah berhasil digunakan
    DB::table('tb_password_reset')
        ->where('email', $request->email)
        ->delete();

    return redirect()
        ->route('login')
        ->with(
            'success',
            'Password berhasil diubah. Silakan login menggunakan password baru.'
        );
}


}
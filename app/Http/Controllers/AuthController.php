<?php

namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Voucher;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
  /**
   * Show the login form
   */
  public function showLoginForm()
  {
    return view('pages.auth.login');
  }

  /**
   * Handle the login request
   */
  public function login(Request $request)
  {
    // Validasi input
    $credentials = $request->validate(
      [
        'email'    => ['required', 'email'],
        'password' => 'required|min:8|max:10',
      ],
      [
        'email.required'    => 'Email wajib diisi.',
        'email.email'       => 'Masukkan email yang valid.',
        'password.required' => 'Password wajib diisi.',
        'password.min'      => 'Password harus memiliki minimal 8 karakter.',
        'password.max'      => 'Password tidak boleh lebih dari 10 karakter.',
      ]
    );

    // Log attempt for debugging
    Log::info('Attempting login for:', ['email' => $credentials['email']]);

    // Attempt login with custom column mapping including role
    if (Auth::attempt([
      'email_222336' => $credentials['email'],
      'password'     => $credentials['password'],  // Laravel will use getAuthPassword internally
    ])) {
      // Regenerate session for security
      $request->session()->regenerate();

      session([
        'user_id'   => Auth::user()->email_222336,
        'user_role' => Auth::user()->role_222336,
        'email'     => Auth::user()->email_222336,
        'name'      => Auth::user()->nama_222336,
      ]);

      $user = Auth::user();

      $voucherPenggunaBaru = Voucher::where('id_user_222336', $user->email_222336)
        ->where('tipe_222336', 'pengguna_baru')
        ->where('status_222336', 'tersedia')
        ->first();

      Log::debug('Hasil pencarian voucher untuk pengguna baru:', [
        'user_email'        => $user->email_222336,
        'voucher_ditemukan' => $voucherPenggunaBaru ? $voucherPenggunaBaru->toArray() : null
      ]);

      if ($voucherPenggunaBaru) {
        $request->session()->put('show_new_user_voucher', [
          'kode'   => $voucherPenggunaBaru->kode_voucher_222336,
          'diskon' => $voucherPenggunaBaru->persentase_diskon_222336
        ]);
      }

      // Log success
      Log::info('Login successful for user:');

      // Redirect based on role
      if (Auth::user()->role_222336 === 'admin') {
        // For admin, redirect to admin panel (Filament or your custom admin)
        return redirect('/admin/produk')->with('success', 'Login berhasil!');
      } else {
        // For regular users
        return redirect('/')->with('success', 'Login berhasil!');
      }
    }

    // Log failure
    Log::info('Login failed for:', ['email' => $credentials['email']]);

    return back()->withErrors([
      'email' => 'Password dan email anda salah',
    ]);
  }

  /**
   * Show the registration form
   */
  public function showRegisterForm()
  {
    return view('pages.auth.signup');
  }

  /**
   * Handle the registration request
   */
  public function register(Request $request)
  {
    $request->validate([
      'name'       => 'required|string|max:255',
      'email'      => 'required|string|email|max:255|unique:users_222336,email_222336',
      'password'   => 'required|string|min:8|confirmed',
      // Kolom lainnya tidak required
      'gender'     => 'nullable|in:male,female',
      'phone'      => 'nullable|string|max:15',
      'address'    => 'nullable|string',
      'birth_date' => 'nullable|date',
    ]);

    $user = Users::create([
      'name'              => $request->name,
      'email_222336'      => $request->email,
      'password_222336'   => Hash::make($request->password),
      'gender_222336'     => $request->gender,
      'phone_222336'      => $request->phone,
      'address_222336'    => $request->address,
      'birth_date_222336' => $request->birth_date,
      'role_222336'       => 'customer',
    ]);

    if ($user) {
      Voucher::create([
        'id_user_222336'            => $user->email_222336,
        'tipe_222336'               => 'pengguna_baru',
        'persentase_diskon_222336'  => 15,  // Ganti sesuai keinginan
        'tanggal_kadaluarsa_222336' => Carbon::now()->addDays(14),  // Berlaku 14 hari
      ]);
    }

    return redirect('/login');
  }

  /**
   * Handle the logout request
   */
  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
  }
}

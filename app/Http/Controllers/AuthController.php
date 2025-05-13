<?php

namespace App\Http\Controllers;

use App\Models\Users;
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

    // Attempt login with custom column mapping
    if (Auth::attempt([
      'email_2222336' => $credentials['email'],
      'password'      => $credentials['password']  // Laravel will use getAuthPassword internally
    ])) {
      // Regenerate session for security
      $request->session()->regenerate();

      // Store additional session data
      session([
        'user_id'   => Auth::user()->id_2222336,
        'user_role' => Auth::user()->role_2222336,
        'email'     => Auth::user()->email_2222336,
        'name'      => Auth::user()->name,
      ]);

      // Log success
      Log::info('Login successful for user:', [
        'id'   => Auth::user()->id_2222336,
        'role' => Auth::user()->role_2222336
      ]);

      // Redirect based on role
      if (Auth::user()->role_2222336 === 'admin') {
        // For admin, redirect to admin panel (Filament or your custom admin)
        return redirect('/admin')->with('success', 'Login berhasil!');
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
      'email'      => 'required|string|email|max:255|unique:users_2222336,email_2222336',
      'password'   => 'required|string|min:8|confirmed',
      // Kolom lainnya tidak required
      'gender'     => 'nullable|in:male,female',
      'phone'      => 'nullable|string|max:15',
      'address'    => 'nullable|string',
      'birth_date' => 'nullable|date',
    ]);

    $user = Users::create([
      'name'               => $request->name,
      'email_2222336'      => $request->email,
      'password_2222336'   => Hash::make($request->password),
      'gender_2222336'     => $request->gender,
      'phone_2222336'      => $request->phone,
      'address_2222336'    => $request->address,
      'birth_date_2222336' => $request->birth_date,
      'role_2222336'       => 'customer',
    ]);

    Auth::login($user);

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

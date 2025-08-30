<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthGuestController extends Controller
{
  public function showLogin()
  {
    return view('guest.pages.auth.login', [
      'page_title' => 'Masuk',
      'page_meta_description' => 'Login ke akun Anda'
    ]);
  }

  public function showRegister()
  {
    return view('guest.pages.auth.register', [
      'page_title' => 'Daftar',
      'page_meta_description' => 'Daftar akun baru'
    ]);
  }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ], [
      'email.required' => 'Email wajib diisi.',
      'email.email' => 'Format email tidak valid.',
      'password.required' => 'Password wajib diisi.',
    ]);

    $remember = $request->boolean('remember');

    if (Auth::attempt($credentials, $remember)) {
      $request->session()->regenerate();
      return redirect()->intended(route('guest.beranda.index'))
        ->with('success', 'Berhasil masuk. Selamat datang!');
    }

    throw ValidationException::withMessages([
      'email' => 'Email atau password salah.',
    ]);
  }

  public function register(Request $request)
  {
    $data = $request->validate([
      'fullname' => ['required', 'string', 'max:100'],
      'username' => ['required', 'string', 'max:50', 'unique:users,username'],
      'email' => ['required', 'email', 'max:255', 'unique:users,email'],
      'password' => ['required', 'confirmed', 'min:8'],
    ], [
      'fullname.required' => 'Nama lengkap wajib diisi.',
      'fullname.max' => 'Nama lengkap maksimal 100 karakter.',
      'username.required' => 'Username wajib diisi.',
      'username.max' => 'Username maksimal 50 karakter.',
      'username.unique' => 'Username sudah digunakan.',
      'email.required' => 'Email wajib diisi.',
      'email.email' => 'Format email tidak valid.',
      'email.max' => 'Email maksimal 255 karakter.',
      'email.unique' => 'Email sudah terdaftar.',
      'password.required' => 'Password wajib diisi.',
      'password.confirmed' => 'Konfirmasi password tidak cocok.',
      'password.min' => 'Password minimal 8 karakter.',
    ]);

    $user = User::create([
      'fullname' => $data['fullname'],
      'username' => $data['username'],
      'email' => $data['email'],
      'password' => Hash::make($data['password']),
    ]);

    Auth::login($user);

    return redirect()->route('guest.beranda.index')
      ->with('success', 'Akun berhasil dibuat. Selamat datang!');
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('guest.beranda.index')
      ->with('status', 'Anda telah berhasil keluar.');
  }
}

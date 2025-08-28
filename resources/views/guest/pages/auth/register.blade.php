@extends('guest.layouts.auth')

@section('document.body')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-base-200 via-primary/10 to-base-100">
  <div class="w-full max-w-3xl flex flex-col md:flex-row shadow-xl overflow-hidden bg-base-100/80">
    {{-- Left: Pure Image --}}
    <div class="hidden md:flex md:w-1/2 relative bg-primary/10 p-0">
      <img src="https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=600&q=80"
           alt="Ilustrasi Register"
           class="w-full h-full object-cover object-center" />
    </div>
    {{-- Right: Form --}}
    <div class="w-full md:w-1/2 flex items-center justify-center p-8">
      <div class="w-full max-w-sm">
        <h1 class="text-2xl font-bold text-base-content mb-1">Daftar</h1>
        <p class="text-base-content/60 text-xs mb-6">Buat akun baru untuk mulai menulis</p>
        <div class="card bg-base-100/80 shadow-none p-0 border-0">
          <form method="POST" action="{{ route('guest.register') }}" class="space-y-4">
            @csrf
            <div>
              <label class="label text-xs font-semibold" for="fullname">Nama Lengkap</label>
              <div class="relative">
                <input id="fullname" type="text" name="fullname" value="{{ old('fullname') }}"
                  class="input w-full pl-10 bg-base-200 focus:outline-primary @error('fullname') input-error @enderror z-0"
                  required autofocus placeholder="Masukkan nama lengkap Anda">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-base-content/40 pointer-events-none z-10">
                  <i class="fa fa-user"></i>
                </span>
              </div>
              @error('fullname')
                <span class="text-error text-xs">{{ $message }}</span>
              @enderror
            </div>
            <div>
              <label class="label text-xs font-semibold" for="username">Username</label>
              <div class="relative">
                <input id="username" type="text" name="username" value="{{ old('username') }}"
                  class="input w-full pl-10 bg-base-200 focus:outline-primary @error('username') input-error @enderror z-0"
                  required placeholder="Masukkan username">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-base-content/40 pointer-events-none z-10">
                  <i class="fa fa-at"></i>
                </span>
              </div>
              @error('username')
                <span class="text-error text-xs">{{ $message }}</span>
              @enderror
            </div>
            <div>
              <label class="label text-xs font-semibold" for="email">Email</label>
              <div class="relative">
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                  class="input w-full pl-10 bg-base-200 focus:outline-primary @error('email') input-error @enderror z-0"
                  required placeholder="Masukkan email Anda">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-base-content/40 pointer-events-none z-10">
                  <i class="fa fa-envelope"></i>
                </span>
              </div>
              @error('email')
                <span class="text-error text-xs">{{ $message }}</span>
              @enderror
            </div>
            <div>
              <label class="label text-xs font-semibold" for="password">Password</label>
              <div class="relative">
                <input id="password" type="password" name="password"
                  class="input w-full pl-10 bg-base-200 focus:outline-primary @error('password') input-error @enderror z-0"
                  required placeholder="Masukkan password">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-base-content/40 pointer-events-none z-10">
                  <i class="fa fa-lock"></i>
                </span>
              </div>
              @error('password')
                <span class="text-error text-xs">{{ $message }}</span>
              @enderror
            </div>
            <div>
              <label class="label text-xs font-semibold" for="password_confirmation">Konfirmasi Password</label>
              <div class="relative">
                <input id="password_confirmation" type="password" name="password_confirmation"
                  class="input w-full pl-10 bg-base-200 focus:outline-primary z-0"
                  required placeholder="Ulangi password">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-base-content/40 pointer-events-none z-10">
                  <i class="fa fa-lock"></i>
                </span>
              </div>
            </div>
            <button type="submit" class="btn btn-primary w-full font-semibold tracking-wide">Daftar</button>
          </form>
          <div class="divider text-xs text-base-content/40 my-4">atau</div>
          <div class="text-center">
            <span class="text-xs">Sudah punya akun?</span>
            <a href="{{ route('guest.login') }}" class="link link-primary font-semibold">Masuk</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
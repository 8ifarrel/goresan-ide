@extends('guest.layouts.main')

@section('document.body')
  <div class="max-w-2xl mx-auto my-8 lg:my-12 px-4">
    <div class="space-y-6 mb-6">
      {{-- Breadcrumb --}}
      <div class="text-sm breadcrumbs py-0">
        <ul>
          <li><a href="{{ route('guest.beranda.index') }}">Beranda</a></li>
          <li class="text-base-content/60">Profil Saya</li>
        </ul>
      </div>

      {{-- Page Header --}}
      <div>
        <h1 class="text-4xl font-bold mb-2">{{ $page_title }}</h1>
        <p class="text-base-content/70">{{ $page_description }}</p>
      </div>
    </div>
    @if (session('success'))
      <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
      <div class="alert alert-error mb-4">
        <ul class="list-disc pl-5">
          @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form method="POST" action="{{ route('guest.profil.update') }}" enctype="multipart/form-data" class="space-y-4">
      @csrf
      <div>
        <label class="label font-semibold">Nama Lengkap</label>
        <input type="text" name="fullname" class="input input-bordered w-full"
          value="{{ old('fullname', $user->fullname) }}" required>
        <span class="text-xs text-base-content/60">Maksimal 100 karakter</span>
      </div>
      <div>
        <label class="label font-semibold">Username</label>
        <input type="text" name="username" class="input input-bordered w-full"
          value="{{ old('username', $user->username) }}" required>
        <span class="text-xs text-base-content/60">Maksimal 50 karakter. Hanya huruf, angka, dan tanda hubung.</span>
      </div>
      <div>
        <label class="label font-semibold">Email</label>
        <input type="email" name="email" class="input input-bordered w-full" value="{{ old('email', $user->email) }}"
          required>
        <span class="text-xs text-base-content/60">Pastikan email aktif dan valid.</span>
      </div>
      <div>
        <label class="label font-semibold">Tentang</label>
        <textarea name="about" class="textarea textarea-bordered w-full" maxlength="120">{{ old('about', $user->about) }}</textarea>
        <span class="text-xs text-base-content/60">Maksimal 120 karakter. Ceritakan sedikit tentang Anda.</span>
      </div>
      <div>
        <label class="label font-semibold">Foto Profil</label>
        <input type="file" name="profile_picture" class="file-input file-input-bordered w-full" accept="image/*">
        <span class="text-xs text-base-content/60">Format file: png, jpg, jpeg. Maksimal 2 MB.</span>
        @if ($user->profile_picture)
          <img src="{{ asset('storage/' . $user->profile_picture) }}" class="w-24 mt-2 rounded-full" alt="Foto Profil">
        @endif
      </div>
      <div>
        <div class="divider divider-start">Ubah Password</div>
        <div class="text-sm text-base-content/60">
          Kosongkan kolom password jika tidak ingin mengubah password.
        </div>
      </div>
      <div>
        <label class="label font-semibold">Password Lama</label>
        <input type="password" name="old_password" class="input input-bordered w-full">
        <span class="text-xs text-base-content/60">Masukkan password lama Anda untuk konfirmasi perubahan password.</span>
        @error('old_password')
          <span class="text-error text-xs">{{ $message }}</span>
        @enderror
      </div>
      <div>
        <label class="label font-semibold">Password Baru</label>
        <input type="password" name="new_password" class="input input-bordered w-full">
        <span class="text-xs text-base-content/60">Minimal 8 karakter. Gunakan kombinasi angka dan huruf.</span>
        @error('new_password')
          <span class="text-error text-xs">{{ $message }}</span>
        @enderror
      </div>
      <div>
        <label class="label font-semibold">Konfirmasi Password Baru</label>
        <input type="password" name="new_password_confirmation" class="input input-bordered w-full">
        <span class="text-xs text-base-content/60">Ulangi password baru Anda.</span>
      </div>
      <div class="flex gap-2">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ url()->previous() }}" class="btn btn-ghost">Batal</a>
      </div>
    </form>
  </div>
  </div>
@endsection

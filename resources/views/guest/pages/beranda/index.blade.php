@extends('guest.layouts.main')

@section('document.head')
@endsection

@section('document.body')
  {{-- Featured Post Header --}}
  <div class="bg-base-200 py-8">
    <div class="max-w-6xl mx-auto px-4">
      <div class="grid lg:grid-cols-2 gap-8 items-center">
        {{-- Featured Post Image --}}
        <div class="relative h-56 lg:h-[400px] card overflow-hidden">
          <img src="https://picsum.photos/800/600" alt="Featured Post" class="w-full h-full object-cover">
          <div class="absolute top-4 left-4">
            <span class="badge badge-secondary">Blog Pilihan</span>
          </div>
        </div>
        {{-- Featured Post Content --}}
        <div class="space-y-4">
          <div class="flex gap-4 text-sm flex-col lg:flex-row lg:items-center">
            <div>
              <span class="badge badge-primary">Teknologi</span>
              <span class="badge badge-primary">Budaya</span>
            </div>
            <div class="flex gap-2 text-sm text-base-content/60 w-fit flex-row">
              <span>2 hari lalu</span>
              <span>•</span>
              <span>5 menit baca</span>
              <span>•</span>
              <span>3 ribu pembaca</span>
            </div>
          </div>
          <h1 class="text-2xl lg:text-4xl font-bold">Masa Depan Kecerdasan Buatan dalam Masyarakat Modern</h1>
          <p class="text-base-content/70 text-base lg:text-lg">Jelajahi bagaimana AI mengubah dunia kita dan apa artinya
            bagi masa depan manusia. Dari sistem otomatis hingga aplikasi kreatif, temukan perkembangan terbaru dalam
            teknologi AI.</p>
          <div class="flex items-center gap-4">
            <div class="flex items-center gap-2">
              <div class="avatar">
                <div class="w-10 rounded-full">
                  <img src="https://i.pravatar.cc/150?img=1" alt="Author">
                </div>
              </div>
              <span class="font-medium">Farrel Sirah</span>
            </div>
            {{-- <button class="btn btn-primary">Baca Blog</button> --}}
          </div>
        </div>
      </div>
    </div>
  </div>

  <main class="max-w-6xl mx-auto px-4">
    {{-- Populer Section --}}
    <section class="py-12">
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Blog Populer</h2>
        <a class="btn btn-primary">Lihat lsemua</a>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @for ($i = 1; $i <= 3; $i++)
          <div class="card bg-base-100 shadow-hover transition-shadow duration-300">
            <figure class="relative">
              <img src="https://picsum.photos/600/400?random={{ $i }}" alt="Article"
                class="h-48 w-full object-cover" />
              <div class="absolute top-2 left-2">
                <span class="badge badge-secondary">Populer #{{ $i }}</span>
              </div>
            </figure>
            <div class="card-body">
              <div class="flex-wrap flex gap-2 text-sm">
                <div>
                  <span class="badge badge-primary">Teknologi</span>
                  <span class="badge badge-primary">Budaya</span>
                </div>
                <div class="flex gap-2 text-sm text-base-content/60 w-fit flex-row">
                  <span>2 hari lalu</span>
                  <span>•</span>
                  <span>5 menit baca</span>
                  <span>•</span>
                  <span>3 ribu pembaca</span>
                </div>
              </div>
              <div>
                <h3 class="card-title hover:text-primary cursor-pointer">Blog Populer {{ $i }}</h3>
                <p class="text-base-content/70">Pratinjau singkat dari blog populer yang menarik perhatian pembaca...</p>
                <div class="flex items-center gap-2">
                  <div class="avatar">
                    <div class="w-8 rounded-full">
                      <img src="https://i.pravatar.cc/150?img={{ $i }}" alt="Author">
                    </div>
                  </div>
                  <span class="text-sm">Nama Penulis</span>
                </div>
              </div>
            </div>
          </div>
        @endfor
      </div>
    </section>

    {{-- Blog Terkinis with Categories --}}
    <section class="py-12">
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Blog Terkini</h2>
        <a class="btn btn-primary">Lihat semua</a>
      </div>
      <div class="flex items-center gap-4 mb-8 overflow-x-auto">
        <button class="btn btn-primary">Semua</button>
        <button class="btn btn-ghost">Teknologi</button>
        <button class="btn btn-ghost">Sains</button>
        <button class="btn btn-ghost">Budaya</button>
        <button class="btn btn-ghost">Bisnis</button>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @for ($i = 1; $i <= 6; $i++)
          <div class="card bg-base-100 shadow-hover transition-shadow duration-300">
            <figure>
              <img src="https://picsum.photos/400/300?random={{ $i + 3 }}" alt="Article"
                class="h-48 w-full object-cover" />
            </figure>
            <div class="card-body">
              <div class="flex-wrap flex gap-2 text-sm">
                <div>
                  <span class="badge badge-primary">Teknologi</span>
                  <span class="badge badge-primary">Budaya</span>
                </div>
                <div class="flex gap-2 text-sm text-base-content/60 w-fit flex-row">
                  <span>2 hari lalu</span>
                  <span>•</span>
                  <span>5 menit baca</span>
                  <span>•</span>
                  <span>3 ribu pembaca</span>
                </div>
              </div>
              <h3 class="card-title hover:text-primary cursor-pointer">Blog Terbaru {{ $i }}</h3>
              <p class="text-base-content/70">Pratinjau singkat dari konten blog...</p>
              <div class="flex items-center gap-2">
                <div class="avatar">
                  <div class="w-8 rounded-full">
                    <img src="https://i.pravatar.cc/150?img={{ $i }}" alt="Author">
                  </div>
                </div>
                <span class="text-sm">Nama Penulis</span>
              </div>
            </div>
          </div>
        @endfor
      </div>
    </section>
  </main>
@endsection

@section('document.end')
@endsection

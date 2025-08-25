@extends('guest.layouts.main')

@section('document.head')
@endsection

@section('document.body')
  <div class="bg-base-200">
    <div class="max-w-6xl mx-auto px-4 py-8">
      {{-- Breadcrumb --}}
      <div class="text-sm breadcrumbs mb-6">
        <ul>
          <li><a href="{{ route('guest.beranda.index') }}">Beranda</a></li>
          <li class="text-base-content/60">Blog Terkini</li>
        </ul>
      </div>

      {{-- Page Header --}}
      <div class="mb-8">
        <h1 class="text-4xl font-bold mb-2">{{ $page_title }}</h1>
        <p class="text-base-content/70">{{ $page_description }}</p>
      </div>

      {{-- Search and Filter --}}
      <div class="flex flex-col md:flex-row gap-4 mb-8">
        <div class="flex-1">
          <div class="join w-full max-w-md">
            <input type="text" placeholder="Cari blog..." class="input input-bordered join-item flex-1" />
            <button class="btn btn-primary join-item"><i class="fas fa-search"></i></button>
          </div>
        </div>
        <div class="flex gap-2 overflow-x-auto pb-2">
          <button class="btn btn-primary">Semua</button>
          <button class="btn btn-ghost">Teknologi</button>
          <button class="btn btn-ghost">Bisnis</button>
          <button class="btn btn-ghost">Lifestyle</button>
          <button class="btn btn-ghost">Health</button>
        </div>
      </div>

      {{-- Blog Grid --}}
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @for ($i = 1; $i <= 9; $i++)
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

      {{-- Pagination --}}
      <div class="flex justify-center mt-12">
        <div class="join">
          <button class="join-item btn btn-ghost">&laquo;</button>
          <button class="join-item btn btn-primary">1</button>
          <button class="join-item btn btn-ghost">2</button>
          <button class="join-item btn btn-ghost">3</button>
          <button class="join-item btn btn-ghost">...</button>
          <button class="join-item btn btn-ghost">8</button>
          <button class="join-item btn btn-ghost">&raquo;</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('document.end')
@endsection

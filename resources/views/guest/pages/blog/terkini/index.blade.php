@extends('guest.layouts.main')

@section('document.head')
@endsection

@section('document.body')
  <div class="max-w-6xl mx-auto space-y-12 py-12">
    <div class="space-y-6">
      {{-- Breadcrumb --}}
      <div class="text-sm breadcrumbs py-0">
        <ul>
          <li><a href="{{ route('guest.beranda.index') }}">Beranda</a></li>
          <li class="text-base-content/60">Blog Terkini</li>
        </ul>
      </div>

      {{-- Page Header --}}
      <div>
        <h1 class="text-4xl font-bold mb-2">{{ $page_title }}</h1>
        <p class="text-base-content/70">{{ $page_description }}</p>
      </div>
    </div>

    <div class="space-y-8">
      {{-- Search and Filter --}}
      <div class="flex flex-col md:flex-row gap-4">
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
        @foreach ($blogs as $blog)
          <div class="card bg-base-100 shadow-hover transition-shadow duration-300">
            <figure>
              <img src="{{ asset('storage/' . ($blog->primaryImage->image ?? '')) }}" alt="Article"
                class="h-48 w-full object-cover" />
            </figure>
            <div class="card-body">
              <div class="flex gap-2 text-sm flex-col">
                <div class="flex-wrap flex gap-2">
                  @foreach ($blog->categories as $cat)
                    <span class="badge badge-primary">{{ $cat->master->name }}</span>
                  @endforeach
                </div>
                <div class="flex gap-2 text-sm text-base-content/60 w-fit flex-row">
                  <span>{{ $blog->created_at->diffForHumans() }}</span>
                  <span>•</span>
                  <span>{{ number_format($blog->view_count, 0, ',', '.') }} pembaca</span>
                </div>
              </div>
              <div class="space-y-2">
                <h3 class="card-title hover:text-primary cursor-pointer">
                  <a href="{{ route('guest.blog.show', $blog->slug) }}">{{ $blog->title }}</a>
                </h3>
                <p class="text-base-content/70">{{ $blog->summary }}</p>
                <div class="flex items-center gap-2">
                  <div class="avatar">
                    <div class="w-8 rounded-full">
                      <img src="https://i.pravatar.cc/150?u={{ $blog->user->email }}" alt="Author">
                    </div>
                  </div>
                  <span class="text-sm">{{ $blog->user->name }}</span>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      {{-- Pagination --}}
      <div class="flex justify-center">
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

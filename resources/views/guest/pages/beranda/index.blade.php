@extends('guest.layouts.main')

@section('document.head')
@endsection

@section('document.body')
  {{-- Featured Post Header --}}
  <div class="space-y-12 max-w-6xl mx-auto my-12">
    <div>
      @if ($populer->count())
        <div class="grid lg:grid-cols-2 gap-8 items-center">
          {{-- Featured Post Image --}}
          <div class="relative h-56 lg:h-80 card overflow-hidden">
            <img src="{{ asset('storage/' . ($populer[0]->primaryImage->image ?? '')) }}" alt="Featured Post"
              class="w-full h-full object-cover">
            <div class="absolute top-4 left-4">
              <span class="badge badge-secondary">Blog Pilihan</span>
            </div>
          </div>
          {{-- Featured Post Content --}}
          <div class="space-y-2">
            <div class="flex gap-2 text-sm flex-col">
              <div class="flex-wrap flex gap-2">
                @foreach ($populer[0]->categories as $cat)
                  <span class="badge badge-primary">{{ $cat->master->name }}</span>
                @endforeach
              </div>
              <div class="flex gap-2 text-sm text-base-content/60 w-fit flex-row">
                <span>{{ $populer[0]->created_at->diffForHumans() }}</span>
                <span>•</span>
                <span>{{ $populer[0]->read_duration }} menit baca</span>
                <span>•</span>
                <span>{{ number_format($populer[0]->view_count, 0, ',', '.') }} pembaca</span>
              </div>
            </div>
            <div class="space-y-2">
              <h1 class="text-2xl lg:text-4xl font-bold">
                <a href="{{ route('guest.blog.show', $populer[0]->slug) }}">{{ $populer[0]->title }}</a>
              </h1>
              <p class="text-base-content/70 text-base lg:text-lg">{{ $populer[0]->summary }}</p>
              <div class="flex items-center gap-2">
                <div class="avatar">
                  <div class="w-10 rounded-full">
                    <img src="https://i.pravatar.cc/150?u={{ $populer[0]->user->email }}" alt="Author">
                  </div>
                </div>
                <span class="font-medium">{{ $populer[0]->user->name }}</span>
              </div>
            </div>
          </div>
        </div>
      @endif
    </div>

    {{-- Populer Section --}}
    <section>
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Blog Populer</h2>
        <a class="btn btn-primary" href="{{ route('guest.blog.populer.index') }}">Lihat semua</a>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($populer as $i => $blog)
          <div class="card bg-base-100 shadow-hover transition-shadow duration-300">
            <figure class="relative">
              <img src="{{ asset('storage/' . ($blog->primaryImage->image ?? '')) }}" alt="Article"
                class="h-48 w-full object-cover" />
              <div class="absolute top-2 left-2">
                <span class="badge badge-secondary">Populer #{{ $i + 1 }}</span>
              </div>
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
    </section>

    {{-- Blog Terkini with Categories --}}
    <section>
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">Blog Terkini</h2>
        <a class="btn btn-primary" href="{{ route('guest.blog.terkini.index') }}">Lihat semua</a>
      </div>
      <div class="flex items-center gap-4 mb-8 overflow-x-auto">
        <button class="btn btn-primary">Semua</button>
        <button class="btn btn-ghost">Teknologi</button>
        <button class="btn btn-ghost">Sains</button>
        <button class="btn btn-ghost">Budaya</button>
        <button class="btn btn-ghost">Bisnis</button>
      </div>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($terkini as $blog)
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
    </section>
  </div>
@endsection

@section('document.end')
@endsection

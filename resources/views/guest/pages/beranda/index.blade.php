@extends('guest.layouts.main')

@section('document.head')
@endsection

@section('document.body')
  <div class="lg:flex lg:flex-col lg:items-center my-8 lg:my-12 ">
    <div class="max-w-6xl mx-4 space-y-8 lg:space-y-12">
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
                        @if ($blog->user->profile_picture)
                          <img src="{{ asset('storage/' . $blog->user->profile_picture) }}" alt="Author">
                        @else
                          <img src="https://i.pravatar.cc/150?u={{ $blog->user->email }}" alt="Author">
                        @endif
                      </div>
                    </div>
                    <span class="text-sm">{{ $blog->user->fullname }}</span>
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
                        @if ($blog->user->profile_picture)
                          <img src="{{ asset('storage/' . $blog->user->profile_picture) }}" alt="Author">
                        @else
                          <img src="https://i.pravatar.cc/150?u={{ $blog->user->email }}" alt="Author">
                        @endif
                      </div>
                    </div>
                    <span class="text-sm">{{ $blog->user->fullname }}</span>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </section>
    </div>
  </div>
@endsection

@section('document.end')
@endsection

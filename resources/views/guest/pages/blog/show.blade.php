@extends('guest.layouts.main')

@section('document.head')
@endsection

@section('document.body')
  <div class="max-w-6xl mx-auto py-12">
    {{-- Breadcrumb --}}
    <div class="text-sm breadcrumbs mb-6">
      <ul>
        <li><a href="{{ route('guest.beranda.index') }}">Beranda</a></li>
        <li><a href="{{ route('guest.blog.terkini.index') }}">Blog Terkini</a></li>
        <li class="text-base-content/60">{{ $blog->title }}</li>
      </ul>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
      {{-- Main Content --}}
      <div class="lg:col-span-2">
        {{-- Article Header --}}
        <div class="mb-8">
          <figure class="relative">
            <img src="{{ asset('storage/' . ($blog->primaryImage->image ?? '')) }}" alt="Blog Cover"
              class="w-full max-h-[500px] object-cover card" />
          </figure>
          <div class="p-6 space-y-4">
            <div class="flex-wrap flex gap-4 text-sm flex-col">
              <div>
                @foreach ($blog->categories as $cat)
                  <span class="badge badge-primary">{{ $cat->master->name }}</span>
                @endforeach
              </div>
              <div class="flex gap-2 text-sm text-base-content/60 w-fit flex-row flex-wrap">
                <span>{{ $blog->created_at->diffForHumans() }}</span>
                <span>•</span>
                <span>{{ $blog->read_duration }} menit baca</span>
                <span>•</span>
                <span>{{ number_format($blog->view_count, 0, ',', '.') }} pembaca</span>
              </div>
            </div>


            <h1 class="text-4xl font-bold">{{ $blog->title }}</h1>

            {{-- Article Meta --}}
            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <div class="flex items-center gap-2">
                  <div class="avatar">
                    <div class="w-12 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                      @if($blog->user->profile_picture)
                        <img src="{{ asset('storage/' . $blog->user->profile_picture) }}" alt="Author" />
                      @else
                        <img src="https://i.pravatar.cc/150?u={{ $blog->user->email }}" alt="Author" />
                      @endif
                    </div>
                  </div>
                  <div>
                    <p class="font-medium">{{ $blog->user->fullname }}</p>
                    <p class="text-sm text-base-content/60">Penulis</p>
                  </div>
                </div>
              </div>
              <div class="flex gap-2">
                <button class="btn btn-ghost btn-sm" title="Bagikan"><i class="fas fa-share-alt"></i></button>
              </div>
            </div>

            {{-- Article Content --}}
            <div
              class="prose prose-lg max-w-none
                         prose-headings:text-base-content 
                         prose-p:text-base-content/70
                         prose-strong:text-base-content
                         prose-blockquote:text-base-content/70
                         prose-blockquote:border-primary
                         prose-pre:bg-base-200
                         prose-code:text-primary
                         prose-img:rounded-xl
                         prose-a:text-primary">
              {!! nl2br(e($blog->body)) !!}
            </div>
          </div>
        </div>
      </div>

      {{-- Sidebar --}}
      <div class="space-y-8">
        {{-- Author Card --}}
        <div class="card bg-base-100">
          <div class="card-body p-0 gap-4">
            <div class="flex items-center gap-4">
              <div class="avatar">
                <div class="w-16 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                  @if($blog->user->profile_picture)
                    <img src="{{ asset('storage/' . $blog->user->profile_picture) }}" alt="Author" />
                  @else
                    <img src="https://i.pravatar.cc/150?u={{ $blog->user->email }}" alt="Author" />
                  @endif
                </div>
              </div>
              <div>
                <h3 class="font-bold text-lg">{{ $blog->user->fullname }}</h3>
                <p class="text-sm text-base-content/60">{{ $blog->user->blogs()->count() }} Blog</p>
              </div>
            </div>
            <p class="text-base-content/70">{{ $blog->user->about ?? 'Penulis blog aktif.' }}</p>
            <button class="btn btn-primary w-full">Ikuti</button>
          </div>
        </div>

        <div class="card bg-base-100">
          <div class="card-body p-0">
            <h3 class="font-bold text-lg mb-4">Blog Terkait</h3>
            <div class="space-y-4">
              @for ($i = 1; $i <= 3; $i++)
                <div class="flex gap-4">
                  <img src="https://picsum.photos/100/100?random={{ $i }}" alt="Related Post"
                    class="w-24 h-24 rounded-lg object-cover" />
                  <div>
                    <h4 class="font-medium hover:text-primary cursor-pointer">Blog Terkait Tentang AI
                      #{{ $i }}</h4>
                    <p class="text-sm text-base-content/60">{{ rand(2, 5) }} hari lalu • {{ rand(3, 8) }}
                      menit baca</p>
                  </div>
                </div>
              @endfor
            </div>
          </div>
        </div>

        {{-- Popular Categories --}}
        <div class="card bg-base-100">
          <div class="card-body p-0">
            <h3 class="font-bold text-lg mb-4">Kategori Populer</h3>
            <div class="flex flex-wrap gap-2">
              @foreach (['Teknologi', 'Sains', 'Bisnis', 'Lifestyle', 'Budaya', 'Kesehatan'] as $category)
                <span class="badge badge-outline hover:badge-primary cursor-pointer">{{ $category }}</span>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('document.end')
@endsection

@extends('guest.layouts.main')

@section('document.head')
@endsection

@section('document.body')
  <div class="max-w-6xl mx-auto space-y-12 py-12">
    {{-- Breadcrumb --}}
    <div class="space-y-6">
      <div class="text-sm breadcrumbs py-0">
        <ul>
          <li><a href="{{ route('guest.beranda.index') }}">Beranda</a></li>
          <li class="text-base-content/60">Blog Populer</li>
        </ul>
      </div>

      {{-- Page Header --}}
      <div>
        <h1 class="text-4xl font-bold mb-2">{{ $page_title }}</h1>
        <p class="text-base-content/70">{{ $page_description }}</p>
      </div>
    </div>

    {{-- Top Posts Grid --}}
    <div class="grid lg:grid-rows-2 lg:grid-cols-4 gap-6 mb-12 lg:h-[600px]">
      {{-- Most Popular Post (#1) --}}
      <div class="lg:col-span-2 lg:row-span-2">
        <div class="card bg-base-100 h-full group hover:shadow-xl transition-all">
          <figure class="relative h-[450px] lg:h-full">
            <img src="https://picsum.photos/800/600?random=1" alt="Most Popular"
              class="w-full h-full object-cover card" />
            <div class="absolute inset-0 bg-gradient-to-t from-base-100 to-transparent"></div>
            <div class="absolute top-4 left-4 flex gap-2">
              <span class="badge badge-secondary">Terpopuler bulan ini</span>
            </div>
            <div class="absolute bottom-0 p-6 z-10">
              <div class="flex-wrap flex gap-2 text-sm flex-col">
                <div>
                  <span class="badge badge-primary">Teknologi</span>
                  <span class="badge badge-primary">Budaya</span>
                </div>
                <div class="flex gap-2 text-sm text-base-content/75 w-fit flex-row">
                  <span>2 hari lalu</span>
                  <span>•</span>
                  <span>3 ribu pembaca</span>
                </div>
              </div>
              <h2 class="text-2xl font-bold text-black mt-2 group-hover:text-primary transition-colors">Blog Paling
                Populer Minggu Ini</h2>
              <p class="text-black/90 line-clamp-2">Blog menarik yang telah menarik perhatian banyak pembaca minggu
                ini...</p>
              <div class="flex items-center gap-2 mt-2">
                <div class="avatar">
                  <div class="w-10 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                    <img src="https://i.pravatar.cc/150?img=1" alt="Author">
                  </div>
                </div>
                <div class="text-sm">
                  <p class="font-medium text-black">Penulis</p>
                </div>
              </div>
            </div>
          </figure>
        </div>
      </div>

      {{-- Second Most Popular (#2) --}}
      <div class="lg:col-span-2">
        <div class="card card-side bg-base-100 h-full hover:shadow-xl transition-all flex flex-col md:flex-row">
          <figure class="relative md:w-2/5 h-48 md:h-full card">
            <img src="https://picsum.photos/600/400?random=2" alt="Second Popular" class="w-full h-full object-cover" />
            <div class="absolute top-2 left-2">
              <span class="badge badge-secondary">Populer #2 bulan ini</span>
            </div>
          </figure>
          <div class="flex-1 p-6">
            <div class="flex-wrap flex gap-2 text-sm">
              <div>
                <span class="badge badge-primary">Teknologi</span>
                <span class="badge badge-primary">Budaya</span>
              </div>
              <div class="flex gap-2 text-sm text-base-content/60 w-fit flex-row">
                <span>2 hari lalu</span>
                <span>•</span>
                <span>3 ribu pembaca</span>
              </div>
            </div>
            <h3 class="text-xl font-bold mt-2 hover:text-primary cursor-pointer">Blog Populer Kedua</h3>
            <p class="text-base-content/70 line-clamp-2 mt-2">Ringkasan menarik dari blog populer kedua...</p>
            <div class="flex items-center gap-2 mt-2">
              <div class="avatar">
                <div class="w-8 rounded-full">
                  <img src="https://i.pravatar.cc/150?img=3" alt="Author">
                </div>
              </div>
              <span class="text-sm font-medium">Nama Penulis</span>
            </div>
          </div>
        </div>
      </div>

      {{-- Third Most Popular (#3) --}}
      <div class="lg:col-span-2">
        <div class="card card-side bg-base-100 h-full hover:shadow-xl transition-all flex flex-col md:flex-row">
          <figure class="relative md:w-2/5 h-48 md:h-full">
            <img src="https://picsum.photos/600/400?random=3" alt="Third Popular" class="w-full h-full object-cover" />
            <div class="absolute top-2 left-2">
              <span class="badge badge-secondary">Populer #3 bulan ini</span>
            </div>
          </figure>
          <div class="flex-1 p-6">
            <div class="flex-wrap flex gap-2 text-sm">
              <div>
                <span class="badge badge-primary">Teknologi</span>
                <span class="badge badge-primary">Budaya</span>
              </div>
              <div class="flex gap-2 text-sm text-base-content/60 w-fit flex-row">
                <span>2 hari lalu</span>
                <span>•</span>
                <span>3 ribu pembaca</span>
              </div>
            </div>
            <h3 class="text-xl font-bold mt-2 hover:text-primary cursor-pointer">Blog Populer Ketiga</h3>
            <p class="text-base-content/70 line-clamp-2 mt-2">Ringkasan menarik dari blog populer ketiga...</p>
            <div class="flex items-center gap-2 mt-2">
              <div class="avatar">
                <div class="w-8 rounded-full">
                  <img src="https://i.pravatar.cc/150?img=3" alt="Author">
                </div>
              </div>
              <span class="text-sm font-medium">Nama Penulis</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Regular Popular Posts Grid --}}
    <div class="space-y-8">
      <div class="flex items-center gap-4 overflow-x-auto">
        <button class="btn btn-primary">Sepanjang Waktu</button>
        <button class="btn btn-ghost">Minggu Ini</button>
        <button class="btn btn-ghost">Bulan Ini</button>
        <button class="btn btn-ghost">Tahun Ini</button>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($blogs as $blog)
          <div class="card bg-base-100 shadow-hover transition-shadow duration-300 ">
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
                      @if($blog->user->profile_picture)
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

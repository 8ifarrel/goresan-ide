@extends('guest.layouts.main')

@section('document.head')
@endsection

@section('document.body')
  <div class="lg:flex lg:flex-col lg:items-center my-8 lg:my-12 ">
    <div class="max-w-6xl mx-4 space-y-8 lg:space-y-12">
      <div class="space-y-6">
        {{-- Breadcrumb --}}
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
      @if ($blogs->currentPage() == 1 && $blogs->count() > 0)
        <div class="grid lg:grid-rows-2 lg:grid-cols-4 gap-6 mb-12 lg:h-[600px]">
          {{-- Most Popular Post (#1) --}}
          @php $top = $blogs->first(); @endphp
          <div class="lg:col-span-2 lg:row-span-2">
            <div class="card bg-base-100 h-full group hover:shadow-xl transition-all">
              <figure class="relative h-[450px] lg:h-full">
                <img src="{{ asset('storage/' . ($top->primaryImage->image ?? '')) }}" alt="Most Popular"
                  class="w-full h-full object-cover card" />
                <div class="absolute inset-0 bg-gradient-to-t from-base-100 to-transparent"></div>
                <div class="absolute top-4 left-4 flex gap-2">
                  <span class="badge badge-secondary">Terpopuler bulan ini</span>
                </div>
                <div class="absolute bottom-0 p-6 z-10">
                  <div class="flex-wrap flex gap-2 text-sm flex-col">
                    <div>
                      @foreach ($top->categories as $cat)
                        <span class="badge badge-primary">{{ $cat->master->name }}</span>
                      @endforeach
                    </div>
                    <div class="flex gap-2 text-sm text-base-content/75 w-fit flex-row">
                      <span>{{ $top->created_at->diffForHumans() }}</span>
                      <span>•</span>
                      <span>{{ number_format($top->view_count, 0, ',', '.') }} pembaca</span>
                    </div>
                  </div>
                  <h2 class="text-2xl font-bold text-black mt-2 group-hover:text-primary transition-colors">
                    <a href="{{ route('guest.blog.show', $top->slug) }}">{{ $top->title }}</a>
                  </h2>
                  <p class="text-black/90 line-clamp-2">{{ $top->summary }}</p>
                  <div class="flex items-center gap-2 mt-2">
                    <div class="avatar">
                      <div class="w-10 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                        @if ($top->user->profile_picture)
                          <img src="{{ asset('storage/' . $top->user->profile_picture) }}" alt="Author">
                        @else
                          <img src="https://i.pravatar.cc/150?u={{ $top->user->email }}" alt="Author">
                        @endif
                      </div>
                    </div>
                    <div class="text-sm">
                      <p class="font-medium text-black">{{ $top->user->fullname }}</p>
                    </div>
                  </div>
                </div>
              </figure>
            </div>
          </div>

          {{-- Second Most Popular (#2) --}}
          @php $second = $blogs->skip(1)->first(); @endphp
          @if ($second)
            <div class="lg:col-span-2">
              <div class="card card-side bg-base-100 h-full hover:shadow-xl transition-all flex flex-col md:flex-row">
                <figure class="relative md:w-2/5 h-48 md:h-full card">
                  <img src="{{ asset('storage/' . ($second->primaryImage->image ?? '')) }}" alt="Second Popular"
                    class="w-full h-full object-cover" />
                  <div class="absolute top-2 left-2">
                    <span class="badge badge-secondary">Populer #2 bulan ini</span>
                  </div>
                </figure>
                <div class="flex-1 p-6">
                  <div class="flex-wrap flex gap-2 text-sm">
                    <div>
                      @foreach ($second->categories as $cat)
                        <span class="badge badge-primary">{{ $cat->master->name }}</span>
                      @endforeach
                    </div>
                    <div class="flex gap-2 text-sm text-base-content/60 w-fit flex-row">
                      <span>{{ $second->created_at->diffForHumans() }}</span>
                      <span>•</span>
                      <span>{{ number_format($second->view_count, 0, ',', '.') }} pembaca</span>
                    </div>
                  </div>
                  <h3 class="text-xl font-bold mt-2 hover:text-primary cursor-pointer">
                    <a href="{{ route('guest.blog.show', $second->slug) }}">{{ $second->title }}</a>
                  </h3>
                  <p class="text-base-content/70 line-clamp-2 mt-2">{{ $second->summary }}</p>
                  <div class="flex items-center gap-2 mt-2">
                    <div class="avatar">
                      <div class="w-8 rounded-full">
                        @if ($second->user->profile_picture)
                          <img src="{{ asset('storage/' . $second->user->profile_picture) }}" alt="Author">
                        @else
                          <img src="https://i.pravatar.cc/150?u={{ $second->user->email }}" alt="Author">
                        @endif
                      </div>
                    </div>
                    <span class="text-sm font-medium">{{ $second->user->fullname }}</span>
                  </div>
                </div>
              </div>
            </div>
          @endif

          {{-- Third Most Popular (#3) --}}
          @php $third = $blogs->skip(2)->first(); @endphp
          @if ($third)
            <div class="lg:col-span-2">
              <div class="card card-side bg-base-100 h-full hover:shadow-xl transition-all flex flex-col md:flex-row">
                <figure class="relative md:w-2/5 h-48 md:h-full">
                  <img src="{{ asset('storage/' . ($third->primaryImage->image ?? '')) }}" alt="Third Popular"
                    class="w-full h-full object-cover" />
                  <div class="absolute top-2 left-2">
                    <span class="badge badge-secondary">Populer #3 bulan ini</span>
                  </div>
                </figure>
                <div class="flex-1 p-6">
                  <div class="flex-wrap flex gap-2 text-sm">
                    <div>
                      @foreach ($third->categories as $cat)
                        <span class="badge badge-primary">{{ $cat->master->name }}</span>
                      @endforeach
                    </div>
                    <div class="flex gap-2 text-sm text-base-content/60 w-fit flex-row">
                      <span>{{ $third->created_at->diffForHumans() }}</span>
                      <span>•</span>
                      <span>{{ number_format($third->view_count, 0, ',', '.') }} pembaca</span>
                    </div>
                  </div>
                  <h3 class="text-xl font-bold mt-2 hover:text-primary cursor-pointer">
                    <a href="{{ route('guest.blog.show', $third->slug) }}">{{ $third->title }}</a>
                  </h3>
                  <p class="text-base-content/70 line-clamp-2 mt-2">{{ $third->summary }}</p>
                  <div class="flex items-center gap-2 mt-2">
                    <div class="avatar">
                      <div class="w-8 rounded-full">
                        @if ($third->user->profile_picture)
                          <img src="{{ asset('storage/' . $third->user->profile_picture) }}" alt="Author">
                        @else
                          <img src="https://i.pravatar.cc/150?u={{ $third->user->email }}" alt="Author">
                        @endif
                      </div>
                    </div>
                    <span class="text-sm font-medium">{{ $third->user->fullname }}</span>
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>
      @endif

      {{-- Regular Popular Posts Grid --}}
      <div class="space-y-8">
        <div class="flex items-center gap-4 overflow-x-auto">
          <a href="{{ route('guest.blog.populer.index', ['filter' => 'all']) }}"
            class="btn {{ ($filter ?? 'month') === 'all' ? 'btn-primary' : 'btn-ghost' }}">
            Sepanjang Waktu
          </a>
          <a href="{{ route('guest.blog.populer.index', ['filter' => 'week']) }}"
            class="btn {{ ($filter ?? 'month') === 'week' ? 'btn-primary' : 'btn-ghost' }}">
            Minggu Ini
          </a>
          <a href="{{ route('guest.blog.populer.index', ['filter' => 'month']) }}"
            class="btn {{ ($filter ?? 'month') === 'month' ? 'btn-primary' : 'btn-ghost' }}">
            Bulan Ini
          </a>
          <a href="{{ route('guest.blog.populer.index', ['filter' => 'year']) }}"
            class="btn {{ ($filter ?? 'month') === 'year' ? 'btn-primary' : 'btn-ghost' }}">
            Tahun Ini
          </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @if ($blogs->currentPage() == 1)
            @foreach ($blogs->skip(3) as $blog)
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
          @else
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
          @endif
        </div>

        {{-- Pagination --}}
        <div class="flex justify-center mt-8">
          <div class="join">
            {{-- Previous Page --}}
            @if ($blogs->onFirstPage())
              <button class="join-item btn btn-ghost" disabled>&laquo;</button>
            @else
              <a href="{{ $blogs->previousPageUrl() }}" class="join-item btn btn-ghost">&laquo;</a>
            @endif

            {{-- Page Numbers --}}
            @for ($i = 1; $i <= $blogs->lastPage(); $i++)
              @if ($i == $blogs->currentPage())
                <button class="join-item btn btn-primary">{{ $i }}</button>
              @elseif ($i == 1 || $i == $blogs->lastPage() || ($i >= $blogs->currentPage() - 1 && $i <= $blogs->currentPage() + 1))
                <a href="{{ $blogs->url($i) }}" class="join-item btn btn-ghost">{{ $i }}</a>
              @elseif ($i == 2 && $blogs->currentPage() > 4)
                <span class="join-item btn btn-ghost" disabled>...</span>
              @elseif ($i == $blogs->lastPage() - 1 && $blogs->currentPage() < $blogs->lastPage() - 3)
                <span class="join-item btn btn-ghost" disabled>...</span>
              @endif
            @endfor

            {{-- Next Page --}}
            @if ($blogs->hasMorePages())
              <a href="{{ $blogs->nextPageUrl() }}" class="join-item btn btn-ghost">&raquo;</a>
            @else
              <button class="join-item btn btn-ghost" disabled>&raquo;</button>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('document.end')
@endsection

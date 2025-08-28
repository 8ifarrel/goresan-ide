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
        <form method="GET" action="{{ route('guest.blog.terkini.index') }}" class="flex flex-col md:flex-row gap-4"
          id="filterForm">
          <div class="flex-1">
            <div class="join w-full md:max-w-md">
              <input type="text" name="search" value="{{ $search }}" placeholder="Cari blog..."
                class="input input-bordered join-item flex-1" />
              <button class="btn btn-primary join-item" type="submit"><i class="fas fa-search"></i></button>
            </div>
          </div>
          <div class="dropdown dropdown-end ">
            <label tabindex="0" class="btn btn-outline btn-sm flex items-center gap-2">
              <i class="fa fa-filter"></i>
              <span>Filter Kategori</span>
              <i class="fa fa-chevron-down text-xs"></i>
            </label>
            <div tabindex="0" class="dropdown-content z-[1] bg-base-100 rounded-box shadow p-4 mt-2 min-w-[220px]">
              <div class="flex flex-wrap gap-2 items-center">
                <label class="cursor-pointer flex items-center gap-2 w-full">
                  <input type="radio" id="category-all" name="category" value="" class="checkbox"
                    {{ empty($selectedCategory) || count($selectedCategory) === $categories->count() ? 'checked' : '' }}>
                  <span class="label-text">Semua</span>
                </label>
                @foreach ($categories as $cat)
                  <label class="cursor-pointer flex items-center gap-2 w-full">
                    <input type="checkbox" name="category[]" value="{{ $cat->name }}" class="checkbox category-item"
                      @if (empty($selectedCategory) ||
                              count($selectedCategory) === $categories->count() ||
                              (is_array(request()->category ?? null) && in_array($cat->name, request()->category ?? []))) checked @endif>
                    <span class="label-text">{{ $cat->name }}</span>
                  </label>
                @endforeach
              </div>
            </div>
          </div>
        </form>

        {{-- Blog Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          @forelse ($blogs as $blog)
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
          @empty
            <div class="col-span-3 text-center text-base-content/60 py-12">Tidak ada blog ditemukan.</div>
          @endforelse
        </div>

        {{-- Pagination --}}
        <div class="flex justify-center">
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
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const form = document.getElementById('filterForm');
      const allRadio = document.getElementById('category-all');
      const categoryCheckboxes = Array.from(document.querySelectorAll('.category-item'));

      // Saat load: jika "Semua" checked, uncheck semua kategori
      if (allRadio && allRadio.checked) {
        categoryCheckboxes.forEach(cb => cb.checked = false);
      }

      // Jika "Semua" di-check, uncheck semua kategori
      if (allRadio) {
        allRadio.addEventListener('change', function() {
          if (this.checked) {
            categoryCheckboxes.forEach(cb => cb.checked = false);
          }
          form.submit();
        });
      }

      // Jika salah satu kategori di-check, uncheck "Semua"
      categoryCheckboxes.forEach(cb => {
        cb.addEventListener('change', function() {
          if (categoryCheckboxes.some(c => c.checked)) {
            if (allRadio) allRadio.checked = false;
          } else {
            if (allRadio) allRadio.checked = true;
          }
          form.submit();
        });
      });
    });
  </script>
@endsection

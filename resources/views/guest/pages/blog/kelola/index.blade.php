@extends('guest.layouts.main')

@section('document.head')
  @vite(['resources/css/datatables.css', 'resources/js/datatables.js'])
@endsection

@section('document.body')
  <div class="lg:flex lg:flex-col lg:items-center my-8 lg:my-12 ">
    <div class="max-w-6xl mx-4 space-y-8 lg:space-y-12">
      <div class="mb-6">
        <div class="space-y-6">
          {{-- Breadcrumb --}}
          <div class="text-sm breadcrumbs py-0">
            <ul>
              <li><a href="{{ route('guest.beranda.index') }}">Beranda</a></li>
              <li class="text-base-content/60">Blog Saya</li>
            </ul>
          </div>

          <div class="flex items-center justify-between">
            {{-- Page Header --}}
            <div>
              <h1 class="text-4xl font-bold mb-2">{{ $page_title }}</h1>
              <p class="text-base-content/70">{{ $page_description }}</p>
            </div>
            <a href="{{ route('guest.blog.kelola.create') }}" class="btn btn-primary">+ Buat Blog</a>
          </div>
        </div>
      </div>
      @if (session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
      @endif

      {{-- Table for desktop --}}
      <div class="hidden md:block overflow-x-auto w-full">
        <div class="min-w-[700px]">
          <table class="table w-full" id="datatable-blog">
            <thead>
              <tr>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Dibuat</th>
                <th>View</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($blogs as $blog)
                <tr>
                  <td>
                    <div class="flex items-center gap-2">
                      <img src="{{ asset('storage/' . ($blog->primaryImage->image ?? '')) }}"
                        class="w-12 h-12 object-cover rounded-lg" alt="">
                      <div>
                        <div class="font-semibold">{{ $blog->title }}</div>
                        <div class="text-xs text-base-content/60">{{ $blog->summary }}</div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <div class="flex gap-y-1 flex-col">
                      @foreach ($blog->categories as $cat)
                        <span class="badge badge-primary">{{ $cat->master->name }}</span>
                      @endforeach
                    </div>
                  </td>
                  <td>{{ $blog->created_at->format('d M Y') }}</td>
                  <td>{{ number_format($blog->view_count, 0, ',', '.') }}</td>
                  <td>
                    <div class="flex gap-y-1 flex-col">
                      <a href="{{ route('guest.blog.kelola.edit', $blog->id) }}"
                        class="btn btn-sm btn-warning w-full text-center">
                        Edit
                      </a>
                      <form action="{{ route('guest.blog.kelola.destroy', $blog->id) }}" method="POST"
                        class="inline w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-error w-full text-center"
                          onclick="return confirm('Yakin hapus blog ini?')">
                          Hapus
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      {{-- Card list for mobile --}}
      <div class="block md:hidden space-y-4">
        @foreach ($blogs as $blog)
          <div class="card bg-base-100 shadow p-4 flex flex-col gap-2">
            <div class="flex items-center gap-3">
              <img src="{{ asset('storage/' . ($blog->primaryImage->image ?? '')) }}"
                class="w-16 h-16 object-cover rounded-lg" alt="">
              <div>
                <div class="font-semibold text-lg">{{ $blog->title }}</div>
                <div class="text-xs text-base-content/60">{{ $blog->summary }}</div>
              </div>
            </div>
            <div class="flex flex-wrap gap-1">
              @foreach ($blog->categories as $cat)
                <span class="badge badge-primary">{{ $cat->master->name }}</span>
              @endforeach
            </div>
            <div class="flex justify-between text-xs text-base-content/60">
              <span>{{ $blog->created_at->format('d M Y') }}</span>
              <span>{{ number_format($blog->view_count, 0, ',', '.') }} views</span>
            </div>
            <div class="flex gap-2 mt-2">
              <a href="{{ route('guest.blog.kelola.edit', $blog->id) }}" class="btn btn-sm btn-warning flex-1">Edit</a>
              <form action="{{ route('guest.blog.kelola.destroy', $blog->id) }}" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-error w-full"
                  onclick="return confirm('Yakin hapus blog ini?')">Hapus</button>
              </form>
            </div>
          </div>
        @endforeach
      </div>
      <div class="mt-6">
        {{-- {{ $blogs->links() }} --}}
      </div>
    </div>
  </div>
@endsection

@section('document.end')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      if (window.innerWidth >= 768) {
        $('#datatable-blog').DataTable({
          responsive: true,
          language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {
              first: "Awal",
              last: "Akhir",
              next: ">",
              previous: "<"
            },
            zeroRecords: "Tidak ada data ditemukan"
          },
          "ordering": false
        });
      }
    });
  </script>
@endsection

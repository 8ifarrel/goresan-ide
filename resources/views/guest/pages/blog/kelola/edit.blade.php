@extends('guest.layouts.main')

@section('document.body')
  <div class="max-w-2xl mx-auto my-8 lg:my-12 px-4">
    <div class="space-y-6 mb-6">
      {{-- Breadcrumb --}}
      <div class="text-sm breadcrumbs py-0">
        <ul>
          <li><a href="{{ route('guest.beranda.index') }}">Beranda</a></li>
          <li><a href="{{ route('guest.blog.kelola.index') }}">Blog Saya</a></li>
          <li class="text-base-content/60">Edit Blog</li>
        </ul>
      </div>

      {{-- Page Header --}}
      <div>
        <h1 class="text-4xl font-bold mb-2">{{ $page_title }}</h1>
        <p class="text-base-content/70">{{ $page_description }}</p>
      </div>
    </div>

    @if ($errors->any())
      <div class="alert alert-error mb-4">
        <ul class="list-disc pl-5">
          @foreach ($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <form method="POST" action="{{ route('guest.blog.kelola.update', $blog->id) }}" enctype="multipart/form-data"
      class="space-y-6">
      @csrf
      @method('PUT')
      <div>
        <label class="label font-semibold">Judul</label>
        <input type="text" name="title" class="input input-bordered w-full" value="{{ old('title', $blog->title) }}"
          required>
        <span class="text-xs text-base-content/60">Maksimal 256 karakter</span>
      </div>
      <div>
        <label class="label font-semibold">Ringkasan</label>
        <input type="text" name="summary" class="input input-bordered w-full" maxlength="155"
          value="{{ old('summary', $blog->summary) }}" required>
        <span class="text-xs text-base-content/60">Maksimal 155 karakter</span>
      </div>
      <div>
        <label class="label font-semibold">Isi Blog</label>
        <div id="quill-editor" style="min-height: 200px;">{!! old('body', $blog->body) !!}</div>
        <input type="hidden" id="body" name="body" value="{!! old('body', $blog->body) !!}">
      </div>
      <div>
        <label class="label font-semibold">Durasi Baca (menit)</label>
        <input type="number" name="read_duration" class="input input-bordered w-full" min="1" max="60"
          value="{{ old('read_duration', $blog->read_duration) }}" required>
      </div>
      <div>
        <label class="label font-semibold">Kategori</label>
        <div class="flex flex-wrap gap-2">
          @foreach ($categories as $cat)
            <label class="cursor-pointer flex items-center gap-2">
              <input type="checkbox" name="categories[]" value="{{ $cat->id }}" class="checkbox checkbox-primary"
                @if (in_array($cat->id, old('categories', $selectedCategories))) checked @endif>
              <span class="label-text">{{ $cat->name }}</span>
            </label>
          @endforeach
        </div>
        <span class="text-xs text-base-content/60">Pilih 1 atau lebih kategori</span>
      </div>
      <div>
        <label class="label font-semibold">Gambarw</label>
        <input type="file" name="primary_image" class="file-input file-input-bordered w-full" accept="image/*">
        @if ($blog->primaryImage)
          <img src="{{ asset('storage/' . $blog->primaryImage->image) }}" class="w-32 mt-2" alt="Gambar">
        @endif
      </div>
      <div class="flex gap-2">
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('guest.blog.kelola.index') }}" class="btn btn-ghost">Batal</a>
      </div>
    </form>
  </div>
@endsection

@section('document.end')
  @vite(['resources/css/quill.css', 'resources/js/quill.js'])
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var quill = new Quill('#quill-editor', {
        theme: 'snow',
        placeholder: 'Tulis isi blog di sini...'
      });

      quill.root.innerHTML = `{!! old('body', $blog->body) !!}`;

      quill.on('text-change', function() {
        document.getElementById('body').value = quill.root.innerHTML;
      });

      document.querySelector('form').addEventListener('submit', function(e) {
        document.getElementById('body').value = quill.root.innerHTML;
        var plain = quill.getText().trim();
        if (!plain) {
          alert('Isi blog wajib diisi.');
          e.preventDefault();
        }
      });
    });
  </script>
@endsection

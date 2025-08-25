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
          <li><a href="{{ route('guest.blog.terkini.index') }}">Blog Terkini</a></li>
          <li class="text-base-content/60">Masa Depan Kecerdasan Buatan dalam Masyarakat Modern</li>
        </ul>
      </div>

      <div class="grid lg:grid-cols-3 gap-8">
        {{-- Main Content --}}
        <div class="lg:col-span-2">
          {{-- Article Header --}}
          <div class="card bg-base-100 mb-8">
            <figure class="relative">
              <img src="https://picsum.photos/1200/600" alt="Blog Cover" class="w-full max-h-[500px] object-cover card" />
            </figure>
            <div class="card-body">
              <div class="flex-wrap flex gap-2 text-sm flex-col">
                <div>
                  <span class="badge badge-primary">Teknologi</span>
                  <span class="badge badge-primary">Budaya</span>
                </div>
                <div class="flex gap-2 text-sm text-base-content/60 w-fit flex-row flex-wrap">
                  <span>2 hari lalu</span>
                  <span>•</span>
                  <span>5 menit baca</span>
                  <span>•</span>
                  <span>3 ribu pembaca</span>
                  {{-- <span>•</span>
                  <span>Diperbarui 1 hari lalu</span> --}}
                </div>
              </div>

              <h1 class="text-4xl font-bold">Masa Depan Kecerdasan Buatan dalam Masyarakat Modern</h1>

              {{-- Article Meta --}}
              <div class="flex items-center justify-between mb-6 mt-2">
                <div class="flex items-center gap-4">
                  <div class="flex items-center gap-2">
                    <div class="avatar">
                      <div class="w-12 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                        <img src="https://i.pravatar.cc/150?img=1" alt="Author" />
                      </div>
                    </div>
                    <div>
                      <p class="font-medium">Farrel Sirah</p>
                      <p class="text-sm text-base-content/60">Penulis</p>
                    </div>
                  </div>
                </div>
                <div class="flex gap-2">
                  {{-- <button class="btn btn-ghost btn-sm" title="Simpan"><i class="fas fa-bookmark"></i></button> --}}
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
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam voluptatibus, voluptatum, quae, quos
                  voluptates quia voluptas quidem voluptate doloribus quibusdam dolorum. Quisquam voluptatibus,
                  voluptatum, quae, quos voluptates quia voluptas quidem voluptate doloribus quibusdam dolorum.</p>

                <h2>Subtitle Pertama</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam voluptatibus, voluptatum, quae, quos
                  voluptates quia voluptas quidem voluptate doloribus quibusdam dolorum.</p>

                <h2>Subtitle Kedua</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam voluptatibus, voluptatum, quae, quos
                  voluptates quia voluptas quidem voluptate doloribus quibusdam dolorum.</p>

                <blockquote>
                  "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam voluptatibus, voluptatum, quae, quos
                  voluptates quia voluptas quidem voluptate doloribus quibusdam dolorum."
                </blockquote>

                <h2>Kesimpulan</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam voluptatibus, voluptatum, quae, quos
                  voluptates quia voluptas quidem voluptate doloribus quibusdam dolorum.</p>
              </div>
            </div>
          </div>

          {{-- Comments Section --}}
          <div class="card bg-base-100">
            <div class="card-body">
              <h3 class="text-xl font-bold mb-6">Komentar (12)</h3>

              {{-- Comment Form --}}
              <div class="flex gap-4 mb-8">
                <div class="avatar">
                  <div class="w-12 h-12 rounded-full">
                    <img src="https://i.pravatar.cc/150?img=2" alt="User" />
                  </div>
                </div>
                <div class="flex-1">
                  <textarea class="textarea textarea-bordered w-full" placeholder="Tulis komentar..."></textarea>
                  <button class="btn btn-primary mt-2">Kirim Komentar</button>
                </div>
              </div>

              {{-- Comments List --}}
              <div class="space-y-6">
                @for ($i = 1; $i <= 3; $i++)
                  <div class="flex gap-4">
                    <div class="avatar">
                      <div class="w-10 h-10 rounded-full">
                        <img src="https://i.pravatar.cc/150?img={{ $i + 2 }}" alt="Commenter" />
                      </div>
                    </div>
                    <div>
                      <div class="flex items-center gap-2 mb-1">
                        <span class="font-medium">Nama Komentator</span>
                        <span class="text-sm text-base-content/60">{{ rand(1, 24) }} jam lalu</span>
                      </div>
                      <p class="text-base-content/80">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam
                        voluptatibus.</p>
                      <div class="flex items-center gap-4 mt-2">
                        <button class="text-sm text-base-content/60 hover:text-primary"><i class="fas fa-reply"></i>
                          Balas</button>
                        <button class="text-sm text-base-content/60 hover:text-primary"><i class="fas fa-heart"></i>
                          Suka</button>
                      </div>
                    </div>
                  </div>
                @endfor
              </div>

              <div class="text-center mt-6">
                <button class="btn btn-ghost">Lihat Komentar Lainnya</button>
              </div>
            </div>
          </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-8">
          {{-- Author Card --}}
          <div class="card bg-base-100">
            <div class="card-body">
              <div class="flex items-center gap-4 mb-4">
                <div class="avatar">
                  <div class="w-16 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                    <img src="https://i.pravatar.cc/150?img=1" alt="Author" />
                  </div>
                </div>
                <div>
                  <h3 class="font-bold text-lg">Farrel Sirah</h3>
                  <p class="text-sm text-base-content/60">120 Blog • 1.2K Pengikut</p>
                </div>
              </div>
              <p class="text-base-content/70 mb-4">Penulis teknologi yang fokus pada AI dan perkembangan teknologi modern.
              </p>
              <button class="btn btn-primary w-full">Ikuti</button>
            </div>
          </div>

          {{-- Related Posts --}}
          <div class="card bg-base-100">
            <div class="card-body">
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
            <div class="card-body">
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
  </div>
@endsection

@section('document.end')
@endsection

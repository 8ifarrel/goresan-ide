<div class="navbar bg-base-100 shadow-sm">
  <div class="navbar-start">
    <div class="dropdown">
      <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
        </svg>
      </div>
      <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
        <li><a href="{{ route('guest.beranda.index') }}">Beranda</a></li>
        {{-- <li>
          <a>Parent</a>
          <ul class="p-2">
            <li><a>Submenu 1</a></li>
            <li><a>Submenu 2</a></li>
          </ul>
        </li> --}}
        <li><a href="{{ route('guest.blog.populer.index') }}">Populer</a></li>
        <li><a href="{{ route('guest.blog.terkini.index') }}">Terkini</a></li>
      </ul>
    </div>
    <a class="btn btn-ghost">
      <img src="{{ asset('images/logos/goresan-ide_logotype-horizontal.png') }}" alt=""
        class="inline h-8 mr-2" />
    </a>
  </div>
  <div class="navbar-center hidden lg:flex">
    <ul class="menu menu-horizontal px-1">
      <li><a href="{{ route('guest.beranda.index') }}">Beranda</a></li>
      {{-- <li>
        <details>
          <summary>Parent</summary>
          <ul class="p-2">
            <li><a class="text-nowrap">Submenu 1</a></li>
            <li><a class="text-nowrap">Submenu 2</a></li>
          </ul>
        </details>
      </li> --}}
      <li><a href="{{ route('guest.blog.populer.index') }}">Populer</a></li>
      <li><a href="{{ route('guest.blog.terkini.index') }}">Terkini</a></li>
    </ul>
  </div>
  <div class="navbar-end">
    @auth
      <div class="dropdown dropdown-end">
        <div tabindex="0" role="button" class="btn btn-ghost flex items-center gap-2">
          <div class="avatar">
            <div class="w-8 rounded-full">
              @if(auth()->user()->profile_picture)
                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile">
              @else
                <img src="https://i.pravatar.cc/150?u={{ auth()->user()->email }}" alt="Profile">
              @endif
            </div>
          </div>
          <span class="hidden md:inline">{{ auth()->user()->fullname }}</span>
          <i class="fa fa-chevron-down text-xs"></i>
        </div>
        <ul tabindex="0" class="dropdown-content menu menu-sm bg-base-100 shadow mt-3 w-44 p-2 z-10">
          <li><a href="{{ route('guest.blog.kelola.create') }}">Buat Blog</a></li>
          <li><a href="{{ route('guest.blog.kelola.index') }}">Blog Saya</a></li>
          <li><a href="{{ route('guest.profil.edit') }}">Profil</a></li>
          <li>
            <form method="POST" action="{{ route('guest.logout') }}">
              @csrf
              <button type="submit" class="w-full text-left">Keluar</button>
            </form>
          </li>
        </ul>
      </div>
    @else
      <a class="btn btn-primary" href="{{ route('guest.login') }}"><i class="fa-solid fa-circle-user"></i>Masuk</a>
    @endauth
  </div>
</div>

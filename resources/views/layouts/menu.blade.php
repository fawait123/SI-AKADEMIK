<li class="sidebar-menu-title">DASHBOARD</li>
<li>
    <a href="{{route('home')}}" class="navItem {{Request::is('home') ? 'active' : ''}}">
        <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="uil:dashboard"></iconify-icon>
            <span>DASHBOARD</span>
        </span>
    </a>
</li>

@if(auth()->user()->namespace == null)
    <li class="sidebar-menu-title">MASTER DATA</li>
    <li>
        <a href="{{route('guru.index')}}" class="navItem {{Request::is('guru*') ? 'active' : ''}}">
        <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="mdi:teach"></iconify-icon>
            <span>GURU</span>
        </span>
        </a>
    </li>
    <li>
        <a href="{{route('user.index')}}" class="navItem {{Request::is('user*') ? 'active' : ''}}">
        <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="mdi:user"></iconify-icon>
            <span>USER</span>
        </span>
        </a>
    </li>
    <li>
        <a href="{{route('tahun-akademik.index')}}" class="navItem {{Request::is('tahun-akademik*') ? 'active' : ''}}">
        <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="mdi:calendar"></iconify-icon>
            <span>TAHUN AKADEMIK</span>
        </span>
        </a>
    </li>
    <li>
        <a href="{{route('wali-kelas.index')}}" class="navItem {{Request::is('wali-kelas*') ? 'active' : ''}}">
        <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="iconoir:people-tag"></iconify-icon>
            <span>WALI KELAS</span>
        </span>
        </a>
    </li>
    <li>
        <a href="{{route('siswa.index')}}" class="navItem {{Request::is('siswa*') ? 'active' : ''}}">
        <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="ph:student"></iconify-icon>
            <span>SISWA</span>
        </span>
        </a>
    </li>
    <li>
        <a href="{{route('kelas-siswa.index')}}" class="navItem {{Request::is('kelas-siswa*') ? 'active' : ''}}">
        <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="cil:room"></iconify-icon>
            <span>KELAS SISWA</span>
        </span>
        </a>
    </li>
    <li>
        <a href="{{route('mapel.index')}}" class="navItem {{Request::is('mapel*') ? 'active' : ''}}">
        <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="material-symbols:menu-book"></iconify-icon>
            <span>MAPEL</span>
        </span>
        </a>
    </li>
    <li>
        <a href="{{route('sesi.index')}}" class="navItem {{Request::is('sesi*') ? 'active' : ''}}">
        <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="ri:time-fill"></iconify-icon>
            <span>SESI</span>
        </span>
        </a>
    </li>
@endif

@if(auth()->user()->namespace == "\App\Models\Guru")
    <li class="sidebar-menu-title">GURU</li>
    <li>
        <a href="{{route('guru.mapel')}}" class="navItem {{Request::is('guru.mapel*') ? 'active' : ''}}">
        <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="mdi:teach"></iconify-icon>
            <span>MATAPELAJARAN</span>
        </span>
        </a>
    </li>
@endif

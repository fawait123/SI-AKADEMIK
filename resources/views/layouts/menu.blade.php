<li class="sidebar-menu-title">DASHBOARD</li>
<li>
    <a href="{{route('home')}}" class="navItem {{Request::is('home') ? 'active' : ''}}">
        <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="heroicons-outline:chat"></iconify-icon>
            <span>DASHBOARD</span>
        </span>
    </a>
</li>

<li class="sidebar-menu-title">MASTER DATA</li>
<li>
    <a href="{{route('guru.index')}}" class="navItem {{Request::is('guru*') ? 'active' : ''}}">
        <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="heroicons-outline:chat"></iconify-icon>
            <span>GURU</span>
        </span>
    </a>
</li>
<li>
    <a href="{{route('user.index')}}" class="navItem {{Request::is('user*') ? 'active' : ''}}">
        <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="heroicons-outline:chat"></iconify-icon>
            <span>USER</span>
        </span>
    </a>
</li>
<li>
    <a href="{{route('tahun-akademik.index')}}" class="navItem {{Request::is('tahun-akademik*') ? 'active' : ''}}">
        <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="heroicons-outline:chat"></iconify-icon>
            <span>TAHUN AKADEMIK</span>
        </span>
    </a>
</li>
<li>
    <a href="{{route('wali-kelas.index')}}" class="navItem {{Request::is('wali-kelas*') ? 'active' : ''}}">
        <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="heroicons-outline:chat"></iconify-icon>
            <span>WALI KELAS</span>
        </span>
    </a>
</li>
<li>
    <a href="{{route('siswa.index')}}" class="navItem {{Request::is('siswa*') ? 'active' : ''}}">
        <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="heroicons-outline:chat"></iconify-icon>
            <span>SISWA</span>
        </span>
    </a>
</li>
<li>
    <a href="{{route('kelas-siswa.index')}}" class="navItem {{Request::is('kelas-siswa*') ? 'active' : ''}}">
        <span class="flex items-center">
            <iconify-icon class="nav-icon" icon="heroicons-outline:chat"></iconify-icon>
            <span>KELAS SISWA</span>
        </span>
    </a>
</li>

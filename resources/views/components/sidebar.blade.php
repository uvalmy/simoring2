<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/" class="text-nowrap logo-img mx-auto my-3 pt-2">
                <img src="{{ asset('images/logos/logo.png') }}" width="100" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                @auth
                    @if (auth()->user()->role == 'admin')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/staff" aria-expanded="false">
                                <i class="ti ti-layout-dashboard"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/staff/jurusan" aria-expanded="false">
                                <i class="ti ti-tools"></i>
                                <span class="hide-menu">Jurusan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/staff/kelas" aria-expanded="false">
                                <i class="ti ti-school"></i>
                                <span class="hide-menu">Kelas</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/staff/guru" aria-expanded="false">
                                <i class="ti ti-user"></i>
                                <span class="hide-menu">Guru</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/staff/siswa" aria-expanded="false">
                                <i class="ti ti-users"></i>
                                <span class="hide-menu">Siswa</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/staff/dudi" aria-expanded="false">
                                <i class="ti ti-building"></i>
                                <span class="hide-menu">Dudi</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/staff/cp" aria-expanded="false">
                                <i class="ti ti-book"></i>
                                <span class="hide-menu">Cp</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->is('staff/pkl/*') ? 'active' : '' }}" href="/staff/pkl" aria-expanded="false">
                                <i class="ti ti-news"></i>
                                <span class="hide-menu">Pkl</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/staff/pengaturan" aria-expanded="false">
                                <i class="ti ti-settings"></i>
                                <span class="hide-menu">Pengaturan</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/staff/profile" aria-expanded="false">
                                <i class="ti ti-user-circle"></i>
                                <span class="hide-menu">Profile</span>
                            </a>
                        </li>
                    @elseif(auth()->user()->role == 'guru_pembimbing')
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/guru" aria-expanded="false">
                                <i class="ti ti-layout-dashboard"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->is('guru/pkl/*') ? 'active' : '' }}" href="/guru/pkl" aria-expanded="false">
                                <i class="ti ti-news"></i>
                                <span class="hide-menu">Pkl</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/guru/laporan-harian" aria-expanded="false">
                                <i class="ti ti-file-description"></i>
                                <span class="hide-menu">Laporan Harian</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->is('guru/laporan-proyek/*') ? 'active' : '' }}"
                                href="/guru/laporan-proyek" aria-expanded="false">
                                <i class="ti ti-file-description"></i>
                                <span class="hide-menu">Laporan Proyek</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link {{ request()->is('guru/laporan-akhir/*') ? 'active' : '' }}"
                                href="/guru/laporan-akhir" aria-expanded="false">
                                <i class="ti ti-file-description"></i>
                                <span class="hide-menu">Laporan Akhir</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/guru/profile" aria-expanded="false">
                                <i class="ti ti-user-circle"></i>
                                <span class="hide-menu">Profile</span>
                            </a>
                        </li>
                    @endif
                @endauth
                @if (auth('dudi')->user() && !auth('web')->check())
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/dudi" aria-expanded="false">
                            <i class="ti ti-layout-dashboard"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('dudi/pkl/*') ? 'active' : '' }}" href="/dudi/pkl" aria-expanded="false">
                            <i class="ti ti-news"></i>
                            <span class="hide-menu">Pkl</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link " href="/dudi/laporan-harian" aria-expanded="false">
                            <i class="ti ti-file-description"></i>
                            <span class="hide-menu">Laporan Harian</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('dudi/laporan-proyek/*') ? 'active' : '' }}"
                            href="/dudi/laporan-proyek" aria-expanded="false">
                            <i class="ti ti-file-description"></i>
                            <span class="hide-menu">Laporan Proyek</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/dudi/profile" aria-expanded="false">
                            <i class="ti ti-user-circle"></i>
                            <span class="hide-menu">Profile</span>
                        </a>
                    </li>
                @elseif (auth('siswa')->user() && !auth('web')->check())
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/siswa" aria-expanded="false">
                            <i class="ti ti-layout-dashboard"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('siswa/laporan-harian/*') ? 'active' : '' }}"
                            href="/siswa/laporan-harian" aria-expanded="false">
                            <i class="ti ti-file-description"></i>
                            <span class="hide-menu">Laporan Harian</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('siswa/laporan-proyek/*') ? 'active' : '' }}"
                            href="/siswa/laporan-proyek" aria-expanded="false">
                            <i class="ti ti-file-description"></i>
                            <span class="hide-menu">Laporan Proyek</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('siswa/laporan-akhir/*') ? 'active' : '' }}"
                            href="/siswa/laporan-akhir" aria-expanded="false">
                            <i class="ti ti-file-description"></i>
                            <span class="hide-menu">Laporan Akhir</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/siswa/profile" aria-expanded="false">
                            <i class="ti ti-user-circle"></i>
                            <span class="hide-menu">Profile</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</aside>

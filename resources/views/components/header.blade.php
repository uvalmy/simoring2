<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                    <i class="ti ti-bell-ringing"></i>
                    <div class="notification bg-primary rounded-circle"></div>
                </a>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="fw-semibold me-3 text-capitalize">
                    @php
                        $role = auth()->user()->role;
                        $roleParts = explode('_', $role);
                        $formattedRole = implode(' ', $roleParts);
                    @endphp
                    {{ auth()->user()->nama }} | {{ $formattedRole }}
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('images/profile/user-1.jpg') }}" alt="" width="35" height="35"
                            class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body">
                            @if(auth()->user()->role == 'admin')
                                <a href="/staff/profile" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-user-circle fs-6"></i>
                                    <p class="mb-0 fs-3">Profile</p>
                                </a>
                            @elseif(auth()->user()->role == 'guru_pembimbing')
                                <a href="/guru/profile" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-user-circle fs-6"></i>
                                    <p class="mb-0 fs-3">Profile</p>
                                </a>
                            @elseif(auth()->user()->role == 'tata_usaha')
                                <a href="/guru/profile" class="d-flex align-items-center gap-2 dropdown-item">
                                    <i class="ti ti-user-circle fs-6"></i>
                                    <p class="mb-0 fs-3">Profile</p>
                                </a>
                            @endif

                            <a href="{{ route('logout') }}" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            <li>
                <a href="/staff" class="ai-icon {{ Request::is('staff')? 'active' : '' }}" aria-expanded="false">
                    <i class="flaticon-144-layout"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/staff/jurusan" class="ai-icon {{ Request::is('staff/jurusan')? 'active' : '' }}" aria-expanded="false">
                    <i class="las la-sitemap"></i>
                    <span class="nav-text">Jurusan</span>
                </a>
            </li>
            <li>
                <a href="/staff/kelas" class="ai-icon {{ Request::is('staff/kelas')? 'active' : '' }}" aria-expanded="false">
                    <i class="la la-person-booth"></i>
                    <span class="nav-text">Kelas</span>
                </a>
            </li>
            <li>
                <a href="/staff/guru" class="ai-icon {{ Request::is('staff/guru')? 'active' : '' }}" aria-expanded="false">
                    <i class="la la-user"></i>
                    <span class="nav-text">Guru</span>
                </a>
            </li>
            <li>
                <a href="/staff/siswa" class="ai-icon {{ Request::is('staff/siswa')? 'active' : '' }}" aria-expanded="false">
                    <i class="la la-users"></i>
                    <span class="nav-text">Siswa</span>
                </a>
            </li>
            <li>
                <a href="/staff/dudi" class="ai-icon {{ Request::is('staff/dudi')? 'active' : '' }}" aria-expanded="false">
                    <i class="la la-user-tie"></i>
                    <span class="nav-text">Dudi</span>
                </a>
            </li>
            <li>
                <a href="/staff/profile" class="ai-icon {{ Request::is('staff/profile')? 'active' : '' }}" aria-expanded="false">
                    <i class="la la-user-circle"></i>
                    <span class="nav-text">Profile</span>
                </a>
            </li>
        </ul>
        <div class="copyright text-center">
            <p>Simoring {{ date('Y') }}</p>
        </div>
    </div>
</div>

<div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
        <li class="nav-header">
            <div class="dropdown profile-element">
                <!-- <img src="{{asset('img/admin.jpg')}}" style="width: 60px;" alt="image" class="rounded-circle"> -->
                <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                    <span class="block m-t-xs font-bold">{{auth()->user()->name}}</span>
                    <span class="text-muted text-xs block">{{ucfirst(auth()->user()->role)}}<b class="caret"></b></span>
                </a>
                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                    @if(auth()->user()->role != 'admin')
                    <li><a href="{{ route('myProfile') }}" class="dropdown-item">My Profile</a></li>
                    @endif
                    <li><a href="/logout" class="dropdown-item">Logout</a></li>
                </ul>
            </div>
        </li>
        <li class="{{ Request::segment(2) === 'dashboard'  ? 'active' : null }}">
            <a href="{{ route('dashboard') }}"><i class="fa fa-line-chart"></i><span
                    class="nav-label">Dashboard</span></a>
        </li>
        @if(in_array(auth()->user()->role, ['admin', 'teacher']))
        <li class="{{ Request::segment(2) === 'student'  ? 'active' : null }}">
            <a href="{{ route('student') }}"><i class="fa fa-address-book"></i><span
                    class="nav-label">Siswa</span></a>
        </li>
        @endif
        @if(auth()->user()->role == 'admin')
        <li class="{{ Request::segment(2) === 'teacher'  ? 'active' : null }}">
            <a href="{{ route('teacher') }}"><i class="fa fa-address-card"></i><span
                    class="nav-label">Guru</span></a>
        </li>
        
        <li class="{{ Request::segment(2) === 'classroom'  ? 'active' : null }}">
            <a href="{{ route('classroom') }}"><i class="fa fa-university"></i><span
                    class="nav-label">Kelas</span></a>
        </li>

        <li class="{{ Request::segment(2) === 'master' ? 'active' : null }}">
            <a href="#"><i class="fa fa-cogs"></i><span class="nav-label">Master Data</span><span
                    class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li class="{{ Request::segment(3) === 'home' ? 'active' : null }}"><a
                        href="{{ route('master.home') }}">Home</a></li>
            </ul>
            <ul class="nav nav-second-level">
                <li class="{{ Request::segment(3) === 'class' ? 'active' : null }}"><a
                        href="{{ route('master.class') }}">Kelas</a></li>
            </ul>
            <ul class="nav nav-second-level">
                <li class="{{ Request::segment(3) === 'school-year' ? 'active' : null }}"><a
                        href="{{ route('master.school-year') }}">Tahun Ajaran</a></li>
            </ul>
            <ul class="nav nav-second-level">
                <li class="{{ Request::segment(3) === 'subjects' ? 'active' : null }}"><a
                        href="{{ route('course') }}">Mata Pelajaran</a></li>
            </ul>
        </li>
        @endif
    </ul>
</div>
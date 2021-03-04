<div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
        <li class="nav-header">
            <div class="dropdown profile-element">
                <img src="{{asset('img/admin.jpg')}}" style="width: 60px;" alt="image" class="rounded-circle">
                <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                    <span class="block m-t-xs font-bold">{{auth()->user()->name}}</span>
                    <span class="text-muted text-xs block">Superadmin <b class="caret"></b></span>
                </a>
                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                    <li><a href="/logout" class="dropdown-item">Logout</a></li>
                </ul>
            </div>
        </li>
        <li class="{{ Request::segment(2) === 'dashboard'  ? 'active' : null }}">
            <a href="{{url('admin/dashboard')}}"><i class="fa fa-line-chart"></i><span class="nav-label">Dashboard</span></a>
        </li>
        <li class="{{ Request::segment(2) === 'student'  ? 'active' : null }}">
            <a href="{{url('admin/student')}}"><i class="fa fa-address-book-o"></i><span class="nav-label">Siswa</span></a>
        </li>
        <li class="{{ Request::segment(2) === 'teacher'  ? 'active' : null }}">
            <a href="{{url('admin/teacher')}}"><i class="fa fa-address-card-o"></i><span class="nav-label">Guru</span></a>
        </li>
        <li class="{{ Request::segment(2) === 'master' ? 'active' : null }}">
            <a href="#"><i class="fa fa-cogs"></i><span class="nav-label">Master Data</span><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li class="{{ Request::segment(3) === 'home' ? 'active' : null }}"><a href="{{url('admin/master/home')}}">Home</a></li>
            </ul>
        </li>
    </ul>
</div>
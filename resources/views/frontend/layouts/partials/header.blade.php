<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>LMS</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Home</a>
            <a href="#" class="nav-item nav-link">About</a>
            <a href="#" class="nav-item nav-link">Courses</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Instructors</a>
                <div class="dropdown-menu fade-down m-0 border-0 shadow-sm">
                    <a href="#" class="dropdown-item">Our Team</a>
                    <a href="#" class="dropdown-item">Top Tutors</a>
                </div>
            </div>
            <a href="#" class="nav-item nav-link">Contact</a>
        </div>
        
        <div class="d-flex align-items-center me-lg-4 ps-4 ps-lg-0 py-3 py-lg-0">
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-primary px-3 rounded-pill me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary px-3 rounded-pill">Join Now</a>
            @else
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                        <img src="{{ Auth::user()->profile_image }}" class="rounded-circle me-2" width="35" height="35" style="object-fit: cover;">
                        <span class="d-none d-lg-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end fade-down m-0 border-0 shadow-sm">
                        <a href="{{ route('dashboard') }}" class="dropdown-item"><i class="fa fa-tachometer-alt me-2 text-primary"></i>Dashboard</a>
                        <a href="{{ route('student.my-courses') }}" class="dropdown-item"><i class="fa fa-play-circle me-2 text-primary"></i>My Learning</a>
                        <a href="#" class="dropdown-item"><i class="fa fa-user me-2 text-primary"></i>Profile Settings</a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger"><i class="fa fa-sign-out-alt me-2"></i>Logout</button>
                        </form>
                    </div>
                </div>
            @endguest
        </div>
    </div>
</nav>

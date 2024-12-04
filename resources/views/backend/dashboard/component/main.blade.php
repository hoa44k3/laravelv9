<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="main-panel">
    <!-- Main Header -->
    <div class="main-header">
        <div class="main-header-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
                <a href="index.html" class="logo">
                    <img src="{{ asset('assets/img/avt1.jpg') }}" alt="Logo" class="navbar-brand" height="20" />
                </a>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                        <i class="gg-menu-left"></i>
                    </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="gg-more-vertical-alt"></i>
                </button>
            </div>
        </div>

        <!-- Navbar Header -->
        <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
            <div class="container-fluid">
                <!-- Search Bar -->
                <form class="navbar navbar-form nav-search" action="{{ route('blogs.search') }}" method="GET">
                    <div class="input-group">
                        <button type="submit" class="btn btn-outline-primary">
                            <i class="fa fa-search"></i>
                        </button>
                        <input type="text" name="query" placeholder="Tìm kiếm bài viết ..." class="form-control" />
                    </div>
                </form>
                
                

                <!-- User Actions -->
                <ul class="navbar-nav ms-md-auto align-items-center">
                    <!-- Profile Dropdown -->
                    <li class="nav-item topbar-user dropdown">
                        <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" 
                           href="{{ route('users.profile', auth()->id()) }}">
                            <div class="avatar-sm">
                                <img src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : asset('assets/img/avt1.jpg') }}" 
                                     alt="Avatar" class="avatar-img rounded-circle" />
                            </div>
                            <span class="profile-username">{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-user animated fadeIn">
                            <li>
                                <div class="user-box text-center">
                                    <div class="avatar-lg mb-2">
                                        <img src="{{ auth()->user()->image ? asset('storage/' . auth()->user()->image) : asset('assets/img/avt1.jpg') }}" 
                                             alt="Profile Image" class="avatar-img rounded" />
                                    </div>
                                    <h4>{{ auth()->user()->name }}</h4>
                                    <p class="text-muted">{{ auth()->user()->email }}</p>
                                    <a href="{{ route('users.profile', ['id' => auth()->id()]) }}" class="btn btn-sm btn-secondary">
                                        Xem thông tin
                                    </a>
                                </div>
                            </li>
                            
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}" 
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Đăng xuất
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    @include('backend.dashboard.home.layout')

    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid d-flex justify-content-between">
            <nav>
                <ul class="nav">
                    <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>
            </nav>
            <div class="copyright text-center">
                &copy; 2024, made with <i class="fa fa-heart text-danger"></i> by Your Company
            </div>
        </div>
    </footer>
</div>

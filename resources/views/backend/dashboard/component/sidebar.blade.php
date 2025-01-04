<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('backend.dashboard.index') }}" class="logo">
                <img src="{{ asset('assets/img/kaiadmin/logo_light.svg') }}" 
                     alt="navbar brand" 
                     class="navbar-brand" 
                     height="20" />
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
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                </li>
                <li class="nav-item">
                  <a href="{{ route('blogs.home') }}">
                      <i class="fas fa-newspaper"></i>
                      <p>Quản lý bài viết</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('tags.index') }}">
                      <i class="fas fa-tags"></i>
                      <p>Quản lý thẻ</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('likes.index') }}">
                      <i class="fas fa-thumbs-up"></i>
                      <p>Quản lý lượt thích</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('category.home') }}">
                      <i class="fas fa-cogs"></i>
                      <p>Quản lý danh mục</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('users.index') }}">
                      <i class="fas fa-users"></i>
                      <p>Quản lý người dùng</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('contacts.index') }}">
                      <i class="fas fa-address-book"></i>
                      <p>Danh sách liên hệ</p>
                  </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('guides.index') }}">
                    <i class="fas fa-book-open"></i> <!-- Icon hướng dẫn -->
                    <p>Hướng dẫn</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('events.index') }}">
                    <i class="fas fa-calendar-alt"></i> <!-- Icon sự kiện -->
                    <p>Sự kiện</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('jobs.index') }}">
                    <i class="fas fa-briefcase"></i> <!-- Icon tuyển dụng -->
                    <p>Tuyển dụng</p>
                </a>
            </li>
            
              <li class="nav-item">
                  <a href="{{ route('ctvien.index') }}">
                      <i class="fas fa-user-friends"></i>
                      <p>CTV</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('statistics.index') }}">
                      <i class="fas fa-chart-line"></i>
                      <p>Thống kê</p>
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('index') }}">
                      <i class="fas fa-sign-out-alt"></i>
                      <p>Đăng xuất</p>
                  </a>
              </li>
            </ul>
        </div>
    </div>
  </div>
  
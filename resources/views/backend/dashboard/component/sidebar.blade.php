<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="index.html" class="logo">
          <img
            src="assets/img/kaiadmin/logo_light.svg"
            alt="navbar brand"
            class="navbar-brand"
            height="20"
          />
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
            <div class="collapse" id="base">
              <ul class="nav nav-collapse">          
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <div class="collapse" id="sidebarLayouts">
                <ul class="nav nav-collapse">
                </ul>
            </div>
          </li>
        <li class="nav-item">
          <a href="{{ route('blogs.home') }}">
              <i class="fas fa-table"></i>
              <p>Quản lý bài viết</p>
              <span class="caret"></span>
          </a>
          
        </li>
        <li class="nav-item">
        <a href="{{ route('likes.index') }}">
            <i class="fas fa-table"></i>
            <p>Quản lý lượt thích</p>
            <span class="caret"></span>
        </a>
       </li>
      <li class="nav-item">
      <a href="{{ route('category.home') }}">
          <i class="fas fa-table"></i>
          <p>Quản lý danh mục</p>
          <span class="caret"></span>
      </a>
       </li>
       {{-- <li class="nav-item">
          <a href="{{ route('comment.index') }}">
          <i class="fas fa-table"></i>
          <p>Quản lý bình luận</p>
          <span class="caret"></span>
           </a>
      </li> --}}
      <li class="nav-item">
         <a href="{{ route('users.index') }}">
          <i class="fas fa-table"></i>
          <p>Quản lý người dùng</p>
          <span class="caret"></span>
         </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('contacts.index') }}">
         <i class="fas fa-table"></i>
         <p>Danh sách liên hệ</p>
         <span class="caret"></span>
        </a>
     </li>

      <li class="nav-item">
        <a href="{{ route('statistics.index') }}">
      <i class="fas fa-table"></i>
      <p> Thống kê</p>
      <span class="caret"></span>
      </a>
      </li>
        </ul>
      </div>
    </div>
  </div>
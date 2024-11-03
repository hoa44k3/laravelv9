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
            <h4 class="text-section">Components</h4>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#base">
              <i class="fas fa-layer-group"></i>
              <p>Quản trị viên</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="base">
              <ul class="nav nav-collapse">
                <li>
                  <a href="{{route('backend.user.index')}}">
                    <span class="sub-item">Quản lý người dùng</span>
                  </a>
                </li>
                <li>
                  <a href="{{route('backend.statistics.index')}}">
                    <span class="sub-item">Thống kê</span>
                  </a>
                </li>
               
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#sidebarLayouts">
                <i class="fas fa-th-list"></i>
                <p>Quản lý chung</p>
                <span class="caret"></span>
            </a>
            <div class="collapse" id="sidebarLayouts">
                <ul class="nav nav-collapse">
                    <li>
                        <a href="{{ route('backend.blog.index') }}">
                            <span class="sub-item">Quản lý bài viết</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('backend.category.index') }}">
                            <span class="sub-item">Quản lý danh mục</span>
                        </a>
                    </li>
                    <li>
                      <a href="{{ route('backend.comment.indexAll') }}">
                          <span class="sub-item">Quản lý bình luận</span>
                      </a>
                  </li>
                  <li>
                    <a href="{{ route('backend.likes.index') }}">
                        <span class="sub-item">Quản lý lượt thích</span>
                    </a>
                </li>
                </ul>
            </div>
        </li>
        
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#forms">
              <i class="fas fa-pen-square"></i>
              <p>Quản lý thẻ</p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="forms">
              <ul class="nav nav-collapse">
                <li>
                  <a href="forms/forms.html">
                    <span class="sub-item">Basic Form</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
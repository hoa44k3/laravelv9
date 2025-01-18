<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tổng quát</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f1f1f1;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background: #ffffff;
        }

        .card-header {
            background: #e0e0e0;
            color: #000000;
            border-bottom: 1px solid #ddd;
            text-shadow: none;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .btn {
            font-weight: 500;
            border-radius: 8px;
            background-color: #e0e0e0;
            color: #000000;
            border-color: #e0e0e0;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn:hover {
            transform: scale(1.03);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .d-flex > a {
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .d-flex > a i {
            margin-right: 8px;
        }

        .button-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
        }

        .button-grid a {
            display: block;
            padding: 15px;
            text-align: center;
            font-weight: bold;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .button-grid a:hover {
            transform: scale(1.03);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>

<body>

<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Trang quản lý tổng quát</h3>
                <h6 class="op-7 mb-2">Quản lý tất cả các khía cạnh trong ứng dụng</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Quản lý</h5>
            </div>
            <div class="card-body">
                <p class="card-text">Sử dụng các nút dưới đây để truy cập các chức năng quản lý khác nhau.
                </p>
                <div class="button-grid">
                        <a href="{{route('users.index')}}" class="btn">
                            <i class="fas fa-users"></i> Quản lý người dùng
                        </a>
                        <a href="{{route('blogs.home')}}" class="btn">
                            <i class="fas fa-newspaper"></i> Quản lý bài viết
                        </a>
                        <a href="{{route('category.home')}}" class="btn">
                            <i class="fas fa-tags"></i> Quản lý danh mục
                        </a>
                        <a href="{{route('ctvien.index')}}" class="btn">
                            <i class="fas fa-user-tie"></i> CTV
                        </a>
                        <a href="{{route('contacts.index')}}" class="btn">
                            <i class="fas fa-envelope"></i> Liên hệ
                        </a>
                        <a href="{{route('events.index')}}" class="btn">
                            <i class="fas fa-calendar-alt"></i> Sự kiện
                        </a>
                        <a href="{{route('guides.index')}}" class="btn">
                            <i class="fas fa-book"></i> Hướng dẫn
                        </a>
                        <a href="{{route('jobs.index')}}" class="btn">
                            <i class="fas fa-briefcase"></i> Tuyển dụng
                        </a>
                        <a href="{{route('statistics.index')}}" class="btn">
                            <i class="fas fa-chart-bar"></i> Thống kê
                        </a>
                    </div>
    
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    
    </html>
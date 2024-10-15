<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tổng quát</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
                <p class="card-text">Sử dụng các nút dưới đây để truy cập các chức năng quản lý khác nhau.</p>
                <div class="d-flex justify-content-start flex-wrap">
                    <a href="/backend/user" class="btn btn-primary me-2 mb-2">Quản lý người dùng</a>
                    <a href="/backend/product" class="btn btn-info me-2 mb-2">Quản lý sản phẩm</a>
                    <a href="/backend/order" class="btn btn-success me-2 mb-2">Quản lý đơn hàng</a>
                    <a href="/backend/report" class="btn btn-warning me-2 mb-2">Báo cáo</a>
                    <a href="/backend/settings" class="btn btn-secondary mb-2">Cài đặt</a>
                    <a href="/backend/dashboard" class="btn btn-dark mb-2">Quay lại Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

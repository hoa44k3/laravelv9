<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm người dùng</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <style>
        body {
            background-color: #f8f9fa; /* Nền sáng */
        }
        .container {
            margin-top: 30px;
            background-color: white; /* Nền trắng cho container */
            border-radius: 0.5rem; /* Bo góc cho container */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Đổ bóng cho container */
            padding: 20px; /* Padding cho container */
        }
        h1 {
            color: #343a40;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center; /* Căn giữa tiêu đề */
        }
        .form-group {
            margin-bottom: 15px; /* Khoảng cách giữa các trường */
        }
        .btn-primary {
            width: 100%; /* Nút thêm người dùng chiếm toàn bộ chiều rộng */
            margin-top: 10px; /* Khoảng cách trên nút */
        }
        .alert {
            margin-top: 15px; /* Khoảng cách trên alert */
        }
        .avatar-preview {
            margin-top: 10px; /* Khoảng cách trên ảnh đại diện */
            border: 1px solid #dee2e6; /* Đường viền cho ảnh */
            border-radius: 0.5rem; /* Bo góc cho ảnh */
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Thêm người dùng</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('backend.user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Tên người dùng:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="image">Ảnh đại diện:</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="phone">Số điện thoại:</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
        </div>

        <div class="form-group">
            <label for="address">Địa chỉ:</label>
            <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
        </div>

        <div class="form-group">
            <label for="birthday">Ngày sinh:</label>
            <input type="date" name="birthday" class="form-control" value="{{ old('birthday') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Thêm người dùng</button>
    </form>
</div>
</body>
</html>

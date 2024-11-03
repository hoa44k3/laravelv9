<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa người dùng</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <style>
        body {
            background-color: #f8f9fa;
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
            width: 100%; /* Nút Cập nhật chiếm toàn bộ chiều rộng */
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
    <h1>Sửa người dùng</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('backend.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên người dùng:</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="image">Ảnh đại diện:</label>
            <input type="file" name="image" class="form-control">
            @if($user->image)
                <img src="{{ asset('storage/' . $user->image) }}" alt="Avatar" width="100" class="avatar-preview">
            @endif
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu mới (nếu có):</label>
            <input type="password" name="password" class="form-control">
            <small class="form-text text-muted">Để trống nếu không muốn thay đổi mật khẩu</small>
        </div>

        <div class="form-group">
            <label for="phone">Số điện thoại:</label>
            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" required>
        </div>

        <div class="form-group">
            <label for="address">Địa chỉ:</label>
            <input type="text" name="address" class="form-control" value="{{ $user->address }}" required>
        </div>

        <div class="form-group">
            <label for="birthday">Ngày sinh:</label>
            <input type="date" name="birthday" class="form-control" value="{{ $user->birthday }}" required>
        </div>

        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea name="description" class="form-control" required>{{ $user->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
</body>
</html>

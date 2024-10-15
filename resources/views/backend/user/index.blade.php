<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    
    <style>
        .table {
            border: 1px solid #dee2e6;
        }

        .table th, .table td {
            padding: 15px;
            text-align: left;
        }

        .table th {
            background-color: #343a40;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-warning, .btn-danger {
            padding: 10px 15px; /* Giữ cho nút có kích thước nhất định */
            width: 40px; /* Đặt chiều rộng cố định */
            height: 40px; /* Đặt chiều cao cố định */
            border-radius: 0; /* Bỏ bo góc để thành hình vuông */
            font-size: 14px; /* Kích thước chữ */
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-add-user {
            display: block;
            width: 100%; /* Chiếm toàn bộ chiều rộng */
            max-width: 200px; /* Giới hạn chiều rộng tối đa */
            margin-bottom: 20px; /* Tạo khoảng cách dưới nút */
        }
    </style>
</head>
<body>
<div class="container">
    <h1 class="mb-4">Quản lý người dùng</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('backend.user.create') }}" class="btn btn-primary btn-add-user">Thêm người dùng</a>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Birthday</th>
                <th>Password</th>
                <th>Description</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('d-m-Y') : '' }}</td>
                <td>***</td>
                <td>{{ $user->description }}</td>
                <td>
                    <a href="{{ route('backend.user.edit', $user->id) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('backend.user.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMJh9W2D7Ek6D71lL9eZl4JKpWq5z6W9G8T0cL" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 30px;
        }
        h1 {
            color: #343a40;
            margin-bottom: 20px;
            font-weight: bold;
            font-size: 2.5rem;
            text-align: center;
        }
        .table {
            border-radius: 0.5rem;
            overflow: hidden;
        }
        .table th, .table td {
            padding: 15px;
            text-align: left;
        }
        .table th {
            background-color: #343a40;
            color: white;
            font-weight: bold;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }
        .btn {
            width: 100px; /* Đặt chiều rộng cố định cho tất cả các nút */
            display: inline-flex; /* Căn giữa nội dung */
            justify-content: center; /* Căn giữa nội dung */
            align-items: center; /* Căn giữa nội dung */
            transition: background-color 0.3s;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .btn-warning:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
        .btn-add-user {
            display: block;
            width: 100%; /* Chiếm toàn bộ chiều rộng */
            max-width: 300px; /* Giới hạn chiều rộng tối đa */
            margin: 20px auto; /* Căn giữa nút */
        }
        .avatar {
            border-radius: 50%; /* Bo tròn hình ảnh */
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Quản lý người dùng</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('backend.user.create') }}" class="btn btn-primary btn-add-user">Thêm người dùng</a>

    <table class="table table-bordered table-striped shadow-sm">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Avatar</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Birthday</th>
                <th>Password</th>
                <th>Description</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    @if($user->image)
                        <img src="{{ asset('storage/' . $user->image) }}" alt="Avatar" class="avatar" width="50">
                    @else
                        <span>Chưa có ảnh</span>
                    @endif
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('d-m-Y') : '' }}</td>
                <td>***</td>
                <td>{{ $user->description }}</td>
                <td>
                    <a href="{{ route('backend.user.edit', $user->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i> Sửa</a>
                    <form action="{{ route('backend.user.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')"><i class="fas fa-trash"></i> Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>

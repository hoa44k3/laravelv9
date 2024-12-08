
@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<style>
    .table tbody tr:hover {
    background-color: #e8f0fe;
}

.table thead th, .table tbody td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: center;
}

    .table thead th {
    background-color: #717172;
    color: white;
}
.password-container {
    display: flex;
    align-items: center;
}

.password-field {
    flex: 1;
    margin-right: 5px;
    max-width: 150px; /* Giới hạn chiều rộng nếu cần */
}

.toggle-password {
    border: none;
    background: none;
    cursor: pointer;
    padding: 0;
}


</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="card-title">Danh sách người dùng</h4>
                        <a href="{{ route('users.create') }}" class="btn btn-primary btn-add-user">Add New</a>
                    </div>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Tên</th>
                                    <th>Avatar</th>
                                    <th>Email</th>
                                    <th>Password</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Birthday</th>
                                    <th>Description</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr id="user-{{ $user->id }}">
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td><img src="{{ asset('storage/' . $user->image) }}" alt="Image" style="width: 80px; height: 70px;">
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div class="password-container">
                                            <input 
                                                type="password" 
                                                id="password-{{ $user->id }}" 
                                                class="form-control password-field" 
                                                value="{{ $user->password }}" 
                                                readonly>
                                            <button 
                                                type="button" 
                                                class="btn btn-sm btn-outline-secondary toggle-password" 
                                                onclick="togglePassword({{ $user->id }})">
                                                <i id="icon-{{ $user->id }}" class="fa fa-eye"></i>
                                            </button>
                                        </div>
                                    </td>
                                    
                                    
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('d-m-Y') : '' }}</td>
                                    <td>{{ $user->description }}</td>
                                    <td>
                                        <span class="badge {{ $user->role === 'admin' ? 'badge-danger' : ($user->role === 'ctv' ? 'badge-warning' : 'badge-secondary') }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                        <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{ $user->id }}">Xóa</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div>
@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script') 
<script>
    $(document).on('click', '.btn-delete', function () {
        var userId = $(this).data('id'); // Lấy ID người dùng từ data-id

        // Xác nhận người dùng có muốn xóa hay không
        if (confirm('Bạn có chắc chắn muốn xóa người dùng này?')) {
            $.ajax({
                url: '/users/' + userId, // URL xóa người dùng
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}', // Token CSRF
                },
                success: function (response) {
                    // Nếu xóa thành công, xóa dòng trong bảng
                    alert(response.success);
                    location.reload(); // Tải lại trang hoặc xóa dòng khỏi bảng mà không tải lại trang
                },
                error: function () {
                    alert('Đã có lỗi xảy ra. Vui lòng thử lại.');
                }
            });
        }
        
    });
    function togglePassword(userId) {
    const passwordField = document.getElementById(`password-${userId}`);
    const icon = document.getElementById(`icon-${userId}`);

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}


</script>


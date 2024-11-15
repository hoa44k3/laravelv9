
@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')

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
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->birthday ? \Carbon\Carbon::parse($user->birthday)->format('d-m-Y') : '' }}</td>
                                    <td>{{ $user->description }}</td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                                        
                                        <!-- Nút xóa sẽ sử dụng AJAX -->
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
</script>


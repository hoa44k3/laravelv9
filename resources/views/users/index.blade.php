
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

    {{-- <a href="{{ route('users.create') }}" class="btn btn-primary btn-add-user">Thêm người dùng</a> --}}
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
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.deleteUser').forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-id');
                if (confirm('Bạn có chắc chắn muốn xóa người dùng này?')) {
                    fetch(`/admin/users/${userId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById(`user-${userId}`).remove();
                            alert('Xóa người dùng thành công');
                        } else {
                            alert('Có lỗi xảy ra');
                        }
                    });
                }
            });
        });
    });
</script>

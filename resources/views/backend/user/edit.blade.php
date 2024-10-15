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

    <form action="{{ route('backend.user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Tên người dùng:</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <!-- Trường mật khẩu không hiển thị lại, chỉ yêu cầu khi muốn thay đổi -->
        <div class="form-group">
            <label for="password">Mật khẩu mới (nếu có):</label>
            <input type="password" name="password" class="form-control">
            <small>Để trống nếu không muốn thay đổi mật khẩu</small>
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

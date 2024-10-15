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

    <form action="{{ route('backend.user.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Tên người dùng:</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
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

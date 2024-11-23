<div class="container">
    <h1>Thông tin người dùng</h1>
    <p><strong>Tên:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Ảnh đại diện:</strong></p>
    <img
        src="{{ asset('storage/' . $user->image) }}"
        alt="Avatar"
        style="width: 150px; height: 150px;"
    >
</div>
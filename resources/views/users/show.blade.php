<div class="container">
    <h1>Thông tin người dùng</h1>
    <div class="card">
        <div class="card-header">
            <h3>{{ $user->name }}</h3>
        </div>
        <div class="card-body">
            <div class="avatar-lg mb-3">
                <img src="{{ $user->image ? asset('storage/' . $user->image) : asset('assets/img/avt1.jpg') }}" alt="Avatar" class="avatar-img rounded-circle" />
            </div>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Ngày tham gia:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
        </div>
    </div>
</div>

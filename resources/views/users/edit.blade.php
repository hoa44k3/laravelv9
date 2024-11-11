
@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Chỉnh sửa người dùng</h4>
                </div>
                <div class="card-body">       
                    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Tên</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Avatar</label>
                            <input type="file" class="form-control" name="image" id="image">
                            @if($user->image)
                                <img src="{{ asset('storage/' . $user->image) }}" alt="Avatar" class="avatar mt-2" style="width: 100px;">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', $user->phone) }}">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address" value="{{ old('address', $user->address) }}">
                        </div>
                        <div class="form-group">
                            <label for="birthday">Birthday</label>
                            <input type="date" class="form-control" name="birthday" id="birthday" value="{{ old('birthday', $user->birthday) }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="4">{{ old('description', $user->description) }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Cập nhật người dùng</button>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>

@include('backend.dashboard.component.custom')
@include('backend.dashboard.component.script')

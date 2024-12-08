<!DOCTYPE html>
<html>

<head>
    <title>HTML Register Form</title>
    <link rel="stylesheet" href="style.css">
    <link href="assets/css/customize.css" rel="stylesheet">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .main {
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
        width: 300px;
    }

    h1 {
        color: #4CAF50;
        font-size: 24px;
        margin-bottom: 10px;
    }

    h3 {
        font-size: 16px;
        margin-bottom: 20px;
        color: #555;
    }

    label {
        display: block;
        text-align: left;
        margin: 10px 0 5px;
        font-size: 14px;
        color: #333;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px;
        width: 100%;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    button:hover {
        background-color: #45a049;
    }

    p {
        margin-top: 20px;
        font-size: 14px;
    }

    a {
        color: #4CAF50;
    }

    .wrap {
        text-align: center;
    }

</style>
<body>
    <div class="main">
        <h1>GeeksforGeeks</h1>
        <h3>Nhập thông tin để tạo tài khoản</h3>

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    
        <form method="POST" action="{{ route('auth.register.submit') }}" enctype="multipart/form-data">
            @csrf
            <label for="name">Tên:</label>
            <input type="text" id="name" name="name" placeholder="Nhập tên của bạn" value="{{ old('name') }}">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Nhập email" value="{{ old('email') }}">

            <label for="password">Mật khẩu:</label>
            <input type="password" id="password" name="password" placeholder="Nhập mật khẩu">

            <label for="password_confirmation">Nhập lại mật khẩu:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Nhập lại mật khẩu">
            <label for="image">Ảnh đại diện:</label>
            <input type="file" id="image" name="image" accept="image/*">
            
            <button type="submit">Đăng Ký</button>
        </form>

        <p>Đã có tài khoản? <a href="{{ route('auth.login') }}">Đăng nhập</a></p>
    </div>
</body>

</html>

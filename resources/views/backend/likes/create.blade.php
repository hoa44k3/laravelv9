<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Lượt Thích</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMJh9W2D7Ek6D71lL9eZl4JKpWq5z6W9G8T0cL" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            background-color: white;
            border-radius: 0.5rem;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #343a40;
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn {
            width: 50%; 
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Thêm Lượt Thích</h1>
    <form action="{{ route('backend.likes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="blog_id">Blog:</label>
            <select name="blog_id" class="form-control" required>
                @foreach($blogs as $blog)
                    <option value="{{ $blog->id }}">{{ $blog->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="user_id">User:</label>
            <select name="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
    <a href="{{ route('backend.likes.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
</body>
</html>

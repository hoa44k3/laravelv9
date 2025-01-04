<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài viết mới</title>
</head>
<body>
    <h1>Thông báo: Có bài viết mới!</h1>
    <p>Tiêu đề: {{ $blog->title }}</p>
    <p>Nội dung: {{ Str::limit($blog->content, 100) }}</p>
    <p><a href="{{ route('blogs.show', $blog->id) }}">Xem chi tiết</a></p>
</body>
</html>

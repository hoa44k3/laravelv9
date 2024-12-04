@extends('site.master')

@section('title', 'Trang chủ')
@section('body')
<div class="container">
    <h1>Kết quả tìm kiếm cho: "{{ $query }}"</h1>

    @if ($blogs->isEmpty())
        <p>Không tìm thấy bài viết nào.</p>
    @else
        <div class="blog-list">
            @foreach ($blogs as $blog)
                <div class="blog-item">
                    <h2>
                        <a href="{{ route('site.post', $blog->id) }}">{{ $blog->title }}</a>
                    </h2>
                    
                    <div class="blog-content">
                        {!! $blog->content !!}
                    </div>

                    <small>Được đăng bởi {{ $blog->user->name }} trong {{ $blog->category->name }}</small>
                    <p>{{ $blog->likes_count }} lượt thích - {{ $blog->comments_count }} bình luận</p>
                </div>
            @endforeach
        </div>

        <div class="pagination">
            {{ $blogs->links() }}
        </div>
    @endif
</div>
@endsection

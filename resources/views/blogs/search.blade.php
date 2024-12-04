
<div class="container">
    <h3>Kết quả tìm kiếm cho: "{{ $query }}"</h3>

    @if($blogs->isEmpty())
        <p>Không tìm thấy bài viết nào phù hợp.</p>
    @else
        <ul>
            @foreach($blogs as $blog)
                <li>
                    <a href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a>
                </li>
            @endforeach
        </ul>
    @endif
</div>

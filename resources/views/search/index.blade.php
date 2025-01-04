<!-- resources/views/search/index.blade.php -->
@include('backend.dashboard.component.head')
@include('backend.dashboard.component.sidebar')
    <h1>Kết quả tìm kiếm cho: {{ $searchQuery }}</h1>

    <!-- Hiển thị kết quả tìm kiếm -->
    <ul>
        @foreach($results as $result)
            <li><a href="{{ route('blogs.show', $result->id) }}">{{ $result->title }}</a></li>
        @endforeach
    </ul>

    <!-- Hiển thị lịch sử tìm kiếm của người dùng -->
    <h2>Lịch sử tìm kiếm của bạn</h2>
    <ul>
        @foreach(auth()->user()->searchHistories as $history)
            <li>{{ $history->search_query }} - {{ $history->created_at->format('d/m/Y H:i') }}</li>
        @endforeach
    </ul>
    @include('backend.dashboard.component.custom')
    @include('backend.dashboard.component.script') 

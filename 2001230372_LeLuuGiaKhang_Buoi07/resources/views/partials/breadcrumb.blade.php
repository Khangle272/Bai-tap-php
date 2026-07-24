<nav style="margin-bottom: 16px; font-size: 0.9em; color: #6b7280;">
    <a href="{{ url('/') }}" style="color: #2563EB; text-decoration: none;">Trang chủ</a>

    @if(Route::currentRouteName() == 'articles.index')
        &gt; <span>Danh sách bài viết</span>
    @elseif(Route::currentRouteName() == 'articles.create')
        &gt; <a href="{{ route('articles.index') }}" style="color: #2563EB; text-decoration: none;">Articles</a>
        &gt; <span>Tạo bài viết</span>
    @elseif(Route::currentRouteName() == 'articles.edit')
        &gt; <a href="{{ route('articles.index') }}" style="color: #2563EB; text-decoration: none;">Articles</a>
        &gt; <span>Sửa bài viết</span>
    @endif
</nav>
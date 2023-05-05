@extends('layouts.app')

@section('content')
<div class="movie-container">
  @foreach($news as $new)
  <div class="movie-card">
    <a href="{{ route('news.show', $new->id) }}" class="movie-img-link">
      <img src={{ $new->image }} class="movie-img" alt="{{ $new->title }}">
    </a>
    <div class="movie-info">
      <h5 class="movie-title">{{ $new->title }}</h5>
      <p class="movie-description">{{ Str::limit($new->content, 100) }}</p>
      <div class="movie-actions">
        <a href="{{ route('news.show', $new->id) }}" class="movie-action-link">View</a>
      </div>
    </div>
  </div>
  @endforeach
  <div class="pagination">
    {{ $news->links('vendor.pagination.default') }}
  </div>
</div>
@endsection


@extends('layouts.app')

@section('content')
<div class="movie-container">
  @foreach($movies as $movie)
  <div class="movie-card">
    <a href="{{ route('movies.show', $movie->id) }}" class="movie-img-link">
      <img src={{ $movie->image }} class="movie-img" alt="{{ $movie->title }}">
    </a>
    <div class="movie-info">
      <h5 class="movie-title">{{ $movie->title }}</h5>
      <p class="movie-description">{{ Str::limit($movie->description, 100) }}</p>
      <div class="movie-actions">
        <a href="{{ route('movies.show', $movie->id) }}" class="movie-action-link">View</a>
        <span class="movie-rating">{{ $movie->rating }}/5</span>
      </div>
    </div>
  </div>
  @endforeach
  <div class="pagination">
    {{ $movies->links('vendor.pagination.default') }}
  </div>
</div>
@endsection


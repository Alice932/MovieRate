@extends('layouts.app')

@section('content')
<div class="movie-container">
  @foreach($serials as $serial)
  <div class="movie-card">
    <a href="{{ route('serials.show', $serial->id) }}" class="movie-img-link">
      <img src={{ $serial->image }} class="movie-img" alt="{{ $serial->title }}">
    </a>
    <div class="movie-info">
      <h5 class="movie-title">{{ $serial->title }}</h5>
      <p class="movie-description">{{ Str::limit($serial->description, 100) }}</p>
      <div class="movie-actions">
        <a href="{{ route('serials.show', $serial->id) }}" class="movie-action-link">View</a>
        <span class="movie-rating">{{ $serial->rating }}/5</span>
      </div>
    </div>
  </div>
  @endforeach
  <div class="pagination">
    {{ $serials->links('vendor.pagination.default') }}
  </div>
</div>
@endsection


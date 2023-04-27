@extends('layouts.app')

@section('content')
  <div class="row">
    @foreach($movies as $movie)
    <div class="col-md-4">
      <div class="card mb-4 shadow-sm">
        <img src="{{ $movie->image_url }}" class="card-img-top" alt="{{ $movie->title }}">
        <div class="card-body">
          <h5 class="card-title">{{ $movie->title }}</h5>
          <p class="card-text">{{ Str::limit($movie->description, 100) }}</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
            </div>
            <small class="text-muted">{{ $movie->rating }}/10</small>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
@endsection


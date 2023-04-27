@extends('layouts.app')

@section('content')
  <div class="row">
    @foreach($serials as $serial)
    <div class="col-md-4">
      <div class="card mb-4 shadow-sm">
        <img src="{{ $serial->image_url }}" class="card-img-top" alt="{{ $serial->title }}">
        <div class="card-body">
          <h5 class="card-title">{{ $serial->title }}</h5>
          <p class="card-text">{{ Str::limit($serial->description, 100) }}</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <a href="{{ route('serials.show', $serial->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
            </div>
            <small class="text-muted">{{ $serial->rating }}/10</small>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
@endsection


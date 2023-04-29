@extends('layouts.app')

@section('content')
  <div class="row">
    @foreach($news as $new)
    <div class="col-md-4">
      <div class="card mb-4 shadow-sm">
        <a href="{{ route('news.show', $new->id) }}" class="btn btn-sm btn-outline-secondary">
          <img src={{ $new->image }} class="card-img-top" alt="{{ $new->title }}">
        </a>
        <div class="card-body">
          <h5 class="card-title">{{ $new->title }}</h5>
          <p class="card-text">{{ Str::limit($new->content, 100) }}</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <a href="{{ route('news.show', $new->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  <div>
    {{ $news->links('vendor.pagination.default') }}
  </div>
  </div>
@endsection


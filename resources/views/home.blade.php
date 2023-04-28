@extends('layouts.app')

@section('content')
  <section class="hero-banner">
    <div class="container">
      <div class="row align-items-center justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-12">
          <div class="hero-banner__content">
            <h1>Welcome to the Best Movie Streaming Platform</h1>
            <p>Discover the ultimate movie experience with our vast collection of the latest blockbusters, independent films, and critically acclaimed titles.
              Our platform offers seamless streaming for your favorite TV shows, documentaries,
              and exclusive originals. Get lost in our hand-picked selection of genres, including action,
              comedy, drama, romance, and more. With our user-friendly interface, you can easily browse and find your next binge-worthy watch.
              Join our community of movie lovers today and start watching now.</p>
            <a href="{{ route('movies.index') }}" class="button button-primary">Start Watching Now</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="featured-movies">
    <div class="container">
      <h2 class="section-title">Featured Movies</h2>
      <div class="row">
        @foreach($movies as $movie)
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="movie-card">
              <div class="movie-card__thumbnail">
                <a href="{{ route('movies.show', $movie->id) }}">
                  <img src="{{ $movie->image }}" alt="{{ $movie->title }}" width="222" height="300">
                </a>
              </div>
              <div class="movie-card__body">
                <h3 class="movie-card__title"><a href="{{ route('movies.show', $movie->id) }}">{{ $movie->title }}</a></h3>
                <div class="movie-card__meta">{{ $movie->year }} | {{ $movie->time }}</div>
                <p class="movie-card__desc">{{ \Illuminate\Support\Str::limit($movie->content, 100, '...') }}</p>
                <div class="movie-card__actions">
                  <a href="{{ route('movies.show', $movie->id) }}" class="button button-secondary">Watch Now</a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection

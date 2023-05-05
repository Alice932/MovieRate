@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h2 class="heading">{{ $movie->title }}</h2>
            <ul class="bloglisting">
                <li>
                    <div class="thumb">
                        <img src={{ $movie->image }} alt="" width="154" height="222" />
                    </div>
                    <div class="desc">
                        <h3 class="colr">{{ $movie->title }}</h3>
                        <p>Director: {{ $movie->director }}</p>
                        <p>Actors: {{ $movie->actors }}</p>
                        <p>Year: {{ $movie->year }}</p>
                        <p>Genre: {{ $movie->genre }}</p>
                        <p>Duration: {{ $movie->time }}</p>
                        <div class="clear"></div>
                    </div>
                    <br />
                </li>
            </ul>
            <div class= "txt-content">
                <h3>Description</h3>
                <p class="txt">
                    {{ $movie->content }}
                </p>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    </div>
@endsection

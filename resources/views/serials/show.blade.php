@extends('layouts.app')

@section('content')
    <div class="col1">
        <div class="blog">
            <!-- Column 1 -->
            <h2 class="heading">{{ $serial->title }}</h2>
            <ul class="bloglisting">
                <li>
                    <div class="thumb">
                        <img src={{ $serial->image }} alt="" width="154" height="222" />
                    </div>
                    <div class="desc">
                        <h3 class="colr">{{ $serial->title }}</h3>
                        <p>Creator: {{ $serial->creator }}</p>
                        <p>Actors: {{ $serial->actors }}</p>
                        <p>Year: {{ $serial->year }}</p>
                        <p>Genre: {{ $serial->genre }}</p>
                        <p>Seasons: {{ $serial->seasons }} seasons</p>
                        <p>Episodes: {{ $serial->episodes }} episodes</p>
                        <div class="clear"></div>
                    </div>
                    <br />
                </li>
            </ul>
            <div class= "txt-content">
                <h3>Description</h3>
                <p class="txt">
                    {{ $serial->content }}
                </p>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
    </div>
@endsection

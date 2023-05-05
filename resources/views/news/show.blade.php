@extends('layouts.app')

@section('content')
<div class="col1">
  <div class="blog">
    <h2 class="heading">{{ $new->title }}</h2>
    <ul class="bloglisting_2">
      <li>
          <img src={{ $new->image }} alt="" width="780px" />
        <br />
      </li>
      <li>
        <div class="desc">
          <h3>Published: {{ $new->publishTime }}</h3>
          <p>Author: {{ $new->author }}</p>
          <div class="clear"></div>
        </div>
      </li>
    </ul>
    <div class="txt-content">
      <h3>Description</h3>
      <p class="txt">
        {{ $new->content }}
      </p>
    </div>
    <div class="clear"></div>
  </div>
  <div class="clear"></div>
</div>
@endsection

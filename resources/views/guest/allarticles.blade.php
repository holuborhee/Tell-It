@extends('guest.layout')

@section('mid_col')

<div class="page-header">
  <h1 class="page-title">ALL ARTICLES</h1>
</div>
@if(sizeof($posts)>0)
@foreach($posts as $p)
@if($p->picture == 'none')
  <div class="newsfeed plain-text-advert">
  <div class="content">
  <div class="feed-btn hidden">
  <div class="feed-btn-abs">
  <div class="dropdown">
  <span class="dropdown-toggle" data-toggle="dropdown">
  <i class="fa fa-share-alt"><small> 3K</small>
  </i>
  </span>
    <ul class="dropdown-menu">
      <li><i class="fa fa-facebook-square fb-link"></i></li>
  <li><i class="fa fa-twitter-square twitter-link"></i></li>
  <li><i class="fa fa-youtube-play youtube-link"></i></li> 
  <li><i class="fa fa-google-plus-square google-plus-link"></i></li>
    </ul>
  </div>
  <i class="fa fa-comment"><small> 300</small></i>
  <i class="fa fa-heart-o"><small> 1.5K</small></i>
  </div>
  </div>
    <mark>{{$p->column->name}}</mark>
    <h3><a href="{{url('/article/'.$p->id)}}">{{$p->title}}.</a></h3>
    <p>{{$p->lead}}. </p>
    <mark class="sec-mark">Today</mark>
  </div>
</div>
@else
<div class="newsfeed textnews">
<img src="{{$p->picture != 'none'?asset('storage/'. $p->picture):asset('storage/articles/article.jpg')}}" class="textnews-img" />
  <div class="content">
  <div class="feed-btn hidden">
  <div class="feed-btn-abs">
  <div class="dropdown">
  <span class="dropdown-toggle" data-toggle="dropdown">
  <i class="fa fa-share-alt"><small> 3K</small>
  </i>
  </span>
    <ul class="dropdown-menu">
      <li><i class="fa fa-facebook-square fb-link"></i></li>
  <li><i class="fa fa-twitter-square twitter-link"></i></li>
  <li><i class="fa fa-youtube-play youtube-link"></i></li> 
  <li><i class="fa fa-google-plus-square google-plus-link"></i></li>
    </ul>
  </div>
  <i class="fa fa-comment"><small> 300</small></i>
  <i class="fa fa-heart-o"><small> 1.5K</small></i>
  </div>
  </div>
    <mark>{{$p->column->name}}</mark>
    <h3><a href="{{url('/article/'.$p->id)}}">{{$p->title}}.</a></h3>
    <p>{{$p->lead}}. </p>
    <mark class="sec-mark">Today</mark>
  </div>
</div>
@endif
@endforeach
{{ $posts->links() }}
@else
  <h2>{{'No Article Available'}}</h2>
@endif
  @endsection
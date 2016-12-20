@extends('guest.layout')

@section('mid_col')

<div class="page-header">
  <h1 class="page-title">Photos</h1>
</div>
@if(sizeof($posts)>0)
@foreach($posts as $p)
<div class="newsfeed picturenews"> 
    
      
    <div class="thumbnail">
    <div class="feed-btn hidden">
  <div class="feed-btn-abs">
  <div class="dropdown">
  <span class="dropdown-toggle" data-toggle="dropdown">
  <i class="fa fa-share-alt"><small> {{$p->shares}}</small>
  </i>
  </span>
    <ul class="dropdown-menu">
      <li class="fb-share"><i class="fa fa-facebook-square fb-link"></i><input type="hidden" class="link" value="{{url('/photos/' .$p->id)}}" /></li>
  <li><i class="fa fa-twitter-square twitter-link"></i></li>
  <li><i class="fa fa-youtube-play youtube-link"></i></li> 
  <li><i class="fa fa-google-plus-square google-plus-link"></i></li>
    </ul>
  </div>
  <i class="fa fa-eye"><small> {{$p->views}}</small></i>
  <i class="fa fa-comment"><small> <span class="fb-comments-count" data-href="{{url('/photos/' .$p->id)}}"></span></small></i>
  <div class="fb-like" data-href="{{url('/photos/' . $p->id)}}" data-width="10" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="false"></div>
  </div>
  </div>
    <h3><a href="{{url('/photos/'.$p->id)}}"><mark>PHOTO</mark> - {{$p->title}}.</a></h3>
        <img src="{{asset('storage/'. $p->photos->first()->picture)}}"  />
        <p><strong>{{$p->photos->count()}} Photos</strong></p>
      </div>  
</div>
@endforeach
{{ $posts->links() }}
@else
  <h2>{{'No News in this category'}}</h2>
@endif
  @endsection
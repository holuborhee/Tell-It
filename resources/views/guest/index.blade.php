@extends('guest.layout')

@section('mid_col')
@unless(Request::has('page'))
<div class="demo3">
        <ul>
           @foreach(App\BreakingNews::latest()->cursor() as $b)     
            <li>{{$b->description}} </li>
            @endforeach
                </ul>
</div>

<div id = "newsCarousel" class = "carousel slide">
   
   <!-- Carousel indicators 
   <ol class = "carousel-indicators">
      <li data-target = "#myCarousel" data-slide-to = "0" class = "active"></li>
      <li data-target = "#myCarousel" data-slide-to = "1"></li>
      <li data-target = "#myCarousel" data-slide-to = "2"></li>
      <li data-target = "#myCarousel" data-slide-to = "3"></li>
      <li data-target = "#myCarousel" data-slide-to = "4"></li>
   </ol> -->  
   
   <!-- Carousel items -->
   <div class = "carousel-inner">
   <?php $i = 1; ?>
   @foreach(App\Post::where('inSlideShow',1)->cursor() as $p)
    @if($p->textpost->picture == 'none')
      <?php continue; ?>
    @endif
      <div class = "item {{ $i == 1 ? 'active' : '' }}">
         <img src = "{{asset('images/uploads/'. $p->textpost->picture)}}" alt = "First slide">
         <div class="carousel-caption headline-carousel">
        <p class="lead"><a href="{{url('/report/'.$p->textpost->id)}}">{{$p->title}}</a></p>
        <p>{{$p->lead}}</p>
      </div>
      </div>
      <?php $i++ ?>
    @endforeach
      
   </div>
   
   <!-- Carousel nav 
   <a class = "carousel-control left" href = "#newsCarousel" data-slide = "prev">&lsaquo;</a>
   <a class = "carousel-control right" href = "#newsCarousel" data-slide = "next">&rsaquo;</a>-->

   <!-- Controls -->
                <a class="left carousel-control" data-slide="prev" href="#newsCarousel"><span class="icon-prev"></span></a>
                <a class="right carousel-control" data-slide="next" href="#newsCarousel"><span class="icon-next"></span></a>
  </div>


  <div id="articles" class="">
  <div class="row">
  <?php  $count = App\Article::where('inthumbnail',1)->count() ?>
  @foreach(App\Article::where('inthumbnail',1)->cursor() as $p)
    <div class="@if($count==4) col-sm-3 @elseif($count==3) col-sm-4 @elseif($count==2) col-sm-6 @elseif($count==1) col-sm-12 @endif">
      <div class="thumbnail">
        <img src="{{asset('images/uploads/'.$p->picture)}}" alt="article image">
        <a href="{{url('/article/'.$p->id)}}"><strong>{{$p->title}}.</strong></a>
          
      </div>
    </div>
    @endforeach
    
    <button onclick="location.href='{{url('/article')}}';" class="btn btn-sm btn-block">View All Articles</button>
</div>
</div>
@endunless
@foreach($posts as $p)

@if($p->type == 'Text')
<?php $post = $p->textpost; ?>
@if($post->picture == 'none')
  <div class="newsfeed plain-text-advert">
  <div class="content">
  <div class="feed-btn hidden">
  <div class="feed-btn-abs">
  <div class="dropdown">
  <span class="dropdown-toggle" data-toggle="dropdown">
  <i class="fa fa-share-alt"><small> {{$p->shares}}</small>
  </i>
  </span>
    <ul class="dropdown-menu">
      <li class="fb-share"><i class="fa fa-facebook-square fb-link"></i><input type="hidden" class="link" value="{{url('/report/' .$post->id)}}" /></li>
  <li><i class="fa fa-twitter-square twitter-link"></i></li>
  <li><i class="fa fa-youtube-play youtube-link"></i></li> 
  <li><i class="fa fa-google-plus-square google-plus-link"></i></li>
    </ul>
  </div>
  <i class="fa fa-eye"><small> {{$p->views}}</small></i>
  <i class="fa fa-comment"><small> <span class="fb-comments-count" data-href="{{url('/report/' .$post->id)}}"></span></small></i>
  <div class="fb-like" data-href="{{url('/report/' . $post->id)}}" data-width="10" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="false"></div>
  </div>
  </div>
    <mark>{{$post->category->name}}</mark>
    <h3><a href="{{url('/report/'.$post->id)}}">{{$p->title}}.</a></h3>
    <p>{{$p->lead}}. </p>
    <mark class="sec-mark">Today</mark>
  </div>
</div>


@else
  <div class="newsfeed textnews">
<img src="{{$post->picture != 'none'?asset('images/uploads/'. $post->picture):asset('images/uploads/reports/news.jpg')}}" class="textnews-img" />
  <div class="content">
  <div class="feed-btn hidden">
  <div class="feed-btn-abs">
  <div class="dropdown">
  <span class="dropdown-toggle" data-toggle="dropdown">
  <i class="fa fa-share-alt"><small> {{$p->shares}}</small>
  </i>
  </span>
    <ul class="dropdown-menu">
      <li class="fb-share"><i class="fa fa-facebook-square fb-link"></i><input type="hidden" class="link" value="{{url('/report/' .$post->id)}}" /></li>
  <li><i class="fa fa-twitter-square twitter-link"></i></li>
  <li><i class="fa fa-youtube-play youtube-link"></i></li> 
  <li><i class="fa fa-google-plus-square google-plus-link"></i></li>
    </ul>
  </div>
  <i class="fa fa-eye"><small> {{$p->views}}</small></i>
  <i class="fa fa-comment"><small> <span class="fb-comments-count" data-href="{{url('/report/' .$post->id)}}"></span></small></i>
  <div class="fb-like" data-href="{{url('/report/' . $post->id)}}" data-width="10" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="false"></div>
  </div>
  </div>
    <mark>{{$post->category->name}}</mark>
    <h3><a href="{{url('/report/'.$post->id)}}">{{$p->title}}.</a></h3>
    <p>{{$p->lead}}. </p>
    <mark class="sec-mark">Today</mark>
  </div>
</div>

@endif

@elseif($p->type == 'Photo')
  
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
    <h3><mark>PHOTO</mark> - <a href="{{url('/photos/'.$p->id)}}">{{$p->title}}.</a></h3>
        <img src="{{asset('images/uploads/'. $p->photos->first()->picture)}}"  />
        <p><strong>{{$p->photos->count()}} Photos</strong></p>
      </div>  
</div>


@elseif($p->type == 'Video')
  <?php continue; ?>
<div class="newsfeed videonews">
  <h2><mark>VIDEO</mark> - Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h2> 
    <video controls <!--autoplay-->>
                                <source src="videos/news2.mp4"" type="video/mp4">
    </video>
    <mark>Time</mark>
</div>

@endif
@endforeach
{{ $posts->links() }}
  @endsection
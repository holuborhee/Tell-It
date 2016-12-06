@extends('guest.layout')

@section('mid_col')
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
   
      <div class = "item {{ $i == 1 ? 'active' : '' }}">
         <img src = "{{asset('storage/'. $p->textpost->picture)}}" alt = "First slide">
         <div class="carousel-caption headline-carousel">
        <p class="lead"><a href="viewnews.html">{{$p->title}}</a></p>
        <p>{{$p->lead}}</p>
      </div>
      </div>
      <?php $i++ ?>
    @endforeach
      
      <!--<div class = "item">
         <img src = "images/slide2.jpg" alt = "Second slide" />
         <div class="carousel-caption headline-carousel">

        <p class="lead"><a href="viewnews.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></p>
        <p>Sed ultrices vehicula neque in dignissim. Fusce nec sagittis sem, mollis volutpat tortor. Fusce tempor ut turpis vel tempus, Sed ultrices vehicula neque in dignissim. Fusce nec sagittis sem, mollis volutpat tortor. Fusce tempor ut turpis vel tempus, Sed ultrices vehicula neque in dignissim. Fusce nec sagittis sem, mollis volutpat tortor. Fusce tempor ut turpis vel tempus.</p>
      </div>
      </div>
      
      <div class = "item">
         <img src = "images/slide3.jpg" alt = "Third slide" />
         <div class="carousel-caption headline-carousel">
        <p class="lead"><a href="viewnews.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></p>
        <p>Sed ultrices vehicula neque in dignissim. Fusce nec sagittis sem, mollis volutpat tortor. Fusce tempor ut turpis vel tempus, Sed ultrices vehicula neque in dignissim. Fusce nec sagittis sem, mollis volutpat tortor. Fusce tempor ut turpis vel tempus, Sed ultrices vehicula neque in dignissim. Fusce nec sagittis sem, mollis volutpat tortor. Fusce tempor ut turpis vel tempus.</p>
      </div>
      </div>

      <div class = "item">
         <img src = "images/slide4.jpg" alt = "Third slide" />

         <div class="carousel-caption headline-carousel">
        <p class="lead"><a href="viewnews.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></p>
        <p>Sed ultrices vehicula neque in dignissim. Fusce nec sagittis sem, mollis volutpat tortor. Fusce tempor ut turpis vel tempus, Sed ultrices vehicula neque in dignissim. Fusce nec sagittis sem, mollis volutpat tortor. Fusce tempor ut turpis vel tempus, Sed ultrices vehicula neque in dignissim. Fusce nec sagittis sem, mollis volutpat tortor. Fusce tempor ut turpis vel tempus.</p>
      </div>
      </div>
      <div class = "item">
         <img src = "images/slide5.jpg" alt = "Third slide" />
         <div class="carousel-caption headline-carousel">
        <p class="lead"><a href="viewnews.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></p>
        <p>Sed ultrices vehicula neque in dignissim. Fusce nec sagittis sem, mollis volutpat tortor. Fusce tempor ut turpis vel tempus, Sed ultrices vehicula neque in dignissim. Fusce nec sagittis sem, mollis volutpat tortor. Fusce tempor ut turpis vel tempus, Sed ultrices vehicula neque in dignissim. Fusce nec sagittis sem, mollis volutpat tortor. Fusce tempor ut turpis vel tempus.</p>
      </div>
      </div>-->
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
    <div class="col-sm-3">
      <div class="thumbnail">
        <img src="{{asset('storage/articles/article.jpg')}}" alt="article image">
        <h5><a href="#"><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</strong></a>
          </h5>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="thumbnail">
        <img src="{{asset('storage/articles/article.jpg')}}" alt="article image">
        <a href="#"><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</strong></a>
        
      </div>
    </div>
    <div class="col-sm-3">
      <div class="thumbnail">
        <img src="{{asset('storage/articles/article.jpg')}}" alt="article image">
        <a href="#"><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</strong></a>
        
      </div>
    </div>
    <div class="col-sm-3">
      <div class="thumbnail">
        <img src="{{asset('storage/articles/article.jpg')}}" alt="article image">
        <a href="#"><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</strong></a>
        
      </div>
    </div>
    <button onclick="location.href='{{url('/article')}}';" class="btn btn-sm btn-block">View All Articles</button>
</div>
</div>

@foreach($posts as $p)

@if($p->type == 'Text')
<?php $post = $p->textpost; ?>
<div class="newsfeed textnews">
<img src="{{$post->picture != 'none'?asset('storage/'. $post->picture):asset('storage/reports/news.jpg')}}" class="textnews-img" />
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
    <mark>{{$post->category->name}}</mark>
    <h3><a href="{{url('/report/'.$post->id)}}">{{$p->title}}.</a></h3>
    <p>{{$p->lead}}. </p>
    <mark class="sec-mark">Today</mark>
  </div>
</div>
@elseif($p->type == 'Photo')

<div class="newsfeed picturenews"> 
    
      
    <div class="thumbnail">
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
    <h3><mark>PHOTO</mark> - {{$p->title}}.</h3>
        <img src="images/slide2.jpg"  />
        <p><strong>43 Photos</strong></p>
      </div>  
</div>


@elseif($p->type == 'Video')

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
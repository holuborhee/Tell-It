<!DOCTYPE html>
<html lang="en">
<head>
  <title>VERBATIM EXPRESS | Lorem ipsum dolor sit amet, consectetur adipiscing elit.</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <!-- Bootstrap -->
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/paper/bootstrap.min.css"
    rel="stylesheet-->    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"
    rel="stylesheet">
  <link href="{{ url('/css/main.css') }}" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" type="text/css">
  
<!--<script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>-->
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      
      <a class="navbar-brand" href="homepage.html">
      <div class="col-xs-12" id="logo-verb">VERBATIM</div>
      <div class="col-xs-12" id="logo-exp">EXPRESS</div></a>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
    </button>
    </div>
    
      <div class="nav navbar-nav navbar-right collapse navbar-collapse">
<form class="navbar-form" role="search">      
        
    <div class="input-group input-group-lg">
      
      <input id="search-input" class="form-control" placeholder="Search News and articles" autocomplete="off" spellcheck="false" autocorrect="off" tabindex="1"> 
      <span class="input-group-addon">
        <span class="sr-only">Search icons</span>
        <i class="fa fa-search" aria-hidden="true"></i>
      </span>
    </div>           
</form>
      </div>
  </div>

<div class="container subnav collapse navbar-collapse">
<span id="abt">ISSN-2354 2241 <a href="homepage.html">More About Us</a></span>
<ul class="navbar-right nav navbar-nav">
  <li><a href="advert.html">Place An Advert</a></li>
  <li><a href="report.html">Submit A Report</a></li>
  <li>
  <ul class="nav navbar-nav">
  <li><i class="fa fa-facebook-square fb-link"></i></li>
  <li><i class="fa fa-twitter-square twitter-link"></i></li>
  <li><i class="fa fa-youtube-play youtube-link"></i></li> 
  <li><i class="fa fa-google-plus-square google-plus-link"></i></li>
  </ul>
  </li>
  <li>{{date('l, F j, Y')}}</li>

</ul>
<ul class="nav main-nav ">
  <li><a href="{{ url('/') }}" id="active"><i class="fa fa-home" ></i>Home</a></li>
  <li><a href="{{ url('/photos') }}"><i class="fa fa-camera" ></i>Photo News</a></li>
  <li><a href="{{ url('/videos') }}"><i class="fa fa-video-camera" ></i>Video News</a></li>
  @foreach(App\Category::orderBy('priority', 'asc')->cursor() as $cat)
                  <li><a href="{{ url('/category/'.$cat->id) }}" id="{{ (isset($post) AND $post->category->id == $cat->id)?'active':'' }}"><i class="{{$cat->icon}}"></i> {{$cat->name}} </a></li>
  @endforeach
  </ul>
</div>
 
</nav>
<nav class="navbar navbar-default" id="nav-default">
</nav> <!-- Dummy nav bar -->


<div class="container-fluid" id="myPage">
  <div class="left-bar" role="navigation">
  
  <ul class="nav main-nav ">
  
  <li><a href="{{ url('/') }}" id="active"><i class="fa fa-home" ></i>Home</a></li>
  <li><a href="{{ url('/photos') }}"><i class="fa fa-camera" ></i>Photo News</a></li>
  <li><a href="{{ url('/videos') }}"><i class="fa fa-video-camera" ></i>Video News</a></li>
  @foreach(App\Category::orderBy('priority', 'asc')->cursor() as $cat)
                  <li><a href="{{ url('/category/'.$cat->id) }}" id="{{ (isset($post) AND $post->category->id == $cat->id)?'active':'' }}"><i class="{{$cat->icon}}"></i> {{$cat->name}} </a></li>
  @endforeach
   
  </ul>
  
  </div>
<div class="col-sm-7 col-xs-10" id="midcol">


    @yield('mid_col')

</div>
    
<div class="col-sm-3 right-bar pull-right">

    <div class="featured-news right-bar-child" id="read-next">

  
    <p><mark class="pull-left">Trending</mark></p>
      <div >
      @foreach(App\Post::where('type','Text')->orderBy('views', 'desc')->latest()->take(10)->cursor() as $post)
        <div class="news-box">
              
                <img src="{{asset('storage/'. $post->textpost->picture)}}" />
                
                <span>
                <span class="dropdown">
                <span class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-share-alt"><small>3K</small>
                </i>
                </span>
                <ul class="dropdown-menu">
      <li><i class="fa fa-facebook-square fb-link"></i></li>
  <li><i class="fa fa-twitter-square twitter-link"></i></li>
  <li><i class="fa fa-youtube-play youtube-link"></i></li> 
  <li><i class="fa fa-google-plus-square google-plus-link"></i></li>
    </ul>

    </span>
                
                
                </i><i class="fa fa-eye"><small>{{$post->views}}</small></i><i class="fa fa-thumbs-up"><small>1.5K</small></i>
                </span>
               
              
                 
                <h4><a href="{{url('/report/'.$post->textpost->id)}}">{{$post->title}}</a></h4>
           
        </div>
        @endforeach
                
        <!--<div class="news-box">
              
                <img src="images/slide4.jpg" />
                
                <span>
                <span class="dropdown">
                <span class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-share-alt"><small>3K</small>
                </i>
                </span>
                <ul class="dropdown-menu">
      <li><i class="fa fa-facebook-square fb-link"></i></li>
  <li><i class="fa fa-twitter-square twitter-link"></i></li>
  <li><i class="fa fa-youtube-play youtube-link"></i></li> 
  <li><i class="fa fa-google-plus-square google-plus-link"></i></li>
    </ul>

    </span>
                
                
                </i><i class="fa fa-comment"><small>300</small></i><i class="fa fa-thumbs-up"><small>1.5K</small></i>
                </span>
               
              
                 
                <h4><a href="viewnews.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
           
        </div>
                
        <div class="news-box">
              
                <img src="images/slide4.jpg" />
                
                <span>
                <span class="dropdown">
                <span class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-share-alt"><small>3K</small>
                </i>
                </span>
                <ul class="dropdown-menu">
      <li><i class="fa fa-facebook-square fb-link"></i></li>
  <li><i class="fa fa-twitter-square twitter-link"></i></li>
  <li><i class="fa fa-youtube-play youtube-link"></i></li> 
  <li><i class="fa fa-google-plus-square google-plus-link"></i></li>
    </ul>

    </span>
                
                
                </i><i class="fa fa-comment"><small>300</small></i><i class="fa fa-thumbs-up"><small>1.5K</small></i>
                </span>
               
              
                 
                <h4><a href="viewnews.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
           
        </div>
                
        <div class="news-box">
              
                <img src="images/slide4.jpg" />
                
                <span>
                <span class="dropdown">
                <span class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-share-alt"><small>3K</small>
                </i>
                </span>
                <ul class="dropdown-menu">
      <li><i class="fa fa-facebook-square fb-link"></i></li>
  <li><i class="fa fa-twitter-square twitter-link"></i></li>
  <li><i class="fa fa-youtube-play youtube-link"></i></li> 
  <li><i class="fa fa-google-plus-square google-plus-link"></i></li>
    </ul>

    </span>
                
                
                </i><i class="fa fa-comment"><small>300</small></i><i class="fa fa-thumbs-up"><small>1.5K</small></i>
                </span>
               
              
                 
                <h4><a href="viewnews.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
           
        </div>
                
        <div class="news-box">
              
                <img src="images/slide4.jpg" />
                
                <span>
                <span class="dropdown">
                <span class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-share-alt"><small>3K</small>
                </i>
                </span>
                <ul class="dropdown-menu">
      <li><i class="fa fa-facebook-square fb-link"></i></li>
  <li><i class="fa fa-twitter-square twitter-link"></i></li>
  <li><i class="fa fa-youtube-play youtube-link"></i></li> 
  <li><i class="fa fa-google-plus-square google-plus-link"></i></li>
    </ul>

    </span>
                
                
                </i><i class="fa fa-comment"><small>300</small></i><i class="fa fa-thumbs-up"><small>1.5K</small></i>
                </span>
               
              
                 
                <h4><a href="viewnews.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
           
        </div>
                
        <div class="news-box">
              
                <img src="images/slide4.jpg" />
                
                <span>
                <span class="dropdown">
                <span class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-share-alt"><small>3K</small>
                </i>
                </span>
                <ul class="dropdown-menu">
      <li><i class="fa fa-facebook-square fb-link"></i></li>
  <li><i class="fa fa-twitter-square twitter-link"></i></li>
  <li><i class="fa fa-youtube-play youtube-link"></i></li> 
  <li><i class="fa fa-google-plus-square google-plus-link"></i></li>
    </ul>

    </span>
                
                
                </i><i class="fa fa-comment"><small>300</small></i><i class="fa fa-thumbs-up"><small>1.5K</small></i>
                </span>
               
              
                 
                <h4><a href="viewnews.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
           
        </div>
                
        <div class="news-box">
              
                <img src="images/slide4.jpg" />
                
                <span>
                <span class="dropdown">
                <span class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-share-alt"><small>3K</small>
                </i>
                </span>
                <ul class="dropdown-menu">
      <li><i class="fa fa-facebook-square fb-link"></i></li>
  <li><i class="fa fa-twitter-square twitter-link"></i></li>
  <li><i class="fa fa-youtube-play youtube-link"></i></li> 
  <li><i class="fa fa-google-plus-square google-plus-link"></i></li>
    </ul>

    </span>
                
                
                </i><i class="fa fa-comment"><small>300</small></i><i class="fa fa-thumbs-up"><small>1.5K</small></i>
                </span>
               
              
                 
                <h4><a href="viewnews.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
           
        </div>
                
        <div class="news-box">
              
                <img src="images/slide4.jpg" />
                
                <span>
                <span class="dropdown">
                <span class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-share-alt"><small>3K</small>
                </i>
                </span>
                <ul class="dropdown-menu">
      <li><i class="fa fa-facebook-square fb-link"></i></li>
  <li><i class="fa fa-twitter-square twitter-link"></i></li>
  <li><i class="fa fa-youtube-play youtube-link"></i></li> 
  <li><i class="fa fa-google-plus-square google-plus-link"></i></li>
    </ul>

    </span>
                
                
                </i><i class="fa fa-comment"><small>300</small></i><i class="fa fa-thumbs-up"><small>1.5K</small></i>
                </span>
               
              
                 
                <h4><a href="viewnews.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
           
        </div>
                
        <div class="news-box">
              
                <img src="images/slide4.jpg" />
                
                <span>
                <span class="dropdown">
                <span class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-share-alt"><small>3K</small>
                </i>
                </span>
                <ul class="dropdown-menu">
      <li><i class="fa fa-facebook-square fb-link"></i></li>
  <li><i class="fa fa-twitter-square twitter-link"></i></li>
  <li><i class="fa fa-youtube-play youtube-link"></i></li> 
  <li><i class="fa fa-google-plus-square google-plus-link"></i></li>
    </ul>

    </span>
                
                
                </i><i class="fa fa-comment"><small>300</small></i><i class="fa fa-thumbs-up"><small>1.5K</small></i>
                </span>
               
              
                 
                <h4><a href="viewnews.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
           
        </div>
                
                
        <div class="news-box">
              
                <img src="images/slide4.jpg" />
                
                <span>
                <span class="dropdown">
                <span class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-share-alt"><small>3K</small>
                </i>
                </span>
                <ul class="dropdown-menu">
      <li><i class="fa fa-facebook-square fb-link"></i></li>
  <li><i class="fa fa-twitter-square twitter-link"></i></li>
  <li><i class="fa fa-youtube-play youtube-link"></i></li> 
  <li><i class="fa fa-google-plus-square google-plus-link"></i></li>
    </ul>

    </span>
                
                
                </i><i class="fa fa-comment"><small>300</small></i><i class="fa fa-thumbs-up"><small>1.5K</small></i>
                </span>
               
              
                 
                <h4><a href="viewnews.html">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
           
        </div>-->
      </div>
          </div>
    
    <div class="advert right-bar-child" >
      <video controls <!--autoplay-->>
                                <source src="videos/advert2.mp4"" type="video/mp4">
            </video>
    </div>

    <div class="advert right-bar-child" >
      <img src="images/verbatimadvert.jpg" />
    </div>

    <div id = "mn" class = "carousel advert right-bar-child slide">
          <!-- Carousel items -->
        <div class = "carousel-inner">
            <div class = "item active">
              <img src="images/advert2.jpg" alt="Advert" />
            </div>
      
            <div class = "item">
              <img src="images/verbatimadvert.jpg" alt="Advert" />
            </div>
      
            <div class = "item">
              <img src="images/advert2.jpg" alt="Advert" />
            </div>

            <div class = "item">
              <img src="images/verbatimadvert.jpg" alt="Advert" />
            </div>
            <div class = "item">
              <img src="images/advert2.jpg" alt="Advert" />
            </div>
        </div>
    </div>

    <div class="advert right-bar-child">
      <video controls <!--autoplay-->>
                                <source src="videos/advert1.mp4"" type="video/mp4">
            </video>
    </div>

    <div id = "mn" class = "carousel advert right-bar-child slide">
          <!-- Carousel items -->
        <div class = "carousel-inner">
            <div class = "item active">
              <img src="images/advert2.jpg" alt="Advert" />
            </div>
      
            <div class = "item">
              <img src="images/verbatimadvert.jpg" alt="Advert" />
            </div>
      
            <div class = "item">
              <img src="images/advert2.jpg" alt="Advert" />
            </div>

            <div class = "item">
              <img src="images/verbatimadvert.jpg" alt="Advert" />
            </div>
            <div class = "item">
              <img src="images/advert2.jpg" alt="Advert" />
            </div>
        </div>
    </div>
    
  </div>


</div>
<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <span class="glyphicon glyphicon-chevron-up"></span>
  </a>
  <p>Copyright  Verbatim Express &copy;2016</p> 
</footer>







<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{asset('js/jquery.easy-ticker.js')}}" ></script>


  <script type="text/javascript">
  $(document).ready(function() {
    $('#newsCarousel').carousel({
      interval: 3000
    });

    $('.demo3').easyTicker({
        visible: 1,
        interval: 4000
    });

    $('.newsfeed').mouseover(function(){
      $(this).find('.feed-btn').removeClass('hidden');
    });

    $('.newsfeed').mouseout(function(){
      $(this).find('.feed-btn').addClass('hidden');
    });

    $('#load_com').click(function(){
      if($(this).text() == 'Load Comments'){
      $('#disqus_thread').removeClass('hidden-xs');
      $(this).text('Hide Comments');

    }
    else if($(this).text() == 'Hide Comments'){
      $('#disqus_thread').addClass('hidden-xs');
      $(this).text('Load Comments');
    }
    });

  });
</script>

<script id="dsq-count-scr" src="//verbatim-express.disqus.com/count.js" async></script>
@yield('pagejavascript')
</body>
</html>
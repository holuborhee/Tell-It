@extends('guest.layout')


@section('facebook')
    <meta property="og:url" content="{{url('/photos/' . $pos->id)}}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{$pos->title}}" />
    <meta property="og:description" content="{{$pos->lead}}" />
    
    <meta property="og:image" content="{{asset('storage/'. $pos->photos->first()->picture)}}" />
    
@endsection
@section('mid_col')
    @unless(Auth::guest())
    <nav aria-label="...">
  <ul class="pager">
    <li class="previous"><a href="{{ url('/home')}}"><span aria-hidden="true">&larr;</span> To Dashboard </a></li>
    
  </ul>
</nav>
        <a href="{{url('/photos/'. $pos->id .'/edit')}}" class="btn btn-primary">Edit</a>
        @unless($isPublished)

        
                <a class="btn btn-warning" id="pub-btn">Publish</a>
         
        @endif
        <a href="{{ url('/photos/'. $pos->id)}}" class="btn btn-danger"
        onclick="event.preventDefault();
        if(confirm('You are about to delete this Post')){
                                                     document.getElementById('delete-form').submit();}">
                                                     Delete
                    
                    </a> 

            
                    <form id="delete-form" action="{{ url('/photos/'. $pos->id) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>

        <a class="btn btn-default">View Info</a>
    @endunless
    <div class="page-header">
	<h3>{{$pos->title}}</h3>
    <mark><i class="fa fa-calendar"></i> {{$pos->getDay()}} <i class="fa fa-clock-o"></i> {{$pos->getTime()}}</mark>
    </div>



    <div class = "carousel slide" id="picture-post-carousel" data-wrap="false">
   
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
   @foreach(App\PicturePost::where('post_id',$pos->id)->cursor() as $p)
   
      <div class = "item {{ $i == 1 ? 'active' : '' }}">
         <img src = "{{asset('storage/'. $p->picture)}}" alt = "First slide">
         <div class="carousel-caption">
        <p class="lead">{{$p->description}}</p>
      </div>
      </div>
      <?php $i++ ?>
    @endforeach
      
      
   </div>
   
   <!-- Carousel nav 
   <a class = "carousel-control left" href = "#newsCarousel" data-slide = "prev">&lsaquo;</a>
   <a class = "carousel-control right" href = "#newsCarousel" data-slide = "next">&rsaquo;</a>-->

   <!-- Controls -->
                <a class="left carousel-control" data-slide="prev" href="#picture-post-carousel"><span class="icon-prev"></span></a>
                <a class="right carousel-control" data-slide="next" href="#picture-post-carousel"><span class="icon-next"></span></a>
  </div>
    
    
    
    <ul class="news-action">
    <li><a href="#"><i class="fa fa-heart-o"></i></a> {{$pos->likes}} people like this</li>
    <li><button type="button" class="btn btn-primary fb-link" id="fb-share"><i class="fa fa-facebook"></i> Facebook</button></li>
    <li><button type="button" class="btn btn-primary twitter-link"><i class="fa fa-twitter"></i>Twitter</button></li>
    <li><button type="button" class="btn btn-primary google-plus-link"><i class="fa fa-google-plus"></i>Google +</button></li>
     </ul>
     <img class="img-responsive advert" src="images/googleadvert.gif" /> 

     <div class="form-group visible-xs">

<button class="btn btn-success" id="load_com" style="width:100%; margin-top: 10px; margin-bottom: 10px;">Load Comments</button>

</div>


<div id="disqus_thread" class="hidden-xs"></div>

<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = '//verbatim-express.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>


@endsection


@section('pagejavascript')
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script>
    $(document).on('click','#pub-btn', function(event){


$.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
    $.ajax({
        dataType: 'json',
        type: 'PUT',
        url: "<?php echo route('photos.update',['id' => $pos->id]) ?>",
        data: {act:'publish'}
    }).done(function(data){
        toastr.success('Post published successfully.', 'Published', {timeOut: 5000});
        $('#pub-btn').addClass('hidden');
        
    });
});

    $(document).on('click','#fb-share', function(event){
        FB.ui({
            method: 'share',
            display: 'popup',
            href: '{{url('/photos/' . $pos->id)}}',
            }, function(response){});
    });

</script>
@endsection
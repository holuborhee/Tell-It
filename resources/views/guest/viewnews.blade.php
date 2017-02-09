@extends('guest.layout')

@section('facebook')
    <meta property="og:url" content="{{url('/report/' . $article->id)}}" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="{{$article->post?$article->post->title:$article->title}}" />
    <meta property="og:description" content="{{$article->post?$article->post->lead:$article->lead}}" />
    @unless($article->picture == 'none')
    <meta property="og:image" content="{{asset('images/uploads/'. $article->picture)}}" />
    @endunless
@endsection
@section('mid_col')
    @unless(Auth::guest())
    <nav aria-label="...">
  <ul class="pager">
    <li class="previous"><a href="{{ url('/home')}}"><span aria-hidden="true">&larr;</span> To Dashboard </a></li>
    
  </ul>
</nav>
        <a href="{{$article->post ?url('/report/'. $article->id .'/edit'):url('/article/'. $article->id .'/edit')}}" class="btn btn-primary">Edit</a> <a href="{{$article->post ?url('/report/'. $article->id .'/edit?act=dp'):url('/article/'. $article->id .'/edit?act=dp')}}" class="btn btn-success">Change Display Picture</a>
        @if($article->isPublished)

        @else 
            @if(isset($article->post) AND !$article->post->isPublished)
                <a class="btn btn-warning" id="pub-btn">Publish</a>
            @elseif(!isset($article->post))
                <a class="btn btn-warning" id="pub-btn">Publish</a>
            @endif
         
        @endif
        <a href="{{ $article->post ?url('/report/'. $article->id):url('/article/'. $article->id)}}" class="btn btn-danger"
        onclick="event.preventDefault();
        if(confirm('You are about to delete this Post')){
                                                     document.getElementById('delete-form').submit();}">
                                                     Delete
                    
                    </a> 

            
                    <form id="delete-form" action="{{ $article->post ?url('/report/'. $article->id):url('/article/'. $article->id) }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                        </form>

        <a class="btn btn-default">View Info</a>
    @endunless
    <div class="page-header">
	<h3>{{$article->post->title or $article->title}}</h3>
    <mark><i class="fa fa-calendar"></i> {{$article->post ?$article->post->getDay():$article->getDay()}} <i class="fa fa-clock-o"></i> {{$article->post ?$article->post->getTime():$article->getTime()}}</mark>
    </div>
    
    {!!html_entity_decode($article->body)!!}


    <div class="panel panel-default" style="margin-top:35px;">
                
            <div class="panel-body">
            <?php $user = $article->post?$article->post->users->first():$article->column->user; ?>
            <img width="167" src="{{$user->picture == NULL ? asset('images/uploads/users/default2.png') :asset('images/uploads/'.$user->picture) }}" alt="..." class="img-circle profile_img pull-left">
                <h3>{{$article->post?$article->post->users->first()->name:$article->column->user->name}}</h3>
                <p>{{$article->post?$article->post->users->first()->description:$article->column->user->description}}</p>
            </div>

            <div class="panel-footer">
            </div>
    </div>

    
    <ul class="news-action">
    <!--<li><a href="#"><i class="fa fa-heart-o"></i></a> {{$article->post->likes or $article->likes}} people like this</li>-->
    <div class="fb-like" data-href="{{url('/report/' . $article->id)}}" data-width="25" data-layout="standard" data-action="like" data-size="large" data-show-faces="true" data-share="false"></div>
    <li><button type="button" class="btn btn-primary fb-link" id="fb-share"><i class="fa fa-facebook"></i> Facebook</button></li>
    <li><button type="button" class="btn btn-primary twitter-link"><i class="fa fa-twitter"></i>Twitter</button></li>
    <li><button type="button" class="btn btn-primary google-plus-link"><i class="fa fa-google-plus"></i>Google +</button></li>
     </ul>
      

     <div class="form-group visible-xs">

<button class="btn btn-success" id="load_com" style="width:100%; margin-top: 10px; margin-bottom: 10px;">Load Comments</button>

</div>

<div class="fb-comments" data-href="{{$article->post?url('/report/' . $article->id):url('/article/' . $article->id)}}" data-width="100%" data-numposts="20"></div>
<!--<div id="disqus_thread" class="hidden-xs"></div>

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
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript> -->


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
        url: "<?php echo isset($article->post)?route('report.update',['id' => $article->id]):route('article.update',['id' => $article->id]) ?>",
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
            href: '{{$article->post?url('/report/' . $article->id):url('/article/' . $article->id)}}',
            }, function(response){});
    });

</script>
@endsection
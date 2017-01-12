@extends('layouts.app')

@section('content')

    <div class="row">

<div class="col-xs-10 col-xs-offset-1">
<nav aria-label="...">
  <ul class="pager">
    <li class="previous"><a href="index.html"><span aria-hidden="true">&larr;</span> Go back </a></li>
    
  </ul>
</nav>
<div class="page-header">
        
            <h3><i class="fa fa-camera" ></i> Photo Reports <span class="label label-info">{{App\Post::where('type','Photo')->count()}}</span></h3>
            
            <a href="{{ url('/photos/create?page=create') }}" class="btn btn-success pull-right" 
                               >
                    <i class="fa fa-plus"></i> Create New Post

                    
            </a>



            
                    
</div>
        <div class="row">

            <div class="col-md-6">
                <form role="search" class="search-box">      
        
                    <div class="input-group input-group-lg">
      
                    <input id="search-input" class="form-control" placeholder="Search Photos" autocomplete="off" spellcheck="false" autocorrect="off" tabindex="1"> 
                    <span class="input-group-addon">
                    <span class="sr-only">Search icon</span>
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </span>
                    </div>           
                </form>
            </div>

            <div class="col-md-6">
                <label for="title" class="col-md-2 control-label">From</label><div class="col-md-10"><input type="date" class="form-control" name="from" /></div>

                <label for="title" class="col-md-2 control-label">To</label><div class="col-md-10"><input type="date" name="to" class="form-control" /></div>

            </div>
        </div>
            <div class="panel panel-success content-box">
                <div class="panel-heading">
                    <h3 class="panel-title">All Posts <span class="label label-warning">{{count($posts)}}</span>
                    <i class="fa fa-angle-up pull-right"></i>
                    </h3>
                    
                </div>
                <div class="panel-body">
                @foreach($posts as $post)
                    <div class="newsfeed picturenews"> 
    
      
                        <a href="{{ url('photos/1') }}" class="thumbnail">
                            <h3>{{$post->title}}.</h3>

                                <img src="{{ asset('images/uploads/'.$post->photos->first()->picture) }}"  />
                                <p><strong>{{$post->photos->count()}} Photos</strong> <strong>{{$post->likes}} Likes</strong> <strong>{{$post->shares}} Shares</strong> <strong>0 Comments</strong> 
                                <mark>{{$post->created_at}}</mark></p>

                        </a>  
                    </div>

                    @endforeach
                        
                    
                        
                    
                </div>
            </div>
        </div>
     </div>   
@endsection

@section('pagejavascript')
    <script type="text/javascript">
  $(document).ready(function() {
    
    $('.content-box > .panel-heading > .panel-title > i').click(function() {
    if($(this).hasClass( "fa-angle-down" ) == true){
       var content_box = $(this).parents('.content-box');
       content_box.removeClass('panel-info');
       content_box.addClass('panel-success'); 
       content_box.find('.panel-body').removeClass('hidden');
       content_box.find('.panel-heading > .panel-title > i').removeClass('fa-angle-down');
       content_box.find('.panel-heading > .panel-title > i').addClass('fa-angle-up');
    }else if($(this).hasClass( "fa-angle-up" ) == true){
    
       var content_box = $(this).parents('.content-box');
       content_box.removeClass('panel-success');
       content_box.addClass('panel-info'); 
       content_box.find('.panel-body').addClass('hidden');
       content_box.find('.panel-heading > .panel-title > i').removeClass('fa-angle-up');
       content_box.find('.panel-heading > .panel-title > i').addClass('fa-angle-down');
    
    }
    });
  });
</script>
@endsection
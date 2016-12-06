@extends('layouts.app')

@section('content')

    <div class="row">

<div class="col-xs-10 col-xs-offset-1">
<nav aria-label="...">
  <ul class="pager">
    <li class="previous"><a href="{{url('/column')}}"><span aria-hidden="true">&larr;</span> View All Existing Columns </a></li>
    
  </ul>
</nav>
<div class="page-header">
        
            <h3><i class="fa fa-file" ></i> {{$col->name}} <span class="label label-info">{{App\Column::find($col->id)->articles()->count()}}</span></h3>

            <p class="lead">{{ucfirst($col->description)}}</p>
            
            <a href="{{url('/article/create?colid='.$col->id)}}" class="btn btn-success pull-right" 
                               >
                    <i class="fa fa-plus"></i> Create New Article

                    
            </a>



            
                    
</div>
        <div class="row">

            <div class="col-md-6">
                <form role="search" class="search-box">      
        
                    <div class="input-group input-group-lg">
      
                    <input id="search-input" onkeyup="search_reports();" class="form-control" placeholder="Search News" autocomplete="off" spellcheck="false" autocorrect="off" tabindex="1"> 
                    <span class="input-group-addon">
                    <span class="sr-only">Search icon</span>
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </span>
                    </div>           
                </form>
            </div>

            <div class="col-md-6">
                <label for="title" class="col-md-2 control-label">From</label><div class="col-md-10"><input id="search-from" onkeyup="search_reports();" onchange="search_reports();" type="date" class="form-control" name="from" /></div>

                <label for="title" class="col-md-2 control-label">To</label><div class="col-md-10"><input id="search-to" onkeyup="search_reports();" onchange="search_reports();" type="date" name="to" class="form-control" /></div>

            </div>
        </div>
            <div class="panel panel-success content-box">
                <div class="panel-heading">
                    <h3 class="panel-title">All Posts <span class="label label-warning">{{count($articles)}}</span>
                    <i class="fa fa-angle-up pull-right"></i>
                    </h3>

                    
                </div>
                <div class="panel-body">
                    <div class="list-group">

                    @foreach($articles as $post)
                        <a href="{{url('/article/'.$post->id)}}" class="list-group-item report-short-display">
                            <h4 class="list-group-item-heading">{{$post->title}}<small><em> on </em> {{ $post->created_at}} </small></h4>
                            
                            <div class="list-group-item-text row">
                            <div class="col-xs-3 col-sm-2 news-info text-center" >
                                 <i class="fa fa-cog"></i> <br /> {{ $post->isPublished == 0 ? 'Saved' : 'Published'}}
                            </div>
                            <div class="col-xs-3 col-sm-2 news-info text-center" >
                                <i class="fa fa-calendar"></i> 2 <br />days ago
                            </div>
                            <div class="col-xs-3 col-sm-2 text-center news-info" >
                                <i class="fa fa-share-alt"></i> {{ $post->shares}}
                                <br />shares
                            </div>
                            <div class="col-xs-3 col-sm-2 news-info text-center" >
                                 <i class="fa fa-heart"></i> {{ $post->likes}} <br /> likes
                            </div>
                            <div class="col-xs-3 col-sm-2 news-info text-center" >
                                 <i class="fa fa-eye"></i> {{ $post->views }} <br /> views
                            </div>
                            <div class="col-xs-3 col-sm-2 news-info-last text-center" >
                                 <i class="fa fa-comment"></i> 1 <br /> comment
                            </div>
                            </div>
                        </a>

                    @endforeach
                        
                    
                        
                    </div>
                    {{ $articles->links() }}
                    <ul id="pagination" class="pagination-sm"></ul>
                </div>
            </div>
        </div>
     </div>   
@endsection

@section('pagejavascript')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
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



var page = 1;
        var current_page = 1;
        var total_page = 0;
        var is_ajax_fire = 0;       
var url = "<?php echo route('article.index') ?>";
  function search_reports(){

        page = 1;
        current_page = 1;
        total_page = 0;
        is_ajax_fire = 0;
        var all = 0;

        var datefrom = $('#search-from').val();
        var dateto = $('#search-to').val();
        var searchword = $('#search-input').val();
        
        $.ajax({
        dataType: 'json',
        type:'GET',
        url: url,
        data: {page:page, act:'search', col: "<?php echo $col->id ?>", datefrom: datefrom, dateto: dateto, searchword: searchword}
    }).done(function(data){
           total_page = data.last_page;
            current_page = data.current_page;

            
            $('.label-warning').html(data.total);

        $('#pagination').twbsPagination({
            totalPages: total_page,
            visiblePages: current_page,
            onPageClick: function (event, pageL) {
                page = pageL;
                if(is_ajax_fire != 0){
                  getPageData(url);
                }
            }
        });

        manageRow(data.data);
        is_ajax_fire = 1;
    }); 
        

    }


    /* Get Page Data*/
function getPageData(url) { 
        var datefrom = $('#search-from').val();
        var dateto = $('#search-to').val();
        var searchword = $('#search-input').val();  
    $.ajax({
        dataType: 'json',
        type:'GET',
        url: url,
        data: {page:page, act:'search', col: "<?php echo $col->id ?>", datefrom: datefrom, dateto: dateto, searchword: searchword}
    }).done(function(data){
        //alert(data.data);
        $('.label-warning').html(data.total);
        manageRow(data.data);
        
    });

}

function manageRow(data) {
    
    var rows = ' ';
    //$('.label-warning').html(page);
    $.each( data, function( key, value ) {
        rows = rows + '<a href="<?php echo url('/report/') ?>' + value.id + '" class="list-group-item report-short-display">';
        rows = rows + '<h4 class="list-group-item-heading">' + value.title + '<small><em> by </em> John Doe <em> on </em>' + value.created_at + '</small></h4>';
        rows = rows + '<div class="list-group-item-text row">';
        rows = rows + '<div class="col-xs-3 col-sm-2 news-info text-center" ><i class="fa fa-cog"></i> <br />';
        if(value.isPublished == 0)
            pub = 'Saved';
        else
            pub = 'Published';
        rows = rows + '' + pub + '</div>';
        rows = rows + '<div class="col-xs-3 col-sm-2 news-info text-center" ><i class="fa fa-calendar"></i>' + value.created_at + ' </div>';
        rows = rows + '<div class="col-xs-3 col-sm-2 text-center news-info" ><i class="fa fa-share-alt"></i>'  + value.shares + ' <br />shares</div>';
        rows = rows + '<div class="col-xs-3 col-sm-2 news-info text-center" ><i class="fa fa-heart"></i>'  + value.likes + '<br /> likes</div>';
        rows = rows + '<div class="col-xs-3 col-sm-2 news-info text-center" ><i class="fa fa-eye"></i>'  + value.views + '<br /> views</div>';

        rows = rows + '<div class="col-xs-3 col-sm-2 news-info-last text-center" ><i class="fa fa-comment"></i> 1 <br /> comment</div></div></a>';
    });


                            
                            
                            
                             
                            
                            
                            
                            
                            
           
           
           

    $(".list-group").html(rows);
}

</script>
@endsection
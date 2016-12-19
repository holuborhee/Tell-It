@extends('layouts.app')

@section('pagecss')
<!-- Dropzone.js -->
    <link href="{{url('/css/dropzone.min.css')}}" rel="stylesheet">
@endsection


@section('modal')
    
    <div class="modal fade" id="selectNewsModal" tabindex="-1" role="dialog" aria-labelledby="selectNewsModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body ">
        <ul class="list-group news-items">
  
        </ul>
        <ul id="pagination" class="pagination-sm"></ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary disabled">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection


@section('content')

    <div class="row">

<div class="col-xs-10 col-xs-offset-1">
<nav aria-label="...">
  <ul class="pager">
    <li class="previous"><a href="index.html"><span aria-hidden="true">&larr;</span> Go back </a></li>
    
  </ul>
</nav>
<div class="page-header">
        
            <h3><i class="fa fa-camera" ></i> Customize </h3>            
                    
</div>
        
            <div class="panel panel-info content-box">
                <div class="panel-heading">
                    <h3 class="panel-title"><a href="business.html">Slideshow</a> <span class="label label-warning">5</span>
                    <i class="fa fa-angle-down pull-right"></i>
                    </h3>
                    
                </div>
                <div class="panel-body hidden slide-body">
                @foreach($posts as $post)
                    <div class="col-xs-4 well text-center slideshow-box">
                    <div class="thumbnail">
                        <img src="{{asset('storage/'. $post->textpost->picture)}}" alt="...">
                        <div class="caption">
                        <p><small>{{$post->title}}.</small></p>
                        </div>
                        
                    </div>
                    <input type="hidden" id="id" name="id" value="{{$post->id}}" />
                      <button class="btn btn-success remove-btn" value="{{url('/post')}}"><i class="fa fa-minus"></i> Remove</button>  
                     </div>
                @endforeach

                @for($i = 1; $i<=(5-count($posts)); $i++)   
                     
                     <div class="col-xs-4 well text-center slideshow-box">
                        <button class="btn btn-success open-report" type="button"><i class="fa fa-plus"></i> Insert</button>
                     </div>
                     
                 @endfor    
                     
                     
                </div>
            </div>


            <div class="panel panel-info content-box">
                <div class="panel-heading">
                    <h3 class="panel-title"><a href="business.html">Article thumbnails</a> <span class="label label-warning">4</span>
                    <i class="fa fa-angle-down pull-right"></i>
                    </h3>
                    
                </div>
                <div class="panel-body hidden article-body">
                @foreach($articles as $post)
                    <div class="col-xs-4 well text-center slideshow-box">
                    <div class="thumbnail">
                        <img src="{{asset('storage/' . $post->picture)}}" alt="...">
                        <div class="caption">
                        <p><small>{{$post->title}}</small></p>
                        </div>
                    
                    </div>
                    <input type="hidden" id="id" name="id" value="{{$post->id}}" />
                      <button class="btn btn-success removearticle-btn" value="{{url('/article')}}"><i class="fa fa-minus"></i> Remove</button>  
                     </div>
                 @endforeach

                 @for($i = 1; $i<=(4-count($articles)); $i++)    
                     <div class="col-xs-4 well text-center slideshow-box">
                        <button class="btn btn-success open-articles" type="button"><i class="fa fa-plus"></i> Insert</button>
                     </div>
                 @endfor
                     
                </div>
            </div>



            
        </div>
     </div>   
@endsection

@section('pagejavascript')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script>
    $(document).ready(function(){

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












        

    //var url = "/verbatimexpress/public";
        var page = 1;
        var current_page = 1;
        var total_page = 0;
        var is_ajax_fire = 0;
    $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

    $('.open-report').click(function(){

        var url = "<?php echo route('post.index') ?>";

        manageData(url);

        $('#selectNewsModal').modal('show');
    });


    $('.remove-btn').click(function(){

        var url = $(this).val();
        
        var id = $(this).parents('.slideshow-box').find("input[name='id']").val();
        url = url + '/' + id;

        $.ajax({
        dataType: 'json',
        type:'PUT',
        url: url,
        data: {act:'remove'}
    }).done(function(data){
            if(data.success == true)
            updateSlideShow();    
            toastr.success('Removed From Slide Show SuccesFully.', 'Success Alert', {timeOut: 5000});
        });
        //manageData(url);

        //$('#selectNewsModal').modal('show');
    });


    function manageData(url) {
    $.ajax({
        dataType: 'json',
        url: url,
        data: {page:page}
    }).done(function(data){

        total_page = data.last_page;
        current_page = data.current_page;

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
        $.ajax({
        dataType: 'json',
        url: url,
        data: {page:page}
    }).done(function(data){
        manageRow(data.data);
        
    });

}


    function manageRow(data) {
    var rows = '<input type="hidden" value="{{url('/post')}}" id="url" name="url" />';
    $.each( data, function( key, value ) {
        rows = rows + '<li class="list-group-item ">';
        rows = rows + '<div class="row news-modal-body">';
        rows = rows + '<span class="col-sm-2"><input type="radio" value="' + value.id + '" class="radio-inline" name="news" /> </span>';
        rows = rows + '<span class="col-sm-8"><h3 >' + value.title + '</h3></span>';
        rows = rows + '<span class="col-sm-2"><img src="storage/' + value.textpost.picture +'" class="img-responsive" /></span>';
                rows = rows + '</div>';
        rows = rows + '</li>';
    });
           
           
           

    $(".news-items").html(rows);
}

function updateSlideShow()
    {
        var url = "<?php echo route('post.index') ?>";
        var rows = " "; 
    $.ajax({
        dataType: 'json',
        type:'GET',
        url: url,
        data: {act:'inslide'}
    }).done(function(data){
            
           $.each( data, function( key, value ) {

        rows = rows + '<div class="col-xs-4 well text-center slideshow-box">'
                    rows = rows + '<div class="thumbnail">'
                        rows = rows + '<img src="storage/' + value.textpost.picture +'" alt="...">'
                        rows = rows + '<div class="caption">'
                        rows = rows + '<p><small>' + value.title + '</small></p>'
                        rows = rows + '</div>'
                    
                    rows = rows + '</div>'
                    rows = rows + '<input type="hidden" id="id" name="id" value="' + value.id + '" />';
                      rows = rows + '<button class="btn btn-success remove-btn" value="{{url('/post')}}"><i class="fa fa-minus"></i> Remove</button>';  
                     rows = rows + '</div>'; 
        
    }); 
           for(i = 1; i<=(5-data.length); i++){
                rows = rows + '<div class="col-xs-4 well text-center slideshow-box">';
                rows = rows + '<button class="btn btn-success open-report" type="button"><i class="fa fa-plus"></i> Insert</button>';
                rows = rows + '</div>';
           }

           $(".slide-body").html(rows);
            
        });
    }

});





/*    Ajax Loaded Modal Window */
    $(document).on('change','.radio-inline', function(event){

        
        
        var id = $(this).val();
        
        var url = $('#url').val();
        //url = window.location.protocol + "//" + window.location.host  + '/verbatimexpress';
        
        addToSlideshow();
        
        
$.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

        function addToSlideshow(){
            url = url + '/' + id;
    $.ajax({
        dataType: 'json',
        type:'PUT',
        url: url
    }).done(function(data){
            if(data.success == true)
            updateSlideShow();
            $('#selectNewsModal').modal('hide');    
            toastr.success('New Slide Show Added.', 'Success Alert', {timeOut: 5000});
        });

    }

    function updateSlideShow()
    {
        var url = "<?php echo route('post.index') ?>";
        var rows = " "; 
    $.ajax({
        dataType: 'json',
        type:'GET',
        url: url,
        data: {act:'inslide'}
    }).done(function(data){
            
           $.each( data, function( key, value ) {

        rows = rows + '<div class="col-xs-4 well text-center slideshow-box">'
                    rows = rows + '<div class="thumbnail">'
                        rows = rows + '<img src="storage/' + value.textpost.picture +'" alt="...">'
                        rows = rows + '<div class="caption">'
                        rows = rows + '<p><small>' + value.title + '</small></p>'
                        rows = rows + '</div>'
                    
                    rows = rows + '</div>'
                    rows = rows + '<input type="hidden" id="id" name="id" value="' + value.id + '" />';
                      rows = rows + '<button class="btn btn-success remove-btn" value="{{url('/post')}}"><i class="fa fa-minus"></i> Remove</button>';  
                     rows = rows + '</div>'; 
        
    }); 
           for(i = 1; i<=(5-data.length); i++){
                rows = rows + '<div class="col-xs-4 well text-center slideshow-box">';
                rows = rows + '<button class="btn btn-success open-report" type="button"><i class="fa fa-plus"></i> Insert</button>';
                rows = rows + '</div>';
           }

           $(".slide-body").html(rows);
            
        });
    }



    });





/*    Ajax Loaded Slide Show */

$(document).on('click','.open-report', function(event){

    var page = 1;
        var current_page = 1;
        var total_page = 0;
        var is_ajax_fire = 0;
            var url = "<?php echo route('post.index') ?>";

        manageData(url);

        $('#selectNewsModal').modal('show');


        function manageData(url) {
    $.ajax({
        dataType: 'json',
        url: url,
        data: {page:page}
    }).done(function(data){

        total_page = data.last_page;
        current_page = data.current_page;

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
        $.ajax({
        dataType: 'json',
        url: url,
        data: {page:page}
    }).done(function(data){
        manageRow(data.data);
        
    });

}


    function manageRow(data) {
    var rows = '<input type="hidden" value="{{url('/post')}}" id="url" name="url" />';
    $.each( data, function( key, value ) {
        rows = rows + '<li class="list-group-item ">';
        rows = rows + '<div class="row news-modal-body">';
        rows = rows + '<span class="col-sm-2"><input type="radio" value="' + value.id + '" class="radio-inline" name="news" /> </span>';
        rows = rows + '<span class="col-sm-8"><h3 >' + value.title + '</h3></span>';
        rows = rows + '<span class="col-sm-2"><img src="storage/' + value.textpost.picture +'" class="img-responsive" /></span>';
                rows = rows + '</div>';
        rows = rows + '</li>';
    });
           
           
           

    $(".news-items").html(rows);
}

    });

$(document).on('click','.remove-btn', function(event){

    var url = $(this).val();
        
        var id = $(this).parents('.slideshow-box').find("input[name='id']").val();
        url = url + '/' + id;

        $.ajax({
        dataType: 'json',
        type:'PUT',
        url: url,
        data: {act:'remove'}
    }).done(function(data){
            if(data.success == true)
            updateSlideShow();    
            toastr.success('Removed From Slide Show SuccesFully.', 'Success Alert', {timeOut: 5000});
        });

    function updateSlideShow()
    {
        var url = "<?php echo route('post.index') ?>";
        var rows = " "; 
    $.ajax({
        dataType: 'json',
        type:'GET',
        url: url,
        data: {act:'inslide'}
    }).done(function(data){
            
           $.each( data, function( key, value ) {

        rows = rows + '<div class="col-xs-4 well text-center slideshow-box">'
                    rows = rows + '<div class="thumbnail">'
                        rows = rows + '<img src="storage/' + value.textpost.picture +'" alt="...">'
                        rows = rows + '<div class="caption">'
                        rows = rows + '<p><small>' + value.title + '</small></p>'
                        rows = rows + '</div>'
                    
                    rows = rows + '</div>'
                    rows = rows + '<input type="hidden" id="id" name="id" value="' + value.id + '" />';
                      rows = rows + '<button class="btn btn-success remove-btn" value="{{url('/post')}}"><i class="fa fa-minus"></i> Remove</button>';  
                     rows = rows + '</div>'; 
        
    }); 
           for(i = 1; i<=(5-data.length); i++){
                rows = rows + '<div class="col-xs-4 well text-center slideshow-box">';
                rows = rows + '<button class="btn btn-success open-report" type="button"><i class="fa fa-plus"></i> Insert</button>';
                rows = rows + '</div>';
           }

           $(".slide-body").html(rows);
            
        });
    }
});



/***************************************************************************************************************
    **********************************************************************************************************
    **********************************************************************************************************
    **********************************************************************************************************
    ************* ARRRRRRRRRRRRRRRTTTTTTTTTTTTTTIIIIIIIIIIIIIICCCCCCCCCCLLLLLLLLLLEEEEEEESSSSSSSSSSS *********
    **********************************************************************************************************
    **********************************************************************************************************
    **********************************************************************************************************
***************************************************************************************************************/

function addToThumbnail(url, id){
    
     url = url + '/' + id;
    $.ajax({
        dataType: 'json',
        type:'PUT',
        url: url,
        data: {act:'addthumbnail'}
    }).done(function(data){
            if(data.success == true)
            updateThumbnail();
            $('#selectNewsModal').modal('hide');    
            toastr.success('New Article added to Thumbnail.', 'Success Alert', {timeOut: 5000});
        });

    }


    function updateThumbnail()
    {
        var url = "<?php echo route('article.index') ?>";
        var rows = " "; 
    $.ajax({
        dataType: 'json',
        type:'GET',
        url: url,
        data: {act:'inslide'}
    }).done(function(data){
            
           $.each( data, function( key, value ) {

        rows = rows + '<div class="col-xs-4 well text-center slideshow-box">'
                    rows = rows + '<div class="thumbnail">'
                        rows = rows + '<img src="storage/' + value.picture +'" alt="...">'
                        rows = rows + '<div class="caption">'
                        rows = rows + '<p><small>' + value.title + '</small></p>'
                        rows = rows + '</div>'
                    
                    rows = rows + '</div>'
                    rows = rows + '<input type="hidden" id="id" name="id" value="' + value.id + '" />';
                      rows = rows + '<button class="btn btn-success removearticle-btn" value="{{url('/article')}}"><i class="fa fa-minus"></i> Remove</button>';  
                     rows = rows + '</div>'; 
        
    }); 


           


           for(i = 1; i<=(4-data.length); i++){
                rows = rows + '<div class="col-xs-4 well text-center slideshow-box">';
                rows = rows + '<button class="btn btn-success open-articles" type="button"><i class="fa fa-plus"></i> Insert</button>';
                rows = rows + '</div>';
           }

           $(".article-body").html(rows);
            
        });
    }



$(document).on('change','.select-article', function(event){

        
        
        var id = $(this).val();
        
        var url = $('#url').val();
        //url = window.location.protocol + "//" + window.location.host  + '/verbatimexpress';
        
        addToThumbnail(url, id);
        
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
});





$(document).on('click','.open-articles', function(event){

    var page = 1;
        var current_page = 1;
        var total_page = 0;
        var is_ajax_fire = 0;
            var url = "<?php echo route('article.index') ?>";

        manageData(url);

        $('#selectNewsModal').modal('show');


        function manageData(url) {
    $.ajax({
        dataType: 'json',
        url: url,
        data: {page:page}
    }).done(function(data){

        total_page = data.last_page;
        current_page = data.current_page;

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
        $.ajax({
        dataType: 'json',
        url: url,
        data: {page:page}
    }).done(function(data){
        manageRow(data.data);
        
    });

}


    function manageRow(data) {
    var rows = '<input type="hidden" value="{{url('/article')}}" id="url" name="url" />';
    $.each( data, function( key, value ) {
        rows = rows + '<li class="list-group-item ">';
        rows = rows + '<div class="row news-modal-body">';
        rows = rows + '<span class="col-sm-2"><input type="radio" value="' + value.id + '" class="select-article" name="news" /> </span>';
        rows = rows + '<span class="col-sm-8"><h3 >' + value.title + '</h3></span>';
        rows = rows + '<span class="col-sm-2"><img src="storage/' + value.picture +'" class="img-responsive" /></span>';
                rows = rows + '</div>';
        rows = rows + '</li>';
    });
           
           
           

    $(".news-items").html(rows);
}

    });




$(document).on('click','.removearticle-btn', function(event){

    var url = $(this).val();
        
        var id = $(this).parents('.slideshow-box').find("input[name='id']").val();
        url = url + '/' + id;

        $.ajax({
        dataType: 'json',
        type:'PUT',
        url: url,
        data: {act:'remove'}
    }).done(function(data){
            if(data.success == true)
                updateThumbnail();    
            toastr.success('Removed From Thumbnail SuccesFully.', 'Success Alert', {timeOut: 5000});
        });

    
});


</script>   
@endsection
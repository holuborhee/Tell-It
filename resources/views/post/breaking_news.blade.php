@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <nav aria-label="...">
          <ul class="pager">
            <li class="previous"><a href="{{url('/home')}}"><span aria-hidden="true">&larr;</span> DashBoard </a></li>
    
          </ul>
        </nav>
            <div class="panel panel-default">
                <div class="panel-heading">New Breaking News</div>
                <div class="panel-body">
                       
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            

                            <div class="col-md-12">
                                <input id="content" type="text" class="form-control" name="content" value="{{ old('content') }}" placeholder="Breaking News Content" onkeyup="enablebutton()" required autofocus>

                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" id="add-btn" class="btn btn-primary disabled">
                                    Add
                                </button>
                            </div>
                        </div>
                    
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">All Breaking News</div>
                <div class="panel-body all-news-body">
                    
                        
                      @foreach(App\BreakingNews::cursor() as $news)
                      <div class="news-item">
                        <div class="form-group">
                            <input type="hidden" class="news-id" value="{{$news->id}}" />
                            <div class="col-md-12 content-div">

                            <p>{{$news->description}}</p>

                            </div>

                        </div>


                        <div class="form-group">

                            <div class="col-md-6">
                                <button type="submit" class="btn btn-danger delete-btn">
                                    Delete
                                </button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-warning edit-btn">
                                    Edit
                                </button>
                            </div>

                            
                        </div>
                    </div>

                    @endforeach    
                   
                </div>
            </div>


        </div>
    </div>

@endsection

@section('pagejavascript')
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
<script>
$(document).on('click','#add-btn', function(event){

        event.preventDefault();
        storeNews();
        
});

$(document).on('click','.delete-btn', function(event){

        event.preventDefault();
        if(confirm('Do you wanto delete this News?')){
           news_item = $(this).parents('.news-item');
            deleteNews(news_item.find('.news-id').val());
            news_item.remove(); 
        }
        
        
});

$.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

    function storeNews()
    {
        
        var content = $('#content').val();
        var url = "<?php echo route('breaking-news.store') ?>";
        $.ajax({
        dataType: 'json',
        type: 'POST',
        url: url,
        data: {description:content}
        }).done(function(data){

            addNewsRow(data);
            $('#content').val('');
            toastr.success('The breaking News has been successfully Added.', 'Done', {timeOut: 5000});
        
        });
    }

    function updateNews(id)
    {
        
        var content = $('#edit-content').val();
        var url = "<?php echo url('/breaking-news') ?>" + "/" + id;
        $.ajax({
        dataType: 'json',
        type: 'PUT',
        url: url,
        data: {description:content}
        }).done(function(data){

            content = data.description;
            
        
        });

        return content;
    }

    function deleteNews(id)
    {
        
        //var content = $('#edit-content').val();
        var url = "<?php echo url('/breaking-news') ?>" + "/" + id;
        $.ajax({
        dataType: 'json',
        type: 'DELETE',
        url: url
        }).done(function(data){

            toastr.success('The breaking News has been successfully removed.', 'Done', {timeOut: 5000});
            
        
        });
    }




    var onedit = false;
    $(document).on('click','.edit-btn', function(event){

        event.preventDefault();
        var news_item = $(this).parents('.news-item');
        var news_content = news_item.find('p').html();
        var content_div = news_item.find('.content-div');
        
        if(onedit){
            if(news_item.find('p').length)
            {
                //User trying to edit another while one is one edit
                alert("Currently editing a News");
            }
            else
            {
                //do edit

                var new_news_content = updateNews(news_item.find('.news-id').val());
                content_div.html('<p>' + new_news_content + '</p>');
                $(this).html("Edit");
                onedit = false;
                toastr.success('The breaking News has been updated successfully.', 'Done', {timeOut: 5000});
            }

        }else{
            onedit = true;
           
            content_div.html('<input type="text" id="edit-content" autofocus class="form-control" value="' + news_content + '" autofocus /> ');
            $(this).html("UPDATE");
             
        }
        
    });

    


    function addNewsRow(data)
    {
        var row = ' ';
        row += '<div class="news-item">';
        row += '<div class="form-group">';
        row += '<input type="hidden" class="news-id" value="' + data.id + '" />';
                row += '<div class="col-md-12 content-div">';

                    row += '<p>' + data.description +'</p>';

                row += '</div>';

        row += '</div>';


        row += '<div class="form-group">';
                row += '<div class="col-md-6">';
                            row += '<button type="submit" class="btn btn-danger delete-btn">Delete</button>';
                row += '</div>';

                row += '<div class="col-md-6">';
                            row += '<button type="submit" class="btn btn-warning edit-btn">Edit</button>';
                row += '</div>';
        row += '</div>';
        row += '</div>';


        //var curr = $(".all-news-body").html();
        $(".all-news-body").append(row);
    }




    


function enablebutton()
    {

            if($('#content').val() === ''){
        
                $('#add-btn').addClass('disabled');

            }else{
        
            $('#add-btn').removeClass('disabled');

            }
    
    }

</script>
@endsection
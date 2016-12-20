@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <nav aria-label="...">
          <ul class="pager">
            <li class="previous"><a href="{{url('/home')}}"><span aria-hidden="true">&larr;</span> Back To Dashboard </a></li>
    
          </ul>
        </nav>
            <div class="panel panel-default">
                <div class="panel-heading">New User</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4">Name</label>

                            <div class="col-md-6 value">
                                <p class="lead">{{Auth::user()->name}}</p>
                            </div>

                            <a class="col-md-1 pull-right edit-link" href="{{ url('/user/' . Auth::user()->id . "?col=name") }}"><i class="fa fa-pencil"></i> Edit</a>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4">E-Mail Address</label>

                            <div class="col-md-6 value">
                                <p class="lead">{{Auth::user()->email}}</p>
                            </div>
                            <a class="col-md-1 pull-right edit-link" href="{{ url('/user/' . Auth::user()->id . "?col=email") }}"><i class="fa fa-pencil"></i> Edit</a>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-md-4">Phone Number</label>

                            <div class="col-md-6 value">
                                <p class="lead">{{Auth::user()->phone}}</p>
                            </div>

                            <a class="col-md-1 pull-right edit-link" href="{{ url('/user/' . Auth::user()->id . "?col=phone") }}"><i class="fa fa-pencil"></i> Edit</a>
                        </div>

                        <div class="form-group">
                            <label for="gender" class="col-md-4">Gender</label>

                            <div class="col-md-6">
                                <p class="lead">{{Auth::user()->gender}}</p>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="role" class="col-md-4">Role</label>

                            <div class="col-md-6">
                                <p class="lead">{{Auth::user()->role->name}}</p>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="description" class="col-md-4">About</label>

                            <div class="col-md-6 value">
                                <p class="lead">{{Auth::user()->description == NULL ?"Click the edit Button to Add a Description About yourself":Auth::user()->description}}</p>
                            </div>

                            <a class="col-md-1 pull-right edit-link" href="{{ url('/user/' . Auth::user()->id . "?col=description") }}"><i class="fa fa-pencil"></i> Edit</a>
                        </div>
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('pagejavascript')
<script type="text/javascript">

$(document).on('click','.edit-link', function(event){

        event.preventDefault();
        var href = $(this).attr('href');
        var column = getURLParameter(href, 'col');
        var userValue = getColumnValue(column);
        var value_box = $(this).parent('.form-group').find('.value');

        if(column == 'description')
        value_box.html('<textarea class="form-control value-text" placeholder="Describe yourself put in email phone and other things"  required>' + userValue +  '</textarea>');
        else    
        value_box.html('<input type="text" class="form-control value-text" placeholder="Add your value" value="' + userValue +  '" required autofocus>');
        $(this).removeClass('edit-link');
        $(this).addClass('done-link');

        $(this).html('<i class="fa fa-check fa-3x"></i> Done');
        /*if(confirm('Do you wanto delete this News?')){
           news_item = $(this).parents('.news-item');
            deleteNews(news_item.find('.news-id').val());
            news_item.remove(); 
        }*/
        
        
});

$.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
$(document).on('click','.done-link', function(event){

        event.preventDefault();
        
        var href = $(this).attr('href');
        var column = getURLParameter(href, 'col');
        var value_box = $(this).parent('.form-group').find('.value');
        var new_value = $(this).parent('.form-group').find('.value-text').val();
        $.ajax({
        dataType: 'json',
        type: 'PUT',
        url: href,
        data: {value: new_value}
        }).done(function(data){

            

            if(column == 'name')
                value_box.html('<p class="lead">' + data.name + '</p>');
            else if(column == 'email')
                value_box.html('<p class="lead">' + data.email + '</p>');
            else if(column == 'phone')
                value_box.html('<p class="lead">' + data.phone + '</p>');
            else if(column == 'description')
                value_box.html('<p class="lead">' + data.description + '</p>');
            
        });

        $(this).removeClass('done-link');
        $(this).addClass('edit-link');
        $(this).html('<i class="fa fa-pencil"></i> Edit');        
        
});


function getURLParameter(url, name) {
    return (RegExp(name + '=' + '(.+?)(&|$)').exec(url)||[,null])[1];
}

function getColumnValue(column)
{
        
        if(column == 'name')
            return "{{Auth::user()->name}}";
        else if(column == 'email')
            return "{{Auth::user()->email}}";
        else if(column == 'phone')
            return "{{Auth::user()->phone}}";
        else if(column == 'description')
            return "{{Auth::user()->description}}";
}

</script>
@endsection
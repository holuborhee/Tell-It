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
        
            <h3><i class="fa fa-video-camera" ></i> New Video Post </h3>            
                    
</div>
        
            <div class="panel panel-success content-box">
                <div class="panel-heading">
                    <h3 class="panel-title">Create New Post 
                    <i class="fa fa-angle-up pull-right"></i>
                    </h3>
                    
                </div>
                <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/videos') }}">
                        {{ csrf_field() }}
                       <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-2 control-label">News' Title</label>

                            <div class="col-md-10">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Descriptive Title For News" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



    <div class="form-group{{ $errors->has('lead') ? ' has-error' : '' }}">
                            <label for="lead" class="col-md-2 control-label">News' Lead</label>

                            <div class="col-md-10">
                                <textarea id="lead" class="form-control" name="lead" rows="4" placeholder="News Lead here" required>{{ old('lead') }}</textarea>
                                @if ($errors->has('lead'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lead') }}</strong>
                                    </span>
                                @endif
                            </div>
    </div>

    <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="url" class="col-md-2 control-label">Video URL</label>

                            <div class="col-md-10">
                                <input id="url" type="url" class="form-control" name="url" value="{{ old('url') }}" placeholder="Youtube URL for video" required>

                                @if ($errors->has('url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


    

    <div class="form-group{{ $errors->has('publish') ? ' has-error' : '' }}">
                            

                            <div class="col-md-4 col-md-offset-5">
                                <input id="publish" type="checkbox" name="publish" value="1" {{ old('publish') ? 'selected':'' }} >
                                <label for="publish" class="control-label ">Save and Publish</label>
                                @if ($errors->has('publish'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('publish') }}</strong>
                                    </span>
                                @endif
                            </div>
                            

                            <div class="col-md-3 ">
                                <button type="submit" class="btn btn-success">
                                    SAVE
                                </button>
                            </div>
    </div>


    </form>
                    
                        
                    
                </div>
            </div>
        </div>
     </div>   
@endsection

@section('pagejavascript')
    
@endsection
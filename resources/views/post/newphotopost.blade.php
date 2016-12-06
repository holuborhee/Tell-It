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
        
            <h3><i class="fa fa-camera" ></i> New Photo Post </h3>            
                    
</div>
        
            <div class="panel panel-success content-box">
                <div class="panel-heading">
                    <h3 class="panel-title">Create New Post 
                    <i class="fa fa-angle-up pull-right"></i>
                    </h3>
                    
                </div>
                <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/photos') }}">
                        {{ csrf_field() }}
                        <input type="hidden" value="create" name="page" />
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


    <div class="form-group">                            

                            <div class="col-md-6 col-md-offset-5" >
                                <button type="submit" class="btn btn-success">
                                    Create Post
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
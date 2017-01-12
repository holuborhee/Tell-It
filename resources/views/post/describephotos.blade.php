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
        
            <h3><i class="fa fa-camera" ></i> {{App\Post::find(Request::get('photo'))->title}} </h3>            
                    
</div>
        
            <div class="panel panel-success content-box">
                <div class="panel-heading">
                    <h3 class="panel-title">Photo Description 
                    <i class="fa fa-angle-up pull-right"></i>
                    </h3>
                    
                </div>
                <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/photos') }}">
                        {{ csrf_field() }}
                        <input type="hidden" value="describe" name="page" />
                        <input type="hidden" name="post_id" value="{{Request::get('photo')}}" />
@foreach(App\Post::findOrFail(Request::get('photo'))->photos()->cursor() as $pho)
<div class="form-group{{ $errors->has('lead') ? ' has-error' : '' }}">
                            <img src="{{ asset('images/uploads/'.$pho->picture) }}" class="col-md-4" />

                            <div class="col-md-8">
                                <textarea id="lead" class="form-control" name="lead[{{$pho->id}}]" rows="5" placeholder="Description for Picture goes here" required>{{ old('lead') }}</textarea>
                                @if ($errors->has('lead'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lead') }}</strong>
                                    </span>
                                @endif
                            </div>
    </div>
@endforeach
    
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
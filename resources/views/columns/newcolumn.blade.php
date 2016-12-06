@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <nav aria-label="...">
            <ul class="pager">
                <li class="previous"><a href="{{url('/column')}}"><span aria-hidden="true">&larr;</span> View All Existing Columns </a></li>
    
            </ul>
        </nav>
            <div class="panel panel-default">
                <div class="panel-heading">New Column</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/column') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name Of Column</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
                            <label for="user" class="col-md-4 control-label">Column Administrator</label>

                            <div class="col-md-6">
                                <select id="user" class="form-control" name="user" required>
                                <option disabled="disabled" {{ isset($user) ?'': 'selected' }}>------- Choose an option ------</option>
                            @foreach(App\User::where('role_id', 3)->cursor() as $user)
                                <option value="{{$user->id}}" {{ old('user') == '0' ?'selected':'' }} >{{$user->name}}</option>
                                
                            @endforeach
                                </select>

                                @if ($errors->has('user'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Column Description</label>

                            <div class="col-md-6">
                                <textarea id="description" class="form-control" name="description" rows="4" placeholder="Column description here" required>{{ old('description') }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>




                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create Column
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <nav aria-label="...">
          <ul class="pager">
            <li class="previous"><a href="{{url('/user')}}"><span aria-hidden="true">&larr;</span> Back To All Users </a></li>
    
          </ul>
        </nav>
            <div class="panel panel-default">
                <div class="panel-heading">
                <div class="row">
                <div class="col-sm-4">
                    <img src="{{$picture === null ?asset('storage/users/default2.png'):asset('storage/'.$picture)}}" />
                </div>
                <div class="col-sm-8 text-right">
                <form class="form-inline" method="POST" action="{{ url('/user/'.$id) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                    <button type="submit"><i class="fa fa-trash fa-3x"></i></button>
                </form>

                    <a href="{{url('/user/'.$id . '/edit')}}" ><i class="fa fa-pencil fa-3x"></i></a> 
                </div>
                </div>
                </div>

                <div class="panel-body profile">

                    <div class="col-sm-4">Name:</div>
                    <div class="col-sm-8 text-right text-success">{{ $name }}</div>

                    <div class="col-sm-4">Role:</div>
                    <div class="col-sm-8 text-right"><strong>{{App\Role::find($role_id)->name}}</strong></div>

                    <div class="col-sm-4">Email:</div>
                    <div class="col-sm-8 text-right">{{ $email }}</div>

                    <div class="col-sm-4">Phone:</div>
                    <div class="col-sm-8 text-right">{{ $phone }}</div>

                    <div class="col-sm-4">Gender:</div>
                    <div class="col-sm-8 text-right">{{ $gender }}</div>

                    <div class="col-sm-4">Activated:</div>
                    <div class="col-sm-8 text-right">{{ $isActivated? "Yes":"No" }}</div>

                    <div class="col-sm-4">Date Added:</div>
                    <div class="col-sm-8 text-right">{{ $created_at }}</div>
                </div>
            
            </div>


            <div class="panel panel-default">
                <div class="panel-heading"><h4>About User</div>

                <div class="panel-body profile">
                    <p>{{$description or "No Information about this User"}}</p>
                </div>
            
            </div>
            @if($role_id === 3)
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Columns By this User</div>

                <div class="panel-body profile">
                @foreach(App\Column::where('user_id',$id)->cursor() as $col)
                    <a href="{{url('/column/'.$col->id)}}"><p>{{$col->name}} <span class="pull-right">{{App\Article::where('column_id',$col->id)->count()}} Articles</span></p></a>
                @endforeach
                </div>
            
            </div>
            @endif


        </div>
    </div>

@endsection

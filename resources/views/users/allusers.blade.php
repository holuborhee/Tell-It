@extends('layouts.app')

@section('tablecss')
    <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"
    rel="stylesheet">
@endsection

@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <nav aria-label="...">
          <ul class="pager">
            <li class="previous"><a href="{{url('/home')}}"><span aria-hidden="true">&larr;</span> Dashboard </a></li>
    
          </ul>
        </nav>
            <div class="panel panel-default">
                <div class="panel-heading"><a class="pull-right" href="{{ url('/user/create') }}">Create New</a>All Users</div>

                <div class="panel-body">
            <table id="userTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Activated</th>
                    <th></th>
                  
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Activated</th>
                    <th></th> 
                </tr>
            </tfoot>
            <tbody>
            @foreach(App\User::cursor() as $user)
            <tr>
                <td>{{$user->name}}</td>
                <td> {{$user->email}}</td>
                <td>{{$user->phone}}</td>
                <td> {{$user->role->name}}</td>
                <td> {{$user->isActivated?"Yes":"No"}}</td>
                <td><a href="{{url('/user/'.$user->id)}}"><i class="fa fa-eye"></i></a></td>
            </tr>
            @endforeach
            
            </tbody>
        </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('tablejavascript')
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
    $('#userTable').DataTable();
} );
</script>
@endsection
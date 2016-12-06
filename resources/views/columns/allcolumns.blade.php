@extends('layouts.app')

@section('tablecss')
    <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css"
    rel="stylesheet">
@endsection

@section('modal')
    
    <div class="modal fade" id="editColumnModal" tabindex="-1" role="dialog" aria-labelledby="editColumnModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Column</h4>
      </div>
      <div class="modal-body column-details">
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary edit-btn">Save changes</button>
      </div>
    </div>
  </div>
</div>

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
                <div class="panel-heading"><a class="pull-right" href="{{ url('/column/create') }}">Create New</a>ALL COLUMNS</div>

                <div class="panel-body">
            <table id="columnTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Column name</th>
                    <th>Administrator</th>
                    <th></th>
                    <th></th>
                    <th></th> 
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Column name</th>
                    <th>Administrator</th>
                    <th></th>
                    <th></th>
                    <th></th> 
                </tr>
            </tfoot>
            <tbody>
            @foreach(App\Column::latest()->cursor() as $col)
            <tr>
                <td>{{$col->name}}</td>
                <td> {{$col->user->name}}</td>
                <td class="text-center"><a href="{{url('/column/'.$col->id)}}"><i class="fa fa-eye fa-lg"></i></a></td>
                <td class="text-center"><a href="{{url('/column/'.$col->id)}}" class="delete-btn" ><i class="fa fa-trash fa-lg"></i></a></td>
                <td class="text-center">
                <a href="{{url('/column/'.$col->id. '/edit')}}" class="link" ><i class="fa fa-pencil fa-lg"></i></a>
                </td>
                
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
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script>
    $(document).ready(function() {

    $('#columnTable').DataTable();


    $('.link').click(function(){
        event.preventDefault();
        var href = $(this).attr('href');
        
        $.ajax({
        dataType: 'json',
        url: href
        }).done(function(data){
            
            showEditForm(data);
        
        });

    });

    $('.delete-btn').click(function(){
        event.preventDefault();
        var reply = confirm('This Column Will Be permanently Deleted!!!');
        if(reply){
            $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
        var url = $(this).attr('href');


        $.ajax({
       dataType: 'json',
       type: 'DELETE',
       url: url
        }).done(function(data){
           if(data.success) 
             toastr.success('Column SuccessFully DELETED, Refresh page to see change effects.', 'Column DELETED', {timeOut: 10000});  
        
        });
        }   
        
        
       /* $.ajax({
        dataType: 'json',
        url: href
        }).done(function(data){
            
            showEditForm(data);
        
        });*/

    });



    $('.edit-btn').click(function(){
        
$.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});
        var url = $(".edit-form").attr('action');


        $.ajax({
       dataType: 'json',
       type: 'PUT',
       url: url,
        data: {name: $("#name").val(), description: $("#description").val()}
        }).done(function(data){
           if(data.success) 
             $('#editColumnModal').modal('hide');
             toastr.success('Column SuccessFully Updated, Refresh page to see change effects.', 'Column Updated', {timeOut: 10000});  
        
        });

    });

    } );

    function showEditForm(data)
    {
        
        var row = " ";
        
        row += '<form class="form-horizontal edit-form" role="form" method="POST" action="{{ url('/column') }}/' + data.id + '">';
        row += '<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">';
                row += '<label for="name" class="col-md-4 control-label">Name Of Column</label>';

                        row += '<div class="col-md-6">';
                           row += '<input id="name" type="text" class="form-control" name="name" value="'+ data.name +' " required autofocus>';

                           
                                @if ($errors->has('name'))
                                  row += '<span class="help-block">';
                                        row += '<strong>{{ $errors->first('name') }}</strong>';
                                    row += '</span>';
                                @endif
                            row += '</div>';
                        row += '</div>';


                        

                        row += '<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">';
                            row += '<label for="description" class="col-md-4 control-label">Column Description</label>';

                            row += '<div class="col-md-6">';
                                row += '<textarea id="description" class="form-control" name="description" rows="4" placeholder="Column description here" required>'+ data.description +'</textarea>';
                                @if ($errors->has('description'))
                                    row += '<span class="help-block">';
                                        row += '<strong>{{ $errors->first('description') }}</strong>';
                                    row += '</span>';
                                @endif
                            row += '</div>';
                        row += '</div>';

                row += '</form>';
        
        $('.column-details').html(row);
        $('#editColumnModal').modal('show');
        
        
    }
</script>
@endsection
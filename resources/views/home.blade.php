@extends('layouts.app')


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
        <div class="col-xs-10 col-sm-offset-1">
        @unless(Request::user()->isActivated)
        <div class="alert alert-danger">
                             <strong>INACTIVE ACCOUNT ? </strong> Your account is yet to be activated, activate to get started. <a target="_blank" href="{{ url('/editpersonal/changepassword') }}"> Click Here</a>.
        </div>
        @endunless
        @if(Request::user()->isColumnist())
        <div class="panel panel-default">
                <div class="panel-heading"><h4>Your Columns</div>

                <div class="panel-body profile">
                @foreach(Request::user()->columns()->withCount('articles')->cursor() as $col)
                    <a href="{{url('/column/'.$col->id. '/edit')}}" class="link" ><i class="fa fa-pencil fa-lg"></i></a><a href="{{url('/column/'.$col->id)}}"><p>{{$col->name}} <span class="pull-right">
                    {{$col->articles_count}} Articles</span></p></a>

                @endforeach
                </div>
            
            </div>
        @else
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">QUICK LINKS</h3>
                </div>
                <div class="panel-body">
                     <a href="{{url('/report/create?catid=0')}}" class="col-sm-4 well text-center">
                        <i class="fa fa-cog fa-5x"></i>
                          <h4>New Report</h4>
                     </a>
                     <a href="{{ url('/report') }}" class="col-sm-4 well text-center">
                        <i class="fa fa-cog fa-5x"></i>
                          <h4>All Reports</h4>
                     </a>
                     <a class="col-sm-4 well text-center">
                        <i class="fa fa-cog fa-5x"></i>
                          <h4>Infographics</h4>
                     </a>
                     <a href="{{url('/user/' . Request::user()->id)}}" class="col-sm-4 well text-center">
                        <i class="fa fa-user fa-5x"></i>
                          <h4>Profile</h4>
                     </a>
                     @if(Request::user()->isAdministrator())
                     <a href="{{ url('/breaking-news') }}" class="col-sm-4 well text-center">
                        <i class="fa fa-cog fa-5x"></i>
                          <h4>Breaking News</h4>
                     </a>
                     <a href="{{ url('/advert') }}" class="col-sm-4 well text-center">
                        <i class="fa fa-cog fa-5x"></i>
                          <h4>Manage Advert</h4>
                     </a>
                     
                     <a href="{{ url('/user') }}" class="col-sm-4 well text-center">
                        <i class="fa fa-group fa-5x"></i>
                          <h4>Manage Staffs</h4>
                     </a>

                     <a href="{{ url('/column') }}" class="col-sm-4 well text-center">
                        <i class="fa fa-group fa-5x"></i>
                          <h4>Manage Columns</h4>
                     </a>

                     <a href="{{ url('/customize') }}" class="col-sm-4 well text-center">
                        <i class="fa fa-group fa-5x"></i>
                          <h4>Customize</h4>
                     </a>

                     <a href="{{ url('/user') }}" class="col-sm-4 well text-center">
                        <i class="fa fa-group fa-5x"></i>
                          <h4>Recycle Bin</h4>
                     </a>
                     @endif
                </div>
            </div>
        @endif
         </div>
    </div>

@endsection


@section('tablejavascript')
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script>
    $(document).ready(function() {

    


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

});

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



@extends('layouts.app')



@section('modal')
    
    <div class="modal fade" id="confirmpasswordModal" tabindex="-1" role="dialog" aria-labelledby="selectNewsModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
    <div class="modal-header">
        <h4 class="modal-title">Enter Password to continue</h4>
      </div>
      <div class="modal-body ">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/postpassword') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Current Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" onkeyup="enablebutton()" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="continuebutton" onclick="checkPassword()" class="btn btn-primary disabled">Continue</button>
      </div>
    </div>
  </div>
</div>

@endsection
@section('content')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Change Password</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/postpassword') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">New Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm New Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
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
<script>
$(document).ready(function() {
   // $('#confirmpasswordModal').modal('show');
     $('#confirmpasswordModal').modal({backdrop: 'static', keyboard: false});
});

function checkPassword()
{
    
    $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        dataType: 'json',
        type:'POST',
        url: "<?php echo url('/checkpassword'); ?>",
        data: {password: $('#password').val()}
    }).done(function(data){
            if(data.success){
                $('#confirmpasswordModal').modal('hide');
               // $('#confirmpasswordModal').removeData('bs.modal').modal({backdrop: true, keyboard: true});


            }
            else
                alert('wrong');
        });
}

function enablebutton()
{

    if($('#password').val() === ''){
        
        $('#continuebutton').addClass('disabled');
    }else
    {
        
      $('#continuebutton').removeClass('disabled');  
    }
    
}
</script>


@endsection

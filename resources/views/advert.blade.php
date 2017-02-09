@extends('layouts.app')

@section('content')


<div class="row">
    
        <div class="col-md-10 col-sm-offset-1">
        
        	<div class="panel panel-default">
                <div class="panel-body text-center">
                <a href="{{url('/advert?page=1')}}">
                    <?php $files = Storage::files('adverts/1'); ?>
                    @if(!empty($files))               
                        <img width="100" height="100" src="{{asset('images/uploads/'.$files[0])}}" />
                    @else
                        <img width="100" height="100" src="{{asset('images/uploads/adverts/ad3.png')}}" />
                    @endif
                    

                    <h2>Manage Advert</h2>

                </a>
                <a href="{{url('/advert?page=2')}}">
                    <?php $files = Storage::files('adverts/2'); ?>
                    @if(!empty($files))
                    <img width="100" height="100" src="{{asset('images/uploads/'.$files[0])}}" />
                    @else
                        <img width="100" height="100" src="{{asset('images/uploads/adverts/ad3.png')}}" />
                    @endif
                    <h2>Manage Advert</h2>

                </a>
                </div>

                <div class="panel-footer">
                    
                </div>
            </div>
            
        </div>
 </div>
@endsection
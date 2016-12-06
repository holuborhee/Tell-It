@extends('layouts.app')

@section('content')


<div class="row">
    
        <div class="col-md-10 col-sm-offset-1">
        <div class="alert alert-success">
                             <strong>{{$title}}  </strong> {{$content}} <a href="{{url($link)}}" class="text-warning">{{ $link_text}}</a>.
        </div>
            
        </div>
 </div>
@endsection
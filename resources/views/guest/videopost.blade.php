@extends('guest.layout')

@section('mid_col')

<div class="page-header">
  <h1 class="page-title">Videos</h1>
</div>
@if(sizeof($posts)>0)
@foreach($posts as $p)
<div class="newsfeed videonews">
  <h2><mark>VIDEO</mark> - {{$p->post->title}}.</h2> 
    <video controls <!--autoplay-->>
                                <source src="videos/news2.mp4"" type="video/mp4">
    </video>
    <mark>Time</mark>
</div>
@endforeach
{{ $posts->links() }}
@else
  <h2>{{'No Video Available Currently'}}</h2>
@endif
  @endsection
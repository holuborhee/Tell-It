@extends('layouts.app')

@section('pagecss')
<!-- Dropzone.js -->
    <link href="{{url('/css/dropzone.min.css')}}" rel="stylesheet">
@endsection
@section('content')

    <div class="row">

<div class="col-xs-10 col-xs-offset-1">
<nav aria-label="...">
  <ul class="pager">
    <li class="previous"><a href="index.html"><span aria-hidden="true">&larr;</span> Go back </a></li>
    
  </ul>
</nav>
<div class="page-header">
        
            <h3><i class="fa fa-camera" ></i> {{$title}} </h3>            
                    
</div>
        
    <div class="panel panel-success content-box">
                <div class="panel-heading">
                    <h3 class="panel-title">Current Display Photo 
                    <i class="fa fa-angle-up pull-right"></i>
                    </h3>
                    
                </div>
                <div class="panel-body">
                @if($picture != 'none')
                <img width="100" src="{{ asset('images/uploads/'. $picture)}}" height="100" />
                <br />
                <br />
                <br />
                @else
                <p>No Display Picture yet</p>
                @endif
                </div>
    </div>

            <div class="panel panel-success content-box">
                <div class="panel-heading">
                    <h3 class="panel-title">Upload Photos 
                    <i class="fa fa-angle-up pull-right"></i>
                    </h3>
                    
                </div>
                <div class="panel-body">
                <p>Drag multiple pictures to the box below for multi upload or click to select files.</p>
                    <form action="{{ url('/articlephoto') }}" id="my-dropzone" class="dropzone">
                    {{ csrf_field() }}
                    <input type="hidden" name="post_id" value="{{$id}}" />

                    </form>
                    <br />
                    <br />
                    <br />
                    <br />
                    
                   <div class="form-group">
                            <div class="col-md-3 col-md-offset-8">
                                <a href="{{ url('/article/'.$id) }}" class="btn btn-primary">
                                    View Article&rarr;
                                </a>
                            </div>
    </div>     
                    
                </div>
            </div>
        </div>
     </div>   
@endsection

@section('pagejavascript')
 <script src="{{url('/js/dropzone.min.js')}}"></script>
 <script>
Dropzone.options.myDropzone = {
  accept: function(file, done) {
    console.log("uploaded");
    done();
  },
  init: function() {
    this.on("addedfile", function() {
      if (this.files[1]!=null){
        this.removeFile(this.files[0]);
      }
    });
  }
};
 /*var myDropzone = new Dropzone("#my-dropzone",{
        url: "{{url('/removephotos')}}",
        addRemoveLinks: true,
        removedfile: function(file) {
    var name = file.name;        
    $.ajax({
        type: 'POST',
        url: 'url',
        data: "id="+name,
        dataType: 'html'
    });
var _ref;
return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        
              }
}); */
 </script>
 
@endsection
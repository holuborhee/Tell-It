@extends('layouts.app')


@section('pagecss')
    <link href="{{url('/css/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <link href="{{url('/css/typeaheadjs.css')}}" rel="stylesheet">
@endsection
@section('content')

    <div class="row">

<div class="col-xs-10 col-sm-offset-1">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/report') }}">
                        {{ csrf_field() }}
                        
                        @if(isset($id))
                        <input type="hidden" name="category" value="{{ $id }}">
                        <div class="form-group">
                            <!--<label for="category" class="col-md-2 control-label">News' Category</label>-->

                            <div class="col-md-12">
                                <input id="category" type="text" class="form-control" readonly value="{{ $name }}" required autofocus>
                            </div>
                        </div>
                        @else
                            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                            <!--<label for="category" class="col-md-2 control-label">News' Category</label>-->

                            <div class="col-md-12">
                                <select id="category" class="form-control" name="category" value="" required>
                                @foreach(App\Category::cursor() as $cat)
                                    <option {{ old('category') == $cat->id?'selected':'' }} value="{{ $cat->id }}">{{$cat->name}}</option>
                                @endforeach
                                </select>
                                @if ($errors->has('category'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('category') }}</strong>
                                    </span>
                                @endif
                            </div>
    </div>
                        @endif
  <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <!--<label for="title" class="col-md-2 control-label">News' Title</label>-->

                            <div class="col-md-12">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Descriptive Title For News" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
    </div>



    <div class="form-group{{ $errors->has('lead') ? ' has-error' : '' }}">
                            <!--<label for="lead" class="col-md-2 control-label">News' Lead</label>-->

                            <div class="col-md-12">
                                <textarea id="lead" class="form-control" name="lead" rows="4" placeholder="News Lead here" required>{{ old('lead') }}</textarea>
                                @if ($errors->has('lead'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lead') }}</strong>
                                    </span>
                                @endif
                            </div>
    </div>


    <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            

                            <div class="col-md-12">


                            @include('post.editor')
                                
                            </div>

    
    </div>


    <div class="form-group">
    <label class="col-sm-2" for="newsTag">Tags</label>
    <div class="col-sm-10">

    
<input type="hidden" id="news_tag" class="news_tag" name="news_tag" />

<input id="cat" name="tags" class="form-control" data-role="tagsinput" placeholder="Search related Tags for Post" required>

                                @if ($errors->has('tags'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tags') }}</strong>
                                    </span>
                                @endif
    </div>
    </div>


    <div class="form-group{{ $errors->has('publish') ? ' has-error' : '' }}">
                            

                            <div class="col-md-4 col-md-offset-5">
                                <input id="publish" type="checkbox" name="publish" value="1" {{ old('publish') ? 'selected':'' }} >
                                <label for="publish" class="control-label ">Save and Publish</label>
                                @if ($errors->has('publish'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('publish') }}</strong>
                                    </span>
                                @endif
                            </div>
                            

                            <div class="col-md-3 ">
                                <button type="submit" class="btn btn-success submit-post">
                                    SAVE
                                </button>
                            </div>
    </div>
    
  
  <!--<div class="form-group">
    <label class="col-sm-2" for="newsPicture">File input</label>
    <div class="col-sm-10">
    <input type="file" class="form-control" id="newsPicture">
    </div>
  </div>-->
  
  
  
  
  
  
  
  <!--<div class="col-sm-6 col-sm-offset-6">
  <button type="submit" class="btn btn-info">Preview</button>--> <!--<button type="submit" class="btn btn-primary"> Save </button> <button type="submit" class="btn btn-success">Publish</button>
  </div>-->

  
  </form>
                </div>
            
     </div>   
@endsection
@section('pagejavascript')
<script type="text/javascript" src="{{ url('/js/jquery.hotkeys.js') }}"></script>
<script type="text/javascript" src="{{ url('/js/richtext.js') }}"></script>
<script>
   $(document).ready(function() {
        $('#editor').wysiwyg();
    });
</script>

<script>
  $(function(){
    function initToolbarBootstrapBindings() {
      var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier', 
            'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
            'Times New Roman', 'Verdana'],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
      $.each(fonts, function (idx, fontName) {
          fontTarget.append($('<li><a data-edit="fontName ' + fontName +'" style="font-family:\''+ fontName +'\'">'+fontName + '</a></li>'));
      });
      $('a[title]').tooltip({container:'body'});
        $('.dropdown-menu input').click(function() {return false;})
            .change(function () {$(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');})
        .keydown('esc', function () {this.value='';$(this).change();});

      $('[data-role=magic-overlay]').each(function () { 
        var overlay = $(this), target = $(overlay.data('target')); 
        overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
      });
      if ("onwebkitspeechchange"  in document.createElement("input")) {
        var editorOffset = $('#editor').offset();
        $('#voiceBtn').css('position','absolute').offset({top: editorOffset.top, left: editorOffset.left+$('#editor').innerWidth()-35});
      } else {
        $('#voiceBtn').hide();
      }
    };
    function showErrorAlert (reason, detail) {
        var msg='';
        if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
        else {
            console.log("error uploading file", reason, detail);
        }
        $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
         '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
    };
    initToolbarBootstrapBindings();  
    $('#editor').wysiwyg({ fileUploadError: showErrorAlert} );
    window.prettyPrint && prettyPrint();
  });
</script>




@include('post.tagsuggest');


<script>
$(document).on('click','.submit-post', function(event){

        if($('#cat').val() == '')
        alert('Select at least a Tag for news');
    $('.news_tag').val($('#cat').val());

    $('#body').val($('#editor').html());
        
        
});
</script>

@endsection


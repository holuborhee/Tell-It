@extends('layouts.app')

@section('pagecss')
    <link href="{{url('/css/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <link href="{{url('/css/typeaheadjs.css')}}" rel="stylesheet">
@endsection


@section('content')

    <div class="row">

<div class="col-xs-12">

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/article') }}">
                        {{ csrf_field() }}
                        
                        @if(isset($id))
                        <input type="hidden" name="column" value="{{ $id }}">
                        <div class="form-group">
            

                            <div class="col-md-12">
                                <input id="column" type="text" class="form-control" readonly value="{{ $name }}">
                            </div>
                        </div>
                        @else
                            <div class="form-group{{ $errors->has('column') ? ' has-error' : '' }}">
                            <label for="column" class="col-md-2 control-label">Articles' column</label>

                            <div class="col-md-10">
                                <select id="column" class="form-control" name="column" required>
                                @foreach(Request::User()->columns()->cursor() as $col)
                                    <option {{ old('column') == $col->id?'selected':'' }} value="{{ $col->id }}">{{$col->name}}</option>
                                @endforeach
                                </select>
                                @if ($errors->has('column'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('column') }}</strong>
                                    </span>
                                @endif
                            </div>
    </div>
                        @endif
  <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            

                            <div class="col-md-12">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Descriptive Title For Article" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
    </div>



    <div class="form-group{{ $errors->has('lead') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <textarea id="lead" class="form-control" name="lead" rows="4" placeholder="Article Lead here" required>{{ old('lead') }}</textarea>
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


    <!--<div class="form-group">
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
    </div>-->
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
    <label class="col-sm-2" for="ArticlePicture">File input</label>
    <div class="col-sm-10">
    <input type="file" class="form-control" id="ArticlePicture">
    </div>
  </div>-->
  
  
  
  
  
  <!--<div class="form-group">
    <label class="col-sm-2" for="ArticleTitle">Tags</label>
    <div class="col-sm-10">
    <input type="text" class="form-control" id="ArticleTag" placeholder="Search related Tags for Article">
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
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.4/typeahead.bundle.min.js"></script>
    <script src="https://rawgithub.com/davidkonrad/Bootstrap-3-Typeahead/master/bootstrap3-typeahead.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>-->
    <script src="{{asset('js/typeahead.js')}}"></script>
    <script src="{{asset('js/bootstrap-tagsinput.min.js')}}"></script>
    
    <!--<script src="https://rawgithub.com/bootstrap-tagsinput/bootstrap-tagsinput/master/dist/bootstrap-tagsinput.js"></script>-->
    
<script>





/*var mytags = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: "<?php echo route('tags.index') ?>"
});
mytags.initialize();

$('#cat').tagsinput({
    typeaheadjs: [{
          minLength: 1,
          highlight: true,
    },{
        minlength: 3,
        name: 'citynames',
        displayKey: 'name',
        valueKey: 'name',
        source: citynames.ttAdapter()
    }],
    freeInput: true
});*/

/*var cities = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: "<?php echo route('tags.index') ?>"
});
cities.initialize();

var elt = $('#cat');
elt.tagsinput({
  itemValue: 'value',
  itemText: 'name',
  typeaheadjs: {
    name: 'cities',
    displayKey: 'name',
    source: cities.ttAdapter()
  },
  freeInput: true
});*/

</script>


<script>



var cities = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('text'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  remote: '<?php echo url("/tags") ?>'
});
cities.initialize();

var elt = $('#cat');
elt.tagsinput({
  itemValue: 'value',
  itemText: 'text',
  typeaheadjs: {
    name: 'cities',
    displayKey: 'text',
    source: cities.ttAdapter()
  }
});

</script>
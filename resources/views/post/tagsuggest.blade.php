<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.10.4/typeahead.bundle.min.js"></script>
    <script src="https://rawgithub.com/davidkonrad/Bootstrap-3-Typeahead/master/bootstrap3-typeahead.js"></script>-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>-->
    <script src="{{asset('js/typeahead.js')}}"></script>
    <script src="{{asset('js/bootstrap-tagsinput.min.js')}}"></script>
    
    <!--<script src="https://rawgithub.com/bootstrap-tagsinput/bootstrap-tagsinput/master/dist/bootstrap-tagsinput.js"></script>-->
    







<script>
var cities = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: '<?php echo asset("js/tags.json") ?>'
});
cities.initialize();

var elt = $('#cat');
elt.tagsinput({
  itemValue: 'id',
  itemText: 'name',
  typeaheadjs: {
    name: 'cities',
    displayKey: 'name',
    source: cities.ttAdapter()
  }
});
</script>


<html>
<head></head>
<body>
<form action="{{ url('/test') }}" method="get">
{{ csrf_field() }}
  <input type="date" name="textb" />
  <input type="hidden" name="page" value="upload" />
  <input type="submit" value="Done" />


</form>

</body>
</html>
<table class="table table-striped m-b-none {{ $class = str_random(8) }}" data-ride="datatables">
  <thead>
    <tr>
      @foreach($columns as $i => $c)
        <th >{{ $c }}</th>
      @endforeach
      <!-- <th width="20%">Rendering engine</th> -->
    </tr>
  </thead>
  <tbody>
    @foreach($data as $d)
    <tr>
        @foreach($d as $dd)
        <td>{{ $dd }}</td>
        @endforeach
    </tr>
    @endforeach
  </tbody>
</table>
<script type="text/javascript">
    jQuery(document).ready(function(){
        // dynamic table
        jQuery('.{{ $class }}').dataTable({
            "sPaginationType": "full_numbers",
            "bProcessing": false,
            "sDom": "<'row'<'col-sm-6'l><'col-sm-6'f>r>t<'row'<'col-sm-6'i><'col-sm-6'p>>",
            @foreach ($options as $k => $o)
            {{ json_encode($k) }}: {{ json_encode($o) }},
            @endforeach
            @foreach ($callbacks as $k => $o)
            {{ json_encode($k) }}: {{ $o }},
            @endforeach
            //"fnDrawCallback": function(oSettings) {
            //    jQuery.uniform.update();
            //}
        });
        // custom values are available via $values array
    });
</script>

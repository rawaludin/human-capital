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
            "fnDrawCallback": function ( oSettings ) {
                /* Need to redo the counters if filtered or sorted */
                if ( oSettings.bSorted || oSettings.bFiltered )
                {
                    for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
                    {
                        $('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
                    }
                }
            },
            "aaSorting": [[ 1, 'asc' ]]
        });
        // custom values are available via $values array
    });
</script>

$("table").stupidtable();
$( "table tbody tr" ).draggable({
      cursor: "move",
      helper: function( event ) {
        return $( "<div class='helper'>"+$(this).attr('target-name')+"</div>" );
      }
    });

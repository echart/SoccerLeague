/*
FILTER BY DEFENDERS
*/
$('.positions').each(function(){
  x = 0;
   $(this).children().each(function(){
     if($(this).hasClass('position-D'))
      x++;
   });
   if(x==0){
     $(this).closest('tr').toggle();
   }
 });

/* make ctrl+click in a player open a new page*/
 $(".player-name").on('click',function(e){
	if(e.ctrlKey){
		window.open("/players/"+$(this).closest('tr').attr("player-id"));
	}
});
 /*TATICS JS*/
containers = [document.querySelector('.field'), document.querySelector('.list-players')];
players = [];
players_on_field = {};
max_players_on_field = 11;
max_subs = 5;
players_by_id = []; // array of player_id : i - in player[i];
on_field = [];
on_subs = [];
positions = ['gk','dc','dcl','dcr','dl','dr','dmc','dmcr'];
player_on_drag = {};
function makedraggable(){
  $( "table tbody tr, .field_player" ).draggable({
    start: function(){
      if(Object.keys(players_on_field).length < max_players_on_field){
        //styles
        $('.field_player').toggleClass('ondraging');
        if(this.tagName=='TR'){
          $(this).toggleClass('drag');
        }else{
          $(this).toggleClass('ondrag1');
        }
        //start logic
        player_on_drag = {id_player:$(this).attr('player-id'), playername:$(this).attr('player-name')};
      }
    },
    stop: function(){
      if(Object.keys(players_on_field).length < max_players_on_field){
        $('.field_player').toggleClass('ondraging');
        if(this.tagName=='TR'){
          $(this).toggleClass('drag');
        }else{
          $(this).toggleClass('ondrag1');
        }
      }
    },
    cursorAt: { top: 25, left: 25 },
    helper: function( event ) {
      // return $( "<div class='drag'><div class='playershirt ondrag'></div><p>"+$(this).attr('player-name')+"</p></div>" );
      return $( "<div class='drag'><div class='playershirt ondrag'></div></div>" );
    }
  });
}
function makedroppable(){
  $( "table tbody tr, .field_player" ).droppable({
    drop: function( event, ui ) {
      if(this.tagName=='TR'){
        /* put it back on listtable */
        $("table").append('<tr><td colspan="5">OLARR</td></tr>');
        makedraggable();
      }else{
        /* delete from list table */
        $("tr[player-id='"+player_on_drag.id_player+"']").remove();

        // if players already is on field in another position
        if($.inArray(player_on_drag.id_player,Object.values(players_on_field)) != -1){

        }else{
          players_on_field[$(this).attr('position')] = player_on_drag.id_player;
        }
      }
      /* transfer player to field_player */
      $(this).addClass('visible');
      $(this).attr('player-id',player_on_drag.id_player);
      $(this).attr('player-name',player_on_drag.playername);
      $(this).find('p.playername').html(player_on_drag.playername);

    }
  });
}

makedraggable();
makedroppable();

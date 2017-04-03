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
on_field = [];
on_subs = [];
positions = ['gk','dc','dcl','dcr','dl','dr','dmc','dmcr'];
player_on_drag = {};

function loadplayers(){
  for (var i = 0; i < players_by_id.length; i++) {
    $.ajax({
      url : '../helpers/ajax/player.php',
      method: 'GET',
      data : {id_player : players_by_id[i]},
      success : function(response){
        players.push(response.data);
      }
    });
  }
}
function makeplayerslist(){
  var target = $('table tbody');

  var positions = "<span></span>";
  $(target).append("<tr player-id='"+players[0].playerid+"' player-name='"+players[0].name+"'>"+
                      "<td>"+players[0].name+"</td>"+
                      "<td class='positions'>"+
                          positions+
                      "</td>"+
                      "<td>"+players[0].skill_index+"</td>"+
                      "<td></td>"+
                    "</tr>");
}
function makedraggable(){
  $( "table tbody tr, .field_player" ).draggable({
    start: function(){
      if(Object.keys(players_on_field).length < max_players_on_field){
        //styles
        $('.field_player').addClass('ondraging');
        if(this.tagName=='TR'){
          $(this).addClass('drag');
        }else{
          $(this).addClass('ondrag1');
        }
        //start logic
      }
      player_on_drag = {id_player:$(this).attr('player-id'), playername:$(this).attr('player-name')};
    },
    stop: function(){
      if(Object.keys(players_on_field).length < max_players_on_field+1){
        $('.field_player').removeClass('ondraging');
        if(this.tagName=='TR'){
          $(this).removeClass('drag');
        }else{
          $(this).removeClass('ondrag1');
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
      console.log(player_on_drag.id_player);
      if(this.tagName=='TR'){
        /* put it back on listtable */
        $("table").append('<tr><td colspan="5">OLARR</td></tr>');
        makedraggable();
      }else{
        /* delete from list table */
        $("tr[player-id='"+player_on_drag.id_player+"']").remove();
        // if players already is on field in another position
        if($.inArray(player_on_drag.id_player,Object.values(players_on_field)) != -1){
          //delete player in the old position
          $(".field_player[position='"+key(players_on_field)+"']").attr('player-id','');
          $(".field_player[position='"+key(players_on_field)+"']").attr('player-name','');
          $(".field_player[position='"+key(players_on_field)+"']").removeClass('visible');
          $(".field_player[position='"+key(players_on_field)+"']").find('p.playername').html('');
          delete players_on_field[key(players_on_field)];
          //added player in new position
          players_on_field[$(this).attr('position')] = player_on_drag.id_player;
        }else{
          players_on_field[$(this).attr('position')] = player_on_drag.id_player;
        }
      }
      /* transfer player to field_player */
      $(this).addClass('visible');
      $(this).attr('player-id',player_on_drag.id_player);
      $(this).attr('player-name',player_on_drag.playername);
      $(this).find('p.playername').html(player_on_drag.playername);
      delete player_on_drag.id_player;
      delete player_on_drag.playername;
    }
  });
}
function key(obj){
  var key = $.inArray(String(player_on_drag.id_player),Object.values(obj));
  if(key!=-1){
    return Object.keys(obj)[key];
  }
}
loadplayers();
makedraggable();
makedroppable();

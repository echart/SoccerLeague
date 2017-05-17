 /*TATICS JS*/
players = [];
players_on_field = {};
players_on_reserve = {};
functions = {captain:'',freekick:''};
max_players_on_field = 11;
max_subs = 5;
positions = ['gk','dc','dcl','dcr','dl','dr','dmc','dmcr'];
player_on_drag = {};

function loadplayers(){
  //notification('Está página não dá suporte a dispositivos mobile','error','error');
  $.ajax({
    url : '../helpers/ajax/players.php',
    method: 'GET',
    success : function(response){
      $.each( response.data, function( index, value ){
          players.push(value);
      });
      makeplayerslist();
      draggable_playerlist();
      droppable_playerlist();
      draggable_field();
      droppable_field();
      draggable_reserves();
      droppable_reserves();
    },
    error: function(response){
      console.log(response);
    }
  });
}
function makeplayerslist(){
  var target = $('table tbody');
  var html = "";
  $(players).each(function(){
     $player = this;
     var positions = "";
      $(this.positions).each(function(){
        positions += "<span class='position-"+this.position+"'>"+this.position+" " + this.side+"</span> ";
      });
      var name = $player.name.split(' ');
      html += "<tr player-id='"+$player.player_id+"' player-name='"+name [0]+" " + name[1]+"'>"+
                          "<td class='player-name'>"+$player.name+"</td>"+
                          "<td class='positions'>"+
                              positions+
                          "</td>"+
                          "<td>"+$player.skill_index+"</td>"+
                          "<td>"+$player.recomendation+"</td>"+
                          "<td></td>"+
                        "</tr>";

    });
  $(target).html('');
  $(target).html(html);
  /* make ctrl+click in a player open a new page*/
  $(".player-name").on('click',function(e){
  	if(e.ctrlKey){
  		window.open("/players/"+$(this).closest('tr').attr("player-id"));
  	}
  });
  /*make the filter*/
  filter();
}
function draggable_playerlist(){
  $( "table tbody tr" ).draggable({
    scroll: false,
    start: function(){
      //if 10 players and we dont have gk, just visible gk.
      if((Object.values(players_on_field).length==10 || Object.values(players_on_field).length==11) && $('.field_player[position="gk"]').hasClass('visible')!=true){
        $('.field_player[position="gk"]').addClass('ondraging');
        if(this.tagName=='TR'){
          $(this).addClass('drag');
        }else{
          $(this).addClass('ondrag1');
        }
      //if it's not OR players_on_field < max_players_on_field, make all visible.
      }else if(Object.keys(players_on_field).length < max_players_on_field){
        //styles
        $('.field_player').addClass('ondraging');
        if(this.tagName=='TR'){
          $(this).addClass('drag');
        }else{
          $(this).addClass('ondrag1');
        }
      //else probaly all full
      }else{
        if(this.tagName!='TR'){
          $('.field_player').addClass('ondraging');
        }
      }
      //players on drag
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
function draggable_field(){
  $( ".field_player" ).draggable({
   scroll: false,
   start: function(){
     $('table').css('border','2px dashed #62de9f');
     //if 10 players and we dont have gk, just visible gk.
     if((Object.values(players_on_field).length==10 || Object.values(players_on_field).length==11) && $('.field_player[position="gk"]').hasClass('visible')!=true){
       $('.field_player[position="gk"]').addClass('ondraging');
       if(this.tagName=='TR'){
         $(this).addClass('drag');
       }else{
         $(this).addClass('ondrag1');
       }
     //if it's not OR players_on_field < max_players_on_field, make all visible.
     }else if(Object.keys(players_on_field).length < max_players_on_field){
       //styles
       $('.field_player').addClass('ondraging');
       if(this.tagName=='TR'){
         $(this).addClass('drag');
       }else{
         $(this).addClass('ondrag1');
       }
     //else probaly all full
     }else{
       if(this.tagName!='TR'){
         $('.field_player').addClass('ondraging');
       }
     }
     //players on drag
     player_on_drag = {id_player:$(this).attr('player-id'), playername:$(this).attr('player-name')};
   },
   stop: function(){
     $('table').css('border','none');
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
function droppable_playerlist(){
  $( "table tbody" ).droppable({
    drop: function( event, ui ) {
      if(ui.draggable.context.nodeName!='TR'){
        /* put it back on listtable */
        //delete player in the old position
        $(".field_player[position='"+key(players_on_field)+"']").attr('player-id','');
        $(".field_player[position='"+key(players_on_field)+"']").attr('player-name','');
        $(".field_player[position='"+key(players_on_field)+"']").removeClass('visible');
        $(".field_player[position='"+key(players_on_field)+"']").find('p.playername').html('');
        $(".reserve_player[position='"+key(players_on_reserve)+"']").attr('player-id','');
        $(".reserve_player[position='"+key(players_on_reserve)+"']").attr('player-name','');
        $(".reserve_player[position='"+key(players_on_reserve)+"']").removeClass('visible');
        $(".reserve_player[position='"+key(players_on_reserve)+"']").find('p.playername').html('');
        var positions = "";
        var target = $('table tbody');
        var cache;
        for(var i = 0; i < players.length; i++){
          if(players[i].player_id == player_on_drag.id_player){
            cache = i;
          }
        }
        $(players[cache].positions).each(function(){
          positions += "<span class='position-"+this.position+"'>"+this.position+" " + this.side+"</span> ";
        })
        var name = players[cache].name.split(' ');
        var html = "<tr player-id='"+players[cache].player_id+"' player-name='"+name[0]+"'>"+
                            "<td class='player-name'>"+players[cache].name+"</td>"+
                            "<td class='positions'>"+
                                positions+
                            "</td>"+
                            "<td>"+players[cache].skill_index+"</td>"+
                            "<td>"+players[cache].recomendation+"</td>"+
                            "<td></td>"+
                          "</tr>"
        $(target).append(html);
        // if position filter is set to another position that player doest have, the player must not be visible in the list
        var radio = $('input[type="radio"]:checked').val();
        var controller = 0;
        $("tr[player-id='"+players[cache].player_id+"'] td.positions span").each(function(){
          $(players[cache].positions).each(function(){
            if(radio == 'def' && this.position=='D'){
              controller++;
            }else if((radio=='mid') && ((this.position=='DM') || (this.position=='M') || (this.position=='OM'))){
              controller++;
            }else if((radio=='atk') && (this.position=='FC')){
              controller++;
            }else if((radio=='gk') && (this.position=='GK')){
              controller++;
            }
          })
        });
        if(controller==0){
          $("tr[player-id='"+players[cache].player_id+"']").css('display','none');
        }

        draggable_playerlist();
        delete players_on_field[key(players_on_field)];
      //save tactics and delete player on the player_on_drag.
      __SAVETACTICS();
      delete player_on_drag.id_player;
      delete player_on_drag.playername;
    }
    }
  });
}
function draggable_reserves(){
  $( ".reserve_player:not([player-id=''])").draggable({
     scroll: false,
     start: function(){
       $('table').css('border','2px dashed #62de9f');
       //if 10 players and we dont have gk, just visible gk.
       console.log(Object.values(players_on_field).length);
       if((Object.values(players_on_field).length==10 || Object.values(players_on_field).length==11) && $('.field_player[position="gk"]').hasClass('visible')!=true){
         $('.field_player[position="gk"]').addClass('ondraging');
         if(this.tagName=='TR'){
           $(this).addClass('drag');
         }else{
           $(this).addClass('ondrag1');
         }
       //if it's not OR players_on_field < max_players_on_field, make all visible.
       }else if(Object.keys(players_on_field).length < max_players_on_field){
         //styles
         $('.field_player').addClass('ondraging');
         if(this.tagName=='TR'){
           $(this).addClass('drag');
         }else{
           $(this).addClass('ondrag1');
         }
       //else probaly all full
       }else{
         if(this.tagName!='TR'){
           $('.field_player').addClass('ondraging');
         }
       }
       //players on drag
       player_on_drag = {id_player:$(this).attr('player-id'), playername:$(this).attr('player-name')};
     },
     stop: function(){
       $('table').css('border','none');
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
function droppable_field(){
  $( ".field_player" ).droppable({
    drop: function( event, ui ) {
      /* delete from list table */
      var old = players_on_field[$(this).attr('position')];

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
      }else if($.inArray(player_on_drag.id_player,Object.values(players_on_reserve)) != -1){
        //delete player in the old position
        $(".reserve_player[position='"+key(players_on_reserve)+"']").attr('player-id','');
        $(".reserve_player[position='"+key(players_on_reserve)+"']").attr('player-name','');
        $(".reserve_player[position='"+key(players_on_reserve)+"']").removeClass('visible');
        $(".reserve_player[position='"+key(players_on_reserve)+"']").find('p.playername').html('');
        delete players_on_reserve[key(players_on_reserve)];
        //added player in new position
        players_on_field[$(this).attr('position')] = player_on_drag.id_player;
      }else{
        players_on_field[$(this).attr('position')] = player_on_drag.id_player;
      }
      if(old!=undefined){
        delete players_on_field[key(players_on_field)];
        //added player in new position
        players_on_field[$(this).attr('position')] = player_on_drag.id_player;

        /* put it back on listtable */
        var positions = "";
        var target = $('table tbody');
        var cache;
        for(var i = 0; i < players.length; i++){
          if(players[i].player_id == old){
            cache = i;
          }
        }
        $(players[cache].positions).each(function(){
          positions += "<span class='position-"+this.position+"'>"+this.position+" " + this.side+"</span> ";
        })
        var name = players[cache].name.split(' ');
        var html = "<tr player-id='"+players[cache].player_id+"' player-name='"+name[0]+"'>"+
                            "<td class='player-name'>"+players[cache].name+"</td>"+
                            "<td class='positions'>"+
                                positions+
                            "</td>"+
                            "<td>"+players[cache].skill_index+"</td>"+
                            "<td>"+players[cache].recomendation+"</td>"+
                            "<td></td>"+
                          "</tr>"
        $(target).append(html);
        // if position filter is set to another position that player doest have, the player must not be visible in the list
        var radio = $('input[type="radio"]:checked').val();
        var controller = 0;
        $("tr[player-id='"+players[cache].player_id+"'] td.positions span").each(function(){
          $(players[cache].positions).each(function(){
            if(radio == 'def' && this.position=='D'){
              controller++;
            }else if((radio=='mid') && ((this.position=='DM') || (this.position=='M') || (this.position=='OM'))){
              controller++;
            }else if((radio=='atk') && (this.position=='FC')){
              controller++;
            }else if((radio=='gk') && (this.position=='GK')){
              controller++;
            }
          })
        });
        if(controller==0){
          $("tr[player-id='"+players[cache].player_id+"']").css('display','none');
        }

        draggable_playerlist();
      }
      /* transfer player to field_player */
      $(this).addClass('visible');
      $(this).attr('player-id',player_on_drag.id_player);
      $(this).attr('player-name',player_on_drag.playername);
      $(this).find('p.playername').html(player_on_drag.playername);
      $(this).find('.rec').html(players[player_on_drag.id_player].recomendation);
      //save tactics and delete player on the player_on_drag.
      __SAVETACTICS();
      delete player_on_drag.id_player;
      delete player_on_drag.playername;
    }
  });
}
function droppable_reserves(){
  $( ".reserve_player" ).droppable({
    drop: function( event, ui ) {
      /* delete from list table */
      var old = players_on_reserve[$(this).attr('position')];
      $("tr[player-id='"+player_on_drag.id_player+"']").remove();
      if($.inArray(player_on_drag.id_player,Object.values(players_on_field)) != -1){
        //delete player in the old position
        $(".field_player[position='"+key(players_on_field)+"']").attr('player-id','');
        $(".field_player[position='"+key(players_on_field)+"']").attr('player-name','');
        $(".field_player[position='"+key(players_on_field)+"']").removeClass('visible');
        $(".field_player[position='"+key(players_on_field)+"']").find('p.playername').html('');
        delete players_on_field[key(players_on_field)];
        delete players_on_reserve[key(players_on_reserve)];
        //added player in new position
        players_on_reserve[$(this).attr('position')] = player_on_drag.id_player;
      }else if($.inArray(player_on_drag.id_player,Object.values(players_on_reserve)) != -1){
        //delete player in the old position
        $(".reserve_player[position='"+key(players_on_reserve)+"']").attr('player-id','');
        $(".reserve_player[position='"+key(players_on_reserve)+"']").attr('player-name','');
        $(".reserve_player[position='"+key(players_on_reserve)+"']").removeClass('visible');
        $(".reserve_player[position='"+key(players_on_reserve)+"']").find('p.playername').html('');
        delete players_on_reserve[key(players_on_reserve)];
        //added player in new position
        players_on_reserve[$(this).attr('position')] = player_on_drag.id_player;
      }else{
        players_on_reserve[$(this).attr('position')] = player_on_drag.id_player;
      }
      /* transfer player to reserve_player */
      $(this).addClass('visible');
      $(this).attr('player-id',player_on_drag.id_player);
      $(this).attr('player-name',player_on_drag.playername);
      $(this).find('p.playername').html(player_on_drag.playername);
      //save tactics and delete player on the player_on_drag.
      //make reserve_player with visible class draggable
      draggable_reserves();
      __SAVETACTICS();
      delete player_on_drag.id_player;
      delete player_on_drag.playername;
    }
  });
}

function makedroppable(){
  $( "table tbody tr, .field_player" ).droppable({
    drop: function( event, ui ) {
      if(this.tagName=='TR'){
        /* put it back on listtable */
        if($.inArray(player_on_drag.id_player,Object.values(players_on_field)) != -1){
          //delete player in the old position
          $(".field_player[position='"+key(players_on_field)+"']").attr('player-id','');
          $(".field_player[position='"+key(players_on_field)+"']").attr('player-name','');
          $(".field_player[position='"+key(players_on_field)+"']").removeClass('visible');
          $(".field_player[position='"+key(players_on_field)+"']").find('p.playername').html('');
          var positions = "";
          var target = $('table tbody');
          var cache;
          for(var i = 0; i < players.length; i++){
            if(players[i].player_id == player_on_drag.id_player){
              cache = i;
            }
          }
          $(players[cache].positions).each(function(){
            positions += "<span class='position-"+this.position+"'>"+this.position+" " + this.side+"</span> ";
          })
          var name = players[cache].name.split(' ');
          $(target).append("<tr player-id='"+players[cache].player_id+"' player-name='"+name[0]+"'>"+
                              "<td class='player-name'>"+players[cache].name+"</td>"+
                              "<td class='positions'>"+
                                  positions+
                              "</td>"+
                              "<td>"+players[cache].skill_index+"</td>"+
                              "<td></td>"+
                            "</tr>");
          // if position filter is set to another position that player doest have, the player must not be visible in the list
          var radio = $('input[type="radio"]:checked').val();
          var controller = 0;
          $("tr[player-id='"+players[cache].player_id+"'] td.positions span").each(function(){
            $(players[cache].positions).each(function(){
              if(radio == 'def' && this.position=='D'){
                controller++;
              }else if((radio=='mid') && ((this.position=='DM') || (this.position=='M') || (this.position=='OM'))){
                controller++;
              }else if((radio=='atk') && (this.position=='FC')){
                controller++;
              }else if((radio=='gk') && (this.position=='GK')){
                controller++;
              }
            })
          });
          if(controller==0){
            $("tr[player-id='"+players[cache].player_id+"']").css('display','none');
          }
        }

        makedraggable();
        delete players_on_field[key(players_on_field)];
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
      //save tactics and delete player on the player_on_drag.
      __SAVETACTICS();
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

function __SAVETACTICS(){
  $.ajax({
    url : 'tactics/save',
    method: 'POST',
    dataType: 'JSON',
    data : {players_on_field:JSON.stringify(players_on_field)},
    beforeSend: function(){
      $('.lastsaved').html('Salvando...');
    },
    success : function(response){
      console.log(response);
      $('.lastsaved').html('Salvo');
    },
    error : function(response){
      console.log('error');
      console.log(response);
    }
  });
  console.log('SAVING....');
}
function filter(){
  $('tr').each(function(){
    $(this).css('display','table-row');
  })
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
   $("#radio").attr('checked','checked');
}
$(document).ready(function(){
  loadplayers();
});

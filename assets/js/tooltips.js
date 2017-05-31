$('.tooltip[club]').hover(function(){
  var id = $(this).attr('club');
  $.ajax({
    data: {id_club:id},
    url: url+'helpers/ajax/tooltip.club.php',
    dataType: 'json',
    success: function(json){
      $(".tooltip[club='"+id+"'] .tooltip-text").html(
        '<h3>'+json.data.clubname+'</h3><br>'+
        '<strong>Jogando </strong>'+json.data.leaguename+' <img src="'+url+'assets/img/icons/flags/brazil.png" width="20px"><br>'+
        '<strong>Fundado em </strong>'+json.data.created+'<br>'+
        // '<strong>Economia está </strong>'+id+'<br>'+
        '<strong>Ultimo login </strong>'+json.data.lastlogin+'<br>'
      );
    },
  })
});

$('.tooltip[player]').hover(function(){
  var id = $(this).attr('player');
  $.ajax({
    data: {id_player:id},
    url: url+'helpers/ajax/player.php',
    dataType: 'json',
    success: function(json){
      console.log(json);
      $(".tooltip[player='"+id+"'] .tooltip-text").html(
        '<h3>'+json.data.name+' <img src="'+url+'assets/img/icons/flags/'+json.data.country+'.png" width="20px"><br></h3><br>'+
        '<strong>Jogando por </strong><a href="'+url+'club/'+json.data.club+'">'+json.data.clubname+'</a><br>'+
        '<strong>Salário:</strong> $'+json.data.wage+'<br>'+
        '<strong>Idade: </strong> '+json.data.age+' anos<br>'+
        '<strong>Peso/Altura:</strong> '+json.data.weight+'kg/'+json.data.height+'cm<br>'
      );
    },
    error: function(data){
      console.log(data);
    }
  })
});

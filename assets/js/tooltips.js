$('.tooltip[club]').hover(function(){
  var id = $(this).attr('club');
  $.ajax({
    data: {id_club:id},
    url: 'http://localhost/helpers/ajax/tooltip.club.php',
    dataType: 'json',
    success: function(json){
      $(".tooltip[club='"+id+"'] .tooltip-text").html(
        '<h3>'+json.data.clubname+'</h3><br>'+
        '<strong>Fundado em: </strong>'+json.data.created+'<br>'+
        '<strong>Disputando: </strong>'+id+'<br>'+
        '<strong>Economia: </strong>'+id+'<br>'+
        '<strong>Ultimo login: </strong>'+json.data.lastlogin+'<br>'
      );
    },
  })
});
console.log('eeee');

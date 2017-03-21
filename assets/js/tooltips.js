$('.tooltip[club]').hover(function(){
  var id = $(this).attr('club');
  $.ajax({
    data: {id_club:id},
    url: 'http://localhost/helpers/ajax/tooltip.club.php',
    dataType: 'json',
    success: function(json){
      $(".tooltip[club='"+id+"'] .tooltip-text").html(
        '<h3><img src="http://localhost/assets/img/icon.png" width="50px">'+json.data.clubname+'</h3><br>'+
        '<strong>Jogando </strong>'+json.data.leaguename+' <img src="http://localhost/assets/img/icons/flags/brazil.png" width="20px"><br>'+
        '<strong>Fundado em </strong>'+json.data.created+'<br>'+
        '<strong>Economia está </strong>'+id+'<br>'+
        '<strong>Ultimo login </strong>'+json.data.lastlogin+'<br>'
      );
    },
  })
});

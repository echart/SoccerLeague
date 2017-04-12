function searchclub(){
  var whois = $('#search-clubname').val();
  $.ajax({
    url : url+'helpers/ajax/search.club.php',
    dataType: 'json',
    method: 'post',
    data : {who:whois},
    success : function(response){
      console.log(response);
      var target = $('table.club-result tbody');
      $(target).html('');

      if(response.data.length==0){
        $(target).append('<tr><td colspan="3">Nada encontrado :(</td><tr>');
      }else{
        $(response.data).each(function(){
          $(target).append('<tr><td>'+this.id_club+'</td><td><a href="'+url+'club/'+this.id_club+'">'+this.clubname+'</a></td><td>'+this.competition+'</td></tr>');
        })
      }
    },
    error : function(response){
      console.log(response);
    }
  });
}

$('#search-clubname').keyup(searchclub);

function buddy(button,action,buddy1,buddy2){
  $.ajax({
    url: url+'helpers/ajax/buddy.php?id_buddyA='+buddy1+'&id_buddyB='+buddy2+'&action='+action,
    method: 'POST',
    dataType: 'JSON',
    beforeSend: function(){
      $(button).html('.....');
    },
    success: function(response){
      if(response.data.success){
        if(action=='aproval'){
          $(button).html('Desfazer amizade');
          $(button).attr('onclick',"buddy(this,'unbuddy','"+buddy1+"','"+buddy2+"')");
        }else if(action=='request'){
          $(button).html('Solicitaçao pendente');
          $(button).attr('onclick',"buddy(this,'unMakeBuddy','"+buddy1+"','"+buddy2+"')");
        }else if(action=='unMakeBuddy'){
          $(button).html('Fazer novo amigo');
          $(button).attr('onclick',"buddy(this,'request','"+buddy1+"','"+buddy2+"')");
        }else if(action=='unbuddy'){
          $(button).html('Fazer novo amigo');
          $(button).attr('onclick',"buddy(this,'request','"+buddy1+"','"+buddy2+"')");
        }
      }
    },
    error: function(response){
      console.log(response);
    }
 });
}

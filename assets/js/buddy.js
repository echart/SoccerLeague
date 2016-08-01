function buddy(button,action,buddy1,buddy2){
  $.ajax({
    url: '../buddy/'+buddy1+'/'+buddy2+'/'+action,
    method: 'POST',
    dataType: 'JSON',
    beforeSend: function(){
      $(button).html('.....');
    },
    success: function(data){
      console.log(data.data.success);
      console.log(data);
      if(data.data.success){
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
    }
 });
}

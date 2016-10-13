function authentication(){
  $.ajax({
      url: 'controllers/_login.php',
      type: 'POST',
      dataType: 'json',
      data: {login: $("#login-input").val(), password:$("#pass-input").val()},
      beforeSend: function(data){

      },
      success: function(data){
        if(typeof data.error != 'undefined'){
          if(data.error.message=='denied'){

          }
        }
        if(typeof data.data.success != 'undefined'){
          if(data.data.success=='logged'){

            setTimeout(function(){
              location.reload();
            },1000);
          }
        }
      },
      error: function(data){
        
      }
  });
}

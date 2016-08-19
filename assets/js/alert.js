function newAlert(type,message,time,location){
    if($('#alert').length!=0){
      var div=$('#alert');
      $('#alert').html('<p>'+message+'</p>');
      div.addClass('alert-'+location);
      div.addClass('alert-'+type);
      div.addClass('visible');
      setTimeout(function(){
        div.removeClass('alert-'+location);
        div.removeClass('alert-'+type);
        div.removeClass('visible');
      },time);
    }
}

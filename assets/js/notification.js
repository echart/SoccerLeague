function notification(message,type='notice', icon='', ttl=8000, callback=function(){}){
  //message : '<span class="icon icon-success"></span><p>Impossível deletar tweet.</p>',
  if(icon==''){
    message = '<p>'+message+'</p>';
  }else{
    message = '<span class="icon icon-'+icon+'"></span><p>'+message+'</p>';
  }
  // create the notification
  var call = new NotificationFx({
    message : message,
    layout  : 'attached',
    effect  : 'bouncyflip',
    type    : type, // notice, warning or error,
    ttl     : ttl,
    onClose : function() {
      callback();
    }
  });
  // show the notification
  call.show();
}

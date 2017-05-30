$('.topic-delete').on('click',function(){
  if(confirm('Você tem certeza?')){
    delete_topic(this);
  }
})

function delete_topic(){
  var id_topic = $('.topic-delete').attr('id-topic');
  $.ajax({
    method: 'POST',
    dataType: 'JSON',
    data : {id_topic:id_topic,delete_topic:true},
    success : function(response){
      notification('Tópico deletado!','success');
      window.location=url+'forum/';
    },
    error : function(response){
      console.log(response);
    }
  });
}



$('.reply-delete').on('click',function(){
  if(confirm('Você tem certeza?')){
    delete_reply(this);
  }
})

function delete_reply(){
  var id_topic = $('.reply-delete').attr('id-reply');
  $.ajax({
    method: 'POST',
    dataType: 'JSON',
    data : {id_reply:id_topic,delete_reply:true},
    success : function(response){
      notification('Resposta deletada!','success');
      location.reload();
    },
    error : function(response){
      console.log(response);
    }
  });
}

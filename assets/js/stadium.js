function facilitie(action,facilitie){
  var constructions = {
    'draining' : [20000000]
  }
  if(confirm('Você tem certeza?')){
    $.ajax({
      method: 'POST',
      dataType: 'JSON',
      data : {action:action, facilitie:facilitie},
      success : function(response){
        notification('Alterada!','success');
        location.reload();
      },
      error : function(response){
        console.log(response);
      }
    });
  }
}

function capacity(){
  if($('#new_capacity').val()!=0 ||$('#new_capacity').val()!='' ){
    if(confirm('Você tem certeza que deseja alterar a capacidade do seu estádio?')){
      $.ajax({
        method: 'POST',
        dataType: 'JSON',
        data : {action:'capacity', new_capacity:$('#new_capacity').val()},
        success : function(response){
          notification('Alterada!','success');
          $('.modal-close').trigger('click');
          location.reload();
        },
        error : function(response){
          console.log(response);
        }
      });
    }
  }
}

$('.capacity').on('click',function(){
  $('#modal_capacity').trigger('click');
})

$('#new_capacity').keyup(function(){
  var value = $('#new_capacity').val()-$('#old_capacity').val();
  value = 250*value;
  if(value<0){
    value=0;
  }
  $('.construction-capacity strong').html('$ '+value);
})

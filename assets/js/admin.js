$('.ban').on('click',function(){
  if(confirm('Você tem certeza?')){
    ban();
  }
})

function ban(){
  $.ajax({
    url : '../../admin/ban',
    method: 'POST',
    dataType: 'JSON',
    data : {id_club:id_club},
    success : function(response){
      notification('Alteração de status feita com sucesso','success');
    },
    error : function(response){
      console.log(response);
    }
  });
}

$('.inactive').on('click',function(){
  if(confirm('Você tem certeza?')){
    inactive();
  }
})

function inactive(){
  $.ajax({
    url : '../../admin/inactive',
    method: 'POST',
    dataType: 'JSON',
    data : {id_club:id_club},
    success : function(response){
      notification('Alteração de status feita com sucesso','success');
    },
    error : function(response){
      console.log(response);
    }
  });
}

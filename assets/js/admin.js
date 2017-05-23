$('.ban').on('click',function(){
  if(confirm('Você deseja banir este clube?')){
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
      notification('BANIDO!','error');
    },
    error : function(response){
      console.log(response);
    }
  });
}

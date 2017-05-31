value = $('.bid').val();
value = parseFloat(value)*2;
$('.buy').on('click',function(){
    $('label[for="modal_buy"]').trigger('click');
});
$('.sell-player').on('click',function(){
    $('label[for="modal_sell"]').trigger('click')
});

$('.fire-player').on('click',function(){
    if(confirm('Você tem certeza que deseja demitir esse jogador? Ele será excluido do jogo e não ficará mais disponível a sua equipe.')){
      fireplayer();
    }
});

function fireplayer(){
  $.ajax({
    method: 'POST',
    dataType: 'JSON',
    data : {fireplayer:true},
    success : function(response){
      notification('Demitido!','success');
      location.reload();
    },
    error : function(response){
      console.log(response);
    }
  });
}

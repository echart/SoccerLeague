$('.report').on('click',function(){
  if($('.modal-report #reason option:selected').val()==''){
    notification('Você deve preencher pelo menos o motivo','error');
  }else{
    $.ajax({
      url : '../../helpers/ajax/club.report.php',
      method: 'POST',
      dataType: 'JSON',
      data : {id_club:id_club,reason:$('.modal-report #reason option:selected').val(),description:$('.modal-report #description').val()},
      success : function(response){
        notification('O clube foi denunciado e um GT irá decidir ou não pela punição.','error');
        $('.modal-report #reason option:selected').attr("selected",false) ;
        $('.modal-report #description').val('');
        $('.modal-report label').trigger('click');
      },
      error : function(response){
        console.log(response);
      }
    });
  }
});

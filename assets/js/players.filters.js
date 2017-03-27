$(document).ready(function(){
  $('.tec,.psi,.phi').css('display','none');
  $("table").stupidtable();
});

$("select[name='visible-attr']").on('change',function(){
    switch ($(this).val()) {
      case 'phi':
          $('.tec,.psi,.gen').css('display','none');
          $('.phi').css('display','table-cell')
        break;
      case 'psi':
          $('.tec,.phi,.gen').css('display','none');
          $('.psi').css('display','table-cell');
          break;
      case 'tec':
          $('.psi,.phi,.gen').css('display','none');
          $('.tec').css('display','table-cell');
          break;
      case 'gen':
          $('.psi,.phi,.tec').css('display','none');
          $('.gen').css('display','table-cell');
          break;
    }
});

$("input[name='pos']").on('change',function(){
  switch ($(this).val()) {
    case 'all':
        $('tr').each(function(){
          $(this).css('display','table-row');
        })
      break;
    case 'def':
      $('tr').each(function(){
       $(this).find('td span').each(function(){
         $(this).each(function(){
           if($(this).hasClass('position-D')){
             $(this).parent().parent().css('display','table-row');
           }else{
             $(this).parent().parent().css('display','none');
           }
         });
       });
      })
      break;
    case 'mid':
      $('tr').each(function(){
       $(this).find('td span').each(function(){
         $(this).each(function(){
           if($(this).hasClass('position-M') || $(this).hasClass('position-DM') || $(this).hasClass('position-OM') ){
             $(this).parent().parent().css('display','table-row');
           }else{
             $(this).parent().parent().css('display','none');
           }
         });
       });
      })
      break;
    case 'atk':
    $('tr').each(function(){
     $(this).find('td span').each(function(){
       $(this).each(function(){
         if($(this).hasClass('position-F') ){
           $(this).parent().parent().css('display','table-row');
         }else{
           $(this).parent().parent().css('display','none');
         }
       });
     });
    })
      break;
      case 'gk':
      $('tr').each(function(){
       $(this).find('td span').each(function(){
         $(this).each(function(){
           if($(this).hasClass('position-GK') ){
             $(this).parent().parent().css('display','table-row');
           }else{
             $(this).parent().parent().css('display','none');
           }
         });
       });
     });
      break;
  }
})

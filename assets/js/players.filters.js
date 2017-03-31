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
    $('.positions').each(function(){
      x = 0;
       $(this).children().each(function(){
         if($(this).hasClass('position-D'))
          x++;
       });
       if(x==0){
         $(this).closest('tr').toggle();
       }
     });
      break;
    case 'mid':
    $('.positions').each(function(){
      x = 0;
       $(this).children().each(function(){
         if($(this).hasClass('position-DM') || $(this).hasClass('position-M') || $(this).hasClass('position-OM'))
          x++;
       });
       if(x==0){
         $(this).closest('tr').toggle();
       }
     });
      break;
    case 'atk':
    $('.positions').each(function(){
      x = 0;
       $(this).children().each(function(){
         if($(this).hasClass('position-F'))
          x++;
       });
       if(x==0){
         $(this).closest('tr').toggle();
       }
     });
      break;
      case 'gk':
      $('.positions').each(function(){
        x = 0;
         $(this).children().each(function(){
           if($(this).hasClass('position-GK'))
            x++;
         });
         if(x==0){
           $(this).closest('tr').toggle();
         }
       });
      break;
  }
})

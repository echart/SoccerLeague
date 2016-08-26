$(document).ready(function(){
  $('.phi').css('display','none');
  $('.tec').css('display','none');
});

$("select[name='visible-attr']").on('change',function(){
    switch ($(this).val()) {
      case 'phi':
          $('.tec,.psi').css('display','none');
          $('.phi').css('display','table-cell')
        break;
      case 'psi':
          $('.tec,.phi').css('display','none');
          $('.psi').css('display','table-cell');
          break;
      case 'tec':
          $('.psi,.phi').css('display','none');
          $('.tec').css('display','table-cell');
          break;
    }
});

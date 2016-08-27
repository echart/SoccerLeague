$(document).ready(function(){
  $('.phi').css('display','none');
  $('.tec').css('display','none');
  $('.psi').css('display','none');
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

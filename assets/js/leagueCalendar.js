$(document).ready(function(){
  $('table tbody').css('display','none');
  $('table thead').on('click',function(){
    $(this).next().toggleClass('visible-table');
  })
})

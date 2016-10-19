$(document).ready(function(){
  $('.sidebar section:not(.sidebar section ul li a)').on('click',function(){
    $(this).children('ul').toggleClass('open');
  })
})

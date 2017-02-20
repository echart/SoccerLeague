$('.menu-mobile').on('click', function(){
  $(this).toggleClass("change");
  $('.navbar').toggleClass('navbar-open');
  $('.content').toggleClass('hidden');
})

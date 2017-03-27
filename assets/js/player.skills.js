$(document).ready(function(){
  $('.skills td').each(function(){
    if($(this).html()=='19'){
      $(this).html("<img src='../assets/img/icons/empty_star.png' width='16px'>");
    }
  })
  $('.skills td').each(function(){
    if($(this).html()=='20'){
      $(this).html("<img src='../assets/img/icons/full_star.png' width='16px'>");
    }
  })
})

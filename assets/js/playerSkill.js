$(document).ready(function(){
  $('table tbody tr td').each(function(){
    if($(this).html()==19){
       $(this).html("<img src='http://t.soccerleague.com.br/assets/img/silverstar.png' width='16px'>");
    }else if($(this).html()==20){
       $(this).html("<img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>");
    }
    switch($(this).html()){
      case 'rec[4.5]':
      case 'rec[4.6]':
      case 'rec[4.7]':
      case 'rec[4.8]':
      case 'rec[4.9]':
        $(this).html("<span class='helper bg-dark'><img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>"+
        "<img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>"+
        "<img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>"+
        "<img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>"+
        "<img src='http://t.soccerleague.com.br/assets/img/halfstar.png' width='16px'></span>");
        break;

      case 'rec[4.4]':
      case 'rec[4.3]':
      case 'rec[4.2]':
      case 'rec[4.1]':
      case 'rec[4.0]':
      $(this).html("<span class='helper bg-dark'><img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>"+
      "<img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>"+
      "<img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>"+
      "<img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>"+
      "<img src='http://t.soccerleague.com.br/assets/img/blankstar.png' width='16px'></span>");
      break;
      case 'rec[3.5]':
      case 'rec[3.6]':
      case 'rec[3.7]':
      case 'rec[3.8]':
      case 'rec[3.9]':
        $(this).html("<span class='helper bg-dark'><img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>"+
        "<img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>"+
        "<img src='http://t.soccerleague.com.br/assets/img/goldstar.png' width='16px'>"+
        "<img src='http://t.soccerleague.com.br/assets/img/halfstar.png' width='16px'>"+
        "<img src='http://t.soccerleague.com.br/assets/img/blankstar.png' width='16px'></span>");
        break;
    }
  })
});

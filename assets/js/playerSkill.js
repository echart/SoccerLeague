$(document).ready(function(){
  $('table tbody tr td').each(function(){
    if($(this).html()==19){
       $(this).html("<img src='http://t.soccerleague.com.br/assets/img/star-19.png' width='16px'>");
    }else if($(this).html()==20){
       $(this).html("<img src='http://t.soccerleague.com.br/assets/img/star-20.png' width='16px'>");
    }
  })
});

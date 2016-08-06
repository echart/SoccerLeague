$(document).ready(function(){
  loadtweets(id_club);
});
function loadtweets(id_club){
  var url='../api/tweets/1/all';

  $.ajax({
    url: url,
    beforeSend: function(){console.log('carregando')},
    success: function(data){
      console.log(data);
      $('.feed').empty();
      for(var i=0;i< data.data.tweets.length;i++){
        console.log(data.data.tweets[i]);
        $('.feed').append("<div class='tweet'><div class='tweet-content'><div class='club-logo'><img width='75px' height='75px' src='../assets/img/logos/"+data.data.tweets[i].club_logo+"'></div><div class='tweet2'><div class='tweet-info'>"+data.data.tweets[i].clubname+" <span class='club-user'></span> - <span class='date'>3h</span></div><div class='tweet-text'>"+data.data.tweets[i].tweet+"</div></div></div><div class='tweet-options'><button type='button' class='btn-tweet btn no-bg no-hover black-text'><span class='reply'></span></button><button type='button' class='btn-tweet btn no-bg no-hover white-text'><span class='like'></span></button><button type='button' class='btn-tweet btn no-bg no-hover white-text'><span class='retweet'></span></button><button type='button' class='btn-tweet btn no-bg no-hover white-text'><span class='delete'></span></button></div></div>");
      }
    }
  })
}

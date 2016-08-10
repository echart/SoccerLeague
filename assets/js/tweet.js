page=0;
$(document).ready(function(){
  $(window).scroll(function(){
    if($(window).scrollTop() + $(window).height() == $(document).height()) {
      loadtweets(id_club);
    }
  });
  loadtweets(id_club);
});
function loadtweets(id_club){
  var url='../api/tweets/all/'+id_club+'/'+page;
  $('.feed').load(url);
  page++;
}
z='';
function tweetaction(action,tweet){
  var url='../api/tweet/'+tweet+'/'+action;
  $.ajax({
    url: url,
    success:function(retorno){
      z=retorno;
      console.log('retorno');
      console.log(retorno);
      if(action=='like'){
        if(retorno.data.action=='liked'){
          $('button span.like').addClass('like2');
          $('button span.like').removeClass('like');
        }else{
          $('button span.like2').addClass('like');
          $('button span.like2').removeClass('like2');
        }
      }
    },
    error:function(data){
      console.log('error');
      console.log(data);
    }
  });
}

function opentweet(id_tweet,page){
  var url='../api/tweet/'+id_tweet;

  $.ajax({
    url: url,
    beforeSend: function(){
      $('#modal_tweet').prop("checked",true);
    },
    success: function(data){
      console.log(data);
      $('.modal-tweet .modal-content .club-logo img').attr('src','../../../assets/img/logo/'+data.data.club_logo);
      $('.modal-tweet .modal-content .tweet-info').html(data.data.clubname+"<span class='date'>"+data.data.tweetdate+"</span>")
      $('.modal-tweet .modal-content .tweet-text').html(data.data.tweet);

    }
  });

}

function composeTweet(id){
  url='../api/tweet/compose/';
  $.ajax({
    url:url,
    method: 'POST',
    data: {tweet: $('#newtweet').val()},
    beforeSend: function(){
      $('span.arrow').addClass('load');
      $('span.load').removeClass('arrow');
    },
    success: function(data){
      console.log(data);
      $('span.load').addClass('arrow');
      $('span.arrow').removeClass('load');
    },
    error: function(data){
      console.log('error');
      console.log(data);
      $('span.load').addClass('arrow');
      $('span.arrow').removeClass('load');
    }
  });
}

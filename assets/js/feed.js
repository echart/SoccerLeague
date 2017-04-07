function loadfeed(id_club,method,page){
  $.ajax({
    url : 'http://localhost/feed/'+id_club+'/'+method+'/'+'/'+page,
    dataType: 'json',
    success : function(feed){
      makefeed(feed.data, id_club)
    }
  });
}
function makefeed(feed, id_club){
  var target = $('.feed-principal .feed-content');
  $(target).html('');
  if(feed.tweets.length>0){
    $(feed.tweets).each(function(){
      var content = "";
      var spandelete = (this.id_club == id_club) ? '<span class="feed-post-content-controllers"></span>' : '';
      content = "<div class='feed-post' id_tweet='"+this.id_tweet+"'>"+
                  "<div class='feed-post-logo'></div>"+
                  "<div class='feed-post-content'>"+
                    "<h4><a href='http://localhost:8080/club/"+this.id_club+"'>"+this.clubname+"</a> <span>"+this.tweetdate+"</span>"+
                      spandelete+
                    "</h4>"+
                    "<p>"+this.tweet+"</p>"+
                    "<div class='feed-post-controllers'><span class='reply'><i></i>"+this.replies+" respostas</span><span class='trash'><i></i>Excluir</span></div>"
                  "</div>"+
                "</div>"
      $(target).append(content);
    })
    $('.reply').on('click',function(){
      opentweet(this);
    });
  }else{
    $(target).append("<p>Nada encontrado :(</p>");
  }
}
function feedcontent(content){
  var keys = ['feed_idclub','feed_match','feed_transfer'];
}
function opentweet(span){
  var post = $(span).parent().parent().parent();
  var id_tweet = $(post).attr('id_tweet');
  var modal = $('.feed-replies');
  $(modal).html("<p>Carregando...</p>");
  $('#modal_feed').trigger('click');
  //load tweet
  $.ajax({
    url : 'http://localhost/helpers/ajax/tweet.php?id_tweet='+id_tweet+'&method=get',
    dataType: 'json',
    success : function(feed){
      $(feed.data.tweet).each(function(){
        var content = "";
        content = "<div class='feed-post father' id_tweet='"+this.id_tweet+"'>"+
                    "<div class='feed-post-logo'></div>"+
                    "<div class='feed-post-content'>"+
                      "<h4><a href='http://localhost:8080/club/"+this.id_club+"'>"+this.clubname+"</a> <span>"+this.tweetdate+"</span></h4>"+
                      "<p>"+this.tweet+"</p>"+
                    "</div>"+
                  "</div>"+
                  "<div class='box-content create-content'>"+
                    "<form action='' method='post'>"+
                      "<textarea required placeholder='Responder tweet'></textarea>"+
                      "<button class='btn btn-medium btn-light'>Responder</button>"+
                    "</form>"+
                  "</div>";
        $(modal).html('');
        $(modal).append(content);
      });
      console.log(feed.data);
      $(feed.data.replies).each(function(){
        var content = "";
        content = "<div class='feed-post' id_tweet='"+this.id_tweet+"'>"+
                    "<div class='feed-post-logo'></div>"+
                    "<div class='feed-post-content'>"+
                      "<h4><a href='http://localhost:8080/club/"+this.id_club+"'>"+this.clubname+"</a> <span>"+this.tweetdate+"</span></h4>"+
                      "<p>"+this.tweet+"</p>"+
                      // "<div class='feed-post-controllers'><span class='reply'><i></i>"+this.replies+" respostas</span></div>"+
                    "</div>"+
                  "</div>";
        $(modal).append(content);
      })
    }
  });
}
loadfeed(id_club,method,page);
  /*
  <div class='feed-post'>
    <div class='feed-post-logo'></div>
    <div class='feed-post-content'>
      <div class='feed-post-content-controllers'></div>
      <h4><a href=''>E.C Grêmio Universidad</a> <span>2h</span></h4>
      <p>
        At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
      </p>
      <div class='feed-post-controllers'><span class='like'><i></i>10 likes</span> <span class='reply'><i></i>10 replies</span></div>
    </div>
  </div>
  */

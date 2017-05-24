cachespan = '';
function loadfeed(id_club,method,page){
  $.ajax({
    url : url+'feed/'+id_club+'/'+method+'/'+'/'+page,
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
      var spandelete = (this.id_club == id_club) ? "<span class='trash'><i></i>Excluir</span>" : '';
      content = "<div class='feed-post' id_tweet='"+this.id_tweet+"'>"+
                  "<div class='feed-post-logo'><img src='"+url+"assets/img/club_pics/"+this.logo+"' width='85px'></div>"+
                  "<div class='feed-post-content'>"+
                    "<h4><a href='"+url+"club/"+this.id_club+"'>"+this.clubname+"</a> <span>"+this.tweetdate+"</span></h4>"+
                    "<p>"+this.tweet+"</p>"+
                    "<div class='feed-post-controllers'><span class='reply'><i></i>"+this.replies+" respostas</span>"+spandelete+"</div>"
                  "</div>"+
                "</div>";
      $(target).append(content);
    })
    $('.reply').on('click',function(){
      opentweet(this);
    });
    $( ".feed-post-controllers span.trash").unbind( "click" );
    $('.feed-post-controllers span.trash').on('click',function(){
      deletetweet(this);
    });
  }else{
    $(target).append("<p>Nada encontrado :(</p>");
  }
}
function feedcontent(content){
  var keys = ['feed_idclub','feed_match','feed_transfer'];
}
function opentweet(span){
  cachespan = span;
  var post = $(span).parent().parent().parent();
  var id_tweet = $(post).attr('id_tweet');
  var modal = $('.feed-replies');
  $(modal).html("<p>Carregando...</p>");
  $('#modal_feed').trigger('click');
  //load tweet
  $.ajax({
    url : url+'helpers/ajax/tweet.php?id_tweet='+id_tweet+'&method=get',
    dataType: 'json',
    success : function(feed){
      $(feed.data.tweet).each(function(){
        console.log(feed.data);
        var content = "";
        content = "<div class='feed-post father' id_tweet='"+this.id_tweet+"'>"+
                "<div class='feed-post-logo'><img src='"+url+"assets/img/club_pics/"+this.logo+"' width='85px'></div>"+
                    "<div class='feed-post-content'>"+
                      "<h4><a href='"+url+"club/"+this.id_club+"'>"+this.clubname+"</a> <span>"+this.tweetdate+"</span></h4>"+
                      "<p>"+this.tweet+"</p>"+
                    "</div>"+
                  "</div>"+
                  "<div class='box-content create-content'>"+
                    "<form action='javascript:reply()'>"+
                      "<textarea name='reply' placeholder='Responder tweet'></textarea>"+
                      "<input type='hidden' name='reply_to' value='"+this.id_tweet+"'>"+
                      "<button class='btn btn-medium btn-light'>Responder</button>"+
                    "</form>"+
                  "</div>";
        $(modal).html('');
        $(modal).append(content);
      });
      console.log(feed.data);
      $(feed.data.replies).each(function(){
        var content = "";
        var spandelete = (this.id_club == id_club) ? "<span class='trash'><i></i>Excluir</span>" : '';
        content = "<div class='feed-post' id_tweet='"+this.id_tweet+"'>"+
              "<div class='feed-post-logo'><img src='"+url+"assets/img/club_pics/"+this.logo+"' width='85px'></div>"+
                    "<div class='feed-post-content'>"+
                      "<h4><a href='"+url+"club/"+this.id_club+"'>"+this.clubname+"</a> <span class='delete'>"+this.tweetdate+"</span></h4>"+
                      "<p>"+this.tweet+"</p>"+
                      "<div class='feed-post-controllers'>"+spandelete+"</div>"+
                    "</div>"+
                  "</div>";
        $(modal).append(content);
      })
      $( ".feed-post-controllers span.trash").unbind( "click" );
      $('.feed-post-controllers span.trash').on('click',function(){
        deletetweet(this);
      });
    }
  });
}
function deletetweet(span){
  if(confirm('Você realmente deseja excluir o tweet?')){
    var post = $(span).parent().parent().parent();
    var id_tweet = $(post).attr('id_tweet');
    $.ajax({
      url : url+'helpers/ajax/tweet.php?id_tweet='+id_tweet+'&method=delete',
      dataType: 'json',
      success : function(feed){
        if(typeof feed.data != undefined){
          notification('Tweet deletado com successo','success','success');
          $(post).remove();
        }else{
          notification('Houve um erro ao deletar tweet','error','error');
        }
      }
    });
  }
}
function sendtweet(tweet,reply_to=null){
  $.ajax({
    url : url+'helpers/ajax/tweet.php?method=post',
    dataType: 'json',
    method: 'post',
    data : {reply_to:reply_to,tweet:tweet},
    success : function(feed){
      if(typeof feed.data != undefined){
        loadfeed(id_club,method,page);
        $('textarea').val(function() {
            return this.defaultValue;
        });
        notification('Publicado com sucesso!','success','success');
        if(reply_to!=''){
          $('#modal_feed').trigger('click');
          opentweet(cachespan);
        }
      }else{
        notification('Houve um erro ao fazer tweet','error','error');
      }
    },
    error: function(feed){
      console.log(feed);
    }
  });
}
function compose(){
  var tweet = $('textarea[name="compose"]').val();
  if(tweet=='') notification('Escreva alguma coisa...','error','error');
  else sendtweet(tweet);
}

function reply(){
  var tweet     = $('textarea[name="reply"]').val();
  var reply_to  = $('input[name="reply_to"]').val();
  if(tweet=='') notification('Escreva alguma coisa...','error','error');
  else sendtweet(tweet,reply_to);

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

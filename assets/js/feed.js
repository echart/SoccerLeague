function loadfeed(id_club,method,page){
  $.ajax({
    url : 'http://localhost/feed/'+id_club+'/'+method+'/'+'/'+page,
    dataType: 'json',
    success : function(feed){
      makefeed(feed.data)
    }
  });
}

loadfeed(1,'all',1);


function makefeed(feed){
  var target = $('.feed-content');
  $(target).html('');
  console.log(feed);
  if(feed.tweets.length>0){
    $(feed.tweets).each(function(){
      var content = "";
      content = "<div class='feed-post'>"+
                  "<div class='feed-post-logo'></div>"+
                  "<div class='feed-post-content'>"+
                    "<h4><a href=''>"+this.clubname+"</a> <span>"+this.tweetdate+"</span></h4>"+
                    "<p>"+this.tweet+"</p>"+
                    "<div class='feed-post-controllers'><span class='reply'><i></i>"+this.replies+" replies</span></div>"
                  "</div>"+
                "</div>"
      $(target).append(content);
    })
  }else{
    $(target).append("<p>Nada encontrado :(</p>");
  }
}
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

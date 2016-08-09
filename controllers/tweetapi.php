<?
$this->data['tree']=__rootpath($_SERVER['REDIRECT_URL']);

/*
Tweets controller base on this rewrites
RewriteRule ^tweet/action/id/$ handler.php?request=tweet&id=$1[NC,L]
*/
if(isset($this->request['tweet'])){
  switch ($this->request['method']) {
    case 'compose':
      /*
        when you need to compose a new tweet
      */
    break;
    case 'delete':
      JsonOutput::jsonHeader();
      // TODO: verificar se o tweed é do clube
      if(Tweet::__deletetweet($this->request['id'])==true){
        JsonOutput::success(array('success'=>'deleted'));
      }else{
        JsonOutput::error('error',"can't delete this tweed");
      }
      /*
        when you need to delete a tweet
      */
    break;
    case 'reply':
      /*
        is like compose, but not.
        make a new tweet, with reply event.
      */
      exit;
    break;
    case 'like':
      JsonOutput::jsonHeader();
      if(Tweet::liked($_SESSION['SL_club'],$this->request['id'])){
        Tweet::__deslike($this->request['id'],$_SESSION['SL_club']);
        echo JsonOutput::success(array('action'=>'deslike'));
      }else{
        Tweet::__like($this->request['id'],$_SESSION['SL_club']);
        echo JsonOutput::success(array('action'=>'like'));
      }
      exit;
      /*
        when you like a tweet
        need to get tweet id, sum+1 in tweets like and added you clubid at likesTweetts table in database
      */
    break;
    case 'retweet':

    break;
    case 'get':
      JsonOutput::jsonHeader();
      $tweet=Tweet::__gettweet($this->request['id']);
      $tweetContent=Tweet::__gettweetcontent($this->request['id']);
      $this->data['id_tweet']=$tweet['id_tweet'];
      $this->data['id_club']=$tweet['id_club'];
      $club=ClubInfo::get($tweet['id_club']);
      if(!isset($club['logo']) or $club['logo']=='null'){
        $this->data['club_logo']='default.png';
      }else{
        $this->data['club_logo']=$club['logo'];
      }
      $this->data['clubname']=Club::getClubNameById($tweet['id_club']);
      $this->data['tweetdate']=$tweet['tweetdate'];
      $this->data['retweet']=$tweet['retweet'];
      if($tweet['retweet']!='' and $tweet['retweet']!=null and $tweet['retweet']!='null'){
        $rt=Tweet::__gettweet($tweet['retweet']);
        $this->data['retweeted_clubid']=$rt['id_club'];
        $this->data['retweeted_club']=Club::getClubNameById($rt['id_club']);
      }
      $this->data['reply_to']=$tweet['reply_to'];
      $this->data['type']=$tweetContent['type'];
      $this->data['tweet']=$tweetContent['tweet'];
      $this->data['likes']=$tweetContent['likes'];
      $this->data['tags']=$tweetContent['tags'];
      echo JsonOutput::success($this->data);
      exit;
      /*
        return a tweet with theyr replys and all the info.
      */
    break;
  }
}else{
  switch ($this->request['method']) {
    case 'all':
        $page=$this->request['page']-1;

        if($this->request['id']!=$_SESSION['SL_club']){
          echo JsonOutput::error('error','This is not your club');
        }else{
          $feed = new Feed($this->request['id']);
          $feed->__getLastTweets(50,$page);
          foreach ($feed->tweet as $key => $id_tweet) {
            $tweet=Tweet::__gettweet($id_tweet);
            $tweetContent=Tweet::__gettweetcontent($id_tweet);
            $this->data['tweets']['clubname']=Club::getClubNameById($tweet['id_club']);
            $club=ClubInfo::get($tweet['id_club']);
            if(!isset($club['logo']) or $club['logo']=='null'){
              $this->data['tweets']['club_logo']='default.png';
            }else{
              $this->data['tweets']['club_logo']=$club['logo'];
            }

            if($tweet['retweet']!='' and $tweet['retweet']!=null and $tweet['retweet']!='null'){
              $rt=Tweet::__gettweet($tweet['retweet']);
              $this->data['tweets']['retweeted_clubid']=$rt['id_club'];
              $this->data['tweets']['retweeted_club']="<span class='action'>retweetd </span>" . Club::getClubNameById($rt['id_club']);
              $t=Tweet::__gettweetcontent($tweet['retweet']);
              $this->data['tweets']['content']=$t['tweet'];
              if($tweet['id_club']==$_SESSION['SL_club']){
                $rtclass='retweet2';
              }else{
                $rtclass='retweet';
              }
            }else{
              $this->data['tweets']['content']=$tweetContent['tweet'];
              $this->data['tweets']['retweeted_clubid']='';
              $this->data['tweets']['retweeted_club']='';
              $rtclass='retweet';
            }

            if(Tweet::liked($tweet['id_club'],$tweet['id_tweet'])){
              $likeclass='like2';
            }else{
              $likeclass='like';
            }

            $datatime1 = new DateTime($tweet['tweetdate']);
            $datatime2 = new DateTime(date('Y/m/d H:i:s'));

            $data1  = $datatime1->format('Y-m-d H:i:s');
            $data2  = $datatime2->format('Y-m-d H:i:s');

            $diff = $datatime1->diff($datatime2);
            $horas = $diff->h + ($diff->days * 24);
            ?>
            <div class='tweet'>
              <div class='tweet-content'>
                <div class='club-logo'><img src='<?=$this->data['tree']?>assets/img/logos/<?=$this->data['tweets']['club_logo']?>' width='75px' height='75px'></div>
                <div class='tweet2'>
                  <div class='tweet-info'><?=$this->data['tweets']['clubname']?>  <?=$this->data['tweets']['retweeted_club']?> - <span class='date'><?=$horas?>h</span> </div>
                  <div class='tweet-text'><?=$this->data['tweets']['content']?></div>
                </div>
              </div>
              <div class='tweet-options'>
                <button type='button' class='btn-tweet btn no-bg no-hover black-text'> <span class='reply'></span></button>
                <button onclick="tweetaction(<?=$tweet['id_tweet']?>,'like')" type='button' class='btn-tweet btn no-bg no-hover black-text'> <?=Tweet::__countLikes($id_tweet);?> <span class='<?=$likeclass?>'></span></button>
                <button type='button' class='btn-tweet btn no-bg no-hover black-text'> <?=Tweet::__countRetweets($id_tweet);?> <span class='<?=$rtclass?>'></span></button>
                <?if($this->data['tweets']['retweeted_club']='' AND $this->data['id_club']==$_SESSION['SL_club']){?><button type='button' class='btn-tweet btn no-bg no-hover black-text'> <span class='delete'></span></button><?}?>
              </div>
            </div>
            <?
          }

        }
        exit;
      break;

    case 'user':
      $page=$this->request['page']-1;

    break;
  }
}

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
      $type = $_POST['type'] ?? 'C';
      $tweet = $_POST['tweet'];
      $reply_to=$_POST['reply_to'] ?? NULL;
      $tags='{}';
      // $tags=Tweet::extractTAG($tweet);
      if($tweet!=''){
        if(Tweet::__tweet($_SESSION['SL_club'],$type,$tweet,$tags,$reply_to)==true){
          echo JsonOutput::success(array('success'=>'composed'));
        }else{
          echo JsonOutput::error('error',"can't compose a tweet");
        }
      }else{
        echo JsonOutput::error('error',"can't compose a tweet");
      }
      exit;
    break;
    case 'delete':
      /*
      when you need to delete a tweet
      */
      JsonOutput::jsonHeader();
      if(Tweet::tweetIsMine($this->request['id'])){
        if(Tweet::__deletetweet($this->request['id'])==true){
          echo JsonOutput::success(array('success'=>'deleted'));
        }else{
          echo JsonOutput::error('error',"can't delete this tweet");
        }
      }else{
        echo JsonOutput::error('error',"can't delete this tweet");
      }
      exit;
    break;
    break;
    case 'like':
      /*
      when you like a tweet
      */
      JsonOutput::jsonHeader();
      if(Tweet::liked($_SESSION['SL_club'],$this->request['id'])){
        Tweet::__deslike($this->request['id'],$_SESSION['SL_club']);
        echo JsonOutput::success(array('action'=>'deslike'));
      }else{
        Tweet::__like($this->request['id'],$_SESSION['SL_club']);
        echo JsonOutput::success(array('action'=>'like'));
      }
      exit;
    break;
    case 'retweet':
      /*
      when you retweet or "desretweet" a tweet :B
      */
      JsonOutput::jsonHeader();
      $id=$this->request['id'];
      if(Tweet::tweetIsMine($this->request['id'])==true or Tweet::retweeted($this->request['id'])==true){
        if(Tweet::tweetIsMine($this->request['id'])==true){
          if(Tweet::__unretweet($this->request['id'],$_SESSION['SL_club'])==true){
            echo JsonOutput::success(array('success'=>'deleted'));
          }else{
            echo JsonOutput::error('error',"can't unretweet this tweet");
          }
        }else{
          $id=Tweet::retweetGetId($this->request['id']);
          if(Tweet::__unretweet($id,$_SESSION['SL_club'])==true){
            echo JsonOutput::success(array('success'=>'deleted'));
          }else{
            echo JsonOutput::error('error',"can't unretweet this tweet");
          }
        }
      }else{
        if(Tweet::__retweet($this->request['id'],$_SESSION['SL_club'])==true){
          echo JsonOutput::success(array('success'=>'retweeted'));
        }else{
          echo JsonOutput::error('error',"can't retweet this tweet");
        }
      }
      exit;
    break;
    case 'get':
      /*
      return a tweet with theyr replys and all the info.
      */
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
              if(Tweet::retweeted($rt['id_tweet'])){
                $rtclass='retweet2';
              }else{
                $rtclass='retweet';
              }
            }else{
              $this->data['tweets']['content']=$tweetContent['tweet'];
              $this->data['tweets']['retweeted_clubid']='';
              $this->data['tweets']['retweeted_club']='';
              if(Tweet::retweeted($tweet['id_tweet'])){
                $rtclass='retweet2';
              }else{
                $rtclass='retweet';
              }
            }

            if(Tweet::liked($_SESSION['SL_club'],$tweet['id_tweet'])){
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
            <div class='tweet'  tweetid='<?=$id_tweet?>' retweetid='<?=$tweet['retweet']?>'>
              <div class='tweet-content'>
                <div class='club-logo'><img src='<?=$this->data['tree']?>assets/img/logos/<?=$this->data['tweets']['club_logo']?>' width='75px' height='75px'></div>
                <div class='tweet2'>
                  <div class='tweet-info'><?=$this->data['tweets']['clubname']?>  <?=$this->data['tweets']['retweeted_club']?> - <span class='date'><?=$horas?>h</span> </div>
                  <div class='tweet-text'><?=$this->data['tweets']['content']?></div>
                </div>
              </div>
              <div class='tweet-options'>
                <button type='button' class='btn-tweet btn no-bg no-hover black-text'> <span class='reply'></span></button>
                <button onclick="tweetaction(<?=$tweet['id_tweet']?>,'like')" type='button' class='like btn-tweet btn no-bg no-hover black-text'> <i><?=Tweet::__countLikes($id_tweet);?></i> <span class='<?=$likeclass?>'></span></button>
                <?if((Tweet::tweetIsMine($tweet['id_tweet'])==true and $rtclass=='retweet2') or (Tweet::tweetIsMine($tweet['id_tweet'])!=true)){?><button onclick="tweetaction(<?=$tweet['id_tweet']?>,'retweet')" type='button' class='retweet btn-tweet btn no-bg no-hover black-text'> <i><?=Tweet::__countRetweets($id_tweet);?></i> <span class='<?=$rtclass?>'></span></button><?}?>
                <?if(Tweet::tweetIsMine($tweet['id_tweet'])==true and $this->data['tweets']['retweeted_clubid']==''){?><button onclick="deletetweet(<?=$tweet['id_tweet']?>)" type='button' class='btn-tweet btn no-bg no-hover black-text'> <span class='delete'></span></button><?}?>
              </div>
            </div>
            <?
          }
          if(count($feed->tweet)==0){ ?>
            <div class='tweet'>
              <p class='center loading bg-white black-text'>Não há mais nada a carregar.</p>
            </div>
          <?
          }else{
          ?>

          <div class='tweet' onclick="loadtweets()">
            <p class='center loading bg-white black-text'>Carregar mais</p>
          </div>

          <?
          }
        }
        exit;
      break;

    case 'user':
    $page=$this->request['page']-1;

    $feed = new Feed($this->request['id']);
    $feed->__getLastTweetsByClub(20,$page);
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
        if(Tweet::retweeted($rt['id_tweet'])){
          $rtclass='retweet2';
        }else{
          $rtclass='retweet';
        }
      }else{
        $this->data['tweets']['content']=$tweetContent['tweet'];
        $this->data['tweets']['retweeted_clubid']='';
        $this->data['tweets']['retweeted_club']='';
        if(Tweet::retweeted($tweet['id_tweet'])){
          $rtclass='retweet2';
        }else{
          $rtclass='retweet';
        }
      }

      if(Tweet::liked($_SESSION['SL_club'],$tweet['id_tweet'])){
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
      <div class='tweet'  tweetid='<?=$id_tweet?>' retweetid='<?=$tweet['retweet']?>'>
        <div class='tweet-content'>
          <div class='club-logo'><img src='<?=$this->data['tree']?>assets/img/logos/<?=$this->data['tweets']['club_logo']?>' width='75px' height='75px'></div>
          <div class='tweet2'>
            <div class='tweet-info'><?=$this->data['tweets']['clubname']?>  <?=$this->data['tweets']['retweeted_club']?> - <span class='date'><?=$horas?>h</span> </div>
            <div class='tweet-text'><?=$this->data['tweets']['content']?></div>
          </div>
        </div>
        <div class='tweet-options'>
          <button type='button' class='btn-tweet btn no-bg no-hover black-text'> <span class='reply'></span></button>
          <button onclick="tweetaction(<?=$tweet['id_tweet']?>,'like')" type='button' class='like btn-tweet btn no-bg no-hover black-text'> <i><?=Tweet::__countLikes($id_tweet);?></i> <span class='<?=$likeclass?>'></span></button>
          <?if((Tweet::tweetIsMine($tweet['id_tweet'])==true and $rtclass=='retweet2') or (Tweet::tweetIsMine($tweet['id_tweet'])!=true)){?><button onclick="tweetaction(<?=$tweet['id_tweet']?>,'retweet')" type='button' class='retweet btn-tweet btn no-bg no-hover black-text'> <i><?=Tweet::__countRetweets($id_tweet);?></i> <span class='<?=$rtclass?>'></span></button><?}?>
          <?if(Tweet::tweetIsMine($tweet['id_tweet'])==true and $this->data['tweets']['retweeted_clubid']==''){?><button onclick="deletetweet(<?=$tweet['id_tweet']?>)" type='button' class='btn-tweet btn no-bg no-hover black-text'> <span class='delete'></span></button><?}?>
        </div>
      </div>
      <?
    }
    if(count($feed->tweet)==0){ ?>
      <div class='tweet'>
        <p class='center loading bg-white black-text'>Não há mais nada a carregar.</p>
      </div>
    <?
    }else{
    ?>

    <div class='tweet' onclick="loadtweets()">
      <p class='center loading bg-white black-text'>Carregar mais</p>
    </div>

    <?
    }
    exit;

    break;
  }
}

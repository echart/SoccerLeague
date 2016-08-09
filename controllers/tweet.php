<?
JsonOutput::jsonHeader();
if(isset($this->request['compose'])){

}else{
  if(isset($this->request['type'])){
    $id_club=$this->request['id'];
    switch ($this->request['method']) {
      case 'all':
        if($id_club!=$_SESSION['SL_club']){
          echo JsonOutput::error('error','This is not your club');
        }else{
          $feed = new Feed($this->request['id']);
          $feed->__getLastTweets(50);
          $i=0;
          foreach ($feed->tweet as $key => $id_tweet) {
            $tweet=Tweet::__gettweet($id_tweet);
            $tweetContent=Tweet::__gettweetcontent($id_tweet);
            $this->data['tweets'][$i]['id_tweet']=$tweet['id_tweet'];
            $this->data['tweets'][$i]['id_club']=$tweet['id_club'];
            $club=ClubInfo::get($tweet['id_club']);
            $this->data['tweets'][$i]['clubname']=Club::getClubNameById($tweet['id_club']);
            if(!isset($club['logo']) or $club['logo']=='null'){
              $this->data['tweets'][$i]['club_logo']='default.png';
            }else{
              $this->data['tweets'][$i]['club_logo']=$club['logo'];
            }
            $this->data['tweets'][$i]['tweetdate']=$tweet['tweetdate'];
            $this->data['tweets'][$i]['retweet']=$tweet['retweet'];
            if($tweet['retweet']!='' and $tweet['retweet']!=null and $tweet['retweet']!='null'){
              $rt=Tweet::__gettweet($tweet['retweet']);
              $this->data['tweets'][$i]['retweeted_clubid']=$rt['id_club'];
              $this->data['tweets'][$i]['retweeted_club']=Club::getClubNameById($rt['id_club']);
              $t=Tweet::__gettweetcontent($tweet['retweet']);
              $this->data['tweets'][$i]['retweet_content']=$t['tweet'];
            }
            $this->data['tweets'][$i]['reply_to']=$tweet['reply_to'];
            $this->data['tweets'][$i]['type']=$tweetContent['type'];
            $this->data['tweets'][$i]['tweet']=$tweetContent['tweet'];
            $this->data['tweets'][$i]['likes']=$tweetContent['likes'];
            $this->data['tweets'][$i]['tags']=$tweetContent['tags'];
            $i++;
          }
          echo JsonOutput::success($this->data);
        }
        break;

      case 'user':
        $feed = new Feed($this->request['id']);
        $feed->__getLastTweetsByClub(50);
        $i=0;
        foreach ($feed->tweet as $key => $id_tweet) {
          $tweet=Tweet::__gettweet($id_tweet);
          $tweetContent=Tweet::__gettweetcontent($id_tweet);
          $this->data['tweets'][$i]['id_tweet']=$tweet['id_tweet'];
          $this->data['tweets'][$i]['id_club']=$tweet['id_club'];
          $club=ClubInfo::get($tweet['id_club']);
          if(!isset($club['logo']) or $club['logo']=='null'){
            $this->data['tweets'][$i]['club_logo']='default.png';
          }else{
            $this->data['tweets'][$i]['club_logo']=$club['logo'];
          }
          $this->data['tweets'][$i]['clubname']=Club::getClubNameById($tweet['id_club']);
          $this->data['tweets'][$i]['tweetdate']=$tweet['tweetdate'];
          $this->data['tweets'][$i]['retweet']=$tweet['retweet'];
          if($tweet['retweet']!='' and $tweet['retweet']!=null and $tweet['retweet']!='null'){
            $rt=Tweet::__gettweet($tweet['retweet']);
            $this->data['tweet'][$i]['retweeted_clubid']=$rt['id_club'];
            $this->data['tweet'][$i]['retweeted_club']=Club::getClubNameById($rt['id_club']);
          }
          $this->data['tweets'][$i]['reply_to']=$tweet['reply_to'];
          $this->data['tweets'][$i]['type']=$tweetContent['type'];
          $this->data['tweets'][$i]['tweet']=$tweetContent['tweet'];
          $this->data['tweets'][$i]['likes']=$tweetContent['likes'];
          $this->data['tweets'][$i]['tags']=$tweetContent['tags'];
          $i++;
        }
        echo JsonOutput::success($this->data);
        break;
    }
  }else{
    $i=0;
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
  }
}
exit;

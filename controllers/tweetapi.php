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
    $this->data[$i]['id_tweet']=$tweet['id_tweet'];
    $this->data[$i]['id_club']=$tweet['id_club'];
    $club=ClubInfo::get($tweet['id_club']);
    if(!isset($club['logo']) or $club['logo']=='null'){
      $this->data['tweets'][$i]['club_logo']='default.png';
    }else{
      $this->data['tweets'][$i]['club_logo']=$club['logo'];
    }
    $this->data['tweets'][$i]['clubname']=Club::getClubNameById($tweet['id_club']);
    $this->data[$i]['tweetdate']=$tweet['tweetdate'];
    $this->data[$i]['retweet']=$tweet['retweet'];
    $this->data[$i]['reply_to']=$tweet['reply_to'];
    $this->data[$i]['type']=$tweetContent['type'];
    $this->data[$i]['tweet']=$tweetContent['tweet'];
    $this->data[$i]['likes']=$tweetContent['likes'];
    $this->data[$i]['tags']=$tweetContent['tags'];
    echo JsonOutput::success($this->data);
  }
}
exit;

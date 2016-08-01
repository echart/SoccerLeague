<?
JsonOutput::jsonHeader();

if((isset($this->request['id'])) AND (isset($this->request['id2'])) AND (isset($this->request['action']))){
  $action=$this->request['action'];
  $buddy1=$this->request['id'];
  $buddy2=$this->request['id2'];

  if($buddy1!=$_SESSION['SL_club'] AND $buddy2!=$_SESSION['SL_club']){
    echo JsonOutput::error('0','oh, this is not your club');
    exit;
  }

  switch($action){
    case 'request':
      if(Buddy::makeBuddy($buddy1,$buddy2)==true){
        echo JsonOutput::success(array('success'=>'you send a friend request'));
      }else{
        echo JsonOutput::error('0','error to send your friend a request');
      }
      break;
    case 'aproval':
      if(Buddy::aprovalBuddy($buddy1,$buddy2)==true){
        echo JsonOutput::success(array('success'=>'you make a new friend'));
      }else{
        echo JsonOutput::error('0','error to send your friend a request');
      }
      break;
    case 'unbuddy':
      if(Buddy::unbuddy($buddy1,$buddy2)==true){
        echo JsonOutput::success(array('success'=>"oh, you lose a friend :("));
      }else{
        echo JsonOutput::error('0','error to send your friend a request');
      }
      break;
    case 'unMakeBuddy':
      if(Buddy::unMakeBuddy($buddy1,$buddy2)==true){
        echo JsonOutput::success(array('success'=>"done"));
      }else{
        echo JsonOutput::error('0','error to send your friend a request');
      }
      break;
    default:
      echo JsonOutput::error('404','action not found');
      break;
  }
}else{
  echo JsonOutput::error('0','error while processing your request');
}


exit;

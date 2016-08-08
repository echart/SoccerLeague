<?
/*
Tweets controller base on this rewrites
RewriteRule ^tweet/action/id/$ handler.php?request=tweet&id=$1[NC,L]
*/
if($this->request['tweets']){
  switch ($this->request['method']) {
    case 'compose':
      /*
        when you need to compose a new tweet
      */
    break;
    case 'delete':
      /*
        when you need to delete a tweet
      */
    break;
    case 'reply':
      /*
        is like compose, but not.
        make a new tweet, with reply event.
      */
    break;
    case 'like':
      /*
        when you like a tweet
        need to get tweet id, sum+1 in tweets like and added you clubid at likesTweetts table in database
      */
    break;
    case 'retweet':

    break;
    case 'get':
      /*
        return a tweet with theyr replys and all the info.
      */
    break;
  }
}

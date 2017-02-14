<?
class App{
  public static function redirect($from='', $to='index'){
    if($from != $to){
      header('Location: '. App::url().$to); //if not, go to frontpage
    }
    $request=array('request'=>$to);
    return $request;
  }
  public static function display_errors($flag=true){
    if($flag==true) $e=1; else $e=0;
    ini_set('display_errors',$e);
    error_reporting($e);
  }
  public static function url(){
    $_config=parse_ini_file('_config.ini');
    return $_config['url'];
  }
}

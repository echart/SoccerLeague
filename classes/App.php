<?

class App{
  public $url = 'http:://localhost:8080/'; //app url ending with a bar

  public static function redirect($from, $to='index'){
    if($from != $to){
      header('location:'. App::$url.$to); //if not, go to frontpage
    }
    $request=array('request'=>$to);
    return $request;
  }

  public static function display_errors($flag=true){
    if($flag==true) $e=1; else $e=0;
    ini_set('display_errors',$e);
    error_reporting($e);
  }
}

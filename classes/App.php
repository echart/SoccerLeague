<?

class App{
  public static function redirect($redirect='index'){
    $request['request']=$redirect;
  }

  public static function display_errors($flag=true){
    if($flag==true) $e=1; else $e=0;
    ini_set('display_errors',$e);
    error_reporting($e);
  }
}

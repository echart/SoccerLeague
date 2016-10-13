<?

class App{
  public static function redirect($redirect='index'){
    header('location: index');
    // return $request;
  }

  public static function display_errors($flag=true){
    if($flag==true) $e=1; else $e=0;
    ini_set('display_errors',$e);
    error_reporting($e);
  }
}

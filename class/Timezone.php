<?

class Timezone{

  public static function setTimezone($timezone){
    $timestamp = time();
    if($timezone=='GM'){
      return gmdate('H,i,s', $timestamp);
    }else{
      date_default_timezone_set($timezone);
      return date("H,i,s");
    }
  }
  public static function getTimezones(){
    $query=Connection::getInstance()->connect()->prepare("SELECT id_timezone,timezone FROM timezones");
    $query->execute();
    $timezones=array();
    while ($data=$query->fetch(PDO::FETCH_ASSOC)){
      if($data['timezone']=='GM'){
        $data['timezone']='Greenwich Mean Time';
      }
      $data['timezone']=str_replace('_',' ',$data['timezone']);
      $timezones[]=$data;
    }
    return $timezones;
  }
  public static function getTimezone($id_timezone){
    $query=Connection::getInstance()->connect()->prepare("SELECT id_timezone,timezone FROM timezones where id_timezone=:id_timezone");
    $query->bindParam(':id_timezone',$id_timezone);
    $query->execute();
    $data=$query->fetch(PDO::FETCH_ASSOC);
    return $data['timezone'];
  }
}

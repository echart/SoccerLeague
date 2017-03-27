<?

function getCountryID($country){
  $country=strtolower($country);
  $query=Connection::getInstance()->connect()->prepare("SELECT id_country FROM countries where abbreviation=:country");
  $query->bindParam(':country',$country);
  $query->execute();
  if($query->rowCount()>0){
    $query->setFetchMode(PDO::FETCH_OBJ);
    $data=$query->fetch();
    return $data->id_country;
  }else{
    return 0;
  }
}
function getCountryByID($country){
  $query=Connection::getInstance()->connect()->prepare("SELECT abbreviation, country FROM countries where id_country=:country");
  $query->bindParam(':country',$country);
  $query->execute();
  $data=$query->fetch(PDO::FETCH_ASSOC);
  return $data;
}

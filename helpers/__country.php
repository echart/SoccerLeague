<?

function getCountryID($country){
  $country=strtolower($country);
  $query=Connection::getInstance()->connect()->prepare("SELECT id_country FROM country where abbreviation=:country");
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

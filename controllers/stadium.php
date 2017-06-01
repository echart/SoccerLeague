<?
$this->menu  = "club";
$this->submenu = 'stadium';
$this->tree = __rootpath($_SERVER['REDIRECT_URL']);
$this->id_club = $this->get['id'] ?? $_SESSION['SL_club'];

$stadium = new ClubStadium(new Club($this->id_club));

$this->title = $stadium->name();
$this->capacity = $stadium->capacity();

$this->facilities = new ClubFacilities(new Club($this->id_club));
$this->facilities->__load();

if(isset($this->post['action'])){
  if($this->post['action']=='capacity'){
    $construction = ($this->capacity - $this->post['new_capacity'])*250;
    $stadium->construction($this->post['new_capacity']);
    JsonOutput::jsonHeader();
    echo JsonOutput::success(array('success'));
  }
  if($this->post['action']=='upgrade'){
    $x = +1;
  }else{
    $x = -1;
  }
  $finance = new ClubFinances(new Club($this->id_club));
  switch ($this->post['facilitie']) {
    case 'draining':
      $z = $this->facilities->draining + $x;
      $value = 100000;
      // $this->facilities->__update('draining',$this->facilities->draining);
      $finance->addConstruction($value);
      $query = Connection::getInstance()->connect()->prepare("UPDATE club_stadium SET draining=:f_value where id_club=:id_club");
      $query->bindParam(':id_club',$this->id_club);
      $query->bindParam(':f_value',$z);
      $query->execute();
      JsonOutput::jsonHeader();
      echo JsonOutput::success(array('success'));
      break;
      case 'cover':
        $z = $this->facilities->cover + $x;
        $value = 75000;
        // $this->facilities->__update('draining',$this->facilities->draining);
        $finance->addConstruction($value);
        $query = Connection::getInstance()->connect()->prepare("UPDATE club_stadium SET pitchcover=:f_value where id_club=:id_club");
        $query->bindParam(':id_club',$this->id_club);
        $query->bindParam(':f_value',$z);
        $query->execute();
        JsonOutput::jsonHeader();
        echo JsonOutput::success(array('success'));
        break;
      case 'lights':
        $z = $this->facilities->lights + $x;
        $value = 2000000;
        // $this->facilities->__update('draining',$this->facilities->draining);
        $finance->addConstruction($value);
        $query = Connection::getInstance()->connect()->prepare("UPDATE club_stadium SET floodlights=:f_value where id_club=:id_club");
        $query->bindParam(':id_club',$this->id_club);
        $query->bindParam(':f_value',$z);
        $query->execute();
        JsonOutput::jsonHeader();
        echo JsonOutput::success(array('success'));
        break;
      case 'sprinklers':
        $z = $this->facilities->sprinklers + $x;
        $value = 100000;
        // $this->facilities->__update('draining',$this->facilities->draining);
        $finance->addConstruction($value);
        $query = Connection::getInstance()->connect()->prepare("UPDATE club_stadium SET sprinklers=:f_value where id_club=:id_club");
        $query->bindParam(':id_club',$this->id_club);
        $query->bindParam(':f_value',$z);
        $query->execute();
        JsonOutput::jsonHeader();
        echo JsonOutput::success(array('success'));
        break;
      case 'heating':
        $z = $this->facilities->heating + $x;
        $value = 100000;
        // $this->facilities->__update('draining',$this->facilities->draining);
        $finance->addConstruction($value);
        $query = Connection::getInstance()->connect()->prepare("UPDATE club_stadium SET heating=:f_value where id_club=:id_club");
        $query->bindParam(':id_club',$this->id_club);
        $query->bindParam(':f_value',$z);
        $query->execute();
        JsonOutput::jsonHeader();
        echo JsonOutput::success(array('success'));
        break;
      case 'tg':
          $z = $this->facilities->tg + $x;
          $value = 8000000;
          // $this->facilities->__update('draining',$this->facilities->draining);
          $finance->addConstruction($value);
          $query = Connection::getInstance()->connect()->prepare("UPDATE club_facilities SET traininggrounds=:f_value where id_club=:id_club");
          $query->bindParam(':id_club',$this->id_club);
          $query->bindParam(':f_value',$z);
          $query->execute();
          JsonOutput::jsonHeader();
          echo JsonOutput::success(array('success'));
        break;
        case 'yd':
            $z = $this->facilities->yd + $x;
            $value = 8000000;
            // $this->facilities->__update('draining',$this->facilities->draining);
            $finance->addConstruction($value);
            $query = Connection::getInstance()->connect()->prepare("UPDATE club_facilities SET youthacademy=:f_value where id_club=:id_club");
            $query->bindParam(':id_club',$this->id_club);
            $query->bindParam(':f_value',$z);
            $query->execute();
            JsonOutput::jsonHeader();
            echo JsonOutput::success(array('success'));
          break;
          case 'medical':
              $z = $this->facilities->medical + $x;
              $value = 525000*$z;
              // $this->facilities->__update('draining',$this->facilities->draining);
              $finance->addConstruction($value);
              $query = Connection::getInstance()->connect()->prepare("UPDATE club_facilities SET medicalcenter=:f_value where id_club=:id_club");
              $query->bindParam(':id_club',$this->id_club);
              $query->bindParam(':f_value',$z);
              $query->execute();
              JsonOutput::jsonHeader();
              echo JsonOutput::success(array('success'));
            break;
            case 'physio':
                $z = $this->facilities->physio + $x;
                $value = 275000*$z;
                // $this->facilities->__update('draining',$this->facilities->draining);
                $finance->addConstruction($value);
                $query = Connection::getInstance()->connect()->prepare("UPDATE club_facilities SET physio=:f_value where id_club=:id_club");
                $query->bindParam(':id_club',$this->id_club);
                $query->bindParam(':f_value',$z);
                $query->execute();
                JsonOutput::jsonHeader();
                echo JsonOutput::success(array('success'));
              break;
              case 'parking':
                  $z = $this->facilities->parking + $x;
                  $value = 325000*$z;
                  // $this->facilities->__update('draining',$this->facilities->draining);
                  $finance->addConstruction($value);
                  $query = Connection::getInstance()->connect()->prepare("UPDATE club_facilities SET parking=:f_value where id_club=:id_club");
                  $query->bindParam(':id_club',$this->id_club);
                  $query->bindParam(':f_value',$z);
                  $query->execute();
                  JsonOutput::jsonHeader();
                  echo JsonOutput::success(array('success'));
                break;
                case 'toilets':
                    $z = $this->facilities->toilets + $x;
                    $value = 325000*$z;
                    // $this->facilities->__update('draining',$this->facilities->draining);
                    $finance->addConstruction($value);
                    $query = Connection::getInstance()->connect()->prepare("UPDATE club_facilities SET toilets=:f_value where id_club=:id_club");
                    $query->bindParam(':id_club',$this->id_club);
                    $query->bindParam(':f_value',$z);
                    $query->execute();
                    JsonOutput::jsonHeader();
                    echo JsonOutput::success(array('success'));
                  break;
    case 'hotdog':
      $z = $this->facilities->hotdog + $x;
      $value = 75000*$z;
      // $this->facilities->__update('draining',$this->facilities->draining);
      $finance->addConstruction($value);
      $query = Connection::getInstance()->connect()->prepare("UPDATE club_facilities SET hotdogs=:f_value where id_club=:id_club");
      $query->bindParam(':id_club',$this->id_club);
      $query->bindParam(':f_value',$z);
      $query->execute();
      JsonOutput::jsonHeader();
      echo JsonOutput::success(array('success'));
    break;
    case 'store':
      $z = $this->facilities->store + $x;
      $value = 125000*$z;
      // $this->facilities->__update('draining',$this->facilities->draining);
      $finance->addConstruction($value);
      $query = Connection::getInstance()->connect()->prepare("UPDATE club_facilities SET merchandisestore=:f_value where id_club=:id_club");
      $query->bindParam(':id_club',$this->id_club);
      $query->bindParam(':f_value',$z);
      $query->execute();
      JsonOutput::jsonHeader();
      echo JsonOutput::success(array('success'));
    break;
    case 'restaurant':
      $z = $this->facilities->restaurant + $x;
      $value = 125000*$z;
      // $this->facilities->__update('draining',$this->facilities->draining);
      $finance->addConstruction($value);
      $query = Connection::getInstance()->connect()->prepare("UPDATE club_facilities SET restaurant=:f_value where id_club=:id_club");
      $query->bindParam(':id_club',$this->id_club);
      $query->bindParam(':f_value',$z);
      $query->execute();
      JsonOutput::jsonHeader();
      echo JsonOutput::success(array('success'));
    break;
    default:
      # code...
      break;
  }
  exit;
}


$this->addCSSFile('stadium.css');
$this->addCSSFile('modal.css');
$this->addJSFile('stadium.js');
$this->addJSFile('mask.js');

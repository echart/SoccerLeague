<?
$this->data['menu']='club';
$this->data['tree']=__rootpath($_SERVER['REDIRECT_URL']);
$club = $this->request['id'] ?? $_SESSION['SL_club'];
/**
 * IF ID ISNT SET IN URL, SET WITH club session.
 */
if(!isset($this->request['id']))
  header('location: http://'.$_SERVER['SERVER_NAME'].'/club/'.$club);

$this->data['title']=Club::getClubNameById($club);
$this->data['clubname']=Club::getClubNameById($club);
/**
 * based on subrequest url to make the order.
 */
if(isset($this->request['subrequest'])){
  if($this->request['subrequest']=='overview'){
    $this->data['menu']='club';
    $this->data['submenu']=1;
    $this->requestURL='club_overview';
    $arrayPlayers=Players::getPlayersByIdClub($this->request['id']);
    $i=0;
    if(count($arrayPlayers)!=0){
      foreach ($arrayPlayers as $key => $id_player) {
        $player = new Player();
        $this->data['overview']['line'][$i]=$player->loadPlayerInfo($id_player);
        $this->data['overview']['line'][$i]['skill_index']=$player->skillIndex();
        $this->data['overview']['line'][$i]['position']=$player->loadPlayerPositions($id_player);
        $i++;
      }
    }
  }else if($this->request['subrequest']=='api'){
    $this->data['api']['name']=Club::getClubNameById($club);
    $info=ClubInfo::get($this->request['id']);
    $this->data['api']['manager']=$info['manager'];
    $this->data['api']['logo']=$info['logo'];
    JsonOutput::jsonHeader();
    echo JsonOutput::success($this->data['api']);
    exit;
  }else if($this->request['subrequest']=='history'){

  }else if($this->request['subrequest']=='friends'){

  }else if($this->request['subrequest']=='matches'){

  }else if($this->request['subrequest']=='statistics'){

  }else if($this->request['subrequest']=='stadium'){
    $this->requestURL='club_stadium';
  }else if($this->request['subrequest']=='edit'){
    $this->addJSfile('uploadLogo.js');
    $this->addJSfile('croppic.min.js');
    $this->addCSSfile('croppic.css');
    $this->addCSSfile('modal.css');
    $this->data['title']='Editar Clube';
    if($_SESSION['SL_club']!=$club){
      echo 'Esse clube não é seu';exit;
    }
    $this->requestURL='editclub';
    $this->data['clubinfo']=ClubInfo::get($club);
    $this->data['clubinfo']['fansname']=ClubFans::getFansName($club);
  }else if($this->request['subrequest']=='save'){

    $id_club=$club;
    extract($_POST);

    // TODO:validations
    ClubInfo::update($id_club,$manager,$nickname,$stadium,$clubcolor,$history);
    header('location: edit/saved');
    exit;
  }else if($this->request['subrequest']=='logosave'){
    $imagePath = "assets/img/logos/temp/";
  	$allowedExts = array("jpeg", "jpg", "png","JPEG", "JPG", "PNG");
  	$temp = explode(".", $_FILES["img"]["name"]);
  	$extension = end($temp);

  	//Check write Access to Directory
  	if(!is_writable($imagePath)){
  		$response = Array(
  			"status" => 'error',
  			"message" => 'Can`t upload File; no write Access'
  		);
  		print json_encode($response);
  		exit;
  	}

  	if ( in_array($extension, $allowedExts))
  	  {
  	  if ($_FILES["img"]["error"] > 0)
  		{
  			 $response = array(
  				"status" => 'error',
  				"message" => 'ERROR Return Code: '. $_FILES["img"]["error"],
  			);
  		}
  	  else
  		{

  	      $filename = $_FILES["img"]["tmp_name"];
  		  list($width, $height) = getimagesize( $filename );
  		  move_uploaded_file($filename,  $imagePath . $_FILES["img"]["name"]);
  		  $response = array(
  			"status" => 'success',
  			"url" => '../../../'.$imagePath.$_FILES["img"]["name"],
  			"width" => $width,
  			"height" => $height
  		  );

  		}
  	  }
  	else
  	  {
  	   $response = array(
  			"status" => 'error',
  			"message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
  		);
  	  }

  	  print json_encode($response);
      exit;
  }else if($this->request['subrequest']=='logotemp'){
    header('Content-Type: image/png');
    $imgUrl = $_POST['imgUrl'];
    $imgUrl=str_replace('../../../','',$imgUrl);
    // original sizes
    $imgInitW = $_POST['imgInitW'];
    $imgInitH = $_POST['imgInitH'];
    // resized sizes
    $imgW = $_POST['imgW'];
    $imgH = $_POST['imgH'];
    // offsets
    $imgY1 = $_POST['imgY1'];
    $imgX1 = $_POST['imgX1'];
    // crop box
    $cropW = $_POST['cropW'];
    $cropH = $_POST['cropH'];
    // rotation angle
    $angle = $_POST['rotation'];
    $jpeg_quality = 100;
    $output_filename = "assets/img/logos/".date('YmdHis');
    // uncomment line below to save the cropped image in the same location as the original image.
    //$output_filename = dirname($imgUrl). "/croppedImg_".rand();
    $what = getimagesize($imgUrl);
    switch(strtolower($what['mime']))
    {
        case 'image/png':
            $img_r = imagecreatefrompng($imgUrl);
    		$source_image = imagecreatefrompng($imgUrl);
    		$type = '.png';
            break;
        case 'image/jpeg':
            $img_r = imagecreatefromjpeg($imgUrl);
    		$source_image = imagecreatefromjpeg($imgUrl);
    		error_log("jpg");
    		$type = '.jpeg';
            break;
        // case 'image/gif':
        //     $img_r = imagecreatefromgif($imgUrl);
    		// $source_image = imagecreatefromgif($imgUrl);
    		// $type = '.gif';
        //     break;
        default: die('image type not supported');
    }
    //Check write Access to Directory
    if(!is_writable(dirname($output_filename))){
    	$response = Array(
    	    "status" => 'error',
    	    "message" => 'Cant write cropped File'
        );
    }else{
      // resize the original image to size of editor
      $resizedImage = imagecreatetruecolor($imgW, $imgH);
    	imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
      // rotate the rezized image
      $rotated_image = $angle == 0 ? $resizedImage : imagerotate($resizedImage, -$angle, 0);
      // find new width & height of rotated image
      $rotated_width = imagesx($rotated_image);
      $rotated_height = imagesy($rotated_image);
      // diff between rotated & original sizes
      $dx = $rotated_width - $imgW;
      $dy = $rotated_height - $imgH;
      // crop rotated image to fit into original rezized rectangle
    	$cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
    	imagecolortransparent($cropped_rotated_image, imagecolorallocatealpha($cropped_rotated_image, 0, 0, 0,127));
    	imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
    	// crop image into selected area
    	$final_image = imagecreatetruecolor($cropW, $cropH);
      imagecolortransparent($final_image, imagecolorallocatealpha($final_image, 0, 0, 0,127));
    	imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
    	// finally output png image
    	imagepng($final_image, $output_filename.$type,0);
    	// imagejpeg($final_image, $output_filename.$type, $jpeg_quality);
      $logo=$output_filename.$type;
      $logo=str_replace('assets/img/logos/','',$logo);
      ClubInfo::updateLogo($club,$logo);
    	$response = Array(
    	    "status" => 'success',
    	    "url" => '../../../'.$output_filename.$type
        );
    }
    print json_encode($response);
    exit;
  }
}else{
  $this->addCSSfile('club.css');
  $this->addJSfile('buddy.js');
  $this->addJSfile('tweetClub.js');
  $this->addCSSfile('tweet.css');
  /**
   * ADD VISIT AT DATABASE
   */
   if($club!=$_SESSION['SL_club']){
     Visits::addVisit($_SESSION['SL_club'],$club,'C');
   }
  /**
   * GET CLUB INFO
   */
  $this->data['clubinfo']=ClubInfo::get($club);
  if((!isset($this->data['clubinfo']['logo'])) or $this->data['clubinfo']['logo']=='null'){
    $this->data['clubinfo']['logo']='default.png';
  }
  if((!isset($this->data['clubinfo']['clubcolor'])) or $this->data['clubinfo']['clubcolor']=='null'){
    $this->data['clubinfo']['clubcolor']='#5FAD56';
  }
  $data=League::getLeagueById(Club::getClubLeague($club));
  $this->data['clubinfo']['league']=$data['name'].' ('.$data['division'].'.'.$data['divgroup'].')';
  if((!isset($this->data['clubinfo']['manager'])) or $this->data['clubinfo']['manager']==null){
    $this->data['clubinfo']['manager']='The Manager';
  }
  if((!isset($this->data['clubinfo']['history'])) or $this->data['clubinfo']['history']=='null'){
    $this->data['clubinfo']['history']='Não há história pra contar :(';
  }
  $this->data['clubinfo']['buddies']=Buddy::howManyBuddies($club) . ' amigo(s)';
  $this->data['leagueURL']='league/'.$data['abbreviation'].'/'.$data['division'].'/'.$data['divgroup'];
  $this->data['clubinfo']['fans']= number_format(ClubFans::howManyFans($club),0,',','.');
  $this->data['clubinfo']['fansname']=ClubFans::getFansName($club);

  /**
   * GET VISITS
   */
   if(Visits::howManyClubsVisitMe($club,'C')>0){
      $visitors=Visits::getLastVisitors($club,'C');
      foreach ($visitors as $key => $value){
        $this->data['visitors'][$key]="<a href='".$value."'>".Club::getClubNameById($value)."</a>";
      }
    }else{
      $this->data['visitors'][0]="Nenhum visitante";
    }
  /**
   * BUDDY BUTTON
   * MAKE THE ACTION AND TEXT FOR BUDDY BUTTON;
   */
  if(Buddy::isPending($_SESSION['SL_club'],$club)){
    $this->data['button']['friend']['text']='Solicitação Pendente';
    $this->data['button']['friend']['action']='unMakeBuddy';
  }else if(Buddy::isPending($club,$_SESSION['SL_club'])){
    $this->data['button']['friend']['text']='Aceitar amigo';
    $this->data['button']['friend']['action']='aproval';
  }else if(Buddy::isMyFriend($_SESSION['SL_club'],$club) or Buddy::isMyFriend($club,$_SESSION['SL_club'])){
    $this->data['button']['friend']['text']='Desfazer amizade';
    $this->data['button']['friend']['action']='unbuddy';
  }else{
    $this->data['button']['friend']['text']='Fazer novo amigo';
    $this->data['button']['friend']['action']='request';
  }
}

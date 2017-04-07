<?
  error_reporting(E_ALL);
  $this->tree=__rootpath($_SERVER['REDIRECT_URL']);
  print_r($this->post);
  $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdHyhgUAAAAAFOfFtYxtON6sUWdwdmZOIzvR79S&response=".$this->post['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
  $obj = json_decode($response);
  if($obj->success != true){
    $_SESSION['E_SIGNUP'] = "Please, robots are not welcome.";
    App::redirect('signup','index');
    exit;
  }
  $validation = new Validation($this->post);
  // var_dump($validation->geterrors());
  $rules = [
  	'email' => 'in:account|required|email',
    'password' => 'required|minsize:8',
    'clubname' => 'required|minsize:8|in:club',
    'country' => 'required'
  ];

  $validation->addRules($rules)->validate();

  if($validation->errors['length']>0){
    $_SESSION['E_SIGNUP'] = 'Por favor, preencha corretamente todos os dados.';
    if(in_array('in',$validation->errors['errors']['email'])){
      $_SESSION['E_SIGNUP'] = 'Email já cadastrado em nossa base de dados.';
    }else if(in_array('email',$validation->errors['errors']['email'])){
      $_SESSION['E_SIGNUP'] = 'Por favor, preencha um email válido!';
    }else if(in_array('minsize',$validation->errors['errors']['password'])){
      $_SESSION['E_SIGNUP'] = 'A senha deve conter pelo menos 8 caracteres.';
    }else if(in_array('minsize',$validation->errors['errors']['clubname'])){
      $_SESSION['E_SIGNUP'] = 'Nome do clube deve conter ao menos 8 caracteres.';
    }

    App::redirect('signup','index');

  }else{
      $account=new Account();

      $account->setEmail($this->post['email']);
      $account->setPassword($this->post['password']);
      $refeer = ($this->post['refeer']!='') ? $this->post['refeer'] : NULL;
      $account->setRefeer($refeer);

      $account->__create();

    try{

      $club = new Club();
      $club->id_account  = $account->id_account;
      $club->id_country  = $this->post['country'];
      $club->clubname    = $this->post['clubname'];

      if($club->checkAvailableClub()==0){
        /* Create new league with new available clubs */
        $last=League::lastDivAndGroup($club->id_country);
        $league = new League($club->id_country,1,$last[0],$last[1]);
        $available=$league->nextAvailableDivAndGroup();
        if(!League::checkIfLeagueAlreadyExists(1,$club->id_country,$available[0],$available[1])){
          $id_competition=Competition::getIdCompetition(Competition::getIdCompetitionType('L'),$club->id_country, 1);
          $league->__create($id_competition,$available[0] . ' division', $available[0], $available[1], 34);
        }
        $league = new League($club->id_country,1,$available[0],$available[1]);
        $league->__loadIDleague();
        for($i=1;$i<19;$i++){
         $clubA=Club::__createAvailableTeam($club->id_country);
         $league->joinClub($clubA);
        }
        $club->checkAvailableClub();
        $fin = $club->__create();
        if($fin===false){
          $account->delete();
        }
      }else{
        $club->checkAvailableClub();
        $fin = $club->__create();
        if($fin===false){
          $account->__delete();
          //App::redirect('signup','index');
          exit;
        }
      }
    }catch(Exception $e){
        $account->__delete();
        //App::redirect('signup','index');
        exit;
    }
  }
  set_time_limit(0); //don't stop the connection! just don't.
  //Goalkeepers
  for ($i=0; $i < 3; $i++) {
    $indice=1;
    $player = PlayerFactory::createGoalkeper($indice,$club->id_club);
    PlayerFactory::savedGoalkeeper($player);
  }
  // Lineplayers
  for ($i=0; $i <22 ; $i++) {
    $indice=1;
    $player = PlayerFactory::createPlayer($indice,$club->id_club);
    PlayerFactory::savePlayer($player);
  }
  $mail = new Mail();
  $mail->open();
  $mail->setFrom('team.soccerleague@gmail.com','Soccer League');
  $mail->subject('Bem vindo ao Soccer League');

  $mail->body('Bem vindo ao Soccer League','Seja bem vindo ao Soccer League, esperamos que você tenha muitas conquistas com o <b>'.$this->post['clubname'].'</b>. Agora, seus jogadores o esperam! Vá para o seu clube', 'Acessar seu clube', 'http://localhost/');
  $mail->addAddress($this->post['email']);
  $mail->_send();

  $_SESSION['SUCCESS'] = 'Seja bem vindo ao Soccer League, faça login para começar sua jornada.';
  App::redirect('signup','index');
  exit;

<?
  $this->tree=__rootpath($_SERVER['REDIRECT_URL']);

  $validation = new Validation($this->post);
  $rules = [
  	'email' => 'in:account|required|email',
    'password' => 'required|minsize:8',
    'clubname' => 'required|minsize:8',
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
    if(!Club::validClubName($this->post['clubname'])){
      $_SESSION['E_SIGNUP'] = 'sda';
      App::redirect('signup','index');
    }
    $account=new Account();

    $account->setEmail($this->post['email']);
    $account->setPassword($this->post['password']);
    $refeer = ($this->post['refeer']!='') ? $this->post['refeer'] : NULL;
    $account->setRefeer($refeer);

    $account->__create();

    $club = new Club($account->id_account);

    $club->id_country  = $this->post['country'];
    $club->clubname    = $this->post['clubname'];

    if($club->checkAvailableClub()==0){
      /* Create new league with new available clubs */
      $last=League::lastDivAndGroup($country);
      $league = new League($country,1,$last[0],$last[1]);
      $available=$league->nextAvailableDivAndGroup();
      if(!League::checkIfLeagueAlreadyExists(1,$country,$available[0],$available[1])){
        $id_competition=Competition::getIdCompetition(Competition::getIdCompetitionType('L'),$country, 1);
        League::createLeague($id_competition,$available[0], $available[1], 34);
      }
      $league = new League($country,1,$available[0],$available[1]);
      for($i=1;$i<19;$i++){
       $club=Club::createAvailableTeam($country);
       $league->joinClub($club);
      }
    }
    if($club->create()==false){
      $account->delete();
    }else{
      echo $club->id_club;
    }
    exit;

    // $mail = new Mail();
    // $mail->open();
    // $mail->setFrom('willians.echart@gmail.com','Willians Echart');
    // $mail->subject('Teste');
    // $mail->body('teste');
    // $mail->addAddress('willians.echart@pelotas.rs.gov.br');
    // $mail->_send();
  }
  exit;

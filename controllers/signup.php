<?
  error_reporting(E_ALL);
  $validation = new Validation($this->post);
  $rules = [
  	'email' => 'in:account|required|email',
    'password' => 'required|minsize:8',
    'clubname' => 'required|minsize:8',
    'country' => 'required'
  ];

  $validation->addRules($rules)->validate();
  if($validation->errors['length']>0){
    // print_r($validation->errors);exit;
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
  }
  exit;

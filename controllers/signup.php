<?
  error_reporting(E_ALL);
  // $validation = new Validation($this->post);
  // $rules = [
  // 	'email' => 'in:account|required|email',
  //   'password' => 'required|minsize:8',
  //   'clubname' => 'required|minsize:8',
  //   'country' => 'required'
  // ];
  function mandamail($senhauser, $emailuser){

      $txtNome    = "Suporte SIADE";
      $txtAssunto    = "Senha de acesso ao SIADE";
      $txtMensagem    = "Voce foi cadastrado(a) como usuario do SIADE, com a senha ".$senhauser;

      /* Montar o corpo do email*/
      $corpoMensagem         = $txtNome." <br>".$txtAssunto."<br>".$txtMensagem;

      /* Extender a classe do phpmailer para envio do email*/

      /* Definir Usuário e Senha do Gmail de onde partirá os emails*/
      define('GUSER', 'willians.echart@gmail.com');
      define('GPWD', '#echart84015521');

      function smtpmailer($para, $de, $nomeDestinatario, $assunto, $corpo) {
          global $error;
          $mail = new PHPMailer();
          /* Montando o Email*/
          $mail->IsSMTP();            /* Ativar SMTP*/
          // $mail->Timeout = 200;
          $mail->SMTPDebug = 2;        /* Debugar: 1 = erros e mensagens, 2 = mensagens apenas*/
          $mail->SMTPAuth = true;        /* Autenticação ativada    */
          $mail->SMTPSecure = 'tls';    /* TLS REQUERIDO pelo GMail*/
          $mail->Host = '64.233.168.108';    /* SMTP utilizado*/
          $mail->Port = 587;             /* A porta 587 deverá estar aberta em seu servidor*/
          $mail->Username = GUSER;
          $mail->Password = GPWD;
          $mail->SetFrom($de, $nomeDestinatario);
          $mail->Subject = $assunto;
          $mail->Body = $corpo;
          $mail->AddAddress($para);
          $mail->IsHTML(true);
          $mail->CharSet = 'utf-8';


          // /* Função Responsável por Enviar o Email*/
          // if(!$mail->Send()) {
          //     $error = "<font color='red'><b>Mail error: </b></font>".$mail->ErrorInfo;
          //     return false;
          // } else {
          //     $error = "<font color='blue'><b>Mensagem enviada com Sucesso!</b></font>";
          //     return true;
          // }

          $mail->Send();
      }

      /* Passagem dos parametros: email do Destinatário, email do remetende, nome do remetente, assunto, mensagem do email.*/
       if (smtpmailer($emailuser, 'willians.echart@gmail.com', $txtNome, $txtAssunto, $corpoMensagem)) {
           return true;
       }
      if (!empty($error)) echo $error;
  }
  mandamail('senha5','willians.fagundes@hotmail.com');
  exit;
  // $validation->addRules($rules)->validate();
  // if($validation->errors['length']>0){
  //   $_SESSION['E_SIGNUP'] = 'Por favor, preencha corretamente todos os dados.';
  //   if(in_array('in',$validation->errors['errors']['email'])){
  //     $_SESSION['E_SIGNUP'] = 'Email já cadastrado em nossa base de dados.';
  //   }else if(in_array('email',$validation->errors['errors']['email'])){
  //     $_SESSION['E_SIGNUP'] = 'Por favor, preencha um email válido!';
  //   }else if(in_array('minsize',$validation->errors['errors']['password'])){
  //     $_SESSION['E_SIGNUP'] = 'A senha deve conter pelo menos 8 caracteres.';
  //   }else if(in_array('minsize',$validation->errors['errors']['clubname'])){
  //     $_SESSION['E_SIGNUP'] = 'Nome do clube deve conter ao menos 8 caracteres.';
  //   }
  //   App::redirect('signup','index');
  // }else{
  //   $account=new Account();
  //   $account->setEmail($this->post['email']);
  //   $account->setPassword($this->post['password']);
  //   $account->setRefeer($this->post['refeer']);
  //
  //   $account->__create();
  //
  //
  // }
  exit;

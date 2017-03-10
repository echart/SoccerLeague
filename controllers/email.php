<?php
function mandamail($senhauser, $emailuser){

    $txtNome    = "Suporte SIADE";
    $txtAssunto    = "Senha de acesso ao SIADE";
    $txtMensagem    = "Voce foi cadastrado(a) como usuario do SIADE, com a senha ".$senhauser;

    /* Montar o corpo do email*/
    $corpoMensagem         = $txtNome." <br>".$txtAssunto."<br>".$txtMensagem;

    /* Extender a classe do phpmailer para envio do email*/
    require_once("class.phpmailer.php");

    /* Definir Usuário e Senha do Gmail de onde partirá os emails*/
    define('GUSER', 'email');
    define('GPWD', 'senha');

    function smtpmailer($para, $de, $nomeDestinatario, $assunto, $corpo) {
        global $error;
        $mail = new PHPMailer();
        /* Montando o Email*/
        $mail->IsSMTP();            /* Ativar SMTP*/
        // $mail->Timeout = 200;
        $mail->SMTPDebug = 1;        /* Debugar: 1 = erros e mensagens, 2 = mensagens apenas*/
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
        $mail->smtpConnect(array(
              "ssl" => array(
                  "verify_peer" => false,
                  "verify_peer_name" => false,
                  "allow_self_signed" => true
              )
          )
      );

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
     if (smtpmailer($emailuser, 'otaviosmeiatto@gmail.com', $txtNome, $txtAssunto, $corpoMensagem)) {
         return true;
    }
    if (!empty($error)) echo $error;
}




?>

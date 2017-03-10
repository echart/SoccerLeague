<?
class Mail{
  public $config;
  public $mail;
  public $error;
  public function __construct(){
    $temp = parse_ini_file('_config.ini');
    $this->config['user'] = $temp['mailuser'] ?? '';
    $this->config['password'] = $temp['mailpassword'] ?? '';
    $this->mail = new PHPMailer();
  }
  public function open(){
    $this->mail = new PHPMailer();
    $this->mail->IsSMTP();
    // $this->mail->Timeout = 200;
    $this->mail->SMTPDebug =1;
    $this->mail->SMTPAuth = true;
    $this->mail->SMTPSecure = 'ssl';
    $this->mail->Host = '64.233.168.108';
    $this->mail->Port = 587;
    $this->mail->Username = $this->config['user'];
    $this->mail->Password = $this->config['password'];
    $this->mail->IsHTML(true);
    $this->mail->CharSet = 'utf-8';
  }
  function setFrom($from,$fromName){
    $this->mail->SetFrom($from, $fromName);
  }
  function subject($subject){
    $this->mail->Subject = $subject;
  }
  function body($body){
    $this->mail->Body =  $body;
  }
  function addAddress($address){
    $this->mail->AddAddress($address);
  }
  function errors(){
    return $this->errors;
  }
  function _send(){
    if(!$this->mail->Send())
      $this->errors = $this->mail->ErrorInfo;
    else
      $this->mail->Send();
  }
}

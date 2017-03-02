<?

switch($this->request['method']){
  case 'country':
    $_SESSION['signup'] = $this->post;
    $this->tree=__rootpath($_SERVER['REDIRECT_URL']);
    $this->title='Cadastrar';
    $this->addCSSFile('styles.css');
    $this->requestURL='countries';
    $this->loadView(false);
    exit;
    break;
  case 'save':

  break;
}

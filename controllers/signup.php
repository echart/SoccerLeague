<?

switch($this->request['method']){
  case 'country':
    $this->tree=__rootpath($_SERVER['REDIRECT_URL']);
    $this->title='Cadastrar';
    // $this->addCSSFile('signup.css');
    $this->requestURL='countries';
    $this->loadView(false);
    exit;
    break;
  case 'save':

  break;
}
echo 'mdskalmdsa';exit;

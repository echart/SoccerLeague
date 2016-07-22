<?
include('helpers/__dontgetlost.php');
class Handler{
	public $request;
	public $requestURL;
	public $response;
	public $data;
	function requestUrl(array $request){
		$this->requestURL=$request['request'];
		$this->request=$request;
	}
	public function loadController(){
		if(file_exists('controllers/'.$this->requestURL.'.php'))
			include_once('controllers/'.$this->requestURL.'.php');
	}
	public function loadView(){
			require_once('views/_head.php');
			require_once('views/_header.php');
		if(file_exists('views/'.$this->request.'.php'))
			include('views/'.$this->request.'.php');
		else
			include('views/404.html');
			require_once('views/_footer.php');

	}
}

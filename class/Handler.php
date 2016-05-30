<?

class Handler{
	public $request;
	public $requestURL;
	public $response;

	function requestUrl(array $request){
		$this->requestURL=$request['request'];
		$this->request=$request;
	}
	public function loadController(){
		//load the controller
		require_once('controllers/'.$this->requestURL.'.php');
	}
	public function loadView(){
		//load the view
		require_once('views/'.$this->requestURL.'.php');
	}
}


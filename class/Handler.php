<?

class Handler{
	public $request;
	public $response;

	function requestUrl(array $request){
		$this->request=$request;
	}
	public function loadController(){
		//load the controller
		require_once('controllers/'.$this->request['request'].'.php');
	}
	public function loadView(){
		//load the view
		require_once('views/'.$this->request['request'].'.php');
	}
}


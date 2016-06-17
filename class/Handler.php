<?
include('helpers/__dontgetlost.php');
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
		$view = new View($this->requestURL);
		$data['tree']=__rootpath($this->requestURL);
		
		$view->setContentHead($data);
		$view->loadHead();

		$view->setContentHeader($data);
		$view->loadHeader();

		$view->setContentView($data);
		$view->loadView();

		$view->loadFooter();
	}
}

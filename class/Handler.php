<?
include('helpers/__dontgetlost.php');
class Handler{
	public $request;
	public $requestURL;
	public $data;
	function parseUrl(array $request){
		$this->requestURL=$request['request'];
		$this->request=$request;
	}
	/**
	 * load controller
	 */
	public function loadController(){
		if(file_exists('controllers/'.$this->requestURL.'.php'))
			include_once('controllers/'.$this->requestURL.'.php');
	}
	public function loadView(){
		/**
		 * load head and header with menu
		 */
		require_once('views/_head.php');
		require_once('views/_header.php');
		/**
		 * load requested view, if cant load then load 404 page.
		 */
		if(file_exists('views/'.$this->requestURL.'.php')){
			include('views/'.$this->requestURL.'.php');
		}else{
			include('views/404.html');
		}
		/**
		 * load footer
		 */
		require_once('views/_footer.php');
	}
}

<?
include('View.php');
class ContentView implements View{
	public $__viewData;
	public $__headerData;
	public $__headData;
	
	public function __construct($request){
		$this->request=$request;
	}
	public function setContentHead(array $data){
		$this->__headData=$data;
	}
	public function loadHead(){
		require_once('views/_head.php');
	}
	public function setContentHeader($data){
		$this->__headerData=$data;
	}
	public function loadHeader(){
		require_once('views/_header.php');
	}
	public function setContentView($data){
		$this->__viewData=$data;
	}
	public function loadView(){
		require_once('views/'.$this->request.'.php');
	}
	public function loadFooter(){
		require_once('views/_footer.php');
	}
}

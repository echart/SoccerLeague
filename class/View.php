<?php


interface class View{
	public $__viewData;
	public $__headerData;
	public $__headData;
	public function loadHead();
	public function setContentHeader($data);
	public function loadHeader();
	public function loadFooter();
	public function setContentView($data);
	public function loadView();
}

class ContentView implements View{
	public function __construct($request, $data){
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

	public function viewer(){
		//call all the methods
	}
}



<?
include('helpers/__dontgetlost.php');
class Handler{
	public $request; /* data from here will contain the controller/view "caller" and will all the other data in the URL, like method, subrequest and this stuff*/
	public $requestURL; /*this will call the controller and view*/

	//page data
	public $data; /*the will pass the data from the Controller to view*/
	public $tree; //virtual path
	public $title; //page title
	public $menu; //menu selected
	public $submenu; //submenu selected

	public $permissions;

	public $dependence=array('JS'=>array(),'CSS'=>array());

	function parseUrl(array $request){
		$this->requestURL=$request['request'];
		$this->request=$request;
	}
	/**
	 * load controller
	 */
	public function loadController(){
		if(file_exists('controllers/'.$this->requestURL.'.php')){
			include_once('controllers/'.$this->requestURL.'.php');
		}else{
			include_once('controllers/404.php');
		}
	}
	public function loadView($flag=true){
    // flag @Param = if flag is true, load head+header+footer
		/**
		 * load head and header with menu
		 */
    if($flag==true){
  		require_once('views/_head.php');
  		require_once('views/_header.php');
    }
		/**
		 * load requested view, if cant load then load 404 page.
		 */
		if(file_exists('views/'.$this->requestURL.'.php')){
			include_once('views/'.$this->requestURL.'.php');
		}else{
			include_once('views/404.html');
		}
		/**
		 * load footer
		 */
    if($flag==true){
      require_once('views/_footer.php');
    }
	}
	public function addCSSFile($name){
		$this->dependence['CSS'][]=$name;
	}
	public function loadCSSfiles(){
		foreach ($this->dependence['CSS'] as $key => $style) {
			echo "<link rel='stylesheet' type='text/css' href='".$this->tree."assets/css/".$style."'>";
		}
	}
	public function addJSFile($name){
		$this->dependence['JS'][]=$name;
	}
	public function loadJSFiles(){
		foreach ($this->dependence['JS'] as $key => $script) {
			echo "<script type='text/javascript' src='".$this->tree."assets/js/".$script."'></script>";
		}
	}
}

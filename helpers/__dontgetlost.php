<?
	/*
		return the current path;	
	*/
	function __dontgetlost($script):string{
		//get the document root and exclude it from url;
		$__tree=str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['REDIRECT_URL']);
		//get the scriptname and exclud it from url;
		$__tree=str_replace($script, '', $__tree);
		//return just the current path
		//ex: /var/www/soccerleague/includes/index.php will return just includes
		return $__tree;
	}

	/*
		return the way  the root path
	*/
	function __rootpath($script):string{
		//get the current path annd count the '/' repeat
		$i=substr_count($script, '/');
		// make the the way to the root based on the result of i
		$__url='';
		while($i>0){
			$__url.='../';
			$i--;
		}
		//return the way to the root path
		return $__url;
	}
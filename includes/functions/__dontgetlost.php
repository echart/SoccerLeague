<?
	/*
		return the current path;	
	*/
	function __dontgetlost($script):string{
		//get the document root and exclude it from url;
		$__tree=str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['SCRIPT_FILENAME']);
		//get the scriptname and exclud it from url;
		$__tree=str_replace($script, '', $__tree);
		//return just the path
		//ex: /var/www/soccerleague/includes/index.php will return just includes
		return $__tree;
	}

	echo __dontgetlost('__dontgetlost.php');
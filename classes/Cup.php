<?
include('Competition.php');

class Cup extends Competition{
	public function __construct($country, $season){
		parent::__construct($country, $season, 'C');
	}
}

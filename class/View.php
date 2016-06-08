<?php


interface View{
	public function loadHead();
	public function setContentHeader($data);
	public function loadHeader();
	public function loadFooter();
	public function setContentView($data);
	public function loadView();
}


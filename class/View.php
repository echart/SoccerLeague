<?php


abstract View{
	public function __construct();
	public function loadController();
	public function setContentView();
	public function loadView();
	public function draw();
}
<?php namespace JetCMS\Admin;

class Controller
{
	static function register ($name,$class)
	{	
		$c = new $class();
		$c->init($name);
	}
}
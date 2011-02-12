<?php if (! defined('BASEPATH')) exit('No direct script access');

class Usuario extends Model {

	//php 5 constructor
	public function __construct() {
		parent::Model();
	}
	
	public function instalar() {
		
	}
	
	public function hash_password($pass)
	{
		if (! empty($pass))
		{
			
		}
	}
	
	public function agregar($dato)
	{
		return TRUE;
	}
}
<?php if (! defined('BASEPATH')) exit('No direct script access');

/**
 * Controlador principal del módulo de usuarios.
 *
 * @package Usuarios
 * @author Luis Felipe Pérez
 * @version 0.1.1
 **/
 
class Usuarios extends Controller {

	public function __construct() {
		parent::Controller();
	}
	
	public function index() {
		$this->template->render();
	}

}
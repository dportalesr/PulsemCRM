<?php if (! defined('BASEPATH')) exit('No direct script access');

/**
 * Controlador principal del módulo de usuarios.
 *
 * @package Usuarios
 * @author Luis Felipe Pérez
 * @version 0.1.1
 **/
 
class Usuarios extends CI_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->template->render();
	}

}
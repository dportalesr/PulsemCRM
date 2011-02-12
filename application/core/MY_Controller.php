<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$publico = array('index.php', 'usuarios/login', 'usuarios/logout', '/', 'usuarios/recordar');
		$actual  = $this->uri->segment(1, '') . '/' . $this->uri->segment(2, '');
		$es_publica = in_array($actual, $publico);
		
		if(!$es_publica AND !$this->session->userdata('logueado')){
			redirect('usuarios/login');
		}
	}
}
/* The MX_Controller class is autoloaded as required */
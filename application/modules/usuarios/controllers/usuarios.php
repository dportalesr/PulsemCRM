<?php if (! defined('BASEPATH')) exit('No direct script access');

/**
 * Controlador principal del módulo de usuarios.
 *
 * @package Usuarios
 * @author Luis Felipe Pérez
 * @version 0.1.1
 **/
 
class Usuarios extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('usuario');
	}
	
	public function index() {
		$this->template->render();
	}
	
	public function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('correo', 'correo electrónico', 'trim|required|valid_email');
		$this->form_validation->set_rules('pass', 'contraseña', 'trim|required');
		if($this->form_validation->run()){
			$res = $this->usuario->logueo($this->input->post('correo', TRUE), $this->input->post('pass', TRUE));
			if($res){
				$session = array(
								'logueado' => TRUE,
								'usuario'  => $res->nombre,
								'idusuario' => $res->idusuario
								);
				$this->session->set_userdata($session);
				redirect('usuarios/panel');
			}
		}else{
			
		}
		$this->template->write_view('contenido', 'login');
		$this->template->render();
	}
	
	public function recordar()
	{
		$this->load->library('form_validation');
		$this->load->library('email');
		
		$this->form_validation->set_rules('correo', 'correo electrónico', 'trim|required|valid_email');
		if($this->form_validation->run()){
			$res = $this->usuario->recuperar($this->input->post('correo', TRUE));
			if($res){
				$liga = site_url('usuarios/reactivar/'.$res->idusuario.'/'.$res->pass);
				$this->email->from('clientes@pulsem.mx')->to($res->correo)->message($liga)->send();
			}
		}
		
		$this->template->render();
	}
	
	public function reactivar($id = '', $clave = '')
	{
		if(!empty($id) AND !empty($clave)){
			if($this->usuario->reactivacion($id, $clave)){
				$this->load->library('form_validation');
				$this->form_validation->set_rules('pass', 'contraseña', 'trim|required|matches[confirmar]');
				$this->form_validation->set_rules('confirmar', 'confirmar contraseña', 'trim|required');
				if($this->form_validation->run()){
					$this->usuario->reset_pass($id, $this->input->post('pass'));
				}
				
			}else{
				redirect('usuarios/login');
			}
		}else{
			redirect('usuarios/login');
		}
		$this->template->render();
	}
	
	public function panel()
	{
		$this->template->render();
	}
	
	public function listado()
	{
		$this->template->render();
	}
}
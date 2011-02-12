<?php if (! defined('BASEPATH')) exit('No direct script access');

class Usuario extends CI_Model {
	
	private   $salt_length    = '10';
	protected $tabla_usuarios = 'credito_usuarios';
	protected $tabla_ips      = 'credito_ips';
	
	public function __construct() {
		parent::__construct();
	}

	private function salt()
	{
		return substr(md5(uniqid(rand(), true)), 0, $this->salt_length);
	}

	private function hash_password($password)
	{
		if (empty($password)){
	        return false;
	    }

	    $salt = $this->salt();
	    return = $salt . substr(sha1($salt . $password), 0, -$this->salt_length);
	}

	private function to_hash($password, $almacenado)
	{
		if(!empty($password) AND !empty($almacenado)){
			$salt = substr($almacenado, 0, $this->salt_length);
			return $salt . substr(sha1($salt . $password), 0, -$this->salt_length);
		}else{
			return FALSE;
		}
	}

	public function validar_ip($ip)
	{
		/* Se eliminan las ips bloqueadas y/o que tengan mas de 30 min de su ultimo intento */
		$this->db->where("TIMEDIFF(CURRENT_TIMESTAMP, bloqueo) > '00:30:00'", NULL, FALSE);
		$this->db->delete($this->tabla_ips);

		/* verificamos su la ip ha tenido intentos */
		$this->db->select('ip, intentos');
		$this->db->where('ip', $ip);
		$this->db->where('intentos', '3');
		$this->db->limit(1);
		$query = $this->db->get($this->tabla_ips);
		if($query->num_rows() == 1){
			return FALSE;
		}else{
			return TRUE;
		}
	}

	public function intento_ip($ip)
	{
		$this->db->select('ip, intentos');
		$this->db->where('ip', $ip);
		$this->db->limit(1);
		$query = $this->db->get($this->tabla_ips);
		$stamp = date("Y-m-d H:i:s");
		if($query->num_rows() == 1){
			$data = $query->row();
			$this->db->where('ip', $ip);
			$this->db->update($this->tabla_ips, array('intentos' => $data->intentos+1, 'bloqueo' => $stamp));
			return $data->intentos + 1;
		}else{
			$this->db->insert($this->tabla_ips, array('intentos' => 1, 'bloqueo' => $stamp));
			return 1;
		}
	}

	public function borrar_ip($ip)
	{
		$this->db->delete($this->tabla_ips, array('ip' => $ip));
	}

	public function logueo($correo, $pass)
	{
		if (!empty($correo) AND !empty($pass)) {
			$query = $this->db->select('idusuario, correo, pass, nombre')
							  ->where('correo', $correo)
							  ->limit(1)
							  ->get($this->tabla_usuarios);
			if($query->num_rows() == 1){
				$datos = $query->row();
				$guardado = $this->to_hash($pass, $datos->pass);
				if($pas == $guardado){

				}
			}
		}
	}
}
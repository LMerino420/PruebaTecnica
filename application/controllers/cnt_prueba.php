<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cnt_prueba extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mod_prueba', 'modelP'); // instanciar modelo para usuarlo en cualquier metodo
	}

	public function index($user = null, $pwd = null)
	{
		//RECIBIR VALORES DEL USUARIO
		$user = $this->input->POST('usuario');
		$pwd = md5($this->input->POST('pwd'));

		//VALIDACION PARA VER QUE EXISTA EL USUARIO
		$revAccess = $this->modelP->login($user, $pwd);

		if ($revAccess) {
			$data = array(
				'id_user' => $revAccess->id_user,
				'id_perso' => $revAccess->id_perso,
				'nick_name' => $revAccess->nick_name,
				'id_tipo' => $revAccess->id_tipo,
				'login' => TRUE
			);

			$this->session->set_userdata($data);
		}

		if ($this->session->userdata('login')) {
			if ($this->session->userdata('id_tipo') == 1) {
				redirect(base_url('index.php/cnt_prueba/usuarios'));
			} else {
				redirect(base_url('index.php/cnt_prueba/inicio'));
			}
		}

		$this->load->view('v_prueba/login');;
	}

	public function logout()
	{
		//SE DESTRUYE LA SESION Y REDIRECCIONA AL HOME
		$this->session->sess_destroy();
		redirect(base_url(''));
	}


	public function usuarios()
	{
		if ($this->session->userdata('login') == FALSE) {
			redirect(base_url(''));
		}
		$data['lista'] = $this->modelP->lista(); // Cargar lista de usuarios desde modelo
		$this->load->view('v_prueba/usuarios', $data);
	}

	public function registro()
	{
		if ($this->session->userdata('login') == FALSE) {
			redirect(base_url(''));
		}

		if (isset($_POST['registrar'])) {
			//ARREGLOS PARA ALMACENAR LOS DATOS INGRESADOS POR LOS USUARIOS
			$personal = array();
			$usuario = array();

			//ASIGNACION DE VALORES PARA LA INSECION DE DATOS
			$personal['nombre'] = $this->input->post('nombre');
			$personal['apellido'] = $this->input->post('apellido');
			$personal['correo'] = $this->input->post('email');

			$usuario['nick_name'] = $this->input->post('usuario');
			$usuario['clave'] = md5($this->input->post('pwd'));
			$usuario['estado'] = 0; //se envia el valor quemado de 0 ya que sera activado el usuario hasta que el admin lo apruebe
			$usuario['id_tipo'] = 2;

			$validPerso = $this->db->query('SELECT * FROM personal where correo = ?', $_POST['email'])->num_rows(); //validacion para no permitir dos usuarios con el mismo correo
			$validUser = $this->db->query('SELECT * FROM usuario WHERE nick_name = ?', $_POST['usuario'])->num_rows(); //validacion para no permitir dos personas con el mismo usuario

			if ($validPerso < 1) {
				if ($validUser < 1) {
					$validacion = $this->modelP->registrar($personal, $usuario);
					if ($validacion) {
						echo "<script type='text/javascript'>alert('REGISTRO EXITOSO, ESPERE A SER AUTORIZADO POR EL ADMINISTRADOR');</script>";
						redirect(base_url(''), 'refresh');
					}
				} else {
					echo "<script type='text/javascript'>alert('EL USUARIO QUE INTENTAS REGISTRAR YA ESTA SIENDO USADO POR OTRA PERSONA');</script>";
				}
			} else {
				echo "<script type='text/javascript'>alert('EL CORREO QUE INTENTA UTILIZAR YA ESTA REGISTRADO CON OTRO USUARIO');</script>";
			}
		}

		if(isset($_POST['regresar']))
		{
			redirect(base_url('index.php/cnt_prueba/usuarios'));
		}
		$this->load->view('v_prueba/registro');
	}

	public function inicio()
	{
		if ($this->session->userdata('login') == FALSE) {
			redirect(base_url(''));
		}
		$this->load->view('v_prueba/inicio');
	}

	public function del_registro(int $id_user,int $id_perso)
	{
		$this->modelP->eliminar_registro($id_perso,$id_user);
	}

	public function valid_user(int $id_user)
	{
		$this->modelP->validar_usuario($id_user);
	}
}

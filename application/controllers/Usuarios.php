<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Usuarios_model');
    }

    public function index() {
        $data['titulo'] = 'Gestión de Usuarios';
        $data['usuarios'] = $this->Usuarios_model->obtener_usuarios();
        $data['roles'] = $this->db->get('roles')->result();

        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/usuarios', $data);
        $this->load->view('layouts/footer');
    }


    public function cambiar_rol($id) {
        $id_rol = $this->input->post('id_rol');
        $this->Usuarios_model->cambiar_rol($id, $id_rol);
        redirect('usuarios');
    }

    public function eliminar($id) {
        $this->Usuarios_model->eliminar($id);
        redirect('usuarios');
    }

    public function cambiar_password($id) {
        $nueva = $this->input->post('password');
        $this->Usuarios_model->cambiar_password($id, $nueva);
        redirect('usuarios');
    }
}

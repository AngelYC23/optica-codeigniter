<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Registro_model');
    }

    public function index() {
        $data = [
            'title'       => 'Registro - OVC',
            'error_msg'   => $this->session->flashdata('error'),
            'success_msg' => $this->session->flashdata('success'),
            'extra_css'   => ['assets/css/stylelogin.css']
        ];

        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/registro', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function registrar() {
        $nombre   = $this->input->post('nombre');
        $email    = $this->input->post('email');
        $password = $this->input->post('password');
        $id_rol = 2;

        if (!empty($nombre) && !empty($email) && !empty($password)) {

            if ($this->Registro_model->obtener_por_email($email)) {
                $this->session->set_flashdata('error', 'El correo ya está registrado.');
                redirect('registro');
                return;
            }

            $data = [
                'nombre'        => $nombre,
                'email'         => $email,
                'password'      => password_hash($password, PASSWORD_BCRYPT),
                'id_rol'        => $id_rol,
                'fecha_creacion'=> date('Y-m-d H:i:s'),
                'activo'        => 1
            ];

            if ($this->Registro_model->registrar_usuario($data)) {
                $this->session->set_flashdata('success', 'Cuenta creada correctamente. Ahora inicia sesión.');
                redirect('login');
            } else {
                $this->session->set_flashdata('error', 'Hubo un problema al registrar el usuario.');
                redirect('registro');
            }

        } else {
            $this->session->set_flashdata('error', 'Debes completar todos los campos.');
            redirect('registro');
        }
    }
}

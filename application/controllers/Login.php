<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }

    public function index() {
        $data = [
            'title'       => 'Login - OVC',
            'error_msg'   => $this->session->flashdata('error'),
            'success_msg' => $this->session->flashdata('success'),
        ];

        $data['extra_css'] = ['assets/css/stylelogin.css']; 
        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/login', $data);
        $this->load->view('layouts/footer', $data);
    }

    public function autenticar() {
        $email    = $this->input->post('email');
        $password = $this->input->post('password');
        $this->load->model('Login_model');
        $usuario = $this->Login_model->obtener_por_email($email);

        if ($usuario && password_verify($password, $usuario->password)) {
            $this->session->set_userdata([
                'logged_in'      => true,
                'usuario_id'     => $usuario->id_usuario,
                'usuario_nombre' => $usuario->nombre,
                'usuario_email'  => $usuario->email,
                'id_rol'         => $usuario->id_rol
            ]);
            redirect('home');
        } else {
            $this->session->set_flashdata('error', 'Usuario o contraseña incorrectos.');
            redirect('login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}

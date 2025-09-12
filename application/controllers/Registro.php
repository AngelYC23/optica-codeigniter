<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Aseguramos que la librería session esté cargada
        $this->load->library('session');
    }

    // Muestra la vista del formulario de registro
    public function index() {
        // Pasamos flashdata a la vista como variables
        $data = [
            'title'       => 'Registro - OVC',
            'error_msg'   => $this->session->flashdata('error'),
            'success_msg' => $this->session->flashdata('success'),
        ];

        // Si usas header/footer en layouts, pásales $data también
        $data['extra_css'] = ['assets/css/stylelogin.css']; 
        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/registro', $data);
        $this->load->view('layouts/footer', $data);
    }

    // Procesa el formulario de creación de cuenta
    public function registrar() {
        // Recibe los datos enviados por POST
        $nombre   = $this->input->post('nombre');
        $email    = $this->input->post('email');
        $password = $this->input->post('password');

        // ⚠️ Esto es solo un ejemplo simple, lo ideal es guardar en DB
        if (!empty($nombre) && !empty($email) && !empty($password)) {
            // Aquí podrías insertar en base de datos con un modelo
            // Ejemplo simple:
            $this->session->set_flashdata('success', 'Cuenta creada correctamente. Ahora inicia sesión.');
            redirect('login');
        } else {
            $this->session->set_flashdata('error', 'Debes completar todos los campos.');
            redirect('registro');
        }
    }
}

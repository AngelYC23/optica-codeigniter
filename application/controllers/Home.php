<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

  public function index() {
    $data['titulo'] = 'Inicio';
    $data['usuario'] = [
      'logged_in' => $this->session->userdata('logged_in'),
      'nombre'    => $this->session->userdata('usuario_nombre'),
      'email'     => $this->session->userdata('usuario_email'),
      'rol'       => $this->session->userdata('id_rol')
    ];

    $this->load->view('layouts/header', $data);
    $this->load->view('home');
    $this->load->view('layouts/footer');
  }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promociones extends CI_Controller {

  public function index() {
    $data['titulo'] = 'Promociones';
    $data['extra_css'] = ['assets/css/promociones/promociones.css']; 
    $this->load->view('layouts/header', $data);
    $this->load->view('paginas/promociones');
    $this->load->view('layouts/footer');
  }
}

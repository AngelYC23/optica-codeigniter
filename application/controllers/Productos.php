<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

  public function index() {
    $data['titulo'] = 'Productos';
    $data['extra_css'] = ['assets/css/promociones/productos.css']; 
    $this->load->view('layouts/header', $data);
    $this->load->view('paginas/productos');
    $this->load->view('layouts/footer');
  }
}
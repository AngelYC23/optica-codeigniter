<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Pedidos_model');

    if (!$this->session->userdata('logged_in')) {
      redirect('login');
    }
  }

    public function index() {
      $id_usuario = $this->session->userdata('usuario_id');
      $data['titulo'] = 'Mis Compras';
      $data['pedidos'] = $this->Pedidos_model->obtener_pedidos_usuario($id_usuario);

      $this->load->view('layouts/header', $data);
      $this->load->view('paginas/compras', $data);
      $this->load->view('layouts/footer');
    }
}

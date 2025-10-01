<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('Dashboard_model');
  }

  public function index() {
    $fecha_inicio = $this->input->get('fecha_inicio');
    $fecha_fin = $this->input->get('fecha_fin');

     if (!$fecha_inicio || !$fecha_fin) {
      $fecha_inicio = date('Y-m-01');
      $fecha_fin = date('Y-m-t');    
    }

    $data['titulo'] = 'DASHBOARD';
    $data['ventas'] = $this->Dashboard_model->ventas_por_mes($fecha_inicio, $fecha_fin);
    $data['estados'] = $this->Dashboard_model->pedidos_por_estado($fecha_inicio, $fecha_fin);
    $data['top_productos'] = $this->Dashboard_model->productos_mas_vendidos($fecha_inicio, $fecha_fin);
    $data['roles'] = $this->Dashboard_model->usuarios_por_rol();
    $data['stock'] = $this->Dashboard_model->stock_por_categoria();

    $data['fecha_inicio'] = $fecha_inicio;
    $data['fecha_fin'] = $fecha_fin;

    $this->load->view('layouts/header', $data);
    $this->load->view('paginas/dashboard', $data);
    $this->load->view('layouts/footer');
  }

}

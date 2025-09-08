<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

  public function index() {
    $data['titulo'] = 'Inicio';
    $this->load->view('layouts/header', $data);
    $this->load->view('home');
    $this->load->view('layouts/footer');
  }
}

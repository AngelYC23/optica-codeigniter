<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function registrar_usuario($data) {
    return $this->db->insert('usuarios', $data);
  }

  public function obtener_por_email($email) {
    return $this->db->get_where('usuarios', ['email' => $email])->row();
  }
}

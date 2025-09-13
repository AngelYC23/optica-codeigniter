<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function obtener_por_email($email) {
    return $this->db->get_where('usuarios', ['email' => $email, 'activo' => 1])->row();
  }
}

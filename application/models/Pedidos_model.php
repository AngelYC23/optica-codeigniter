<?php
class Pedidos_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function obtener_pedidos_usuario($id_usuario) {
    $this->db->select('id_pedido, fecha, total, estado');
    $this->db->from('pedidos');
    $this->db->where('id_usuario', $id_usuario);
    $this->db->order_by('fecha', 'DESC');
    return $this->db->get()->result();
  }
}

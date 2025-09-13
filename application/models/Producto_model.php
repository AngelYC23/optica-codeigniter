<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function obtener_categorias() {
    return $this->db->get('categorias')->result();
  }

  public function obtener_productos() {
    return $this->db->get('productos')->result();
  }

  public function obtener_producto($id_producto) {
    return $this->db->get_where('productos', ['id_producto' => $id_producto])->row();
  }

  public function insertar($data) {
    return $this->db->insert('productos', $data);
  }

  public function actualizar($id, $data) {
    return $this->db->where('id_producto', $id)->update('productos', $data);
  }

  public function eliminar($id) {
    return $this->db->delete('productos', ['id_producto' => $id]);
  }
}

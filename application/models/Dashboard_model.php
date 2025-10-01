<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

  public function __construct() {
    parent::__construct();
    $this->load->database();
  }

  public function ventas_por_mes($fecha_inicio = null, $fecha_fin = null) {
      $sql = "
        SELECT DATE_FORMAT(fecha, '%Y-%m') AS mes, SUM(total) AS ventas
        FROM pedidos
        WHERE estado = 'pagado'
      ";

      if ($fecha_inicio && $fecha_fin) {
          $sql .= " AND DATE(fecha) BETWEEN " . $this->db->escape($fecha_inicio) . " AND " . $this->db->escape($fecha_fin);
      }

      $sql .= " GROUP BY mes ORDER BY mes";

      return $this->db->query($sql)->result();
  }

  public function pedidos_por_estado($fecha_inicio = null, $fecha_fin = null) {
      $sql = "
        SELECT estado, COUNT(*) AS cantidad
        FROM pedidos
        WHERE 1=1
      ";

      if ($fecha_inicio && $fecha_fin) {
          $sql .= " AND DATE(fecha) BETWEEN " . $this->db->escape($fecha_inicio) . " AND " . $this->db->escape($fecha_fin);
      }

      $sql .= " GROUP BY estado";

      return $this->db->query($sql)->result();
  }

  public function productos_mas_vendidos($fecha_inicio = null, $fecha_fin = null) {
      $sql = "
        SELECT p.nombre, SUM(dp.cantidad) AS vendidos
        FROM detalles_pedido dp
        JOIN productos p ON dp.id_producto = p.id_producto
        JOIN pedidos ped ON dp.id_pedido = ped.id_pedido
        WHERE 1=1
      ";

      if ($fecha_inicio && $fecha_fin) {
          $sql .= " AND DATE(ped.fecha) BETWEEN " . $this->db->escape($fecha_inicio) . " AND " . $this->db->escape($fecha_fin);
      }

      $sql .= " GROUP BY p.nombre ORDER BY vendidos DESC LIMIT 5";

      return $this->db->query($sql)->result();
  }

  public function usuarios_por_rol() {
    return $this->db->query("
      SELECT r.nombre_rol, COUNT(u.id_usuario) AS cantidad
      FROM usuarios u
      JOIN roles r ON u.id_rol = r.id_rol
      GROUP BY r.nombre_rol
    ")->result();
  }

  public function stock_por_categoria() {
    return $this->db->query("
      SELECT c.nombre AS categoria, SUM(p.stock) AS stock_total
      FROM productos p
      JOIN categorias c ON p.id_categoria = c.id_categoria
      GROUP BY c.nombre
    ")->result();
  }
}

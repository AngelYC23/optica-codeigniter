<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prueba_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // carga la conexión
    }

    public function listar_bases() {
        // devuelve las bases de datos para probar la conexión
        $query = $this->db->query("SHOW DATABASES");
        return $query->result();
    }

    public function listar_tablas($bd = 'optica') {
        // cambia a la base de datos indicada
        $this->db->query("USE " . $this->db->escape_str($bd));
        $query = $this->db->query("SHOW TABLES");
        return $query->result();
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @property Prueba_model $Prueba_model
 */

class Prueba extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Prueba_model');
    }

    public function index() {
        echo "<h2>Probando conexión a la BD</h2>";

        // Listar bases
        $bases = $this->Prueba_model->listar_bases();
        echo "<h3>Bases de datos disponibles:</h3><ul>";
        foreach ($bases as $b) {
            echo "<li>" . implode("", (array)$b) . "</li>";
        }
        echo "</ul>";

        // Listar tablas de la BD optica
        $tablas = $this->Prueba_model->listar_tablas('Optica');
        echo "<h3>Tablas en la BD 'Optica':</h3><ul>";
        foreach ($tablas as $t) {
            echo "<li>" . implode("", (array)$t) . "</li>";
        }
        echo "</ul>";
    }
}

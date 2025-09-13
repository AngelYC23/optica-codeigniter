<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_DB $db
 * @property CI_Loader $load
 * @property CI_Session $session
 */
class Categorias extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function index()
    {
        $data['titulo'] = 'Categorías';
        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/categorias/index');
        $this->load->view('layouts/footer');
    }

    public function gafasdelectura()
    {
        $data['titulo'] = 'Gafas de Lectura';
        $data['extra_css'] = ['assets/css/categorias/categoria.css'];
        $categoria = $this->db->get_where('categorias', ['nombre' => 'Gafas de Lectura'])->row_array();
        if ($categoria) {
            $data['productos'] = $this->db
                ->where('id_categoria', $categoria['id_categoria'])
                ->get('productos')
                ->result_array();
        } else {
            $data['productos'] = [];
        }

        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/categorias/Gafasdelectura', $data);
        $this->load->view('layouts/footer');
    }

    public function gafasdesol()
    {
        $data['titulo'] = 'Gafas de Sol';
        $data['extra_css'] = ['assets/css/categorias/categoria.css'];
        $categoria = $this->db->get_where('categorias', ['nombre' => 'Gafas de Sol '])->row_array();
        if ($categoria) {
            $data['productos'] = $this->db
                ->where('id_categoria', $categoria['id_categoria'])
                ->get('productos')
                ->result_array();
        } else {
            $data['productos'] = [];
        }
        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/categorias/Gafasdesol');
        $this->load->view('layouts/footer');
    }

    public function lentesdecontacto()
    {
        $data['titulo'] = 'Lentes de Contacto';
        $data['extra_css'] = ['assets/css/categorias/categoria.css'];
        $categoria = $this->db->get_where('categorias', ['nombre' => 'Lentes de Contacto '])->row_array();
        if ($categoria) {
            $data['productos'] = $this->db
                ->where('id_categoria', $categoria['id_categoria'])
                ->get('productos')
                ->result_array();
        } else {
            $data['productos'] = [];
        }

        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/categorias/Lentesdecontacto');
        $this->load->view('layouts/footer');
    }

    public function monturadeacetato()
    {
        $data['titulo'] = 'Monturas de Acetato';
        $data['extra_css'] = ['assets/css/categorias/categoria.css'];
        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/categorias/Monturadeacetato');
        $this->load->view('layouts/footer');
    }

    public function gafasdeportivas()
    {
        $data['titulo'] = 'Gafas Deportivas';
        $data['extra_css'] = ['assets/css/categorias/categoria.css'];
        $categoria = $this->db->get_where('categorias', ['nombre' => 'Gafas Deportivas'])->row_array();
        if ($categoria) {
            $data['productos'] = $this->db
                ->where('id_categoria', $categoria['id_categoria'])
                ->get('productos')
                ->result_array();
        } else {
            $data['productos'] = [];
        }

        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/categorias/Gafasdeportivas', $data);
        $this->load->view('layouts/footer');
    }


    public function gafasparaninos()
    {
        $data['titulo'] = 'Gafas para Niños';
        $data['extra_css'] = ['assets/css/categorias/categoria.css'];
        $categoria = $this->db->get_where('categorias', ['nombre' => 'Gafas para Niños'])->row_array();
        if ($categoria) {
            $data['productos'] = $this->db
                ->where('id_categoria', $categoria['id_categoria'])
                ->get('productos')
                ->result_array();
        } else {
            $data['productos'] = [];
        }

        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/categorias/Gafasparaninos');
        $this->load->view('layouts/footer');
    }
}

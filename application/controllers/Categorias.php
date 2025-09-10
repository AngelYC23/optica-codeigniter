<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

    public function index() {
        $data['titulo'] = 'Categorías';
        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/categorias/index'); // si tienes un index
        $this->load->view('layouts/footer');
    }

    public function gafasdelectura() {
        $data['titulo'] = 'Gafas de Lectura';
        $data['extra_css'] = ['assets/css/categorias/categoria.css'];
        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/categorias/Gafasdelectura'); 
        $this->load->view('layouts/footer');
    }

    public function gafasdesol() {
        $data['titulo'] = 'Gafas de Sol';
        $data['extra_css'] = ['assets/css/categorias/categoria.css'];
        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/categorias/Gafasdesol');
        $this->load->view('layouts/footer');
    }

    public function lentesdecontacto() {
        $data['titulo'] = 'Lentes de Contacto';
        $data['extra_css'] = ['assets/css/categorias/categoria.css'];
        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/categorias/Lentesdecontacto');
        $this->load->view('layouts/footer');
    }

    public function monturadeacetato() {
        $data['titulo'] = 'Monturas de Acetato';
        $data['extra_css'] = ['assets/css/categorias/categoria.css'];
        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/categorias/Monturadeacetato');
        $this->load->view('layouts/footer');
    }

    public function gafasdeportivas() {
        $data['titulo'] = 'Gafas Deportivas';
        $data['extra_css'] = ['assets/css/categorias/categoria.css'];
        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/categorias/Gafasdeportivas');
        $this->load->view('layouts/footer');
    }

    public function gafasparaninos() {
        $data['titulo'] = 'Gafas para Niños';
        $data['extra_css'] = ['assets/css/categorias/categoria.css'];
        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/categorias/Gafasparaninos');
        $this->load->view('layouts/footer');
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gestion_articulos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Producto_model');
        $this->load->library(['session', 'upload']);
        $this->load->helper(['form', 'url']);
    }

    public function index() {
        $data['titulo'] = 'Mantenimiento de Productos';
        $data['productos'] = $this->Producto_model->obtener_productos();
        $data['categorias'] = $this->Producto_model->obtener_categorias();

        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/gestion_articulos', $data);
        $this->load->view('layouts/footer');
    }

    public function editar($id_producto) {
        $data['titulo'] = 'Mantenimiento de Productos';
        $data['productos'] = $this->Producto_model->obtener_productos();
        $data['categorias'] = $this->Producto_model->obtener_categorias();
        $data['producto']   = $this->Producto_model->obtener_producto($id_producto);

        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/gestion_articulos', $data);
        $this->load->view('layouts/footer');
    }

    public function guardar() {
        $config['upload_path']   = './uploads/productos/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;

        $this->upload->initialize($config);

        $imagen = null;
        if ($this->upload->do_upload('imagen')) {
            $imagen = $this->upload->data('file_name');
        }

        $data = [
            'nombre'       => $this->input->post('nombre'),
            'descripcion'  => $this->input->post('descripcion'),
            'precio'       => $this->input->post('precio'),
            'stock'        => $this->input->post('stock'),
            'id_categoria' => $this->input->post('id_categoria'),
        ];

        if ($imagen) {
            $data['imagen'] = $imagen;
        }

        if ($this->input->post('id_producto')) {
            $this->db->where('id_producto', $this->input->post('id_producto'));
            $this->db->update('productos', $data);
        } else {
            $this->db->insert('productos', $data);
        }

        redirect('gestion_articulos');
    }

    public function eliminar($id_producto) {
        if ($id_producto) {
            $this->Producto_model->eliminar($id_producto);
        }
        redirect('gestion_articulos');
    }

}

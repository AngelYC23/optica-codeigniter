<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_DB_query_builder $db
 * @property CI_Input $input
 */

class Carrito extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
    }

    // Mostrar carrito
   public function index() {
        $carrito = $this->session->userdata('carrito') ?? [];
        $data['carrito'] = $carrito;
        $data['titulo'] = 'Carrito de Compras';

        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/carrito', $data);
        $this->load->view('layouts/footer');
    }

    // Agregar producto
   public function agregar($id_producto) {
    // Simulamos productos
    $productos = [
        1 => [
            'id' => 1,
            'nombre' => 'Foster Grant +2.0 Gafas de Lectura Clansy Lola 3 Unidades',
            'precio' => 250,
            'imagen' => 'lec1.jpg'
        ],
        2 => [
            'id' => 2,
            'nombre' => '1-Day Acuvue® Moist',
            'precio' => 350,
            'imagen' => 'contacto1.png.webp'
        ],
        3 => [
            'id' => 3,
            'nombre' => 'Biofinity®',
            'precio' => 400,
            'imagen' => 'contacto4.png'
        ]
    ];

    if(isset($productos[$id_producto])){
        $producto = $productos[$id_producto];
        $carrito = $this->session->userdata('carrito') ?? [];

        // Revisamos si el producto ya está en el carrito
        $encontrado = false;
        foreach($carrito as &$item){
            if($item['id'] == $producto['id']){
                $item['cantidad'] += 1; // sumamos cantidad
                $encontrado = true;
                break;
            }
        }
        if(!$encontrado){
            $carrito[] = [
                'id' => $producto['id'],
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => 1,
                'imagen' => $producto['imagen']
            ];
        }

        $this->session->set_userdata('carrito', $carrito);
    }

    redirect(base_url('index.php/productos'));
}


    // Actualizar cantidad
    public function actualizar() {
        $index = $this->input->post('index');
        $cantidad = $this->input->post('cantidad');
        $carrito = $this->session->userdata('carrito');

        if(isset($carrito[$index])){
            $carrito[$index]['cantidad'] = $cantidad;
            $this->session->set_userdata('carrito', $carrito);
        }
        redirect(base_url('index.php/carrito'));
    }

    // Eliminar producto
    public function eliminar($index) {
        $carrito = $this->session->userdata('carrito');
        if(isset($carrito[$index])){
            unset($carrito[$index]);
            $carrito = array_values($carrito); // reindexar
            $this->session->set_userdata('carrito', $carrito);
        }
        redirect(base_url('index.php/carrito'));
    }

    // Finalizar compra (solo ejemplo)
    public function finalizar() {
        $this->session->unset_userdata('carrito'); // vacía el carrito
        echo "<p>Compra finalizada con éxito. Gracias por tu compra!</p>";
    }
}

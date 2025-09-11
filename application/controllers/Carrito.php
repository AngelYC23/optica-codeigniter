<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_DB_query_builder $db
 * @property CI_Input $input
 * @property CI_User_agent $agent
 */

class Carrito extends CI_Controller {

    public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('session');
    $this->load->library('user_agent'); // Para regresar a la página anterior
    $this->load->database(); // Cargamos DB globalmente
}


    // Mostrar carrito
   public function index() {
        $carrito = $this->session->userdata('carrito') ?? [];
        $data['carrito'] = $carrito;
        $data['titulo'] = 'Carrito de Compras';
        $data['extra_css'] = ['assets/css/carrito.css'];
        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/carrito', $data);
        $this->load->view('layouts/footer');
    }

    // Agregar producto
   public function agregar($id_producto) {
    // Cargar base de datos
    $this->load->database();

    // Obtener producto desde la DB
    $producto = $this->db->get_where('productos', ['id_producto' => $id_producto])->row_array();

    if($producto){
        $carrito = $this->session->userdata('carrito') ?? [];

        // Revisar si el producto ya está en el carrito
        $encontrado = false;
        foreach($carrito as &$item){
            if($item['id'] == $producto['id_producto']){
                $item['cantidad'] += 1; // sumamos cantidad
                $encontrado = true;
                break;
            }
        }
        if(!$encontrado){
            $carrito[] = [
                'id' => $producto['id_producto'],
                'nombre' => $producto['nombre'],
                'precio' => $producto['precio'],
                'cantidad' => 1,
                'imagen' => $producto['imagen']
            ];
        }

        $this->session->set_userdata('carrito', $carrito);
    }

    // Redirigir a la misma página desde donde vino
    redirect($this->agent->referrer());
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
// Checkout: mostrar vista para seleccionar método de pago
public function checkout() {
    $carrito = $this->session->userdata('carrito') ?? [];
    if(empty($carrito)){
        redirect('carrito'); // si carrito vacío
    }
    $data['titulo'] = 'Finalizar Compra';
    $data['carrito'] = $carrito;
    $data['extra_css'] = ['assets/css/checkout.css'];
    $this->load->view('layouts/header', $data);
    $this->load->view('paginas/checkout', $data);
    $this->load->view('layouts/footer');
}

// Procesar compra: guardar pedido y detalles
public function procesar() {
    $carrito = $this->session->userdata('carrito') ?? [];
    if(empty($carrito)){
        redirect('carrito');
    }

    $metodo_pago = $this->input->post('metodo_pago'); // si quieres guardarlo, crea campo extra
    $total = 0;
    foreach($carrito as $item){
        $total += $item['precio'] * $item['cantidad'];
    }

    // Suponiendo que no tienes usuarios logueados, pon id_usuario = 1
    $this->db->insert('pedidos', [
        'id_usuario' => 1, // cambiar si tienes login
        'total' => $total,
        'estado' => 'pendiente',
        'fecha' => date('Y-m-d H:i:s')
    ]);
    
    $id_pedido = $this->db->insert_id();

    // Guardar detalles
    foreach($carrito as $item){
        $this->db->insert('detalles_pedido', [
            'id_pedido' => $id_pedido,
            'id_producto' => $item['id'],
            'cantidad' => $item['cantidad'],
            'precio_unitario' => $item['precio']
        ]);
    }

    // Vaciar carrito
    $this->session->unset_userdata('carrito');

    // Redirigir a factura
    redirect('carrito/factura/'.$id_pedido);
}

// Mostrar factura
public function factura($id_pedido) {
    $pedido = $this->db->get_where('pedidos', ['id_pedido' => $id_pedido])->row_array();
    $detalles = $this->db->select('dp.*, p.nombre')
                         ->from('detalles_pedido dp')
                         ->join('productos p', 'dp.id_producto = p.id_producto')
                         ->where('dp.id_pedido', $id_pedido)
                         ->get()
                         ->result_array();

    $data['pedido'] = $pedido;
    $data['detalles'] = $detalles;
    $this->load->view('paginas/factura', $data);
}


    
}

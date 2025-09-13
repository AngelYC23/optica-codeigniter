<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session $session
 * @property CI_DB_query_builder $db
 * @property CI_Input $input
 * @property CI_User_agent $agent
 */

require_once FCPATH . 'vendor/autoload.php'; // 👈 carga mPDF
use Mpdf\Mpdf;

class Carrito extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('user_agent');
        $this->load->database();
    }

    public function index() {
        $carrito = $this->session->userdata('carrito') ?? [];
        $data['carrito'] = $carrito;
        $data['titulo'] = 'Carrito de Compras';
        $data['extra_css'] = ['assets/css/carrito.css'];
        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/carrito', $data);
        $this->load->view('layouts/footer');
    }

    public function agregar($id_producto) {
        $this->load->database();
        $producto = $this->db->get_where('productos', ['id_producto' => $id_producto])->row_array();

        if($producto){
            $carrito = $this->session->userdata('carrito') ?? [];
            $encontrado = false;
            foreach($carrito as &$item){
                if($item['id'] == $producto['id_producto']){
                    $item['cantidad'] += 1;
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
        redirect($this->agent->referrer());
    }

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

    public function eliminar($index) {
        $carrito = $this->session->userdata('carrito');
        if(isset($carrito[$index])){
            unset($carrito[$index]);
            $carrito = array_values($carrito);
            $this->session->set_userdata('carrito', $carrito);
        }
        redirect(base_url('index.php/carrito'));
    }

    public function checkout() {
        $carrito = $this->session->userdata('carrito') ?? [];
        if(empty($carrito)){
            redirect('carrito');
        }
        $data['titulo'] = 'Finalizar Compra';
        $data['carrito'] = $carrito;
        $data['extra_css'] = ['assets/css/checkout.css'];
        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/checkout', $data);
        $this->load->view('layouts/footer');
    }

    public function procesar() {
        $carrito = $this->session->userdata('carrito') ?? [];
        if (empty($carrito)) {
            redirect('carrito');
        }

        $id_usuario = $this->session->userdata('logged_in') ? $this->session->userdata('usuario_id') : 1;

        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        $this->db->insert('pedidos', [
            'id_usuario' => $id_usuario,
            'total'      => $total,
            'estado'     => 'pagado',
            'fecha'      => date('Y-m-d H:i:s')
        ]);
        
        $id_pedido = $this->db->insert_id();

        foreach ($carrito as $item) {
            $this->db->insert('detalles_pedido', [
                'id_pedido'      => $id_pedido,
                'id_producto'    => $item['id'],
                'cantidad'       => $item['cantidad'],
                'precio_unitario'=> $item['precio']
            ]);
        }

        $this->session->unset_userdata('carrito');

        $urlFactura = base_url("index.php/carrito/factura/".$id_pedido);
        $urlHome = base_url("index.php/productos");

        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>Procesando...</title>
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    text-align: center; 
                    padding: 50px;
                    background-color: #f8f9fa;
                }
                .loading {
                    display: inline-block;
                    width: 40px;
                    height: 40px;
                    border: 4px solid #f3f3f3;
                    border-top: 4px solid #007bff;
                    border-radius: 50%;
                    animation: spin 1s linear infinite;
                }
                @keyframes spin {
                    0% { transform: rotate(0deg); }
                    100% { transform: rotate(360deg); }
                }
            </style>
        </head>
        <body>
            <h2>¡Pedido completado exitosamente!</h2>
            <div class='loading'></div>
            <p>Generando factura y redirigiendo...</p>
            
            <script>
                // Abrir factura inmediatamente
                var facturaWindow = window.open('{$urlFactura}', '_blank', 'width=800,height=600,scrollbars=yes,resizable=yes');
                
                // Verificar si la ventana se abrió correctamente
                if (facturaWindow) {
                    // Esperar 2 segundos y redirigir
                    setTimeout(function() {
                        window.location.href = '{$urlHome}';
                    }, 2000);
                } else {
                    // Si el popup fue bloqueado, mostrar enlace manual
                    document.body.innerHTML = `
                        <h2>¡Pedido completado!</h2>
                        <p>Tu navegador bloqueó la ventana emergente.</p>
                        <a href='{$urlFactura}' target='_blank' style='display:inline-block; padding:10px 20px; background:#007bff; color:white; text-decoration:none; border-radius:5px; margin:10px;'>Descargar Factura</a>
                        <a href='{$urlHome}' style='display:inline-block; padding:10px 20px; background:#28a745; color:white; text-decoration:none; border-radius:5px; margin:10px;'>Continuar Comprando</a>
                    `;
                }
            </script>
        </body>
        </html>";
        exit;
    }

    public function factura($id_pedido) {
        $pedido = $this->db->get_where('pedidos', ['id_pedido' => $id_pedido])->row_array();
        
        if (!$pedido) {
            show_404();
            return;
        }

        $detalles = $this->db->select('dp.*, p.nombre')
                            ->from('detalles_pedido dp')
                            ->join('productos p', 'dp.id_producto = p.id_producto')
                            ->where('dp.id_pedido', $id_pedido)
                            ->get()
                            ->result_array();

        $html = "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <title>Factura #{$pedido['id_pedido']}</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .header { text-align: center; margin-bottom: 30px; }
                .info { margin-bottom: 20px; }
                table { width: 100%; border-collapse: collapse; margin: 20px 0; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f2f2f2; font-weight: bold; }
                .total-row { font-weight: bold; background-color: #f8f8f8; }
                .text-right { text-align: right; }
            </style>
        </head>
        <body>
            <div class='header'>
                <h1>FACTURA #{$pedido['id_pedido']}</h1>
            </div>
            
            <div class='info'>
                <p><strong>Estado:</strong> ".ucfirst($pedido['estado'])."</p>
                <p><strong>Fecha:</strong> ".date('d/m/Y H:i', strtotime($pedido['fecha']))."</p>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th class='text-right'>Cantidad</th>
                        <th class='text-right'>Precio Unitario</th>
                        <th class='text-right'>Subtotal</th>
                    </tr>
                </thead>
                <tbody>";

        $total = 0;
        foreach ($detalles as $d) {
            $subtotal = $d['precio_unitario'] * $d['cantidad'];
            $total += $subtotal;

            $html .= "
                <tr>
                    <td>{$d['nombre']}</td>
                    <td class='text-right'>{$d['cantidad']}</td>
                    <td class='text-right'>Q".number_format($d['precio_unitario'], 2)."</td>
                    <td class='text-right'>Q".number_format($subtotal, 2)."</td>
                </tr>";
        }

        $html .= "
                <tr class='total-row'>
                    <td colspan='3' class='text-right'><strong>TOTAL</strong></td>
                    <td class='text-right'><strong>Q".number_format($total, 2)."</strong></td>
                </tr>
            </tbody>
        </table>
        
        <div style='margin-top: 40px; text-align: center; color: #666;'>
            <p>¡Gracias por tu compra!</p>
        </div>
        </body>
        </html>";

        try {
            $mpdf = new Mpdf([
                'mode' => 'utf-8',
                'format' => 'A4',
                'orientation' => 'P',
                'margin_left' => 15,
                'margin_right' => 15,
                'margin_top' => 15,
                'margin_bottom' => 15
            ]);
            
            $mpdf->WriteHTML($html);
            
            $filename = "Factura_{$pedido['id_pedido']}.pdf";
            
            if (ob_get_level()) {
                ob_end_clean();
            }

            $mpdf->Output($filename, "I");
            
        } catch (Exception $e) {
            log_message('error', 'Error generando PDF: ' . $e->getMessage());
            show_error('Error al generar la factura. Por favor, inténtalo de nuevo.');
        }
    }

    
}

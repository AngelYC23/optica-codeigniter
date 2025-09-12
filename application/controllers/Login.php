<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Aseguramos que la librería session esté cargada
        $this->load->library('session');
    }





    // Muestra la vista del formulario de login
    public function index() {
        // Pasamos flashdata a la vista como variables (evita usar $this->session en la vista)
        $data = [
            'title'       => 'Login - OVC',
            'error_msg'   => $this->session->flashdata('error'),
            'success_msg' => $this->session->flashdata('success'),
            
            
        ];

        // Si usas header/footer en layouts, pásales $data también (opcional)
        $data['extra_css'] = ['assets/css/stylelogin.css']; 
        $this->load->view('layouts/header', $data);
        $this->load->view('paginas/login', $data);
        $this->load->view('layouts/footer', $data);
        
        
    }

    // Procesa el formulario
    public function autenticar() {
        // Recibe los datos enviados por POST
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $remember = $this->input->post('remember'); // si lo usarás

        // Ejemplo simple (tu compañero reemplaza con consulta a BD y password_verify)
        if ($email === "optica@gmail.com" && $password === "123") {
            // Marcar sesión como iniciada
            $this->session->set_userdata('logged_in', true);
            $this->session->set_userdata('user_email', $email);

            // Redirigir al home (controlador Home)
            redirect('home');
        } else {
            // Guardar mensaje de error para mostrar en el login
            $this->session->set_flashdata('error', 'Usuario o contraseña incorrectos.');
            redirect('login');
        }
    }

    // Opcional: cerrar sesión
    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}

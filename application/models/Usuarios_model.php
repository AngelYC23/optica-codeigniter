<?php
class Usuarios_model extends CI_Model {

    public function guardar_usuario($data) {
        $this->db->insert('usuarios', $data);
        return $this->db->insert_id();
    }

    public function obtener_usuarios() {
        $this->db->select('u.id_usuario, u.nombre, u.email, u.id_rol, r.nombre_rol, u.fecha_creacion, u.activo');
        $this->db->from('usuarios u');
        $this->db->join('roles r', 'u.id_rol = r.id_rol', 'left');
        $this->db->order_by('u.fecha_creacion', 'DESC');
        return $this->db->get()->result();
    }

    public function obtener_usuario($id_usuario) {
        $this->db->select('u.id_usuario, u.nombre, u.email, u.id_rol, r.nombre_rol, u.fecha_creacion, u.activo');
        $this->db->from('usuarios u');
        $this->db->join('roles r', 'u.id_rol = r.id_rol', 'left');
        $this->db->where('u.id_usuario', $id_usuario);
        return $this->db->get()->row();
    }

    public function cambiar_rol($id_usuario, $nuevo_rol) {
        $this->db->set('id_rol', $nuevo_rol);
        $this->db->where('id_usuario', $id_usuario);
        return $this->db->update('usuarios');
    }

    public function eliminar($id_usuario) {
        return $this->db->delete('usuarios', ['id_usuario' => $id_usuario]);
    }

    public function cambiar_password($id_usuario, $nueva_pass) {
        $hash = password_hash($nueva_pass, PASSWORD_BCRYPT);
        $this->db->set('password', $hash);
        $this->db->where('id_usuario', $id_usuario);
        return $this->db->update('usuarios');
    }
}

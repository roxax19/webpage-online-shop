<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Model
{

    /**Ponemos el valor de primary key como usuario id
     * Antes de crear nuevo usuario hay que comprobar que el usuario esta en la db
     */

    public $usuario_id;
    public $usuario_nombre;
    public $usuario_contrasena;
    /**habria que cambiarlo a hash */
    public $usuario_email;

    public function busquedaUsuario($nombreUsuario)
    {
        $query = $this->db->get_where('usuarios', array('usuario_nombre' => $nombreUsuario));

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return 1;
        }
    }

    public function busquedaEmail($emailUsuario)
    {
        $query = $this->db->get_where('usuarios', array('usuario_email' => $emailUsuario));

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return 1;
        }
    }

    public function creacionUsuario($email, $nombre, $contrasena)
    {
        $data = array(
            'usuario_email' => $email,
            'usuario_nombre' => $nombre,
            'usuario_contrasena' => $contrasena
        );

        $this->db->insert('usuarios', $data);
    }
}

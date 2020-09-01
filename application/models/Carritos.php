<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carritos extends CI_Model
{
    /* Cada clase es una tabla de la base de datos 
	Campos de la base de datos*/
    public $usuario_id;
    public $producto_id;
    public $primkey;

    public function productosDeUsuario($id)
    {
        $query = $this->db->get_where('carritos', array('usuario_id' => $id));

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 1;
        }
    }

    public function anadirProducto($id_producto, $id_usuario, $cantidad)
    {

        //Tenemos que ver si el producto ya esta en la tabla
        $query = $this->db->get_where(
            'carritos',
            array(
                'usuario_id' => $id_usuario,
                'producto_id' => $id_producto
            )
        );

        if ($query->num_rows() > 0) {
            //Ya esta en la tabla. Sumamos la cantidad.

            //El false lo que hace es quitar el escape de caracteres,
            //Pero en teoria aqui no necesitamos, porque estoy controlando yo la entrada
            $this->db->set('cantidad', 'cantidad+' . strval($cantidad), FALSE);
            $this->db->where(
                array(
                    'usuario_id' => $id_usuario,
                    'producto_id' => $id_producto
                )
            );
            $this->db->update('carritos');
        } else {
            //No esta en la tabla. Anadimos uno

            $data = array(
                'usuario_id' => $id_usuario,
                'producto_id' => $id_producto,
                'cantidad' => $cantidad
            );

            $this->db->insert('carritos', $data);
        }
    }

    public function eliminarDeCarrito($id_producto, $id_usuario)
    {
        $this->db->delete('carritos', array(
            'producto_id' => $id_producto,
            'usuario_id' => $id_usuario
        ));
    }

    public function vaciarCarritoUsuario($id_usuario)
    {

        $this->db->delete('carritos', array(
            'usuario_id' => $id_usuario
        ));
    }
}

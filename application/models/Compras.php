<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Compras extends CI_Model
{

    /**VAMOS A TRATAR ESTA TABLA COMO TEMPORAL
     * NO SE VAN A GUARDAR DIRECCIONES DE USUARIO PARA OTROS ENVIOS
     */

    /* Cada clase es una tabla de la base de datos 
    Campos de la base de datos
    primkey	usuario_id	producto_id	cantidad	estado*/

    public $primkey;
    public $usuario_id;
    public $producto_id;
    public $cantidad;
    public $estado;

    public function guardarCompra($usuario_id, $producto_id, $cantidad, $estado)
    {

        //Tenemos que ver si el producto ya esta en la tabla
        $query = $this->db->get_where(
            'compras',
            array(
                'usuario_id' => $usuario_id,
                'producto_id' => $producto_id,
                'estado' => $estado
            )
        );

        if ($query->num_rows() > 0) {
            //Ya esta en la tabla. Sumamos la cantidad.

            //El false lo que hace es quitar el escape de caracteres,
            //Pero en teoria aqui no necesitamos, porque estoy controlando yo la entrada
            $this->db->set('cantidad', 'cantidad+' . strval($cantidad), FALSE);
            $this->db->where(
                array(
                    'usuario_id' => $usuario_id,
                    'producto_id' => $producto_id,
                    'estado' => $estado
                )
            );
            $this->db->update('compras');
        } else {
            //No esta en la tabla. Anadimos uno

            $data = array(
                'usuario_id' => $usuario_id,
                'producto_id' => $producto_id,
                'cantidad' => $cantidad,
                'estado' => $estado,
            );

            $this->db->insert('compras', $data);
        }

    }

    public function seleccionarConUsuario($usuario_id)
    {
        $query = $this->db->get_where('compras', array('usuario_id' => $usuario_id));

        if ($query->num_rows() > 0) {
            $compra = $query->result();
            return $compra;
        } else {
            return 1;
        }
    }

    public function seleccionarConUsuarioYEstado($usuario_id, $estado)
    {
        $query = $this->db->get_where(
            'compras',
            array(
                'usuario_id' => $usuario_id,
                'estado' => $estado
            )
        );

        if ($query->num_rows() > 0) {
            $compra = $query->result();
            return $compra;
        } else {
            return 1;
        }
    }

    public function eliminarComprasUsuario($usuario_id)
    {
        $this->db->delete('compras', array(
            'usuario_id' => $usuario_id
        ));
    }

    public function eliminarComprasUsuarioYEstado($usuario_id, $estado)
    {
        $this->db->delete('compras', array(
            'usuario_id' => $usuario_id,
            'estado' => $estado
        ));
    }

    public function eliminarDeCompras($id_producto, $id_usuario)
    {
        $this->db->delete('compras', array(
            'producto_id' => $id_producto,
            'usuario_id' => $id_usuario
        ));
    }

    public function cambiarEstadoComprasUsuario($id_usuario, $estado_actual, $estado_deseado){
        $this->db->set('estado', $estado_deseado);
            $this->db->where(
                array(
                    'usuario_id' => $id_usuario,
                    'estado' => $estado_actual
                )
            );
            $this->db->update('compras');
    }





}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productos extends CI_Model
{
    /* Cada clase es una tabla de la base de datos 
    Campos de la base de datos*/
    public $producto_id;
    public $categoria_id;
    public $precio;
    public $imagen;

    public function select($limit, $offset)
    {
        $query = $this->db->get('productos', $limit, $offset);
        $productos = $query->result();
        return $productos;
    }

    public function productoConcreto($id)
    {
        $query = $this->db->get_where(
            'productos',
            array('producto_id' => $id,)
        );

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return 1;
        }
    }

    public function todosLosPrductos($limit, $offset){

        $query = $this->db->get('productos', $limit, $offset);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 1;
        }


    }

    public function productoDeCategoria($categoria, $limit, $offset)
    {
        $this->db->like('categoria_id', $categoria);
        $query = $this->db->get('productos', $limit, $offset);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 1;
        }
    }

    public function productosDeCarrito($carrito)
    {

        //Añadimos esto pq no se si se puede usar or_where directamente
        //Sabemos que ninguno deberia tener id=0
        $this->db->where('producto_id', 0);

        foreach ($carrito as $producto) {
            $this->db->or_where('producto_id', $producto->producto_id);
        }

        $query = $this->db->get('productos');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 1;
        }
    }
}

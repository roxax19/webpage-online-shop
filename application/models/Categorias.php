<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categorias extends CI_Model
{
    /* Cada clase es una tabla de la base de datos 
	Campos de la base de datos*/
    public $categoria_id;
    public $categoria_nombre;

    public function select()
    {

        $query = $this->db->get('categorias');
        $productos = $query->result();
        return $productos;
    }

    public function selectConLyO($limit, $offset)
    {

        $query = $this->db->get('categorias', $limit, $offset);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return 1;
        }
    }

    public function buscarNombreDesdeId($catID)
    {

        $query = $this->db->get_where('categorias', array('categoria_id' => $catID));

        if ($query->num_rows() > 0) {
            $categoria = $query->row();
            return $categoria->categoria_nombre;
        } else {
            return 1;
        }
    }
}

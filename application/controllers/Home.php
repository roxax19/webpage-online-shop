<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    /* ----- Tabla: Categorias ----- */

    private function _selectCategorias()
    {
        $this->load->model('categorias');
        $tablaCategorias = new Categorias;

        return $tablaCategorias->select();
    }

    private function _selectCategoriasDestacadas()
    {
        $this->load->model('categorias');
        $tablaCategorias = new Categorias;

        return $tablaCategorias->selectConLyO(3, 0);
    }

    private function _productosDestacados()
    {
        $this->load->model('productos');
        $tablaProductos = new Productos;

        return $tablaProductos->todosLosPrductos(3, 0);
    }

    public function index()
    {

        /* ----- Vistas ----- */

        $this->load->helper('url');
        $this->load->library('session');

        $this->load->view('common/headhtml');
        /**Contiene inicio body */
        $this->load->view('common/header');

        $aside['categorias'] = $this->_selectCategorias();
        $this->load->view('common/aside', $aside);
        /**Contiene el inicio de content */

        $datos['categoriasDestacadas'] = $this->_selectCategoriasDestacadas();
        $datos['productosDestacados'] = $this->_productosDestacados();
        $this->load->view('home/home', $datos);
        $this->load->view('common/footer');
        /**Contiene el fin de content */
    }
}

<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categoria extends CI_Controller
{

    /* ----- Tabla: Categorias ----- */

    private function _selectCategorias()
    {
        $this->load->model('categorias');
        $tablaCategorias = new Categorias;

        return $tablaCategorias->select();
    }

    private function _nombreCategoria($catID)
    {
        $this->load->model('categorias');
        $tablaProductos = new Categorias;

        return $tablaProductos->buscarNombreDesdeId($catID);
    }

    /* ----- Tabla: Productos ----- */

    private function _selectProductosDeCategoria($categoria, $limit, $offset)
    {
        $this->load->model('productos');
        $tablaProductos = new Productos;

        return $tablaProductos->productoDeCategoria($categoria, $limit, $offset);
    }

    public function index()
    {

        /* ----- Librerias ----- */


        $this->load->helper('url');
        $this->load->library('session');


        /* ----- Comprobaciones de acceso ----- */
        

        /**Vemos si nos han pasado una categoria*/
        if (!isset($_GET['categoria'])) {
            redirect('Home', 'refresh');
        }

        /**Comprobamos si nos han pasado una de las categorias que tenemos */
        $nombreCategoria = $this->_nombreCategoria($_GET['categoria']);
        if(is_int($nombreCategoria)){
            redirect('Home', 'refresh');
        }


        /* ----- Vistas ----- */


        $this->load->view('common/headhtml');
        /**Contiene inicio body */
        $this->load->view('common/header');

        /**El aside lee las categorias de la base de datos */
        $aside['categorias'] = $this->_selectCategorias();
        $this->load->view('common/aside', $aside);
        /**Contiene el inicio de content */        

        $productos['productos'] = $this->_selectProductosDeCategoria($_GET['categoria'], 9, 0);

        $productos['categoriaActual'] = $nombreCategoria;
        $this->load->view('categoria/categoria', $productos);

        //intentar mostrar los productos por pantalla desde aqui, o las categorias de dentro
        $this->load->view('common/footer');
        /**Contiene el fin de content */
    }
}

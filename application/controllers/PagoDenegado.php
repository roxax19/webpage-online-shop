<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PagoDenegado extends CI_Controller
{

    /* ----- Tabla: Categorias ------ */

    private function _selectCategorias()
    {
        $this->load->model('categorias');
        $tablaCategorias = new Categorias;

        return $tablaCategorias->select();
    }

    /* ----- Tabla: Compras ------ */

    private function _eliminarComprasUsuarioYEstado($usuario_id, $estado)
    {
        $this->load->model('Compras');
        $tablaCompras = new Compras;

        $tablaCompras->eliminarComprasUsuarioYEstado($usuario_id, $estado);
    }

    /* ----- Tabla: Datos Envios ------ */

    public function _eliminarDatosEnvioUsuario($usuario_id)
    {
        $this->load->model('DatosEnvios');
        $tablaDatosEnvios = new DatosEnvios;

        $tablaDatosEnvios->eliminarDatosEnvioUsuario($usuario_id);
    }

    public function index()
    {

        /* ----- Librerias ----- */

        $this->load->helper('url');
        $this->load->library('session');

        /* ----- Operaciones ----- */

        /**Tenemos que:
         * Eliminar las compras que esten en proceso
         * Eliminar la direccion temporal
         */

        $this->_eliminarComprasUsuarioYEstado($this->session->id, "En proceso");
        $this->_eliminarDatosEnvioUsuario($this->session->id);


        /* ----- Vistas ----- */

        $this->load->helper('url');
        $this->load->library('session');

        $this->load->view('common/headhtml');
        /**Contiene inicio body */
        $this->load->view('common/header');

        $aside['categorias'] = $this->_selectCategorias();
        $this->load->view('common/aside', $aside);
        /**Contiene el inicio de content */

        $this->load->view('pago/pagoDenegado');
        $this->load->view('common/footer');
        /**Contiene el fin de content */
    }
    
}
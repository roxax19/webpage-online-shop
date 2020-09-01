<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PagoAceptado extends CI_Controller
{

    /* ----- Tabla: Compras ------ */

    private function _cambiarEstadoComprasUsuario($usuario_id, $estado_actual, $estado_deseado)
    {
        $this->load->model('Compras');
        $tablaCompras = new Compras;

        $tablaCompras->cambiarEstadoComprasUsuario($usuario_id, $estado_actual, $estado_deseado);
    }

    private function _productosDeUsuarioYEstado($id, $estado)
    {

        $this->load->model('Compras');
        $tablaCompras = new Compras;

        return $tablaCompras->seleccionarConUsuarioYEstado($id, $estado);
    }

    private function _guardarCompra($usuario_id, $producto_id, $cantidad, $estado)
    {

        $this->load->model('Compras');
        $tablaCompras = new Compras;

        return $tablaCompras->guardarCompra($usuario_id, $producto_id, $cantidad, $estado);
    }

    private function _eliminarComprasUsuarioYEstado($usuario_id, $estado)
    {

        $this->load->model('Compras');
        $tablaCompras = new Compras;

        return $tablaCompras->eliminarComprasUsuarioYEstado($usuario_id, $estado);
    }   

    /* ----- Tabla: Datos Envios ------ */

    public function _eliminarDatosEnvioUsuario($usuario_id)
    {
        $this->load->model('DatosEnvios');
        $tablaDatosEnvios = new DatosEnvios;

        $tablaDatosEnvios->eliminarDatosEnvioUsuario($usuario_id);
    }

    /* ----- Tabla: Carritos ------ */

    public function _vaciarCarritoUsuario($id_usuario)
    {

        $this->load->model('Carritos');
        $tablaCarritos = new Carritos;

        $tablaCarritos->vaciarCarritoUsuario($id_usuario);
    }

    public function index()
    {

        /* ----- Librerias ----- */

        $this->load->helper('url');
        $this->load->library('session');

        /* ----- Comprobaciones de acceso ----- */

        //Si accedemos aqui, tiene que haber alguna compra en proceso:
        $comprasEnProceso = $this->_productosDeUsuarioYEstado($this->session->id, "En proceso");
        if (is_int($comprasEnProceso)) {
            redirect('PagoDenegado', 'refresh');
        }

        /* ----- Operaciones ----- */

        /**Tenemos que:
         * Cambiar las compras de en proceso a enviado
         * Para esto, tenemos que tener en cuenta los productos que ya hay almacenados en la tabla
         * Eliminar la direccion temporal
         * Vaciar el carrito
         */

        /**Tenemos que obtener las compras en proceso, e ir guardando las compras una a una en Enviado
         * Despues, eliminar las que estan en proceso
         */


        foreach($comprasEnProceso as $compra){
            $this->_guardarCompra($this->session->id, $compra->producto_id, $compra->cantidad, "Enviado");
        }
        $this->_eliminarComprasUsuarioYEstado($this->session->id, "En proceso");

        $this->_eliminarDatosEnvioUsuario($this->session->id);
        $this->_vaciarCarritoUsuario($this->session->id);


        /**Ahora redirigimos al usuario a su pagina de compras realizadas */

        redirect('ListaCompras', 'refresh');
    }
}
?>
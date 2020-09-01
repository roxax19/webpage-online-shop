<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ListaCompras extends CI_Controller
{

    /* ----- Tabla: Categorias ----- */

    private function _selectCategorias()
    {
        $this->load->model('categorias');
        $tablaCategorias = new Categorias;

        return $tablaCategorias->select();
    }

    /* ----- Tabla: Compras ----- */

    private function _productosDeUsuario($id)
    {

        $this->load->model('Compras');
        $tablaCompras = new Compras;

        return $tablaCompras->seleccionarConUsuario($id);
    }

    private function _productosDeUsuarioYEstado($id, $estado)
    {

        $this->load->model('Compras');
        $tablaCompras = new Compras;

        return $tablaCompras->seleccionarConUsuarioYEstado($id, $estado);
    }

    private function _eliminarProducto($id_prod)
    {

        $this->load->model('Compras');
        $tablaCompras = new Compras;

        return $tablaCompras->eliminarDeCompras($id_prod, $this->session->id);
    }

    /* ----- Tabla: Productos ----- */

    private function _variosIDDeProducto($compras)
    {
        //Devuelve varios objetos Producto
        $this->load->model('productos');
        $tablaProductos = new Productos;

        return $tablaProductos->productosDeCarrito($compras);
    }

    public function index()
    {
        /* ----- Librerias ----- */


        $this->load->helper(array('form', 'url'));
        $this->load->library('session');


        /* ----- Comprobaciones de acceso ----- */


        /**Comprobamos que el usuario esta logueado: */
        if (!$this->session->has_userdata('sesion')) {
            redirect('Login', 'refresh');
        }


        /* ----- Comprobamos para que estoy accediendo ----- */


        /**Vemos si estoy eliminando un producto */
        if (isset($_GET['eliminar'])) {
            $this->_eliminarProducto($_GET['eliminar']);
        }


        /* ----- Vistas ----- */

        
        /**El objetivo es mostrar los prodcutos que ha comprado o que esta comprando.
         * Para que sea mas fácil, vamos a reutilizar y modificar un poco la vista usada en el carrito.
        */

        $this->load->view('common/headhtml');
        /**Contiene inicio body */
        $this->load->view('common/header');

        /**El aside lee las categorias de la base de datos */

        $aside['categorias'] = $this->_selectCategorias();
        $this->load->view('common/aside', $aside);
        /**Contiene el inicio de content */

        /**Recogemos los datos de la lista de compras: */
        $compras =  $this->_productosDeUsuario($this->session->id);
        $comprasEnProceso =  $this->_productosDeUsuarioYEstado($this->session->id, "En proceso");
        $comprasEnviado =  $this->_productosDeUsuarioYEstado($this->session->id, "Enviado");
        $comprasRecibido =  $this->_productosDeUsuarioYEstado($this->session->id, "Recibido");

        /**Tenemos que comprobar si la lista de compras esta vacio o no */
        if (is_int($compras)) {
            /**El carrito esta vacio */
            $this->load->view('listaCompras/listaComprasVacia');
        } else {
            /**Buscamos los productos_id en la tabla de productos, y los pasamos */
            /**Tambien tenemos que buscar la cantidad del producto dentro de la lista de compras */
            $datos['compras'] = $compras;
            $datos['comprasEnProceso'] = $comprasEnProceso;
            $datos['comprasEnviado'] = $comprasEnviado;
            $datos['comprasRecibido'] = $comprasRecibido;

            if(!is_int($compras)){
                $datos['productos'] = $this->_variosIDDeProducto($compras);
            }
            if(!is_int($comprasEnProceso)){
                $datos['productosEnProceso'] = $this->_variosIDDeProducto($comprasEnProceso);
            }            
            if(!is_int($comprasEnviado)){
                $datos['productosEnviado'] = $this->_variosIDDeProducto($comprasEnviado);
            }
            if(!is_int($comprasRecibido)){
                $datos['productosRecibido'] = $this->_variosIDDeProducto($comprasRecibido);
            }       
            
            $this->load->view('listaCompras/listaComprasLlena', $datos);
        }

        $this->load->view('common/footer');
        /**Contiene el fin de content */
    }
}
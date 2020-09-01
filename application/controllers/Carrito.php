<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Carrito extends CI_Controller
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
        $tablaCategorias = new Categorias;

        return $tablaCategorias->buscarNombreDesdeId($catID);
    }

    /* ----- Tabla: Productos ----- */

    private function _selectProductosDeCategoria($categoria, $limit, $offset)
    {

        $this->load->model('productos');
        $tablaProductos = new Productos;

        return $tablaProductos->productoDeCategoria($categoria, $limit, $offset);
    }

    private function _variosIDDeProducto($carrito)
    {
        $this->load->model('productos');
        $tablaProductos = new Productos;

        return $tablaProductos->productosDeCarrito($carrito);
    }

    /* ----- Tabla: Carritos ----- */

    private function _productosDeUsuario($id)
    {

        $this->load->model('carritos');
        $tablaCarritos = new Carritos;

        return $tablaCarritos->productosDeUsuario($id);
    }    

    private function _eliminarProducto($id_prod)
    {
        $this->load->model('carritos');
        $tablaCarritos = new Carritos;

        return $tablaCarritos->eliminarDeCarrito($id_prod, $this->session->id);
    }

    private function _vaciarCarrito()
    {
        $this->load->model('carritos');
        $tablaCarritos = new Carritos;

        return $tablaCarritos->vaciarCarritoUsuario($this->session->id);
    }

    /* ----- Tabla: Compras ----- */

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

    private function _vistas(){

        $this->load->view('common/headhtml');
        /**Contiene inicio body */
        $this->load->view('common/header');

        /**El aside lee las categorias de la base de datos */

        $aside['categorias'] = $this->_selectCategorias();
        $this->load->view('common/aside', $aside);
        /**Contiene el inicio de content */

        /**Recogemos los datos del carrito: */
        $carrito =  $this->_productosDeUsuario($this->session->id);

        /**Tenemos que comprobar si el carrito esta vacio o no */
        if (is_int($carrito)) {
            /**El carrito esta vacio */
            $this->load->view('carrito/carritoVacio');
        } else {
            /**Buscamos los productos_id en la tabla de productos, y los pasamos */
            /**Tambien tenemos que buscar la cantidad del producto dentro del carrito */
            $datos['productos'] = $this->_variosIDDeProducto($carrito);
            $datos['carrito'] = $carrito;
            $this->load->view('carrito/carritoLleno', $datos);
        }

        $this->load->view('common/footer');
        /**Contiene el fin de content */

    }

    public function index()
    {

        /* ----- Opciones de depuración ----- */

        $sections = array(
            'config'  => TRUE,
            'queries' => TRUE
        );
        $this->output->set_profiler_sections($sections);
        $this->output->enable_profiler(TRUE);


        /* ----- Librerias ----- */


        $this->load->helper('url');
        $this->load->library('session');


        /* ----- Comprobaciones de acceso ----- */


        /**Comprobamos que el usuario esta logueado: */
        if (!$this->session->has_userdata('sesion')) {
            redirect('Login', 'refresh');
        }


        /* ----- Comprobamos para que estoy accediendo ------ */


        /**Vemos si estoy eliminando un producto */
        if (isset($_GET['eliminar'])) {
            $this->_eliminarProducto($_GET['eliminar']);
        }

        /**Vemos si estoy vaciando el carrito */
        if (isset($_GET['vaciar'])) {
            $this->_vaciarCarrito();
            redirect('Carrito', 'refresh');
        }

        /**Vemos si quiero procesar el carrito */
        if (isset($_GET['procesar'])) {
            //Quiero eliminar las compras que haya en transito
            //Y meter los productos del carrito en compras
            $this->_eliminarComprasUsuarioYEstado($this->session->id, "En proceso");
            $carrito =  $this->_productosDeUsuario($this->session->id);

            foreach ($carrito as $producto) {
                $this->_guardarCompra(
                    $producto->usuario_id,
                    $producto->producto_id,
                    $producto->cantidad,
                    "En proceso");
            }

            redirect('DatosEnvio', 'refresh');
            
        } 


        /* ----- Vistas ------ */

        $this->_vistas();
        
    }
}

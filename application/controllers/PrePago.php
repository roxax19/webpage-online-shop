<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PrePago extends CI_Controller
{

    /* ----- Tabla: Categorias ------ */

    private function _selectCategorias()
    {
        $this->load->model('categorias');
        $tablaCategorias = new Categorias;

        return $tablaCategorias->select();
    }

    /* ----- Tabla: Compras ------ */

    private function _productosDeUsuarioYEstado($id, $estado)
    {
        $this->load->model('Compras');
        $tablaCompras = new Compras;

        return $tablaCompras->seleccionarConUsuarioYEstado($id, $estado);
    }

    private function _eliminarComprasUsuarioYEstado($usuario_id, $estado)
    {
        $this->load->model('Compras');
        $tablaCompras = new Compras;

        return $tablaCompras->eliminarComprasUsuarioYEstado($usuario_id, $estado);
    }

    /* ----- Tabla: Productos ------ */

    private function _variosIDDeProducto($carrito)
    {
        $this->load->model('productos');
        $tablaProductos = new Productos;

        return $tablaProductos->productosDeCarrito($carrito);
    }

    /* ----- Tabla: DatosEnvios ------ */

    private function _seleccionarDireccionConUsuario($usuario_id)
    {
        $this->load->model('DatosEnvios');
        $tablaDatosenvio = new DatosEnvios;

        return $tablaDatosenvio->seleccionarUnaConUsuario($usuario_id);
    }

    private function _eliminarDatosEnvioUsuario($id)
    {
        $this->load->model('DatosEnvios');
        $tablaDatosEnvios = new DatosEnvios;

        return $tablaDatosEnvios->eliminarDatosEnvioUsuario($id);
    }

    public function index()
    {

        /* ----- Librerias ------ */

        $this->load->helper(array('form', 'url'));
        $this->load->library('session');

        /* ----- Variables necesarias de la bd ------ */
        $comprasEnProceso =  $this->_productosDeUsuarioYEstado($this->session->id, "En proceso");
        $datosEnvio = $this->_seleccionarDireccionConUsuario($this->session->id);
        $productosEnProceso = $this->_variosIDDeProducto($comprasEnProceso);


        /* ----- Comprobaciones de acceso ------ */


        /**Comprobamos que el usuario esta logueado: */
        if (!$this->session->has_userdata('sesion')) {
            redirect('Login', 'refresh');
        }

        /**Comprobamos que hay compras en proceso: */        
        if (is_int($comprasEnProceso)) {
            redirect('Carrito', 'refresh');
        } 

        /*Comprobamos que hay una direccion de envío temporal: */
        if (is_int($datosEnvio)) {
            redirect('DatosEnvio', 'refresh');
        }


        /* ----- Comprobamos para que estoy accediendo ------ */


        /**Vemos si quiero cancelar el pago: */
        if (isset($_GET['cancelar'])) {
            //Si quiero cancelar, borro la direccion temporal  y las compras en proceso
            $this->_eliminarDatosEnvioUsuario($this->session->id);
            $this->_eliminarComprasUsuarioYEstado($this->session->id, "En proceso");  
            redirect('Carrito', 'refresh');
        }

        /**Vemos si quiero proceder al pago */
        if (isset($_GET['proceder'])) {
 
            $json_item_name = "{";
            $json_item_id = "{";
            $amount = 0;
            $json_quantity = "{";

            foreach($productosEnProceso as $producto){
                $json_item_name = $json_item_name . $producto->nombre. ", ";
                $json_item_id = $json_item_id . $producto->producto_id. ", ";
                

                foreach ($comprasEnProceso as $compra) {
                    if ($producto->producto_id == $compra->producto_id) {
                        $json_quantity = $json_quantity . $compra->cantidad. ", ";
                        $amount = $amount + (((float)$producto->precio) * ((float)$compra->cantidad));
                    }
                }
            }
            

            $json_item_name = $json_item_name . "}";
            $json_item_id = $json_item_id . "}";
            $json_quantity = $json_quantity . "}";

            $json_item_name = str_replace(", }", "}", $json_item_name);
            $json_item_id = str_replace(", }", "}", $json_item_id);
            $json_quantity = str_replace(", }", "}", $json_quantity);


            $callumapal['item_name'] = $json_item_name;
            $callumapal['item_id'] = $json_item_id;
            $callumapal['amount'] = $amount;
            $callumapal['quantity'] = $json_quantity;   
            
            $callumapal['datosEnvio'] = $datosEnvio;
            $callumapal["peticionActual"] = bin2hex(random_bytes(16));
            $callumapal["success"] = base_url().'index.php/PagoAceptado';
            $callumapal["denied"] = base_url().'index.php/PagoDenegado';

            $this->load->view('callumapal/callumapal', $callumapal);
            
        }


        /* ----- Vistas ------ */


        $this->load->view('common/headhtml');
        /**Contiene inicio body */
        $this->load->view('common/header');

        $aside['categorias'] = $this->_selectCategorias();
        $this->load->view('common/aside', $aside);
        /**Contiene el inicio de content */
        
        /**Buscamos los productos_id en la tabla de productos, y los pasamos */
        /**Tambien tenemos que buscar la cantidad del producto dentro de la lista de compras */
        $datos['comprasEnProceso'] = $comprasEnProceso;
        $datos['productosEnProceso'] = $productosEnProceso;
        
        /**Tambien queremos pasarle la dirección de envío */
        $datos['datosEnvio'] = $datosEnvio;

        $this->load->view('prePago/prePago', $datos);

        $this->load->view('common/footer');
    }

}
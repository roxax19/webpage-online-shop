<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Producto extends CI_Controller
{

    /* ----- Tabla: Categorias ----- */

    private function _selectCategorias()
    {
        $this->load->model('categorias');
        $tablaCategorias = new Categorias;

        return $tablaCategorias->select();
    }

    /* ----- Tabla: Productos ----- */

    private function _selectProducto($id)
    {
        $this->load->model('productos');
        $tablaProductos = new Productos;

        return $tablaProductos->productoConcreto($id);
    }

    /* ----- Tabla: Carritos ----- */

    private function _anadirProducto($id_producto, $id_usuario, $cantidad)
    {
        $this->load->model('carritos');
        $tablaCarritos = new Carritos;

        return $tablaCarritos->anadirProducto($id_producto, $id_usuario, $cantidad);
    }

    private function _Vistas()
    {

        $this->load->view('common/headhtml');
        /**Contiene inicio body */
        $this->load->view('common/header');

        /**El aside lee las categorias de la base de datos */
        $aside['categorias'] = $this->_selectCategorias();
        $this->load->view('common/aside', $aside);
        /**Contiene el inicio de content */

        /**Nos han pasado el id con GET o con post, hacemos isset y le pasamos el producto a la view */

        if (!isset($_GET['id']) && !isset($_POST['id'])) {
            redirect("Home", "refresh");
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }


        $data['producto'] = $this->_selectProducto($id);
        $this->load->view('producto/producto', $data);
        //Aqui incluimos el js

        //intentar mostrar los productos por pantalla desde aqui, o las categorias de dentro
        $this->load->view('common/footer');
        /**Contiene el fin de content */
    }

    public function index()
    {

        /* ----- Para depurar ----- */


        $sections = array(
            'config'  => TRUE,
            'queries' => TRUE
        );
        $this->output->set_profiler_sections($sections);
        $this->output->enable_profiler(TRUE);


        /* ----- Librerias ----- */


        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('form_validation');
        

        /* ----- Reglas de validacion ----- */


        $this->form_validation->set_rules(
            'cantidad',
            'Cantidad',
            'htmlspecialchars|trim|required|is_natural_no_zero',
            array(
                'required' => 'No ha introducido la %s.',
            )
        );


        /* ----- Comprobamos para que estoy accediendo ----- */

        /**Vemos si estoy añadiendo un producto:*/

        if (isset($_POST['cantidad']) && isset($_POST['id'])) {
            /**Comprobamos que el usuario esta logueado: */
            if (!$this->session->has_userdata('sesion')) {
                redirect('Login', 'refresh');
            } //else:

            //Comprobamos que el formulario es correcto:
            if ($this->form_validation->run() == FALSE) {
                /**Si no se ha validado bien, volvemos a cargar la pagina */
                $this->_Vistas();
            } else {
                $this->_anadirProducto($_POST['id'], $this->session->id, $_POST['cantidad']);
                redirect(base_url() . 'index.php/Producto?id=' . $_POST['id'], 'refresh');
            }
        } else {
            //Si accedemos de primeras:
            $this->_Vistas();
        }
    }
}

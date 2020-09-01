<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DatosEnvio extends CI_Controller
{

    /* ----- Tabla: Categorias ----- */

    private function _selectCategorias()
    {
        $this->load->model('categorias');
        $tablaCategorias = new Categorias;

        return $tablaCategorias->select();
    }

    /* ----- Tabla: DatosEnvios ----- */

    private function _guardarDireccionEnvio($array)
    {

        $this->load->model('DatosEnvios');
        $tablaDatosenvio = new DatosEnvios;

        $tablaDatosenvio->guardarDireccionEnvio($array);
    }

    private function _seleccionarConUsuario($usuario_id)
    {

        $this->load->model('DatosEnvios');
        $tablaDatosenvio = new DatosEnvios;

        $tablaDatosenvio->seleccionarUnaConUsuario($usuario_id);
    }

    private function _eliminarDatosEnvioConUsuario($usuario_id)
    {

        $this->load->model('DatosEnvios');
        $tablaDatosenvio = new DatosEnvios;

        $tablaDatosenvio->eliminarDatosEnvioUsuario($usuario_id);
    }

    /* ----- Tabla: Carritos ----- */

    private function _productosDeUsuario($id)
    {

        $this->load->model('carritos');
        $tablaCarritos = new Carritos;

        return $tablaCarritos->productosDeUsuario($id);
    }
        

    public function index()
    {
        /* ----- Librerias ----- */


        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');


        /* ----- Reglas de validación ----- */


        $this->form_validation->set_rules(
            'email',
            'Email',
            'htmlspecialchars|trim|required|callback_email_check',
            array(
                'required'      => 'No ha introducido el %s.',
                //Las de length tienen su mensaje por defecto
            )
        );

        $this->form_validation->set_rules(
            'nombre',
            'Nombre',
            'htmlspecialchars|trim|required',
            array(
                'required' => 'No ha introducido el %s.',
            )
        );

        $this->form_validation->set_rules(
            'apellidos',
            'Apellidos',
            'htmlspecialchars|trim|required',
            array(
                'required' => 'No ha introducido los %s.',
            )
        );

        $this->form_validation->set_rules(
            'direccion',
            'Direccion',
            'htmlspecialchars|trim|required',
            array(
                'required' => 'No ha introducido la %s.',
            )
        );

        $this->form_validation->set_rules(
            'cp',
            'Codigo Postal',
            'htmlspecialchars|trim|required|numeric',
            array(
                'required' => 'No ha introducido el %s.',
            )
        );

        $this->form_validation->set_rules(
            'pais',
            'Pais',
            'htmlspecialchars|trim|required',
            array(
                'required' => 'No ha introducido el %s.',
            )
        );

        $this->form_validation->set_rules(
            'telefono',
            'Telefono',
            'htmlspecialchars|trim|required|numeric',
            array(
                'required' => 'No ha introducido el %s.',
            )
        );


        /* ----- Comprobaciones de acceso ----- */


        /**Comprobamos que el usuario esta logueado: */
        if (!$this->session->has_userdata('sesion')) {
            redirect('Login', 'refresh');
        }


        /* ----- Vistas y operaciones ----- */
        

        if ($this->form_validation->run() == FALSE) {
            /**Si no se ha validado bien, o es la primera vez que entramos,
             *  volvemos a cargar el form */

            $this->load->view('common/headhtml');
            /**Contiene inicio body */
            $this->load->view('common/header');

            $aside['categorias'] = $this->_selectCategorias();
            $this->load->view('common/aside', $aside);
            /**Contiene el inicio de content */

            $this->load->view('datosEnvio/datosEnvio');

            $this->load->view('common/footer');
            /**Contiene el fin de content */

            /**Solo deberiamos añadir las cosas a compras la primera vez que entramos aqui
             * Podemos crear un nuevo controlador con una pagina intermedia
             * donde se añadirian las cosas, y asi no realizamos la funcion cada vez que se cargue la pagina
             */


        } else {
            /**
             * Si los datos se han enviado correctamente, accedemos al pago.
             * Almaceno los datos en la db, para usarlos para el envio
             */

            $array = array(
                $this->session->id, //usuario_id
                $_POST['email'],
                $_POST['nombre'],
                $_POST['apellidos'],
                $_POST['direccion'],
                $_POST['cp'],
                $_POST['provincia'],
                $_POST['pais'],
                $_POST['telefono']
            );

            /**Comprobamos si ya hay un usuario con una direccion temporal
             * Si ya hay, la borramos porque significa que ha dejado el pago a medias
             * y no hemos borrado la direccion
             */      

            if (!is_int($this->_seleccionarConUsuario($this->session->id))) {
                //Significa que hay ya hay una
                $this->_eliminarDatosEnvioConUsuario($this->session->id);
            }
            $this->_guardarDireccionEnvio($array);

            redirect('PrePago', 'refresh');
        }
    }

    public function email_check($str)
    {
        /**Cargamos el modelo para hacer las comprobaciones de los campos */
        $this->load->model('usuarios');
        $tablaUsuarios = new Usuarios;

        $usuario = $tablaUsuarios->busquedaEmail($str);
        if (is_int($usuario)) {
            $this->form_validation->set_message('email_check', 'The email ' . $str . ' is not registered');
            return FALSE;
        } else {
            return TRUE;
        }
    }
}

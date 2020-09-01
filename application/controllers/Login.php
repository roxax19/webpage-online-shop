<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    /* ----- Tabla: Categorias ----- */

    private function _selectCategorias()
    {
        $this->load->model('categorias');
        $tablaCategorias = new Categorias;

        return $tablaCategorias->select();
    }

    public function index()
    {

        /* ----- Librerias ----- */

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');


        /* ----- Reglas de validacion ----- */


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
            'password',
            'Password',
            'htmlspecialchars|trim|required|min_length[4]|callback_password_check',
            //Trim lo que hace es quitar los espacios
            array(
                'required' => 'No ha introducido la %s.',
            )
        );

        /**Las reglas por debajo son funciones, asi que podemos poner funciones php ademas de reglas
         * Con callback podemos meter funciones hechas por nsotros
         * Con is unique, comprobamos una tabla.campo para que no haya duplicados
         */


        /* ----- Vistas y operaciones ----- */
        

        if ($this->form_validation->run() == FALSE) {
            /**Si no se ha validado bien, volvemos a cargar el form */

            $this->load->view('common/headhtml');
            /**Contiene inicio body */
            $this->load->view('common/header');

            $aside['categorias'] = $this->_selectCategorias();
            $this->load->view('common/aside', $aside);
            /**Contiene el inicio de content */

            $this->load->view('login/login');

            $this->load->view('common/footer');
            /**Contiene el fin de content */
        } else {
            /**
             * Creamos la cookie sesion que toma de valor el email,
             * que es identificador unico de la tabla
             */

            $this->load->model('usuarios');
            $tablaUsuarios = new Usuarios;

            $usuario = $tablaUsuarios->busquedaEmail(set_value('email'));


            $this->session->set_userdata(
                array(
                    'sesion' => $usuario->usuario_email,
                    'name' => $usuario->usuario_nombre,
                    'id' => $usuario->usuario_id
                )
            );
            redirect('Home', 'refresh');
            //El redirect es como un return, termina de ejecutar el codigo.
            //Carga el controlador
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

    public function password_check($str)
    {
        /**Cargamos el modelo para hacer las comprobaciones de los campos */
        $this->load->model('usuarios');
        $tablaUsuarios = new Usuarios;

        $usuario = $tablaUsuarios->busquedaEmail(set_value('email'));

        if (is_int($usuario)) {
            $this->form_validation->set_message('password_check', 'The email ' . set_value('email') . ' is not registered');
            return FALSE;
        } else {
            if ($usuario->usuario_contrasena == $str) {
                return TRUE;
            } else {
                $this->form_validation->set_message('password_check', 'The password is wrong');
                return FALSE;
            }
        }
    }
}

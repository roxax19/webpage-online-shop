<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SingUp extends CI_Controller
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
            'htmlspecialchars|trim|required|valid_email|callback_email_check',
            array(
                'required' => 'No ha introducido la %s.',
            )
        );

        $this->form_validation->set_rules(
            'username',
            'Username',
            'htmlspecialchars|trim|required|max_length[255]',
            array(
                'required'      => 'No ha introducido el %s.',
                //Las de length tienen su mensaje por defecto
            )
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'htmlspecialchars|trim|required|min_length[4]',
            //Trim lo que hace es quitar los espacios
            array(
                'required' => 'No ha introducido la %s.',
            )
        );

        $this->form_validation->set_rules(
            'passconf',
            'Password Confirmation',
            'htmlspecialchars|trim|required|matches[password]',
            array(
                'required' => 'No ha introducido la %s.',
                'matches' => 'Las contraseñas no coinciden'
            )
        );


        /* ----- Vistas y operaciones ----- */


        if ($this->form_validation->run() == FALSE) {
            /**Si no se ha validado bien, volvemos a cargar el form */

            $this->load->view('common/headhtml');
            /**Contiene inicio body */
            $this->load->view('common/header');

            $aside['categorias'] = $this->_selectCategorias();
            $this->load->view('common/aside', $aside);
            /**Contiene el inicio de content */

            $this->load->view('singup/singup');

            $this->load->view('common/footer');
            /**Contiene el fin de content */
        } else {
            /**Si se ha cargado bien, nos vamos a HOME */
            $this->load->model('usuarios');
            $tablaUsuarios = new Usuarios;

            $tablaUsuarios->creacionUsuario(set_value('email'), set_value('username'), set_value('password'));

            redirect('Login', 'refresh');
            //El redirect es como un return, termina de ejecutar el codigo.
            //Carga el controlador

            //HAY QUE CAMBIAR LA PARTE SUPERIOR DEL HEAD CUANDO HAGAMOS LA SESION
            //Se puede crear una view con un mensaje de que el usuario ha sido creado, y poner un boton que nos lleve al home
        }
    }

    public function email_check($str)
    {
        /**Cargamos el modelo para hacer las comprobaciones de los campos */
        $this->load->model('usuarios');
        $tablaUsuarios = new Usuarios;

        $usuario = $tablaUsuarios->busquedaEmail($str);
        if (is_int($usuario)) {
            /**Si devuelve un 1, es que el email no se ha encontrado en la base de datos */
            return TRUE;
        } else {
            $this->form_validation->set_message('email_check', 'The email ' . $str . ' is already registered');
            return FALSE;
        }
    }
}

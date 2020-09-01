<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DatosEnvios extends CI_Model
{

    /**VAMOS A TRATAR ESTA TABLA COMO TEMPORAL
     * NO SE VAN A GUARDAR DIRECCIONES DE USUARIO PARA OTROS ENVIOS
     */

    /* Cada clase es una tabla de la base de datos 
	Campos de la base de datos*/
    public $envio_id;
    public $usuario_id;
    public $email;
    public $nombre;
    public $apellidos;
    public $direccion;
    public $cp;
    public $provincia;
    public $pais;
    public $telefono;

    public function guardarDireccionEnvio($array)
    {
        $data = array(
            'usuario_id' => $array[0],
            'email' => $array[1],
            'nombre' => $array[2],
            'apellidos' => $array[3],
            'direccion' => $array[4],
            'cp' => $array[5],
            'provincia' => $array[6],
            'pais' => $array[7],
            'telefono' => $array[8],
        );

        $this->db->insert('datosenvios', $data);
    }

    public function seleccionarUnaConUsuario($usuario_id)
    {
        /**En principio guardaremos una por usuario, asi que vamos a buscar por usuario
         * Luego se podria cambiar al envio_id
         */

        $query = $this->db->get_where('datosenvios', array('usuario_id' => $usuario_id));

        if ($query->num_rows() > 0) {
            $datoEnvio = $query->row();
            return $datoEnvio;
        } else {
            return 1;
        }
    }
    public function seleccionarConIDEnvio($envio_id)
    {
        /**En principio guardaremos una por usuario, asi que vamos a buscar por usuario
         * Luego se podria cambiar al envio_id
         */

        $query = $this->db->get_where('datosenvios', array('envio_id' => $envio_id));

        if ($query->num_rows() > 0) {
            $datoEnvio = $query->row();
            return $datoEnvio;
        } else {
            return 1;
        }
    }

    public function eliminarDatosEnvioUsuario($usuario_id)
    {
        $this->db->delete('datosenvios', array(
            'usuario_id' => $usuario_id
        ));
    }
}

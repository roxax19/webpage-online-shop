<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{
    public function index()
    {

        /* ----- Librerias ----- */

        $this->load->library('session');
        $this->load->helper('url');

        /* ----- Operaciones ----- */

        $this->session->sess_destroy();
        redirect('Home', 'refresh');
    }
}

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//ГовноКод, із-за відсутності необхідності надійного модуля AUTH
//в робочий варіант, необхідно ставити надійну бібліотеку...
class Logout extends CI_Controller 
{
    function index(){
        $this->session->sess_destroy();
        redirect('');
    }
}
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$this->load->core('AD_Controller');
class AD_Controller extends CI_Controller
{
//	var $language;
//	var $user_interfage = array();
	var $title = "Admin panel";
	var $nav = "";
//	var $user = array();
//	var $hero = array();
//	var $blog_category = array();
//	var $last_news = array();
//	var $default_engine = array();
    function __construct() {
        parent::__construct();
//		$this->load->model('engine');
		//---
//		$this->blog_category =$this->engine->get_categories();
//		$this->last_news =$this->engine->get_last_news();
//		$this->hero =$this->engine->get_hero();
//		$this->default_engine =$this->engine->default_engine();

$this->load->helper('url');
if($this->session->userdata('role')!='admin') redirect();
		// if($this->session->userdata('id_user')){
			// $this->user=$this->engine->get_user($this->session->userdata('id_user'));
		// }
		//---
	}
}
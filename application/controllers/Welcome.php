<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function index()
	{
		$this->nav ="home";
		$this->title ="Сучасний герой";
		$data=array();
		$data['promo'] = $this->engine->get_promo();
		$this->load->view('welcome_message',$data);
	}
}

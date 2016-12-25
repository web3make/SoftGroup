<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hero extends MY_Controller {

	public function index($hero="")
	{
		$this->nav ="contacts";
		$this->title ="Контакти героїв";
		$this->load->view('contacts_view');
	}
}

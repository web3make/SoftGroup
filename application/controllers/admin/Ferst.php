<?php

class Ferst extends MY_Controller{
	
	public function __construct()
	{
		parent::__construct();
		
		if($this->session->userdata('role')!='admin'){redirect();}else{redirect(base_url().'admin/articles');}
	}
	public function index(){
		
	}

}
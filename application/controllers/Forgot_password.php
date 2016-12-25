<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends MY_Controller {

	public function index()
	{
		$this->nav ="auth";
		$this->title ="Відновлення пароля";
		$this->load->view('forgot_password_view');
	}
}

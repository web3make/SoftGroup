<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends MY_Controller {

	public function index()
	{
		$this->nav ="blog";
		$this->load->view('article_view');
	}
}

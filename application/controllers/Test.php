<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller {

	public function index()
	{
//		$this->load->view('welcome_message');
print_r($this->blog_category);
echo("<hr>");
print_r($this->last_news);
echo("<hr>");
print_r($this->hero);
echo("<hr>");
echo($this->title."|".$this->nav);
	
echo("<hr>");
//echo(date());
print_r($this->default_engine);
echo($this->default_engine->site_name);
echo("<hr>");
print_r($this->session->userdata());

echo("<hr>");
print_r($this->user);

echo("<hr>");
echo($this->user->user_name);
	}
}

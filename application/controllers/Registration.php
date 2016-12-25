<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//ГовноКод, із-за відсутності необхідності надійного модуля AUTH
//в робочий варіант, необхідно ставити надійну бібліотеку...
class Registration extends MY_Controller {

	public function index()
	{
		$this->nav ="auth";
		$this->title ="Реєстрація на сайті";
		//---
        $session_id = @$this->session->userdata('id_user');
        if($session_id) redirect('/admin');
        
        if (isset($_POST['password']) && isset($_POST['login'])){
            $array = array( 
                'user_name' => mysql_real_escape_string(strip_tags(trim($_POST['login']))),
                'password' => md5(trim($_POST['password'])),
                'control' => 'a',
            );
			$this->db->insert('users', $array);            
            $auth = $this->db->get_where('users',$array)->row();

            if (isset($auth) && !empty($auth)){
				$this->session->set_userdata(array('role'=>$auth->role, 'id_user'=>$auth->id_user));
					redirect('');
            } else
                $this->load->view('registration_view');
        } else
//            $this->load->view('reg');
		$this->load->view('registration_view');
	}
}

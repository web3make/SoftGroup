<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//ГовноКод, із-за відсутності необхідності надійного модуля AUTH
//в робочий варіант, необхідно ставити надійну бібліотеку...
class Login extends MY_Controller {
    public function __constuctor(){
        if($this->session->userdata('role')=='admin'){
			redirect('/admin');
		}else{
			redirect('');
		}
	}
	public function index()
	{
		$this->nav ="auth";
		$this->title ="Вхід";
		//-------------------
        $session_id = @$this->session->userdata('id_user');
        if($session_id) redirect('/admin');
        
        if (isset($_POST['password']) && isset($_POST['login'])){
            $array = array( 
                'user_name' => trim($_POST['login']),
                'password' => md5(trim($_POST['password'])),
                'control' => 'a',
            );

            $auth = $this->db->get_where('users',$array)->row();
            if (isset($auth) && !empty($auth)){
                $this->session->set_userdata(array('role'=>$auth->role, 'id_user'=>$auth->id_user));
				if($auth->role =="admin"){
					redirect('/admin');
				}else{
					redirect('');
				}
            } else
            //    $this->load->view('login');
				$this->load->view('login_view');
        } else
            //$this->load->view('login');
		//-------------------
		$this->load->view('login_view');
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends MY_Controller {

	public function index()
	{
		$this->nav ="contacts";
		$this->title ="Контакти героїв";
		$data = array();
		$data['hero']=$this->engine->get_allhero();
		$this->load->view('contacts_view', $data);
	}
//------
	public function person($person){
		$this->nav ="contacts";
		$this->title ="Контакти героїв";
		$data = array();
		$data['person'] = $this->engine->get_person($person);
		$this->title = $data['person']->name;
		$this->load->view('person_view', $data);		
	}
//------
	public function edit($person){
		$person = strval($person);
		if($this->input->post('name')){
			$data = array(
//contact	name	about	slogan	email	photo soc_fb	soc_gp	soc_tw	soc_in	bio
				'name' => $this->input->post('name'),
				'about' => $this->input->post('about'),
				'slogan' => $this->input->post('slogan'),
				'soc_fb' => $this->input->post('soc_fb'),
				'soc_gp' => $this->input->post('soc_gp'),
				'soc_tw' => $this->input->post('soc_tw'),
				'soc_in' => $this->input->post('soc_in'),
				'bio' => $this->input->post('bio')
			);
			$this->db->where('contact',$person)->update('contacts',$data);
			redirect('../contacts/person/'.$person);
		}else{
			$this->nav ="contacts";
			$this->title ="Контакти героїв";
			$data = array();
			$data['person'] = $this->engine->get_person($person);
			$this->load->view('edit_person_view', $data);
		}
	}
	public function create(){
		
	}
	public function delete($id=0){
		
	}
//------
//------
}

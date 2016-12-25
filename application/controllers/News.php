<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller {

	public function index($id=0)
	{
		$this->nav ="news";
		$this->title ="Новини героїв";
		$data = array();
		//---
		//$data['news'] = $this->engine->
        $id = intval($id);
        $this->load->library('pagination');
        $this->load->library('timeword');
		$this->load->helper('date');
        
//        $data = $this->base_model->default_user();

		$config = array(
            'base_url'    => base_url().'news/', 
    		'total_rows'  => $this->db->count_all('news'),
    		'num_links'   => 2,
    		'per_page'    => $this->default_engine->per_page,
    		'uri_segment' => 2
        );
        $config['full_tag_open'] = '<ul class="pagination pagination-lg">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
//        $config['prev_link'] = '&laquo';
        $config['prev_link'] = 'Назад';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
//        $config['next_link'] = '&raquo';
        $config['next_link'] = 'Вперед';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';                       
		$this->pagination->initialize($config);
            
        $data['pages'] = $this->pagination->create_links();
        $data['news'] = $this->engine->news_pagination($id,$this->default_engine->per_page);
		//---
		$this->load->view('news_view', $data);
	}
	public function id($id){
		$id=intval($id);
        $this->load->library('timeword');
		$this->load->helper('date');
//		echo $id;
		$data['new'] = $this->engine->get_new($id);
		$this->nav ="news";
		$this->title =$data['new']->title;
		//$this->title ="Новини героїв";
		//echo($data['new']->title.'<hr>');
		//print_r($data);
		$this->load->view('show_new_view', $data);
	}
//------
	public function edit($id=0){
		if($this->input->post('title')){
			$id = intval($id);
			$data = array(
				'title' => $this->input->post('title'),
				'descript' => $this->input->post('descript'),
				'text' => $this->input->post('text')
			);
			$this->db->where('id',$id)->update('news',$data);
			redirect('../news/id'.$id);
		}else{
			$data['new'] = $this->engine->get_new($id);
			$this->nav ="news";
			$this->title =$data['new']->title;
			$this->load->view('edit_news_view', $data);			
		}
	}
	public function save($id=0){
//		print_r($this->input->post());
		$id = intval($id);
        $data = array(
            'title' => $this->input->post('title'),
            'descript' => $this->input->post('descript'),
            'text' => $this->input->post('text')
        );
        $this->db->where('id',$id)
                    ->update('news',$data);
        redirect('../news/id'.$id);
	}
	public function create(){
		
	}
	public function delete($id=0){
		
	}
//------
}

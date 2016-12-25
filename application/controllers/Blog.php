<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends MY_Controller {

	public function index($id=0){
		$this->nav ="blog";
		$this->title ="Блог сайту";
		//---
        $id = intval($id);
        $this->load->library('pagination');
        $this->load->library('timeword');
		$this->load->helper('date');
        

		$config = array(
            'base_url'    => base_url().'blog/', 
    		'total_rows'  => $this->db->count_all('articles'),
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
        $config['prev_link'] = 'Назад';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
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
        $data['articles'] = $this->engine->blog_pagination($id,$this->default_engine->per_page);
		$this->load->view('blog_view',$data);
	}


	public function category($cat="", $id=0){
		$this->nav ="blog";
		$this->title ="Блог сайту";
		//---
        $cat = strval($cat);
        $id = intval($id);
        $this->load->library('pagination');
        $this->load->library('timeword');
		$this->load->helper('date');
        
		$config = array(
            'base_url'    => base_url().'blog/'.$cat.'/', 
    		'total_rows'  => $this->db->get_where('articles', array('category'=>$cat))->num_rows(),
    		'num_links'   => 2,
    		'per_page'    => $this->default_engine->per_page,
    		'uri_segment' => 3
        );
        $config['full_tag_open'] = '<ul class="pagination pagination-lg">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Назад';
        $config['prev_tag_open'] = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
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
        $data['articles'] = $this->engine->category_pagination($cat,$id,$this->default_engine->per_page);
		$this->load->view('blog_view',$data);
		//---
		//$this->load->view('blog_view');
	}
	
	public function article($id=0){
		$id=intval($id);
        $this->load->library('timeword');
		$this->load->helper('date');
//		echo $id;
		$data['article'] = $this->engine->get_article($id);
		$this->nav ="blog";
		$this->title =$data['article']->title;
		$this->load->view('article_view',$data);
		//($id);
	}
//------
	public function edit($type="", $id=0){
		
	}
	public function create($type=""){
		
	}
	public function delete($type="",$id=0){
		
	}
//------
}

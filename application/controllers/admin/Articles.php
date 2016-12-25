<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//@source http://mbahcoding.com/tutorial/php/codeigniter/codeigniter-ajax-crud-using-bootstrap-modals-datatables-image-upload.html
class Articles extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('role')!='admin'){redirect();}
		$this->load->model('admin/articles_model','articles');
//	id	category	title	create	descript	photo	text
	}

	public function index()
	{
		$this->load->helper('url');
		$dat = array();
		$dat['categories']= $this->articles->get_categories();
		$this->load->view('admin/articles_view', $dat);
	}

	public function ajax_list()
	{
		$this->load->helper('url');

		$list = $this->articles->get_datatables();
		$data = array();
		$no = $_POST['start'];
//id|	title	category	create	descript	text	photo
		foreach ($list as $article) {
			$no++;
			$row = array();
			$row[] = $article->title;
			$row[] = $article->category;
			$row[] = $article->create;
			$row[] = $article->descript;
			$row[] = $article->text;
			if($article->photo)
				$row[] = '<a href="'.base_url('images/blog/'.$article->photo).'" target="_blank"><img src="'.base_url('images/blog/'.$article->photo).'" class="img-responsive" /></a>';
			else
				$row[] = '(No photo)';

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$article->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$article->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->articles->count_all(),
						"recordsFiltered" => $this->articles->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->articles->get_by_id($id);
		$data->text = ($data->text == '0000-00-00') ? '' : $data->text; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
	$this->load->helper('date');//
	
		$this->_validate();
		
		$data = array(
				'title' => $this->input->post('title'),
				'category' => $this->input->post('category'),
//				'create' => $this->input->post('create'),
				'create' =>  now(),
				'descript' => $this->input->post('descript'),
				'text' => $this->input->post('text')
			);

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			$data['photo'] = $upload;
		}

		$insert = $this->articles->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'title' => $this->input->post('title'),
				'category' => $this->input->post('category'),
//				'create' => $this->input->post('create'),
				'descript' => $this->input->post('descript'),
				'text' => $this->input->post('text'),
			);

		if($this->input->post('remove_photo')) // if remove photo checked
		{
			if(file_exists('images/blog/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
				unlink('images/blog/'.$this->input->post('remove_photo'));
			$data['photo'] = '';
		}

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			
			//delete file
			$article = $this->articles->get_by_id($this->input->post('id'));
			if(file_exists('images/blog/'.$article->photo) && $article->photo)
				unlink('images/blog/'.$article->photo);

			$data['photo'] = $upload;
		}

		$this->articles->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		//delete file
		$article = $this->articles->get_by_id($id);
		if(file_exists('images/blog/'.$article->photo) && $article->photo)
			unlink('images/blog/'.$article->photo);
		
		$this->articles->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload()
	{
//		$config['upload_path']          = './upload/';
		$config['upload_path'] = FCPATH . 'images/blog/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_size']             = 3200; //set max size allowed in Kilobyte
        $config['max_width']            = 3200; // set max width image allowed
        $config['max_height']           = 3200; // set max height allowed
//        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
        $config['encrypt_name']          = TRUE;

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
//-------
//---------------------------------------------
$config['image_library'] = 'gd2';
$config['source_image']	= './images/blog/'.$this->upload->data('file_name');
$config['width']	= 730;
$config['height']	= 292;
$config['maintain_ratio'] = false;

$this->load->library('image_lib', $config); 

$this->image_lib->resize();
//---------------------------------------------	
//-------
		return $this->upload->data('file_name');
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('title') == '')
		{
			$data['inputerror'][] = 'title';
			$data['error_string'][] = 'Title is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('category') == '')
		{
			$data['inputerror'][] = 'category';
			$data['error_string'][] = 'Last name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('text') == '')
		{
			$data['inputerror'][] = 'text';
			$data['error_string'][] = 'Date of Birth is required';
			$data['status'] = FALSE;
		}

/*  		if($this->input->post('create') == '')
		{
			$data['inputerror'][] = 'create';
			$data['error_string'][] = 'Please select create';
			$data['status'] = FALSE;
		}  */

		if($this->input->post('descript') == '')
		{
			$data['inputerror'][] = 'descript';
			$data['error_string'][] = 'Addess is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

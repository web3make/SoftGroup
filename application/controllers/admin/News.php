<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//@source http://mbahcoding.com/tutorial/php/codeigniter/codeigniter-ajax-crud-using-bootstrap-modals-datatables-image-upload.html
class News extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('role')!='admin'){redirect();}
		$this->load->model('admin/news_model','news');
//	id	category	title	create	descript	photo	text
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('admin/news_view');
	}

	public function ajax_list()
	{
		$this->load->helper('url');

		$list = $this->news->get_datatables();
		$data = array();
		$no = $_POST['start'];
//id|	title	category	create	descript	text	photo
		foreach ($list as $news) {
			$no++;
			$row = array();
			$row[] = $news->title;
//			$row[] = $news->category;
			$row[] = $news->create;
			$row[] = $news->descript;
			$row[] = $news->text;
			// if($news->photo)
				// $row[] = '<a href="'.base_url('upload/'.$news->photo).'" target="_blank"><img src="'.base_url('upload/'.$news->photo).'" class="img-responsive" /></a>';
			// else
				// $row[] = '(No photo)';

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$news->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$news->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->news->count_all(),
						"recordsFiltered" => $this->news->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->news->get_by_id($id);
		$data->text = ($data->text == '0000-00-00') ? '' : $data->text; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
	$this->load->helper('date');//
	
		$this->_validate();
		
		$data = array(
				'title' => $this->input->post('title'),
				// 'category' => $this->input->post('category'),
//				'create' => $this->input->post('create'),
				'create' =>  now(),
				'descript' => $this->input->post('descript'),
				'text' => $this->input->post('text')
			);

		// if(!empty($_FILES['photo']['name']))
		// {
			// $upload = $this->_do_upload();
			// $data['photo'] = $upload;
		// }

		$insert = $this->news->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'title' => $this->input->post('title'),
				// 'category' => $this->input->post('category'),
//				'create' => $this->input->post('create'),
				'descript' => $this->input->post('descript'),
				'text' => $this->input->post('text'),
			);

		// if($this->input->post('remove_photo')) // if remove photo checked
		// {
			// if(file_exists('upload/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
				// unlink('upload/'.$this->input->post('remove_photo'));
			// $data['photo'] = '';
		// }

		// if(!empty($_FILES['photo']['name']))
		// {
			// $upload = $this->_do_upload();
			
			// //delete file
			// $news = $this->news->get_by_id($this->input->post('id'));
			// if(file_exists('upload/'.$news->photo) && $news->photo)
				// unlink('upload/'.$news->photo);

			// $data['photo'] = $upload;
		// }

		$this->news->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		//delete file
		$news = $this->news->get_by_id($id);
		// if(file_exists('upload/'.$news->photo) && $news->photo)
			// unlink('upload/'.$news->photo);
		
		$this->news->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	// private function _do_upload()
	// {
		// $config['upload_path']          = './upload/';
        // $config['allowed_types']        = 'gif|jpg|jpeg|png';
        // $config['max_size']             = 1000; //set max size allowed in Kilobyte
        // $config['max_width']            = 1000; // set max width image allowed
        // $config['max_height']           = 1000; // set max height allowed
// //        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
        // $config['encrypt_name']          = TRUE;

        // $this->load->library('upload', $config);

        // if(!$this->upload->do_upload('photo')) //upload and validate
        // {
            // $data['inputerror'][] = 'photo';
			// $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			// $data['status'] = FALSE;
			// echo json_encode($data);
			// exit();
		// }
		// return $this->upload->data('file_name');
	// }

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

		// if($this->input->post('category') == '')
		// {
			// $data['inputerror'][] = 'category';
			// $data['error_string'][] = 'Last name is required';
			// $data['status'] = FALSE;
		// }

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

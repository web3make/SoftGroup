<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//@source http://mbahcoding.com/tutorial/php/codeigniter/codeigniter-ajax-crud-using-bootstrap-modals-datatables-image-upload.html
class Def extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('role')!='admin'){redirect();}
		$this->load->model('admin/def_model','def');
//	id	category	title	create	descript	photo	text 
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('admin/def_view');
	}

	public function ajax_list()
	{
		$this->load->helper('url');

		$list = $this->def->get_datatables();
		$data = array();
		$no = $_POST['start'];
//id|	title	category	create	descript	text	photo
//site_name	per_page
		foreach ($list as $def) {
			$no++;
			$row = array();
			$row[] = $def->site_name;
			$row[] = $def->per_page;
//			$row[] = $def->category;
			// $row[] = $def->create;
			// $row[] = $def->descript;
			// $row[] = $def->text;
			// if($def->photo)
				// $row[] = '<a href="'.base_url('upload/'.$def->photo).'" target="_blank"><img src="'.base_url('upload/'.$def->photo).'" class="img-responsive" /></a>';
			// else
				// $row[] = '(No photo)';

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person(1)"><i class="glyphicon glyphicon-pencil"></i> Edit</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						// "recordsTotal" => $this->def->count_all(),
						// "recordsFiltered" => $this->def->count_filtered(),
						
						"recordsTotal" => 1,
						"recordsFiltered" => 1,
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit()
	{
		$data = $this->def->get_by_id(1);
//		$data->text = ($data->text == '0000-00-00') ? '' : $data->text; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	// public function ajax_add()
	// {
	// $this->load->helper('date');//
	
		// $this->_validate();
		
		// $data = array(
				// 'title' => $this->input->post('title'),
				// // 'category' => $this->input->post('category'),
// //				'create' => $this->input->post('create'),
				// 'create' =>  now(),
				// 'descript' => $this->input->post('descript'),
				// 'text' => $this->input->post('text')
			// );

		// // if(!empty($_FILES['photo']['name']))
		// // {
			// // $upload = $this->_do_upload();
			// // $data['photo'] = $upload;
		// // }

		// $insert = $this->def->save($data);

		// echo json_encode(array("status" => TRUE));
	// }

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'site_name' => $this->input->post('site_name'),
				'per_page' => $this->input->post('per_page'),
				// 'category' => $this->input->post('category'),
//				'create' => $this->input->post('create'),
				// 'descript' => $this->input->post('descript'),
				// 'text' => $this->input->post('text'),
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
			// $def = $this->def->get_by_id($this->input->post('id'));
			// if(file_exists('upload/'.$def->photo) && $def->photo)
				// unlink('upload/'.$def->photo);

			// $data['photo'] = $upload;
		// }

		$this->def->update(array('id' => 1), $data);
		echo json_encode(array("status" => TRUE));
	}

	// public function ajax_delete($id)
	// {
		// //delete file
		// $def = $this->def->get_by_id($id);
		// // if(file_exists('upload/'.$def->photo) && $def->photo)
			// // unlink('upload/'.$def->photo);
		
		// $this->def->delete_by_id($id);
		// echo json_encode(array("status" => TRUE));
	// }

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

		if($this->input->post('site_name') == '')
		{
			$data['inputerror'][] = 'site_name';
			$data['error_string'][] = 'Site name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('per_page') == '')
		{
			$data['inputerror'][] = 'per_page';
			$data['error_string'][] = 'per_page is required';
			$data['status'] = FALSE;
		}


		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

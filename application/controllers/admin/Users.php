<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//@source http://mbahcoding.com/tutorial/php/codeigniter/codeigniter-ajax-crud-using-bootstrap-modals-datatables-image-upload.html
class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('role')!='admin'){redirect();}
		$this->load->model('admin/users_model','users');
//	id	category	title	create	descript	photo	text
	}

	public function index()
	{
		$this->load->helper('url');
		$dat = array();
		$this->load->view('admin/users_view');
	}

	public function ajax_list()
	{
		$this->load->helper('url');

		$list = $this->users->get_datatables();
		$data = array();
		$no = $_POST['start'];
//id|	title	category	create	descript	text	photo
		foreach ($list as $users) {
			$no++;
			$row = array();
			$row[] = $users->user_name;
			$row[] = $users->role;
			$row[] = $users->control;
			// $row[] = $users->descript;
			// $row[] = $users->text;
			// if($users->photo)
				// $row[] = '<a href="'.base_url('upload/'.$users->photo).'" target="_blank"><img src="'.base_url('upload/'.$users->photo).'" class="img-responsive" /></a>';
			// else
				// $row[] = '(No photo)';

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$users->id_user."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$users->id_user."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->users->count_all(),
						"recordsFiltered" => $this->users->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id_user)
	{
		$data = $this->users->get_by_id($id_user);
//		$data->text = ($data->text == '0000-00-00') ? '' : $data->text; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	// public function ajax_add()
	// {
	// $this->load->helper('date');//
	
		// $this->_validate();
		
		// $data = array(
				// 'user_name' => $this->input->post('user_name'),
				// 'role' => $this->input->post('role'),
				// 'control' => $this->input->post('control'),
// //				'create' => $this->input->post('create'),
				// // 'create' =>  now(),
				// // 'descript' => $this->input->post('descript'),
				// // 'text' => $this->input->post('text')
			// );

		// if(!empty($_FILES['photo']['name']))
		// {
			// $upload = $this->_do_upload();
			// $data['photo'] = $upload;
		// }

		// $insert = $this->users->save($data);

		// echo json_encode(array("status" => TRUE));
	// }

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'user_name' => $this->input->post('user_name'),
				'role' => $this->input->post('role'),
				'control' => $this->input->post('control'),
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
			// $users = $this->users->get_by_id($this->input->post('id_user'));
			// if(file_exists('upload/'.$users->photo) && $users->photo)
				// unlink('upload/'.$users->photo);

			// $data['photo'] = $upload;
		// }

		$this->users->update(array('id_user' => $this->input->post('id_user')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id_user)
	{
		//delete file
		// $users = $this->users->get_by_id($id_user);
		// if(file_exists('upload/'.$users->photo) && $users->photo)
			// unlink('upload/'.$users->photo);
		
		$this->users->delete_by_id($id_user);
		echo json_encode(array("status" => TRUE));
	}

	// private function _do_upload()
	// {
		// $config['upload_path']          = './upload/';
        // $config['allowed_types']        = 'gif|jpg|jpeg|png';
        // $config['max_size']             = 3200; //set max size allowed in Kilobyte
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
// //-------
// //---------------------------------------------
// $config['image_library'] = 'gd2';
// $config['source_image']	= './upload/'.$this->upload->data('file_name');
// $config['width']	= 730;
// $config['height']	= 292;
// $config['maintain_ratio'] = false;

// $this->load->library('image_lib', $config); 

// $this->image_lib->resize();
// //---------------------------------------------	
// //-------
		// return $this->upload->data('file_name');
	// }

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('user_name') == '')
		{
			$data['inputerror'][] = 'user_name';
			$data['error_string'][] = 'user_name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('role') == '')
		{
			$data['inputerror'][] = 'role';
			$data['error_string'][] = 'Last name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('control') == '')
		{
			$data['inputerror'][] = 'control';
			$data['error_string'][] = 'Date of Birth is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

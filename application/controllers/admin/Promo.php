<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//@source http://mbahcoding.com/tutorial/php/codeigniter/codeigniter-ajax-crud-using-bootstrap-modals-datatables-image-upload.html
class Promo extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('role')!='admin'){redirect();}
		$this->load->model('admin/promo_model','promo');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('admin/promo_view');
	}

	public function ajax_list()
	{
		$this->load->helper('url');

		$list = $this->promo->get_datatables();
		$data = array();
		$no = $_POST['start'];
// id,title,text,link,photo		
		foreach ($list as $promo) {
			$no++;
			$row = array();
			$row[] = $promo->title;
			$row[] = $promo->text;
//			$row[] = $promo->gender;
			$row[] = $promo->link;
//			$row[] = $promo->dob;
			if($promo->photo)
				$row[] = '<a href="'.base_url('images/slider/'.$promo->photo).'" target="_blank"><img src="'.base_url('images/slider/'.$promo->photo).'" class="img-responsive" /></a>';
			else
				$row[] = '(No photo)';

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$promo->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$promo->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->promo->count_all(),
						"recordsFiltered" => $this->promo->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->promo->get_by_id($id);
//		$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
				'title' => $this->input->post('title'),
				'text' => $this->input->post('text'),
//				'gender' => $this->input->post('gender'),
				'link' => $this->input->post('link'),
//				'dob' => $this->input->post('dob'),
			);

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			$data['photo'] = $upload;
		}

		$insert = $this->promo->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'title' => $this->input->post('title'),
				'text' => $this->input->post('text'),
//				'gender' => $this->input->post('gender'),
				'link' => $this->input->post('link'),
//				'dob' => $this->input->post('dob'),
			);

		if($this->input->post('remove_photo')) // if remove photo checked
		{
			if(file_exists(base_url('images/slider/'.$this->input->post('remove_photo'))) && $this->input->post('remove_photo'))
				unlink(base_url('images/slider/'.$this->input->post('remove_photo')));
			$data['photo'] = '';
		}

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			
			//delete file
			$promo = $this->promo->get_by_id($this->input->post('id'));
			if(file_exists(base_url('images/slider/'.$promo->photo)) && $promo->photo)
				unlink(base_url('images/slider/'.$promo->photo));

			$data['photo'] = $upload;
		}

		$this->promo->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		//delete file
		$promo = $this->promo->get_by_id($id);
		if(file_exists(base_url('images/slider/'.$promo->photo)) && $promo->photo)
			unlink(base_url('images/slider/'.$promo->photo));
		
		$this->promo->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload()
	{
//		$config['upload_path']          = base_url('upload/');
//		$config['upload_path']          =  base_url()."upload/";
//		$config['upload_path']          =  site_url("upload/");
		$config['upload_path'] = FCPATH . 'images/slider/';
// $config['upload_path'] ='upload';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
		//---
		//$config['overwrite'] = true;
		//$config['remove_spaces'] = true;		
		//---
        $config['max_size']             = 180200; //set max size allowed in Kilobyte
        $config['max_width']            = 3264; // set max width image allowed
        $config['max_height']           = 2448; // set max height allowed
//        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
        $config['encrypt_name']          = TRUE;

//        $this->load->library('upload');
        $this->load->library('upload', $config);
//$this->upload->initialize($config);
//$this->upload->do_upload(); 
//echo('<script>console.log('$data')</script>');
        if(!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
//---------------------------------------------
$config['image_library'] = 'gd2';
//$config['source_image']	= base_url('upload/'.$this->upload->data('file_name'));
$config['source_image']	= './images/slider/'.$this->upload->data('file_name');
$config['width']	= 1920;
$config['height']	= 750;
$config['maintain_ratio'] = false;
$this->load->library('image_lib', $config); 
$this->image_lib->resize();
//---------------------------------------------		
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
			$data['error_string'][] = 'First name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('text') == '')
		{
			$data['inputerror'][] = 'text';
			$data['error_string'][] = 'Last name is required';
			$data['status'] = FALSE;
		}

		// if($this->input->post('dob') == '')
		// {
			// $data['inputerror'][] = 'dob';
			// $data['error_string'][] = 'Date of Birth is required';
			// $data['status'] = FALSE;
		// }

		// if($this->input->post('gender') == '')
		// {
			// $data['inputerror'][] = 'gender';
			// $data['error_string'][] = 'Please select gender';
			// $data['status'] = FALSE;
		// }

		if($this->input->post('link') == '')
		{
			$data['inputerror'][] = 'link';
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

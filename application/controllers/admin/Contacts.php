<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//@source http://mbahcoding.com/tutorial/php/codeigniter/codeigniter-ajax-crud-using-bootstrap-modals-datatables-image-upload.html
class Contacts extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('role')!='admin'){redirect();}
		$this->load->model('admin/contacts_model','contacts');
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('admin/contacts_view');
	}

	public function ajax_list()
	{
		$this->load->helper('url');

		$list = $this->contacts->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $contacts) {
			$no++;
//'','','','','photo'
			$row = array();
			$row[] = $contacts->contact;
			$row[] = $contacts->name;
			$row[] = $contacts->about;
			$row[] = $contacts->slogan;
			$row[] = $contacts->rank;
			$row[] = $contacts->soc_fb;
			$row[] = $contacts->soc_gp;
			$row[] = $contacts->soc_tw;
			$row[] = $contacts->soc_in;
			$row[] = $contacts->bio;
			if($contacts->photo)
				$row[] = '<a href="'.base_url('images/'.$contacts->photo).'" target="_blank"><img src="'.base_url('images/'.$contacts->photo).'" class="img-responsive" /></a>';
			else
				$row[] = '(No photo)';

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$contacts->contact."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$contacts->contact."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->contacts->count_all(),
						"recordsFiltered" => $this->contacts->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($contact)
	{
		$data = $this->contacts->get_by_id($contact);
//		$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
				'contact' => $this->input->post('contact'),
				'name' => $this->input->post('name'),
				'about' => $this->input->post('about'),
				'slogan' => $this->input->post('slogan'),
				'rank' => $this->input->post('rank'),
				'soc_fb' => $this->input->post('soc_fb'),
				'soc_gp' => $this->input->post('soc_gp'),
				'soc_tw' => $this->input->post('soc_tw'),
				'soc_in' => $this->input->post('soc_in'),
				'bio' => $this->input->post('bio'),
			);

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			$data['photo'] = $upload;
		}

		$insert = $this->contacts->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'contact' => $this->input->post('contact'),
				'name' => $this->input->post('name'),
				'about' => $this->input->post('about'),
				'slogan' => $this->input->post('slogan'),
				'rank' => $this->input->post('rank'),
				'soc_fb' => $this->input->post('soc_fb'),
				'soc_gp' => $this->input->post('soc_gp'),
				'soc_tw' => $this->input->post('soc_tw'),
				'soc_in' => $this->input->post('soc_in'),
				'bio' => $this->input->post('bio'),
			);

		if($this->input->post('remove_photo')) // if remove photo checked
		{
			if(file_exists('images/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
				unlink('images/'.$this->input->post('remove_photo'));
			$data['photo'] = '';
		}

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			
			//delete file
			$contacts = $this->contacts->get_by_id($this->input->post('contact'));
			if(file_exists('images/'.$contacts->photo) && $contacts->photo)
				unlink('images/'.$contacts->photo);

			$data['photo'] = $upload;
		}

		$this->contacts->update(array('contact' => $this->input->post('contact')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($contact)
	{
		//delete file
		$contacts = $this->contacts->get_by_id($contact);
		if(file_exists('images/'.$contacts->photo) && $contacts->photo)
			unlink('images/'.$contacts->photo);
		
		$this->contacts->delete_by_id($contact);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload()
	{
		//$config['upload_path']          = 'upload/';
		$config['upload_path'] = FCPATH.'images/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png';
        $config['max_size']             = 1000; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
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
//---------------------------------------------
$config['image_library'] = 'gd2';
$config['source_image']	= 'images/'.$this->upload->data('file_name');
$config['width']	= 350;
$config['height']	= 350;
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

		if($this->input->post('contact') == '')
		{
			$data['inputerror'][] = 'contact';
			$data['error_string'][] = 'First name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('name') == '')
		{
			$data['inputerror'][] = 'name';
			$data['error_string'][] = 'Last name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('about') == '')
		{
			$data['inputerror'][] = 'about';
			$data['error_string'][] = 'Date of Birth is required';
			$data['status'] = FALSE;
		}

		// if($this->input->post('gender') == '')
		// {
			// $data['inputerror'][] = 'gender';
			// $data['error_string'][] = 'Please select gender';
			// $data['status'] = FALSE;
		// }

		if($this->input->post('slogan') == '')
		{
			$data['inputerror'][] = 'slogan';
			$data['error_string'][] = 'Addess is required';
			$data['status'] = FALSE;
		}
//-------
		if($this->input->post('rank') == ''){
			$data['inputerror'][] = 'rank';
			$data['error_string'][] = 'Addess is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('soc_fb') == ''){
			$data['inputerror'][] = 'soc_fb';
			$data['error_string'][] = 'Addess is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('soc_gp') == ''){
			$data['inputerror'][] = 'soc_gp';
			$data['error_string'][] = 'Addess is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('soc_tw') == ''){
			$data['inputerror'][] = 'soc_tw';
			$data['error_string'][] = 'Addess is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('bio') == ''){
			$data['inputerror'][] = 'bio';
			$data['error_string'][] = 'Addess is required';
			$data['status'] = FALSE;
		}


		if($this->input->post('soc_in') == ''){
			$data['inputerror'][] = 'soc_in';
			$data['error_string'][] = 'Addess is required';
			$data['status'] = FALSE;
		}
//-------
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//@source http://mbahcoding.com/tutorial/php/codeigniter/codeigniter-ajax-crud-using-bootstrap-modals-datatables-image-upload.html
class Categories extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('role')!='admin'){redirect();}
		$this->load->model('admin/categories_model','categories');
//	id	category	title	create	descript	photo	text
//category	title	activated
	}

	public function index()
	{
		$this->load->helper('url');
		$this->load->view('admin/categories_view');
	}

	public function ajax_list()
	{
		$this->load->helper('url');

		$list = $this->categories->get_datatables();
		$data = array();
		$no = $_POST['start'];
//id|	title	category	create	descript	text	photo
		foreach ($list as $categories) {
			$no++;
			$row = array();
			$row[] = $categories->category;
			$row[] = $categories->title;
			$row[] = $categories->activated;
//			$row[] = $categories->descript;
//			$row[] = $categories->text;
			// if($categories->photo)
				// $row[] = '<a href="'.base_url('upload/'.$categories->photo).'" target="_blank"><img src="'.base_url('upload/'.$categories->photo).'" class="img-responsive" /></a>';
			// else
				// $row[] = '(No photo)';

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$categories->category."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$categories->category."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->categories->count_all(),
						"recordsFiltered" => $this->categories->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($category)
	{
		$data = $this->categories->get_by_id($category);
//		$data->text = ($data->text == '0000-00-00') ? '' : $data->text; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
	$this->load->helper('date');//
	
		$this->_validate();
		
		$data = array(		
				'title' => $this->input->post('title'),
				'category' => $this->input->post('category'),
				'activated' => $this->input->post('activated')
			);

		// if(!empty($_FILES['photo']['name']))
		// {
			// $upload = $this->_do_upload();
			// $data['photo'] = $upload;
		// }

		$insert = $this->categories->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'title' => $this->input->post('title'),
				'category' => $this->input->post('category'),
				'activated' => $this->input->post('activated'),
			);

		$this->categories->update(array('category' => $this->input->post('category')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($category)
	{
		//delete file
		$categories = $this->categories->get_by_id($category);
		// if(file_exists('upload/'.$categories->photo) && $categories->photo)
			// unlink('upload/'.$categories->photo);
		
		$this->categories->delete_by_id($category);
		echo json_encode(array("status" => TRUE));
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
			$data['error_string'][] = 'Category is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('activated') == '')
		{
			$data['inputerror'][] = 'activated';
			$data['error_string'][] = 'Activated is required';
			$data['status'] = FALSE;
		}


		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}

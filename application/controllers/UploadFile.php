<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UploadFile extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('FileModel');
	}	

	public function index() {
		$this->load->view('header');
		$this->load->view('uploadFileView');
		$this->load->view('footer');
	}
	
	public function uploadImage() {
		$timeStamp = time();
		$fileName = $timeStamp."-".$_FILES['uploadImage']['name'];
		$config['upload_path'] = './uploads/';
		$config['allowed_types']  = 'gif|jpg|png';
		$config['file_name']  = $timeStamp."-".$_FILES['uploadImage']['name'];
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('uploadImage')) {
			print_r($this->upload->display_errors());die;
		} else {
			$this->FileModel->saveFile($fileName);
			$this->load->library('image_lib');
			$imgConfig = array();
			$imgConfig['image_library']   = 'GD2';
			$imgConfig['source_image']    = $_SERVER['DOCUMENT_ROOT']."/watermark/uploads/".$fileName;
			$imgConfig['wm_type']       = 'overlay';
			$imgConfig['wm_opacity'] = '30';
			$imgConfig['wm_overlay_path'] = $_SERVER['DOCUMENT_ROOT']."/watermark/images/ABP.jpg";
			$imgConfig['wm_x_transp'] = '10';
			//$config['wm_opacity'] = '50';
			$imgConfig['wm_vrt_alignment'] = 'middle';
			//$imgConfig['wm_hor_alignment'] = 'top';
			$this->load->library('image_lib', $imgConfig);
			$this->image_lib->initialize($imgConfig);
			$this->image_lib->watermark();
			$url = base_url()."uploads/".$fileName;
			$img = "<img src='".$url."' />";
			echo $img;
		}
	}


	public function filelist() {
        $data['files'] = $this->FileModel->getFiles();
        $this->load->view('header');
        $this->load->view('fileslist',$data);
    }

    public function editFile() {
    	$id = $this->input->get('id');
    	$data['image_details'] = $this->FileModel->getImageDetails($id);
    	$this->load->view('header');
    	$this->load->view('editFileView',$data);
    	$this->load->view('footer');
    }	

    public function deleteFile() {
    	$id = $this->input->get('id');
    	$this->FileModel->removeFile($id);
    	redirect('UploadFile/filelist');
    }

    public function changeFile() {
    	$post = $this->input->post();
    	unset($post['btnSubmit']);
    	$timeStamp = time();
		$fileName = $timeStamp."-".$_FILES['uploadImage']['name'];
		$config['upload_path'] = './uploads/';
		$config['allowed_types']  = 'gif|jpg|png';
		$config['file_name']  = $timeStamp."-".$_FILES['uploadImage']['name'];
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('uploadImage')) {
			print_r($this->upload->display_errors());die;
		} else {
			$this->FileModel->saveEditedFile($fileName,$post['image_id']);
			$this->load->library('image_lib');
			$imgConfig = array();
			$imgConfig['image_library']   = 'GD2';
			$imgConfig['source_image']    = $_SERVER['DOCUMENT_ROOT']."/watermark/uploads/".$fileName;
			$imgConfig['wm_type']       = 'overlay';
			$imgConfig['wm_opacity'] = '30';
			$imgConfig['wm_overlay_path'] = $_SERVER['DOCUMENT_ROOT']."/watermark/images/ABP.jpg";
			$imgConfig['wm_x_transp'] = '10';
			//$config['wm_opacity'] = '50';
			$imgConfig['wm_vrt_alignment'] = 'middle';
			//$imgConfig['wm_hor_alignment'] = 'top';
			$this->load->library('image_lib', $imgConfig);
			$this->image_lib->initialize($imgConfig);
			$this->image_lib->watermark();
			$deleteImage = $_SERVER['DOCUMENT_ROOT']."/watermark/uploads/".$post['image_name'];
			unlink($deleteImage);
			$url = base_url()."uploads/".$fileName;
			$img = "<img src='".$url."' />";
			echo $img;
		}
    }

}
?>
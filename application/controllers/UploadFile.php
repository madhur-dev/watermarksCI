<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UploadFile extends CI_Controller {

	public function index() {
		$this->load->view('header');
		$this->load->view('uploadFileView');
		$this->load->view('footer');
		// $this->load->library('image_lib');
		// $url = base_url()."images/photo.jpeg";
		// $img = "<img src='".$url."' style='width:500px;height:300px'/>";
		// $imgConfig = array();
        // $imgConfig['image_library']   = 'GD2';
		// $imgConfig['source_image']    = $_SERVER['DOCUMENT_ROOT']."/watermark/images/photo.jpeg";
		// $imgConfig['wm_type']       = 'overlay';  
		// $imgConfig['wm_overlay_path'] = $_SERVER['DOCUMENT_ROOT']."/watermark/images/pro.jpg";
		// $imgConfig['wm_font_size']    = '90';
		// $config['wm_vrt_alignment'] = 'middle';
        // $config['wm_hor_alignment'] = 'right';
		// $this->load->library('image_lib', $imgConfig);
		// $this->image_lib->initialize($imgConfig);
        // $this->image_lib->watermark(); 
		// echo $img;
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
			$this->load->library('image_lib');
			$imgConfig = array();
			$imgConfig['image_library']   = 'GD2';
			$imgConfig['source_image']    = $_SERVER['DOCUMENT_ROOT']."/watermark/uploads/".$fileName;
			$imgConfig['wm_type']       = 'overlay';
			$imgConfig['wm_opacity'] = '100';
			$imgConfig['wm_overlay_path'] = $_SERVER['DOCUMENT_ROOT']."/watermark/images/helpdesk.png";
			//$imgConfig['wm_x_transp'] = '10';
			
			// $imgConfig['wm_vrt_alignment'] = 'middle';
			// $imgConfig['wm_hor_alignment'] = 'right';
			$this->load->library('image_lib', $imgConfig);
			$this->image_lib->initialize($imgConfig);
			$this->image_lib->watermark();
			$url = base_url()."uploads/".$fileName;
			$img = "<img src='".$url."' />";
			echo $img;
		}
	}
}

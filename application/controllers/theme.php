<?php

if(!defined('BASEPATH')) exit ('No direct script allowed');

class Theme extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('mTheme');
	}

	public function index(){
		$data = array();
		$data['content'] = array();
		$data['content'][] = 'theme';
		$data['js'] = 'speedSearch';
		$data['css'] = 'theme';
		$data['themes'] = $this->mTheme->findAll();
		$this->load->view('template', $data);
	}

	public function detail($theme){
		$th = $this->mTheme->findAllBy(array('id_theme' => $theme));
		$data['themes'] = $th;
		$data['content'][] = 'theme';
		$this->load->view('detail_theme', $data);
	}
}
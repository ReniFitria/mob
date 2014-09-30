<?php

class Datanasabah extends Controller {

	function __construct() {
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		if ($logged == false) {
			Session::destroy();
			header('location: ../index');
			exit;
		}
	}
	
	function index() 
	{	
		$this->view->render('datanasabah/index');
	}
	
	function xhrGetListings() 
	{	
		$this->model->xhrGetListings();
		echo json_decode($data, true);
		$aa = $data["Records"];
	}

}
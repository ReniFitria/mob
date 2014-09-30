<?php

class Laporantrans extends Controller {

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
		$this->view->render('laporantrans/index');	
	}
	
	function tampilLap()
	{
		if(isset($_POST))
		{
			$this->model->tampilLap();
			echo json_decode ($data, true);
			$aa = $data["Records"];
		/*	echo json_decode ($data1, true);
			$aa1 = $data1["Results"];
			echo json_decode ($data2, true);
			$aa2 = $data2["abc"]; */
		}
	}
}
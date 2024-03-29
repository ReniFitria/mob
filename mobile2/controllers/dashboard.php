<?php

class Dashboard extends Controller {

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
		$this->view->render('dashboard/index');
	}
	
	function xhrInsert() 
	{	
		$this->model->xhrInsert();
	}

	function logout()
	{
		Session::destroy();
		header('location: ../index');
		exit;
	}
}
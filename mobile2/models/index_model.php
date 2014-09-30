<?php

class Index_Model extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function run()
	{
		$sth = $this->db->prepare("SELECT uid FROM pengguna WHERE 
				username = :username AND pass = MD5(:pass)");
		$sth->execute(array(
			':username' => $_POST['username'],
			':pass' => $_POST['pass']
		));
		
		//$data = $sth->fetchAll();
		
		$count =  $sth->rowCount();
		if ($count > 0) {
			// login
			Session::init();
			Session::set('loggedIn', true);
			header('location: ../utama');
		} else {
			header('location: ../index');
		}
		
	}
	
}
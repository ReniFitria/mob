<?php

class Datanasabah_Model extends Model {

	function __construct() {
		parent::__construct();
	}
	
	function xhrGetListings()
	{
		$sth = $this->db->prepare('SELECT * FROM nasabah order by no_rekening');
		$sth->setFetchMode(PDO::FETCH_OBJ);
		$sth->execute();
		$data = $sth->fetchAll();
		echo json_encode($data);
		
	}
}
<?php

class Dashboard_Model extends Model {

	function __construct() {
		parent::__construct();
	}
	
	function xhrInsert() 
	{
		$no_rekening = $_POST['no_rekening'];
		$nama_nasabah = $_POST['nama_nasabah'];
		$alamat_nasabah = $_POST['alamat_nasabah'];
		$telepon = $_POST['telepon'];
		$saldo = $_POST['saldo'];
		
		$sth = $this->db->prepare('INSERT INTO nasabah (no_rekening, nama_nasabah, alamat_nasabah, telepon, saldo) VALUES (:no_rekening, :nama_nasabah, :alamat_nasabah, :telepon, :saldo)');
		$sth->execute(array(':no_rekening' => $no_rekening, 
							':nama_nasabah' => $nama_nasabah,
							':alamat_nasabah' => $alamat_nasabah,
							':telepon' => $telepon,
							':saldo' => $saldo));
		echo json_encode($sth);
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
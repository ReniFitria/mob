<?php

class Laporanjual_Model extends Model {

	function __construct() {
		parent::__construct();
	}
	
	function tampilLap() 
	{
	$tanggal_awal=$_POST['tanggal_awal'];
	$tanggal_akhir=$_POST['tanggal_akhir'];
	
	if( empty($tanggal_awal) and empty($tanggal_akhir)){
		//jika tidak menginput apa2
		$query=$this->db->prepare("SELECT penjualan_sampah.tgl_penjualan_sampah, penjualan_sampah.kode_penjualan_sampah, pengepul.nama_pengepul, penjualan_sampah.total_bayar FROM penjualan_sampah, pengepul where penjualan_sampah.id_pengepul=pengepul.id_pengepul order by kode_penjualan_sampah");
		$query->execute();	
		$data = $query->fetchAll();
		echo json_encode($data);
		
	/*	$jumlah=$this->db->prepare("select sum(total_bayar) as jumlah from penjualan_sampah");
			$jumlah->execute();
			$data1 = $jumlah->fetchAll();
			echo json_encode($data1);	*/
	}else{
		
		$query=$this->db->prepare("SELECT penjualan_sampah.tgl_penjualan_sampah, penjualan_sampah.kode_penjualan_sampah, pengepul.nama_pengepul, penjualan_sampah.total_bayar FROM penjualan_sampah, pengepul where penjualan_sampah.id_pengepul=pengepul.id_pengepul and tgl_penjualan_sampah between '$tanggal_awal' and '$tanggal_akhir'");
			$query->execute();
		$data = $query->fetchAll();
		echo json_encode($data);
		
	/*	$jumlah=$this->db->prepare("select sum(total_bayar) as jumlah from penjualan_sampah where tgl_penjualan_sampah between '$tanggal_awal' and '$tanggal_akhir'");
			$jumlah->execute();
			$data1 = $jumlah->fetchAll();
			echo json_encode($data1);    */
	}
	while($row=$query->fetch(PDO::FETCH_ASSOC))
	{
		$tgl_penjualan_sampah = $row[0];
		$kode_penjualan_sampah = $row[1];
		$nama_pengepul = $row[2];
		$total_bayar = $row[3];

			print ("<tr>\n");
			print ("<td>". $row['tgl_penjualan_sampah'] ."</td>");
			print ("<td>". $row['kode_penjualan_sampah'] ."</td>");
			print ("<td>". $row['nama_pengepul'] ."</td>");
			print ("<td>". $row['total_bayar'] ."</td>");
			print ("</tr>\n");
	}
	}
}
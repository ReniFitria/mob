<?php

class Laporantrans_Model extends Model {

	function __construct() {
		parent::__construct();
	}
	
	function tampilLap() 
	{
	$tanggal_awal=$_POST['tanggal_awal'];
	$tanggal_akhir=$_POST['tanggal_akhir'];
	
	if( empty($tanggal_awal) and empty($tanggal_akhir)){
		//jika tidak menginput apa2
		
		
		$query=$this->db->prepare("SELECT transaksi.tgl_transaksi, transaksi.no_transaksi, nasabah.no_rekening, nasabah.nama_nasabah,
									transaksi.debet, transaksi.kredit from transaksi, nasabah where transaksi.no_rekening=nasabah.no_rekening");
		$query->execute();
		$data = $query->fetchAll();
		echo json_encode($data);
		
	/*	$jumlah=$db->prepare("select sum(debet) as total from transaksi");
		$jumlah->execute();
		$data1 = $jumlah->fetchAll();
		echo json_encode($data1);
		
		$jumlah2=$db->prepare("select sum(kredit) as total_kredit from transaksi");
		$jumlah2->execute();
		$data2 = $jumlah2->fetchAll();
		echo json_encode($data2);*/
		
	}else{
	
	
		
		$query=$this->db->prepare("SELECT transaksi.tgl_transaksi, transaksi.no_transaksi, nasabah.no_rekening, nasabah.nama_nasabah,
									transaksi.debet, transaksi.kredit from transaksi, nasabah where transaksi.no_rekening=nasabah.no_rekening and transaksi.tgl_transaksi between '$tanggal_awal' and '$tanggal_akhir'");
		$query->execute();	
		$data = $query->fetchAll();
		echo json_encode($data);	

		/*	$jumlah=$this->db->prepare("select sum(debet) as total from transaksi where tgl_transaksi between '$tanggal_awal' and '$tanggal_akhir'");
			$jumlah->execute();
			$data1 = $jumlah->fetchAll();
			echo json_encode($data1);
			
			$jumlah2=$this->db->prepare("select sum(kredit) as total_kredit from transaksi where tgl_transaksi between '$tanggal_awal' and '$tanggal_akhir'");
			$jumlah2->execute();
			$data2 = $jumlah2->fetchAll();
				echo json_encode($data2);*/
		
	}
	while($row=$query->fetch(PDO::FETCH_ASSOC))
		{
			$tgl_transaksi = $row[0];
			$no_transaksi = $row[1];
			$no_rekening = $row[2];
			$nama_nasabah = $row[3];
			$debet = $row[4];
			$kredit = $row[5];

			print ("<tr>\n");
			print ("<td>". $row['tgl_transaksi'] ."</td>");
			print ("<td>". $row['no_transaksi'] ."</td>");
			print ("<td>". $row['no_rekening'] ."</td>");
			print ("<td>". $row['nama_nasabah'] ."</td>");
			print ("<td>". $row['debet'] ."</td>");
			print ("<td>". $row['kredit'] ."</td>");
		}
	}
	}
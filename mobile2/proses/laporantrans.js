$(document).ready(function() {
		$("#proses").click( function(e){
			e.preventDefault();
			var awal = $("#tanggal_awal").val();
			var akhir = $("#tanggal_akhir").val();
			if(awal==''){
				$('#required').show();
			}else if(akhir==''){
				$('#required').show();
			}else{
				$('#form').hide();
				$('#required').hide();
				$('#loading_panel').show();
				epg_channel(awal,akhir);
			}
		});
	
function epg_channel(awal,akhir){
	var serviceURL = "http://localhost/mobile2/";
	var strAwal		= $("#tanggal_awal").val();
	var strAkhir	= $("#tanggal_akhir").val();
	$.ajax({
				type : 'POST',
				url : serviceURL + 'laporantrans/tampilLap',
				async: true,
				data: {
					awal: strAwal,
					akhir: strAkhir
				},
				beforeSend: function(x) {
					if(x && x.overrideMimeType) {
      					 x.overrideMimeType("application/j-son;charset=UTF-8");
      				}
				},
				dataType : 'json',
				success : function(data){
						if(data ==''){
							$('#loading_panel').hide();
							$('#empty').show();
						}else{ 
							$('#loading_panel').hide();
							$('#tampilData').show();
								$.each(data, function(index, loaddata) {
									var tgl_transaksi = loaddata.tgl_transaksi;
									var no_transaksi = loaddata.no_transaksi;
									var no_rekening = loaddata.no_rekening;
									var nama_nasabah = loaddata.nama_nasabah;
									var debet = loaddata.debet;
									var kredit = loaddata.kredit;
							$('#laporan').append(
								'<h4>' + loaddata.tgl_transaksi + '</h4>' +
								'<p>' + loaddata.no_transaksi  +'</p>' +
								'<p>' + loaddata.no_rekening  +'</p>' +
								'<p>' + loaddata.nama_nasabah  +'</p>' +
								'<p>' + loaddata.debet  +'</p>' +
								'<p>' + loaddata.kredit + '</p>');
							});
							$('#laporan').listview('refresh');
						}
				},
				error: function(jqXHR, exception) {
					$('#loading_panel').hide();
					$('#conn_failed').show();
				}
		});	
}
	

}); //Tutup Document Ready
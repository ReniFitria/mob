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
				url : serviceURL + 'laporanjual/tampilLap',
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
						if(data==''){
							$('#loading_panel').hide();
							$('#empty').show();
						}else{ 
							$('#loading_panel').hide();
							$('#tampilData').show();
								$.each(data, function(index, loaddata) {
									var tgl_penjualan_sampah = loaddata.tgl_penjualan_sampah;
									var kode_penjualan_sampah = loaddata.kode_penjualan_sampah;
									var nama_pengepul = loaddata.nama_pengepul;
									var total_bayar = loaddata.total_bayar;
							$('#laporan').append(
								'<h4>' + loaddata.tgl_penjualan_sampah + '</h4>' +
								'<p>' + loaddata.kode_penjualan_sampah  +'</p>' +
								'<p>' + loaddata.nama_pengepul  +'</p>' +
								'<p>' + loaddata.total_bayar  +'</p>');
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
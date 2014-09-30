$(document).ready(function() {
				
		$("#proses").click( function(e){
			var no_rekening		= $("#no_rekening").val();
			var nama_nasabah	= $("#nama_nasabah").val();
			var alamat_nasabah	= $("#alamat_nasabah").val();
			var telepon  	    = $("#telepon").val();
			var saldo			= $("#saldo").val();
			
			e.preventDefault();
			
			if(no_rekening==''){
				$('#required').show();
			}else if(nama_nasabah==''){
				$('#required').show();
			}else if(alamat_nasabah==''){
				$('#required').show();
			}else if(telepon==''){
				$('#required').show();
			}else if(saldo==''){
				$('#required').show();
			}else{
				$('#formsaran').hide();
				$('#required').hide();
				$('#loading_panel').show();
				KirimSaran();
			}
		});
	
	
		

function KirimSaran(){
	var serviceURL = "http://localhost/mobile2/";
	
			var no_rekening		= $("#no_rekening").val();
			var nama_nasabah	= $("#nama_nasabah").val();
			var alamat_nasabah	= $("#alamat_nasabah").val();
			var telepon  	    = $("#telepon").val();
			var saldo			= $("#saldo").val();
	
	$.ajax({
				type : 'POST',
				url : serviceURL + 'dashboard/xhrInsert',
				async: true,
				data: {
					no_rekening: no_rekening,
					nama_nasabah: nama_nasabah,
					alamat_nasabah: alamat_nasabah,
					telepon: telepon,
					saldo: saldo
				},
				beforeSend: function(x) {
					if(x && x.overrideMimeType) {
      					 x.overrideMimeType("application/j-son;charset=UTF-8");
      				}
				},	
				dataType : 'json',
				success : function(data){
						var cek = data.result;
						if(cek=='Sukses'){
							$('#loading_panel').hide();
							$('#sukses').show();
						}
				},
				error: function(jqXHR, exception) {
					$('#loading_panel').hide();
					$('#conn_failed').show();
				}
		});	
}
	

}); //Tutup Document Ready










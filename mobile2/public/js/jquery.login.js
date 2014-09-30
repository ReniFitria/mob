$(document).ready(function() {
	
	removeSession();
	
	$("#login").click(function(e){
		$('#formlogin').show();
		
        e.preventDefault();
		var username    = document.getElementById('username').value
		var pass    	= document.getElementById('pass').value
		var dataString	= 'username='+ username + '&pass=' + pass
		var serviceURL = "http://localhost/mobile2/";
		$.ajax({
			url: serviceURL + 'index/run',
			dataType:'json',
			type: 'POST',
			timeout: 15000,
			cache: false,
			data: dataString,
			success:function(response){
				$('#infologin').hide();
				for(var i=0; i<response.length; i++){
					
						var str,str2,str3 = "";
						str		= response[i].username;
						str2	= response[i].pass;
						str3	= response[i].DESC_LOGIN;
						
						
					if(str=='-'){
						$('#wrong_password').show();
					}else{
						
						sessionStorage.setItem('username',str);
						sessionStorage.setItem('pass',str2);
						
						$.mobile.changePage($(document.location.href="utama"), 'slide');
					} 
				}
					
			},	
			error: function (xhr, ajaxOptions, thrownError) {
				if(thrownError==="timeout") {
					$('#formlogin').hide();
					$('#connection_failed').show();
				} else {
					$('#formlogin').hide();
					$('#connection_failed').show();
				}
			}  
		}); //Tutup Ajax
	
	
	}); //Tutup Button Click
	
}); //Tutup Document Ready


function removeSession(){
	sessionStorage.removeItem('username');
	sessionStorage.removeItem('pass');
}
	
function LoadingPanel(){
	$.mobile.changePage( "loading.html", { 
	   role: "dialog" 
	});
}

function ClosePanel(){
	$('[data-role=dialog]').dialog( "close" );	
}

function callAdmin(){
	$.mobile.loadPage( "utama" );
}


function clearData(){
	$('#username').val('');
	$('#pass').val('');
}


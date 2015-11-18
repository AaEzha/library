$(document).ready(function() {
	$("#numid").keyup( function() {
		var id = $("#numid").val();
	    $.ajax({
	        url: "kelurahan.php",
	        data: "kec="+id,
	        cache: false,
	        success: function(msg){
	            //jika data sukses diambil dari server kita tampilkan
	            //di <select id=kel>
	            $("#kel").html(msg);
	        }
	    });
	});
});
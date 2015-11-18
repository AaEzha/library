
<div style=" padding:15px"><br><p>
<b style='font-size:25px'>Register</b><br><p>
<div style='margin:25px'>

<script type="text/javascript">
$(document).ready(function() {
	$("#inputNomor_id").focusout( function() {
		var id = $("#inputNomor_id").val();
	    $.ajax({
	    	type: "GET",
	        url: "<?=base_url();?>users/daftarnama",
	        data: "id="+id,
	        cache: false,
	        success: function(data){
	            var container = $('#inputNama'); //jquery selector (get element by id)
				if(data){
					container.val(data);
				}else{
					container.val("");
				}
	        }
	    });
	    $.ajax({
	    	type: "GET",
	        url: "<?=base_url();?>users/daftarunit",
	        data: "id="+id,
	        cache: false,
	        success: function(data){
	            var container = $('#inputUnit'); //jquery selector (get element by id)
				if(data){
					container.val(data);
				}else{
					container.val("");
				}
	        }
	    });
	});
});	
</script>

<div  style="border-radius:15px;padding:15px" >
<?php
// print_r($option);
print_r( $this->session->flashdata('message') );
?>
<form action="" method="POST" class="form-horizontal" role="form">
		<div class="form-group">
			<label for="inputNomor_id" class="col-sm-2 control-label">ID Number</label>
			<div class="col-sm-4">
				<input type="text" name="nomor_id" id="inputNomor_id" class="form-control" maxlength="<?php echo $desc_table['nomor_id']['max_length']?>" value="<?php echo set_value('nomor_id'); ?>" required="required">
			</div>
		</div>

		<div class="form-group">
			<label for="inputNama" class="col-sm-2 control-label">Name</label>
			<div class="col-sm-4">
				<input type="text" name="nama" id="inputNama" class="form-control" maxlength="<?php echo $desc_table['nama']['max_length']?>" value="<?php echo set_value('nama'); ?>" readonly required>
			</div>
		</div>

		<div class="form-group">
			<label for="inputUnit" class="col-sm-2 control-label">Unit</label>
			<div class="col-sm-4">
				<input type="text" name="unit" id="inputUnit" class="form-control" maxlength="<?php echo $desc_table['unit']['max_length']?>" value="<?php echo set_value('unit'); ?>" readonly required>
			</div>
		</div>

		<div class="form-group">
			<label for="inputEmail" class="col-sm-2 control-label">Email</label>
			<div class="col-sm-4">
				<input type="email" name="email" id="inputEmail" class="form-control" maxlength="<?php echo $desc_table['email']['max_length']?>" value="<?php echo set_value('email'); ?>" required="required">
			</div>
		</div>

		<div class="form-group">
			<label for="inputTelepon" class="col-sm-2 control-label">Phone Number</label>
			<div class="col-sm-4">
				<input type="text" name="telepon" id="inputTelepon" class="form-control" maxlength="<?php echo $desc_table['telepon']['max_length']?>" value="<?php echo set_value('telepon'); ?>" required="required">
			</div>
		</div>

		<div class="form-group">
			<label for="inputKata_sandi" class="col-sm-2 control-label">Password</label>
			<div class="col-sm-4">
				<input type="password" name="kata_sandi" id="inputKata_sandi" class="form-control" required="required" maxlength="<?php echo $desc_table['kata_sandi']['max_length']?>" value="<?php echo set_value('kata_sandi'); ?>">
			</div>
		</div>

		<div class="form-group">
			<label for="inputUkata_sandi" class="col-sm-2 control-label">Confirm Password</label>
			<div class="col-sm-4">
				<input type="password" name="ukata_sandi" id="inputUkata_sandi" class="form-control" required="required" maxlength="<?php echo $desc_table['ukata_sandi']['max_length']?>" value="<?php echo set_value('ukata_sandi'); ?>">
			</div>
		</div>

		

		<div class="form-group">
			<div class="col-sm-10 col-sm-offset-2">
				<input type="submit" class="btn btn-primary" name="submit" value='Register'>
			</div>
		</div>
</form>

</div>
</div>
</div>


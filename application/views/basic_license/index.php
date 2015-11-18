<?php 	// echo "<pre>";	// print_r($this->session->all_userdata());	$data = $this->session->all_userdata();	// echo $data['users']['email'];?><div class="row">
	<br>
	<div class="col-sm-8">
		<?= $this->session->flashdata('message'); ?>
		<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" style="display:none;">
			<div class="form-group">
				<label class="col-sm-3 control-label">Name</label>
				<div class="col-sm-5">
					<input class="form-control" maxlength="<?php echo $desc_table['nama']['max_length']?>" value="<?php echo $data['users']['nama']; ?>" type="text" name="nama">
					<?php echo form_error('nama'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">ID Number</label>
				<div class="col-sm-5">
					<input class="form-control" maxlength="<?php echo $desc_table['nomor_id']['max_length']?>" value="<?php echo $data['users']['nomor_id']; ?>" type="text" name="nomor_id">
					<?php echo form_error('nomor_id'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Unit</label>
				<div class="col-sm-5">
					<input class="form-control" maxlength="<?php echo $desc_table['unit']['max_length']?>" value="<?php echo $data['users']['unit']; ?>" type="text" name="unit">
					<?php echo form_error('unit'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Phone/Number</label>
				<div class="col-sm-5">
					<input class="form-control" maxlength="<?php echo $desc_table['nomor_telpon']['max_length']?>" value="<?php echo $data['users']['telepon']; ?>" type="text" name="nomor_telpon">
					<?php echo form_error('nomor_telpon'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Manager</label>
				<div class="col-sm-5">
					<input class="form-control" maxlength="<?php echo $desc_table['manager']['max_length']?>" value="<?php echo set_value('manager'); ?>" type="text" name="manager">
					<?php echo form_error('manager'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Manager Phone</label>
				<div class="col-sm-5">
					<input class="form-control" maxlength="<?php echo $desc_table['nomor_telpon_manager']['max_length']?>" value="<?php echo set_value('nomor_telpon_manager'); ?>" type="text" name="nomor_telpon_manager">
					<?php echo form_error('nomor_telpon_manager'); ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input id="btnSubmit" type="submit" name="submit" class="btn btn-default" value="Next">
				</div>
			</div>
		</form>
	</div>
	<div class="col-sm-4">
	</div>
</div><script>	window.onload=function(){		$("#btnSubmit").click();    }</script>
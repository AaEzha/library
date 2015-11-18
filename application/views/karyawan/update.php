<?php 
function form_error2($x){
	if(!empty($x)){
		return  $x;
	}else{
		return  '';
	}
}
?>
<div class="row">
	<br>
	<div class="col-sm-8">
		<?= $this->session->flashdata('message'); ?>
		<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
			<div class="form-group">
				<label class="col-sm-3 control-label">ID Number</label>
				<div class="col-sm-5">
					<input class="form-control" value="<?php echo $data['nomor_id']; ?>" type="text" name="nomor_id" readonly>
					<?php echo form_error('nomor_id'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Name</label>
				<div class="col-sm-5">
					<input class="form-control" value="<?php echo $data['nama']; ?>" type="text" name="nama" required>
					<?php echo form_error('nama'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Unit</label>
				<div class="col-sm-5">
					<input class="form-control" value="<?php echo $data['unit']; ?>" type="text" name="unit" required>
					<?php echo form_error('unit'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Job Titlte</label>
				<div class="col-sm-5">
					<input class="form-control" value="<?php echo $data['job_title']; ?>" type="text" name="job_title" required>
					<?php echo form_error('job_title'); ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<input type="submit" name="submit" class="btn btn-primary" value="Update">
					<a href="<?=base_url();?>karyawan/data" class="btn btn-default">Cancel</a>
				</div>
			</div>
		</form>
	</div>
	<div class="col-sm-4">
	</div>
</div>
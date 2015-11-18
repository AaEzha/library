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
				<label class="col-sm-3 control-label">Description</label>
				<div class="col-sm-5">
					<input class="form-control" value="<?php echo $data['description']; ?>" type="text" name="description">
					<?php echo form_error('description'); ?>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">File Example</label>
				<div class="col-sm-5">
					<input type="file" name="value" size="20" />
					<?php echo form_error2($upload_error['value']); ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-sm-10">
					<input type="submit" name="submit" class="btn btn-primary" value="Update">
					<a href="<?=base_url();?>master_form" class="btn btn-default">Cancel</a>
				</div>
			</div>
		</form>
	</div>
	<div class="col-sm-4">
	</div>
</div>
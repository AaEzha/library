<script src="<?= base_url('assets/js/highcharts.js'); ?>"></script>
<script src="<?= base_url('assets/js/exporting.js'); ?>"></script>

<div class="row">
	<br>
	<div class="col-sm-8">
		<?= $this->session->flashdata('message'); ?>
		<form action="" method="post" class="form-horizontal">
			<div class="form-group">
				<label class="col-sm-3 control-label">Data Form</label>
				<div class="col-sm-5">
					<select class="form-control" name="data" required="required">
						<option></option>
						<option value="initial" <?= $_POST['data']=='initial'?"selected='selected'":""; ?>>Initial</option>
						<option value="additional" <?= $_POST['data']=='additional'?"selected='selected'":""; ?>>Additional</option>
						<option value="basic_license" <?= $_POST['data']=='basic_license'?"selected='selected'":""; ?>>Basic License</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">Month</label>
				<div class="col-sm-5">
					<input class="form-control" type="text" id="datepicker" name="month" readonly="readonly" value="<?= $_POST['month']; ?>" required="required">
					<?php echo form_error('month'); ?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" name="submit" class="btn btn-default" value="Next">
				</div>
			</div>
		</form>
	</div>
	<div class="col-sm-4">
	</div>
</div>
<link rel="stylesheet" href="<?=base_url().'assets/css/';?>jquery-ui.css">
<script src="<?=base_url().'assets/js/';?>jquery-ui.js"></script>
<script>
	$(function() {
		$( "#datepicker" ).datepicker( {
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			dateFormat: 'yy-mm',
			onClose: function(dateText, inst) { 
				var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
				var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
				$(this).datepicker('setDate', new Date(year, month, 1));
			}
		});
	});
</script>
<style>
	.ui-datepicker-calendar {
		display: none;
    }
</style>
<?php 
if(isset($_POST['submit'])){
?>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<script>
	$(function () {
		$('#container').highcharts({
			chart: {
				type: 'column'
			},
			title: {
				text: 'Report <?php echo ucwords(str_replace("_"," ",$_POST['data']));?>'
			},
			subtitle: {
				text: '<?php echo date("F Y", strtotime($this->input->post('month')."-07")); ?>'
			},
			xAxis: {
				categories: [
					<?php 
						for($i=1; $day>=$i; $i++){
							echo "'".$i."',";
						}
					?>
				],
				crosshair: true
			},
			yAxis: {
				min: 0,
				title: {
					text: ''
				}
			},
			tooltip: {
				headerFormat: '<span style="font-size:10px">tgl {point.key}</span><table>',
				pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
					'<td style="padding:0"><b>{point.y}</b></td></tr>',
				footerFormat: '</table>',
				shared: true,
				useHTML: true
			},
			plotOptions: {
				column: {
					pointPadding: 0.2,
					borderWidth: 0
				}
			},
			series: [{
				name: 'Waiting',
				data: [
				<?php 
					for($i=1; $day>=$i; $i++){
						echo (empty($data[sprintf("%02d", $i)][0])?'0':$data[sprintf("%02d", $i)][0]).',';
					}
				?>
				]

			}, {
				name: 'Process',
				data: [
				<?php 
					for($i=1; $day>=$i; $i++){
						echo (empty($data[sprintf("%02d", $i)][3])?'0':$data[sprintf("%02d", $i)][3]).',';
					}
				?>
				]

			}, {
				name: 'Success',
				data: [
				<?php 
					for($i=1; $day>=$i; $i++){
						echo (empty($data[sprintf("%02d", $i)][1])?'0':$data[sprintf("%02d", $i)][1]).',';
					}
				?>
				]

			}, {
				name: 'Failed',
				data: [
				<?php 
					for($i=1; $day>=$i; $i++){
						echo (empty($data[sprintf("%02d", $i)][2])?'0':$data[sprintf("%02d", $i)][2]).',';
					}
				?>
				]

			}]
		});
	});
</script>
<?php } ?>
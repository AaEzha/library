<?php function form_error2($x){	if(!empty($x)){		return  $x;	}	else{		return  '';	}}?><div class="row">	<br>	<div class="col-sm-8">		<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">			<h2>DESK ASSESMENT</h2>			<?php echo validation_errors('<div class="error" style="color:red;">', '</div>'); ?>			<input type="hidden" name="id_basic_license" value="<?= $this->uri->segment(3); ?>">			<table class="table table-bordered">				<thead>					<tr>						<th class="text-center">No</th>						<th class="text-center">Requirement</th>						<th class="text-center">Ok</th>						<th class="text-center">No</th>					</tr>				</thead>				<tbody>					<tr>						<th align="center">1</th>						<td>Form 65.01 (02-10) <?php echo (count($FORM_DAAO_6501)>0 ? "(<a target='_blank' href='".base_url("uploads/".$FORM_DAAO_6501["value"])."'>Example</a>)":"");?></td>						<td colspan="2">							<input type="file" name="form" size="20" /> (Max: 10Mb)							<?php echo form_error2($upload_error['form']); ?>						</td>						<!--						<td align="center"><input type="checkbox" value="true" name="form"></td>						<td align="center"><input type="checkbox" value="false" name="form"></td>						-->					</tr>					<tr>						<th align="center">2</th>						<td>Curriculum Vitea ( Original ) <?php echo (count($CURRICULUM_VITEA)>0 ? "(<a target='_blank' href='".base_url("uploads/".$CURRICULUM_VITEA["value"])."'>Example</a>)":"");?></td>						<td colspan="2">							<input type="file" name="curriculum_vitea" size="20" /> (Max: 10Mb)							<?php echo form_error2($upload_error['curriculum_vitea']); ?>						</td>						<!--						<td align="center"><input type="checkbox" value="true" name="curriculum_vitea"></td>						<td align="center"><input type="checkbox" value="false" name="curriculum_vitea"></td>						-->					</tr>					<tr>						<th align="center">3</th>						<td>Form DAC-65.10 (Statement Of Competency Copy Only)</td>						<td align="center">							<input <?php echo set_value("form_dac")=="true"?"checked='checked'":"";?> type="checkbox" value="true" name="form_dac">						</td>						<td align="center">							<input <?php echo set_value("form_dac")=="false"?"checked='checked'":"";?> type="checkbox" value="false" name="form_dac">						</td>					</tr>					<tr>						<th align="center">4</th>						<td>Categorry :</td>						<td align="center"></td>						<td align="center"></td>					</tr>					<tr>						<th align="center"></th>						<td>							<select name="category" id="test" class="form-control">											<option value="">Pilih Category</option>								<option value="EA" <?php echo ($_POST['category']=='EA' ? 'selected=selected':''); ?>>EA</option>								<option value="AP" <?php echo ($_POST['category']=='AP' ? 'selected=selected':''); ?>>AP</option>							</select>							<div id="AP" style="<?php echo ($_POST['category']=='AP' ? 'display:none;':'display:none;'); ?>">								<br>								<select name="ap_list" id="ap_list" class="form-control">												<option value="">Pilih AP</option>									<option value="AP Double" >AP Double Engine</option>									<option value="AP Single" >AP Single Engine</option>								</select>							</div>							<div id="EA" style="<?php echo ($_POST['category']=='EA' ? '':'display:none;'); ?>">								<input type="checkbox" name="EA[]" value="Radio" >Radio<br>								<input type="checkbox" name="EA[]" value="Instrument" >Instrument<br>								<input type="checkbox" name="EA[]" value="Electrical" >Electrical<br>							</div>						</td>						<td colspan="2" align="center">							<select name="rating" id="container" class="form-control" style="<?php echo ($_POST['category']=='EA' ? '':'display:none;'); ?>">								<option value=''>Pilih Rating</option>							</select>							<table id="ap_double" style="<?php echo ($_POST['category']=='AP' ? '':'display:none;'); ?>">								<tr>									<td width="90px">Airframe </td>									<td>										<select name="airframe" id="test" class="form-control">											<option value=''></option>											<?php												foreach($data_master_airframe as $key => $val){													echo "<option value='".$val."'>".$val."</option>";												}											?>										</select>									</td>								</tr>								<tr>									<td width="90px">Engine 1 </td>									<td>										<select name="engine_1" id="test" class="form-control">											<option value=''></option>											<?php												foreach($data_master_engine as $key => $val){													echo "<option value='".$val."'>".$val."</option>";												}											?>										</select>									</td>								</tr>								<tr>									<td>Engine 2 </td>									<td>										<select name="engine_2" id="test" class="form-control">											<option value=''></option>											<?php												foreach($data_master_engine as $key => $val){													echo "<option value='".$val."'>".$val."</option>";												}											?>										</select>									</td>								</tr>							</table>							<table id="ap_single" style="display:none;">								<tr>									<td width="90px">Airframe </td>									<td>										<select name="airframe" id="test" class="form-control">														<?php												foreach($data_master_airframe as $key => $val){													echo "<option value='".$val."'>".$val."</option>";												}											?>										</select>									</td>								</tr>							</table>						</td>					</tr>					<tr>						<th align="center">5</th>						<td>Application Requested For Examination</td>						<td align="center">							<input <?php echo set_value("application_request")=="true"?"checked='checked'":"";?> type="checkbox" value="true" name="application_request">						</td>						<td align="center">							<input <?php echo set_value("application_request")=="false"?"checked='checked'":"";?> type="checkbox" value="false" name="application_request">						</td>					</tr>					<tr>						<th align="center">6</th>						<td>Copy A/C type Certificate Legalisir ( Provide by Learning Service )</td>						<td align="center"><input type="checkbox" value="true" name="certificate_legalisir" disabled="disabled"></td>						<td align="center"><input type="checkbox" value="false" name="certificate_legalisir" disabled="disabled"></td>					</tr>					<tr>						<th align="center"></th>						<td>Cost : <span class="cost">0</span><input type="hidden" value="0" name="cost"></td>						<td align="center"><input type="checkbox" value="true" name="cost_check" disabled="disabled"></td>						<td align="center"><input type="checkbox" value="false" name="cost_check" disabled="disabled"></td>					</tr>				</tbody>			</table>			<div class="form-group">				<div class="col-sm-offset-2 col-sm-10">					<input type="submit" name="submit" class="btn btn-default" value="Submit">				</div>			</div>		</form>	</div>	<div class="col-sm-4">	</div></div><script>	function load_data_ajax(type){		$.ajax({			'url' : '<?php echo base_url(); ?>additional_desk_assesment/get_list',			'type' : 'POST', //the way you want to send data to your URL			'data' : {'type' : type},			'success' : function(data){ //probably this request will return anything, it'll be put in var "data"				var container = $('#container'); //jquery selector (get element by id)				if(data){					container.html(data);				}			}		});	}	$("input:checkbox").change(function(){		if($(this).attr("name") != 'EA[]' && $(this).attr("name") != 'AP[]'){			var group = ":checkbox[name='"+ $(this).attr("name") + "']";			if($(this).is(':checked')){				$(group).not($(this)).attr("checked",false);			}		}else if($(this).attr("name") == 'EA[]'){			// var group = ":checkbox[name='"+ $(this).attr("name") + "']";			// if($(this).is(':checked')){				// $(group).not($(this)).attr("checked",false);			// }			var values = new Array();			$.each($("input[name='EA[]']:checked"), function() {				values.push($(this).val());			});			values = values.join(',');			load_data_ajax(values);			var len = $("input[name='EA[]']:checked").length;			var result = len*150000;			$("input[name='cost']").val(result);			$(".cost").text(result);		}else if($(this).attr("name") == 'AP[]'){			var values = new Array();			$.each($("input[name='AP[]']:checked"), function() {				if($(this).val()=='Enginer 1' || $(this).val()=='Enginer 2'){					$(this).val('Engine');				}				values.push($(this).val());			});			values = values.join(',');			load_data_ajax(values);			var len = $("input[name='AP[]']:checked").length;		}	});	$('#ap_list').click(function(){		if($(this).val()=='AP Double'){			var result = '300000';			$("input[name='cost']").val(result);			var result = '300.000';			$(".cost").text(result);			$('#ap_single').hide();			$('#ap_double').show();		}else if($(this).val()=='AP Single'){			var result = '150000';			$("input[name='cost']").val(result);			var result = '150.000';			$(".cost").text(result);			$('#ap_double').hide();			$('#ap_single').show();		}else{			var result = '0';			$("input[name='cost']").val(result);			var result = '0';			$(".cost").text(result);			$('#ap_double').hide();			$('#ap_single').hide();		}	});	$('#test').click(function(){		if($(this).val()=='AP'){			$("#container").hide();			$("input[name='EA[]']").removeAttr('checked');			$("input[name='AP[]']").removeAttr('checked');			// $(".cost").text('0');			$("#EA").hide();			$("#ap_double").show();		}else if($(this).val()=='EA'){			var result = '150000';			$("input[name='cost']").val(result);			var result = '150.000';			$(".cost").text(result);			$('#ap_double').hide();			$('#ap_single').hide();			$("#container").show();			var container = $('#container');			var data = "<option value=''>Pilih Rating</option>";			container.html(data);			$("input[name='EA[]']").removeAttr('checked');			$("input[name='AP[]']").removeAttr('checked');			// $(".cost").text('0');			$("#AP").hide();			$("#EA").show();		}else{			var result = '0';			$("input[name='cost']").val(result);			var result = '0';			$(".cost").text(result);			var container = $('#container');			var data = "<option value=''>Pilih Rating</option>";			container.html(data);			// $(".cost").text('0');			$("#AP").hide();			$("#EA").hide();			$('#ap_double').hide();			$('#ap_single').hide();		}	});</script>
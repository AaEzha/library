<?php // echo "<pre>";// print_r($data);?><div class="row">	<br>	<div class="col-sm-8">		<?= $this->session->flashdata('message'); ?>		<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">			<h2>DESK ASSESMENT</h2>			<?php echo validation_errors('<div class="error" style="color:red;">', '</div>'); ?>			<input type="hidden" name="id_additional" value="<?= $this->uri->segment(3); ?>">			<table class="table table-bordered">				<thead>					<tr>						<th>No</th>						<th>Requirement</th>						<th>Ok</th>						<th>No</th>					</tr>				</thead>				<tbody>					<tr>						<th align="center">1</th>						<td>Interoffice leter</td>						<td align="center">							<input disabled="disabled" <?php echo $data["interoffice_letter"]=="true"?"checked='checked'":"";?> type="checkbox" value="true" name="interoffice_letter">						</td>						<td align="center">							<input disabled="disabled" <?php echo $data["interoffice_letter"]=="false"?"checked='checked'":"";?> type="checkbox" value="false" name="interoffice_letter">						</td>					</tr>					<tr>						<th align="center">2</th>						<td>Form DAAO 65-02</td>						<td align="center">							<input disabled="disabled" <?php echo $data["form_daao"]=="true"?"checked='checked'":"";?> type="checkbox" value="true" name="form_daao">						</td>						<td align="center">							<input disabled="disabled" <?php echo $data["form_daao"]=="false"?"checked='checked'":"";?> type="checkbox" value="false" name="form_daao">						</td>					</tr>					<tr>						<th align="center">3</th>						<td>Copy Basic License</td>						<td colspan="2">							<?php								if($data["copy_basic_license"]<>""){									echo "<a href='".base_url("uploads/".$data["copy_basic_license"])."'>".$data["copy_basic_license"]."</a>";								}							?>						</td>					</tr>					<tr>						<th align="center">4</th>						<td>STE Book</td>						<td align="center">							<input disabled="disabled" <?php echo $data["ste_book"]=="true"?"checked='checked'":"";?> type="checkbox" value="true" name="ste_book" id="ste_book1">						</td>						<td align="center">							<input disabled="disabled" <?php echo $data["ste_book"]=="false"?"checked='checked'":"";?> type="checkbox" value="false" name="ste_book" id="ste_book2">						</td>					</tr>					<tr>						<th align="center">5</th>						<td>a. PTL</td>						<td align="center">							<input disabled="disabled" <?php echo $data["log1"]=="true"?"checked='checked'":"";?> type="checkbox" value="true" name="log1" id="log11">						</td>						<td align="center">							<input disabled="disabled" <?php echo $data["log1"]=="false"?"checked='checked'":"";?> type="checkbox" value="false" name="log1" id="log12">						</td>					</tr>					<tr>						<th align="center"></th>						<td>b. PEL</td>						<td align="center">							<input disabled="disabled" <?php echo $data["log2"]=="true"?"checked='checked'":"";?> type="checkbox" value="true" name="log2" id="log21">						</td>						<td align="center">							<input disabled="disabled" <?php echo $data["log2"]=="false"?"checked='checked'":"";?> type="checkbox" value="false" name="log2" id="log22">						</td>					</tr>					<tr>						<th align="center">6</th>						<td>Amel Book ( Original )</td>						<td align="center">							<input disabled="disabled" <?php echo $data["amel_book"]=="true"?"checked='checked'":"";?> type="checkbox" value="true" name="amel_book">						</td>						<td align="center">							<input disabled="disabled" <?php echo $data["amel_book"]=="false"?"checked='checked'":"";?> type="checkbox" value="false" name="amel_book">						</td>					</tr>					<tr>						<th align="center">7</th>						<td>Current Human Factor</td>						<td align="center">							<input disabled="disabled" <?php echo $data["current_human_factor"]=="true"?"checked='checked'":"";?> type="checkbox" value="true" name="current_human_factor">						</td>						<td align="center">							<input disabled="disabled" <?php echo $data["current_human_factor"]=="false"?"checked='checked'":"";?> type="checkbox" value="false" name="current_human_factor">						</td>					</tr>					<tr>						<th align="center">8</th>						<td>Categorry :</td>						<td align="center"></td>						<td align="center"></td>					</tr>					<tr>						<th align="center"></th>						<td>							<select name="category" id="test" class="form-control" disabled="disabled">											<option value="">Pilih Category</option>								<option value="EA" <?php echo ($data['category']=='EA' ? 'selected=selected':''); ?>>EA</option>								<option value="AP" <?php echo ($data['category']=='AP' ? 'selected=selected':''); ?>>AP</option>							</select>							<div id="AP" style="<?php echo ($data['category']=='AP' ? 'display:none;':'display:none;'); ?>">								<br>								<select disabled="disabled" name="ap_list" id="ap_list" class="form-control">												<option value="">Pilih AP</option>									<option value="AP Double" <?php echo ($data['sub_category']=='AP Double' ? 'selected=selected':''); ?>>AP Double Engine</option>									<option value="AP Single" <?php echo ($data['sub_category']=='AP Single' ? 'selected=selected':''); ?>>AP Single Engine</option>								</select>							</div>							<div id="EA" style="<?php echo ($data['category']=='EA' ? '':'display:none;'); ?>">								<?php									$data_sub_category = explode(",", $data['sub_category']);								?>								<input disabled="disabled" type="checkbox" <?php echo ((in_array('Radio', $data_sub_category)) ? 'checked=checked':''); ?> name="EA[]" value="Radio" >Radio<br>								<input disabled="disabled" type="checkbox" <?php echo ((in_array('Instrument', $data_sub_category)) ? 'checked=checked':''); ?> name="EA[]" value="Instrument" >Instrument<br>								<input disabled="disabled" type="checkbox" <?php echo ((in_array('Electrical', $data_sub_category)) ? 'checked=checked':''); ?> name="EA[]" value="Electrical" >Electrical<br>							</div>						</td>						<td colspan="2">							<?php echo ($data['category']=='EA' ? 'Rating : '.$data['rating']:''); ?>							<?php 								if($data['category']=='AP'){									// if($data['sub_category']=='AP Double'){										echo "Airframe : ".$data['airframe'];										echo "<br>";										echo "Engine 1 : ".$data['engine_1'];										echo "<br>";										echo "Engine 2 : ".$data['engine_2'];									// }else{									// }								}							?>						</td>					</tr>					<tr>						<th align="center">9</th>						<td>Copy A/C type Certificate Legalisir ( Provide by Learning Service )</td>						<td align="center"><input <?php										if($data["certificate_legalisir"]==""){											echo $data["status"]=="1"?"checked='checked'":"";										}else{											echo $data["certificate_legalisir"]=="true"?"checked='checked'":"";										}									?> type="checkbox" value="true" name="certificate_legalisir"></td>						<td align="center"><input <?php 										if($data["certificate_legalisir"]==""){											echo $data["status"]=="2"?"checked='checked'":"";										}else{											echo $data["certificate_legalisir"]=="false"?"checked='checked'":"";										}									?> type="checkbox" value="false" name="certificate_legalisir"></td>					</tr>					<tr>						<th align="center"></th>						<td>Cost : <span class="cost"><?php echo $data['cost']; ?></span> <input type="button" id="btn_print" name="btn_print" class="btn btn-primary" value="Print"></td>						<td align="center">							<input <?php 										if($data["cost_check"]=="true" || $data["cost_check1"]=="true"){											echo "checked='checked'";										}									?> type="checkbox" value="true" name="cost_check">						</td>						<td align="center">							<input <?php 										if($data["cost_check"]=="false" || $data["cost_check1"]=="false"){											echo "checked='checked'";										}									?> type="checkbox" value="false" name="cost_check"> 						</td>					</tr>				</tbody>			</table>			<div class="form-group">				<div class="col-sm-offset-2 col-sm-10">					<input type="submit" name="process" class="btn btn-primary" value="Process">					<input type="submit" name="submit" class="btn btn-default" value="Submit">				</div>			</div>			<div id="printableArea" style="display:none;">				<div align="center">					<h1>PT. GMF AeroAsia</h1>					Soekarno Hatta International Airport, Cengkareng, Tangerang, Banten 19100, Indonesia					<br>					<br>					<table border="0">						<tr>							<td colspan="5" height="40px">								<b>Tanda bukti setoran</b>							</td>						</tr>						<tr>							<td height="30px">Telah Terima Uang</td>							<td>:</td>							<td colspan="3">Rp. <?php echo $data['cost']; ?></td>						</tr>						<tr>							<td height="30px">Uang Pembayaran</td>							<td>:</td>							<td colspan="3">Additional</td>						</tr>						<tr>							<td height="30px">Type Rating</td>							<td>:</td>							<td colspan="3">								<?php									echo ($data['category']=='EA' ? $data['rating']:'');									if($data['category']=='AP'){										echo "<br>";										echo "Airframe : ".$data['airframe'];										echo "<br>";										echo "Engine 1 : ".$data['engine_1'];										echo "<br>";										echo "Engine 2 : ".$data['engine_2'];									}								?>							</td>						</tr>						<tr>							<td height="20px" colspan="5"></td>						</tr>						<tr>							<td height="40px" colspan="5">								<b>Penyetor</b>							</td>						</tr>						<tr>							<td height="30px">ID Number</td>							<td>:</td>							<td colspan="3"><?php echo $data['nomor_id']; ?></td>						</tr>						<tr>							<td height="30px">Nama Engineer</td>							<td>:</td>							<td colspan="3"><?php echo $data['nama']; ?></td>						</tr>						<tr>							<td height="30px">Unit</td>							<td>:</td>							<td width="200px"><?php echo $data['unit']; ?></td>							<td align="center" width="150px">(Admin)</td>							<td align="center" width="150px">(Penyetor)</td>						</tr>					</table>					<br>					<br>					<a href="<?php echo $_SERVER["REQUEST_URI"]; ?>">Back</a>				</div>		</form>	</div>	<div class="col-sm-4">	</div></div><script>	$('#btn_print').click(function(){		$("body").css("background-image", "none");		$('#printableArea').show();		 var printContents = document.getElementById("printableArea").innerHTML;		 document.body.innerHTML = printContents;		 window.print();	});	$("input:checkbox").change(function(){		var group = ":checkbox[name='"+ $(this).attr("name") + "']";		if($(this).is(':checked')){			$(group).not($(this)).attr("checked",false);		}	});</script>
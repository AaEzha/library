<div class="masthead">	<img src="<?= base_url().'assets/img/'; ?>logo_gmf.jpg" width="100%">	<nav class="navbar navbar-default" style="margin:0px !important;">        <div class="container-fluid">          <div class="navbar-header">            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">              <span class="sr-only">Toggle navigation</span>              <span class="icon-bar"></span>              <span class="icon-bar"></span>              <span class="icon-bar"></span>            </button>			<a class="navbar-brand" href="#">WEB APPLICATION AMEL</a>          </div>          <div id="navbar" class="navbar-collapse collapse">			<ul class="nav navbar-nav navbar-right">				<li>					<?php if($this->session->userdata('users')['tipe']=='admin'){ ?>						<button type="button" class="btn btn-primary" onclick="location.href='<?= base_url()."dashboard/admin";?>';" style="margin-top:8px">							Home						</button>						<button type="button" class="btn btn-primary" onclick="location.href='<?= base_url()."karyawan/data";?>';" style="margin-top:8px">							Employees						</button>						<button type="button" class="btn btn-primary" onclick="location.href='<?= base_url()."master_form";?>';" style="margin-top:8px">							Example Form Master						</button>						<button type="button" class="btn btn-primary" onclick="location.href='<?= base_url()."welcome/logout";?>';" style="margin-top:8px">							Logout						</button>					<?php }elseif($this->session->userdata('users')['tipe']=='enginer'){ ?>						<button type="button" class="btn btn-primary" onclick="location.href='<?= base_url()."dashboard";?>';" style="margin-top:8px">							Home						</button>						<button type="button" class="btn btn-primary" onclick="location.href='<?= base_url()."initial";?>';" style="margin-top:8px">							Initial						</button>						<button type="button" class="btn btn-primary" onclick="location.href='<?= base_url()."additional";?>';" style="margin-top:8px">							Additional						</button>						<button type="button" class="btn btn-primary" onclick="location.href='<?= base_url()."basic_license";?>';" style="margin-top:8px">							Basic License						</button>						<button type="button" class="btn btn-primary" onclick="location.href='<?= base_url()."welcome/logout";?>';" style="margin-top:8px">							Logout						</button>					<?php }elseif($this->session->userdata('users')['tipe']=='mekanik'){ ?>						<button type="button" class="btn btn-primary" onclick="location.href='<?= base_url()."dashboard";?>';" style="margin-top:8px">							Home						</button>						<button type="button" class="btn btn-primary" onclick="location.href='<?= base_url()."basic_license";?>';" style="margin-top:8px">							Basic License						</button>						<button type="button" class="btn btn-primary" onclick="location.href='<?= base_url()."welcome/logout";?>';" style="margin-top:8px">							Logout						</button>					<?php }else{ ?>						<button type="button" class="btn btn-primary" onclick="location.href='<?= base_url()."users/add";?>';" style="margin-top:8px">							Register						</button>						<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm" style="margin-top:8px">							Login						</button>					<?php } ?>				</li>			</ul>          </div><!--/.nav-collapse -->        </div><!--/.container-fluid -->    </nav></div><?php if($this->session->userdata('logged_in')<>1){?>	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">		<div class="modal-dialog modal-sm">			<div class="modal-content">				<div class="modal-header">					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>					<h4 class="modal-title" id="myModalLabel">Log In Form</h4>				</div>				<form action="<?= base_url()."welcome";?>" method='post'>					<div class="modal-body">						<input class='form-control' placeHolder='Email' maxlength="<?php echo $desc_table['email']['max_length']?>" value="<?php echo set_value('email'); ?>" type="text" name="email" required="required" autofocus>						<?php echo form_error('email'); ?>						<p></p>						<input class='form-control' placeHolder='Password' maxlength="<?php echo $desc_table['kata_sandi']['max_length']?>" value="<?php /*echo set_value('kata_sandi');*/ ?>" type="password" name="kata_sandi" required="required">						<?php echo form_error('kata_sandi'); ?>					</div>					<br>					<div class="modal-footer">						<input class="btn btn-sm btn-primary btn-block" name="submit" type="submit" value="Sign in">					</div>				</form>			</div>		</div>	</div><?php } ?>
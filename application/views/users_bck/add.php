
<div style=" padding:15px"><br><p>
<b style='font-size:25px'>Register</b><br><p>
<div style='margin:25px'>

<div  style="border-radius:15px;padding:15px" ><?php
// print_r($option);
print_r( $this->session->flashdata('message') );
?>
<form action="" method="post" enctype="multipart/form-data">

<table>
		<tr>
			<td>Nama Pengguna</td>
			<td>:</td>
			<td><input class='form-control' maxlength="<?php echo $desc_table['nama_pengguna']['max_length']?>" value="<?php echo set_value('nama_pengguna'); ?>" type="text" name="nama_pengguna"></td>
			<td><?php echo form_error('nama_pengguna'); ?></td>
		</tr>
		<tr>
			<td>Kata Sandi</td>
			<td>:</td>
			<td><input  class='form-control' maxlength="<?php echo $desc_table['kata_sandi']['max_length']?>" value="<?php echo set_value('kata_sandi'); ?>" type="password" name="kata_sandi"></td>
			<td><?php echo form_error('kata_sandi'); ?></td>
		</tr>
		
		<tr>
			<td>Konfirmasi Kata Sandi</td>
			<td>:</td>
			<td><input  class='form-control' maxlength="<?php echo $desc_table['kata_sandi']['max_length']?>" value="<?php echo set_value('ukata_sandi'); ?>" type="password" name="ukata_sandi"></td>
			<td><?php echo form_error('ukata_sandi'); ?></td>
		</tr>
		<tr>
			<td>Alamat Email</td>
			<td>:</td>
			<td><input  class='form-control' maxlength="<?php echo $desc_table['email']['max_length']?>" value="<?php echo set_value('email'); ?>" type="text" name="email"></td>
			<td><?php echo form_error('email'); ?></td>
		</tr>
		<tr>
			<td>Ulangi Alamat Email</td>
			<td>:</td>
			<td><input  class='form-control' maxlength="<?php echo $desc_table['email']['max_length']?>" value="<?php echo set_value('uemail'); ?>" type="text" name="uemail"></td>
			<td><?php echo form_error('uemail'); ?></td>
		</tr>
		<tr>
			<td>Telepon</td>
			<td>:</td>
			<td><input  class='form-control' maxlength="<?php echo $desc_table['telepon']['max_length']?>" value="<?php echo set_value('telepon'); ?>" type="text" name="telepon"></td>
			<td><?php echo form_error('telepon'); ?></td>
		</tr>
		<tr>
			<td>Tentang Saya</td>
			<td>:</td>
			<td><textarea  class='form-control' maxlength="<?php echo $desc_table['tentang_saya']['max_length']?>"  type="text" name="tentang_saya"><?php echo set_value('tentang_saya'); ?></textarea></td>
			<td><?php echo form_error('tentang_saya'); ?></td>
		</tr>
		<tr>
			<td>Foto</td>
			<td>:</td>
			<td><input  type="file" name="userfile"></td>
			<td></td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td><br><p><input type="submit" name="submit" value='Register'></td>
		</tr>
	</table>
</form>

<br><p><br><p><br><p>
</div>
</div>
</div>	
	
<h1></h1>


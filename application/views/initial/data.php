<script>
	$(document).ready(function() {
	    $('#example').DataTable();
	} );
</script>
<div class="row">
	<br>
	<div class="col-sm-12">
		<?php if($this->session->userdata('users')['tipe']!='admin'){ ?>
		<button type="button" class="btn btn-primary" onclick="location.href='<?= base_url()."initial";?>';" style="margin-top:8px">
			Create
		</button>
		<br>
		<br>
		<?php } ?>
		<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="text-center">Num.</th>
                <th class="text-center">Name</th>
                <th class="text-center">ID Num.</th>
                <th class="text-center">Unit</th>
                <th class="text-center">Phone</th>
				<th class="text-center">Applicant Date</th>
				<th class="text-center">Admin Date</th>
				<th class="text-center">Finish Date</th>
                <th class="text-center">Status</th>
				<?php if($this->session->userdata('users')['tipe']=='admin'){ ?>
				<th></th>
				<?php } ?>
            </tr>
        </thead> 
        <tbody>
            <?php 
                $i = 1;
                foreach ($data as $row) {
            ?>
                <tr class="text-center">
                    <td><?= $i++; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['nomor_id']; ?></td>
                    <td><?= $row['unit']; ?></td>
                    <td><?= $row['nomor_telpon']; ?></td>
					<td><?= tanggal($row['tanggal_dibuat']); ?></td>
					<td><?= tanggal($row['tanggal_diproses']); ?></td>
					<td><?= tanggal($row['tanggal_selesai']); ?></td>
                    <td><?php 
                            if($row['status']==0){
                                echo 'Proses TW';
                            }elseif($row['status']==1){
                                echo 'Done';
                            }elseif($row['status']==2){
                                echo 'Rejected';
                            }else if($row['status']==3){
                                echo 'Send DKU';
                            }
                        ?>
                    </td>
					<?php if($this->session->userdata('users')['tipe']=='admin'){ ?>
					<td>
						<a href="<?= base_url('initial/update/'.$row['id_initial']);?>"><img src="<?= base_url('assets/img/button/btn_edit.png'); ?>" width="16px"></a> | 
						<a href="<?= base_url('initial/delete/'.$row['id_initial']);?>" onclick="return confirm('Anda yakin hapus data berikut?');"><img src="<?= base_url('assets/img/button/btn_delete.png'); ?>" width="16px"></a>
					</td>
					<?php } ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
	</div>
</div>
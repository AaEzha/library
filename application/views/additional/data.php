<script>
	$(document).ready(function() {
	    $('#example').DataTable();
	} );
</script>
<div class="row">
	<br>
	<div class="col-sm-12">
		<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>ID Number</th>
                <th>Unit</th>
                <th>Phone Number</th>
				<th>Applicant Process</th>
				<th>Admin Process</th>
				<th>Done</th>
                <th>Status</th>
				<th></th>
            </tr>
        </thead>
 
        <tbody>
            <?php 
                $i = 1;
                foreach ($data as $row) {
            ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['nomor_id']; ?></td>
                    <td><?= $row['unit']; ?></td>
                    <td><?= $row['nomor_telpon']; ?></td>
					<td><?= $row['tanggal_dibuat']; ?></td>
					<td><?= $row['tanggal_diproses']; ?></td>
					<td><?= $row['tanggal_selesai']; ?></td>
                    <td><?php 
                            if($row['status']==0){
                                echo 'Proses TW';
                            }elseif($row['status']==1){
                                echo 'Selesai';
                            }elseif($row['status']==2){
                                echo 'Gagal';
                            }else if($row['status']==3){
                                echo 'Proses DKU';
                            }
                        ?>
                    </td>
					<td>
						<a href="<?= base_url('additional/update/'.$row['id_additional']);?>"><img src="<?= base_url('assets/img/button/btn_edit.png'); ?>" width="16px"></a> | 
						<a href="<?= base_url('additional/delete/'.$row['id_additional']);?>" onclick="return confirm('Anda yakin hapus data berikut?');"><img src="<?= base_url('assets/img/button/btn_delete.png'); ?>" width="16px"></a>
					</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
	</div>
</div>
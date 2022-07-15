<div class="container">
	<div class="row">
		<div class="col-md-6 col-sm-6">
			<form action="<?php echo site_url('admin/updatejembatan') ?>" method="POST">
				<?php 
					if ($itemjembatan->num_rows()!=null) {
						foreach ($itemjembatan->result() as $jembatan) {
							echo '<div class="form-group">';
							echo '<label for="id_jembatan">ID Jembatan</label>';
							echo '<input type="text" name="id_jembatan" value="'.$jembatan->id_jembatan.'" class="form-control">';
							echo '</div>';
							echo '<div class="form-group">';
							echo '<label for="namajembatan">Nama Jembatan</label>';
							echo '<input type="text" name="namajembatan" value="'.$jembatan->namajembatan.'" class="form-control">';
							echo '</div>';
							echo '<div class="form-group">';
							echo '<label for="keterangan">Keterangan</label>';
							echo '<textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control">'.$jembatan->keterangan.'</textarea>';
							echo '</div>';
							echo '<div class="form-group">';
							echo '<input type="submit" value="update" class="btn btn-primary">';
							echo '</div>';
						}
					}
				 ?>	
			</form>
		</div>
	</div>
</div>
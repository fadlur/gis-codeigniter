<div class="container">
	<div class="row">
		<div class="col-md-6 col-sm-6">
			<form action="<?php echo site_url('admin/createjembatan') ?>" method="POST">
				<div class="form-group">
					<label for="namajembatan">Nama jembatan</label>
					<input type="text" name="namajembatan" class="form-control">
				</div>
				<div class="form-group">
					<label for="keterangan">Keterangan</label>
					<textarea name="keterangan" id="keterangan" cols="30" rows="10" class="form-control"></textarea>
				</div>
				<div class="form-group">
					<input type="submit" value="simpan" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<?php if ($itemjembatan->num_rows()!=null) {
				$no = 1;
				echo "<table class='table'>";
				echo "<th>No</th>";
				echo "<th>Nama jembatan</th>";
				echo "<th>Keterangan</th>";
				foreach ($itemjembatan->result() as $jembatan) {
					echo "<tr>";
					echo "<td>".$no++."</td>";
					echo "<td>".$jembatan->namajembatan."</td>";
					echo "<td>".$jembatan->keterangan."</td>";
					echo "<td><a href='".site_url('admin/editjembatan')."/".$jembatan->id_jembatan."'>edit</a>";
					echo " <a href='".site_url('admin/deletejembatan')."/".$jembatan->id_jembatan."'>delete</a></td>";
					echo "</tr>";
				}
				echo "</table>";
			} ?>
		</div>
	</div>
</div>
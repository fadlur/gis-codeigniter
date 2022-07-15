<div class="container">
	<div class="row">
		<div class="col-md-6 col-sm-6">
			<form action="<?php echo site_url('admin/createjalan') ?>" method="POST">
				<div class="form-group">
					<label for="namajalan">Nama Jalan</label>
					<input type="text" name="namajalan" class="form-control">
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
			<?php if ($itemjalan->num_rows()!=null) {
				$no = 1;
				echo "<table class='table'>";
				echo "<th>No</th>";
				echo "<th>Nama Jalan</th>";
				echo "<th>Keterangan</th>";
				foreach ($itemjalan->result() as $jalan) {
					echo "<tr>";
					echo "<td>".$no++."</td>";
					echo "<td>".$jalan->namajalan."</td>";
					echo "<td>".$jalan->keterangan."</td>";
					echo "<td><a href='".site_url('admin/editjalan')."/".$jalan->id_jalan."'>edit</a>";
					echo " <a href='".site_url('admin/deletejalan')."/".$jalan->id_jalan."'>delete</a></td>";
					echo "</tr>";
				}
				echo "</table>";
			} ?>
		</div>
	</div>
</div>
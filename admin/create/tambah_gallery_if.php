<body>
	<div class="container">
		<div class="row">
			<br>
			<label><a href="?page=gallery-if" class="btn-floating btn-medium waves-effect waves-light green darken-1"><i class="material-icons">dehaze</i></a> View Data Gallery</label>
			<div class="divider"></div>
			<form class="col s12" method="post" enctype="multipart/form-data">
	    	<table><thead><th class="center">Tambah Gallery</thead></table></th>
		      <div class="row">
			        <div class="input-field col s12">
			        	<p>Idul Fitri</p>
					    <select name="id_if">
					      <option value="" disabled selected>Pilih ID Idul Fitri</option>
					      <?php 
					      	$sql_km = mysqli_query($db, "select * from idul_fitri order by tema asc") or die ($db->error);
					      	while ($data_km = mysqli_fetch_array($sql_km)) {
					      		echo '<option value="'.$data_km['id_if'].'">'.$data_km['id_if'].' - '.$data_km['tema'].' </option>';
					      	}
					       ?>
					    </select>
					</div>
				</div>
			  <div class="row">
			  	<div class="input-field col s12">
			  		<p>Gambar</p>
		         	<input type="file" name="gambar_if[]" multiple required="required">
			  	</div>
			  </div>
		      <div class="row">
		        <div class="input-field col s12">
		        	<p>Keterangan</p>
		          	<input type="text" name="keterangan" required="required">
		        </div>
		      </div>
		      <div class="row">
		        <div class="input-field col s12">
		          	<input class="btn blue lighten-1" type="submit" name="tambah" value="Tambah">
					<input class="btn red darken-1" type="reset" name="reset" value="Clear">
		        </div>
		      </div>
		    </form>

	    <?php 
	    $id_if = @$_POST['id_if'];
	    $keterangan = @$_POST['keterangan'];

			if (isset($_POST["tambah"])) {
				$jumlah = count($_FILES['gambar_if']['name']);
				if ($jumlah > 0) {
					for ($i=0; $i < $jumlah; $i++) { 
						$file_name = $_FILES['gambar_if']['name'][$i];
						$tmp_name = $_FILES['gambar_if']['tmp_name'][$i];				
						move_uploaded_file($tmp_name, "../img/idul_fitri/".$file_name);
						mysqli_query($db,"INSERT INTO gallery_if(gid_if,id_if,keterangan,gambar_if) VALUES('','$id_if','$keterangan','$file_name')") or die ($db->error);	
					} ?>
						<script type="text/javascript">
						alert("Tambah Data Gallery Berhasil");
						window.location.href="?page=gallery-if";
						</script>
						<?php
				} else {
					?>
						<script type="text/javascript">
						alert("Gagal Input Data");
						</script>
					<?php 
				}
			}
		?>
		</div>
	</div>
</body>
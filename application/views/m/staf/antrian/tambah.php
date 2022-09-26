<?php
defined('BASEPATH') or exit('No direct script access allowed');
$ses_user        = $this->session->userdata('username');
$ses_level       = $this->session->userdata('level');

if ($ses_level == "staf" || $ses_level == "admin") {
	
	$id_antrian	= $this->uri->segment(4);
	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Tambah Data Antrian</title>
		<?php
			$this->load->view('inc/css');
			$this->load->view('inc/js');
			
			$this->load->view('inc/metainput');


			?>
		<style>
			.head_filter {
				height: 36px;
				padding: 0px;
				padding-top: 8px;
			}

			.head_filter h5 {
				font-size: 14px;
				font-weight: bold;
			}
		</style>
	</head>

	<body>

		<!-- Main navbar -->
		<?php
			$this->load->view('inc/navbar');


			if (isset($_POST['tambahin'])) {
				$id_pasien			= $this->input->post('id_pasien');
				$id_dokter			= $this->input->post('id_dokter');
				
				$eksekusi 	= $this->db->query("INSERT INTO antrian (tanggal, id_pasien, `status`, jam_daftar, id_dokter, no_antrian) VALUE ('".tanggal("tgl")."','$id_pasien','0','".tanggal("jam")."','$id_dokter','".autoantrian()."')");

				if ($eksekusi) {
					echo "
						<meta http-equiv='refresh' content='2;url=".base_url("m/antrian")."'>
						<script>sukses('tambah');</script>
					";
				} else {
					echo "
						<script>gagal('tambah');</script>
					";
				}
				
			}
			
			
			if(empty($id_antrian)){
?>
		<!-- /main navbar -->


		<!-- Page content -->
		<div class="page-content">

			<?php 
				if($ses_level == "admin"){
					$this->load->view('inc/sidebar/admin');
				}else{
					$this->load->view('inc/sidebar/staf');
				}
				
			?>


			<!-- Main content -->
			<div class="content-wrapper">

				<div class="breadcrumb-line breadcrumb-line-dark header-elements-md-inline bg-brown">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo base_url("m");?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
							<a href="<?php echo base_url("m/antrian");?>" class="breadcrumb-item">Data Antrian</a>
							<span class="breadcrumb-item active">Tambah Data Antrian</span>
						</div>
					</div>
				</div>
				
				<!-- Content area -->
				<div class="content">

					<!-- Basic datatable -->

					

							<div class="card">
								<div class="card-header bg-dark text-white header-elements-inline pt-1 pb-1">
									<h5 class="card-title">Tambah Data Antrian</h5>
									<div class="header-elements">
										<div class="list-icons">

<!--
											<a href="#" data-toggle="modal" data-target="#modalTambah" class="list-icons-item"><b><i class="icon-plus2"></i></b> Tambah Data</a>
-->
											
											<a class="list-icons-item" data-action="collapse"></a>

										</div>
									</div>
								</div>
								<div class="card-body">

									<a href="<?php echo base_url("m/antrian");?>" class="btn bg-dark"><i class="icon-arrow-left8 pr-2"></i> Kembali</a>

									<hr>
	
									<form method="post" class="row">
										<input type="hidden" name="id_pasien" id="id_pasien">
										<input type="hidden" name="id_dokter" id="id_dokter">
										<div class="col-md-6">
											
												<div class="form-group">
													<label class="font-weight-bold text-uppercase">ID. Pasien :</label>
													<div class="input-group">
														<input type="text" class="form-control" name="id_pasien_sample" id="id_pasien_tambah" placeholder="ID. Pasien" readonly="readonly" required>
														<div class="input-group-append">
															<a class="btn btn-outline bg-indigo-400 text-indigo-400 border-indigo-400 legitRipple" data-toggle="modal" data-target="#modalCariPasien">CARI </a>
														</div>
													</div>
												</div>
												<div class="form-group" id="f_nm_pasien">
													<label>Nama Pasien :</label>
													<input type="text" class="form-control" name="nm_pasien" id="nm_pasien_tambah" placeholder="Nama Pasien" readonly="readonly" required>
												</div>
												<div class="form-group" id="f_kelamin">
													<label>Jns. Kelamin :</label>
													<input type="text" class="form-control" name="kelamin" id="kelamin_tambah" placeholder="Jns. Kelamin" readonly="readonly" required>
												</div>
												<div class="form-group" id="f_telp">
													<label>No. Telp :</label>
													<input type="text" class="form-control" name="no_telp" id="no_telp_tambah" placeholder="No. Telp" readonly="readonly" required>
												</div>
												
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="font-weight-bold text-uppercase">ID. Dokter :</label>
												<div class="input-group">
													<input type="text" class="form-control" name="id_dokter_sample" id="id_dokter_tambah" placeholder="ID. Dokter" readonly="readonly" required>
													<div class="input-group-append">
														<a class="btn btn-outline bg-indigo-400 text-indigo-400 border-indigo-400 legitRipple" data-toggle="modal" data-target="#modalCariDokter">CARI </a>
													</div>
												</div>
											</div>
											<div class="form-group" id="f_nm_dokter">
												<label>Nama Dokter :</label>
												<input type="text" class="form-control" name="nm_dokter" id="nm_dokter_tambah" placeholder="Nama Dokter" readonly="readonly" required>
											</div>
											<div class="form-group bg-danger font-weight-bold text-center" style="width:100%;height:100px;padding-top:20px;border-radius:10px;">
												<div>No. Antrian:</div>
												<div style="font-size:24pt;"><?= autoantrian() ?></div>
											</div>
										</div>
										<div class="col-md-12">
											<button type="submit" class="btn bg-dark pull-right mt-3" name="tambahin"><i class="icon-plus2 pr-2"></i> Tambah Data</button>
										</div>
									</form>



								</div>
							</div>
				
				</div>

				<!-- Footer -->
				<?php $this->load->view('inc/footer');?>
				<!-- /footer -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

		
		
		
				<div id="modalCariPasien" class="modal fade" tabindex="-1">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header bg-danger">
								<h5 class="modal-title">Cari Data Pasien</h5>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>

							<div class="modal-body">
								<table class="table datatable-basic table-striped table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Nama Pasien</th>
											<th>Kelamin</th>
											<th>No. Telp</th>
											<th>Alamat</th>
											<th class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$nonoxx 	= 1;
											$spasonan	= $this->db->query("SELECT * FROM pasien ORDER BY nama");

											foreach ($spasonan->result_array() as $dpasonan) {
												if($dpasonan['jenis_kelamin'] == 1){
													$kelamin	= "Laki-laki";
												}else if($dpasonan['jenis_kelamin'] == 2){
													$kelamin	= "Perempuan";
												}
												echo"
													<tr>
														<td class='text-center' style='width:50px;'>" . $nonoxx . "</td>
														<td>" . $dpasonan['nama'] . "</td>
														<td>" . $kelamin . "</td>
														<td>" . $dpasonan['no_telp'] . "</td>
														<td>" . $dpasonan['alamat'] . "</td>
														<td><button class='btn btn-sm bg-danger btpilihpasien' data-id='".$dpasonan['id_pasien']."' data-nama='".$dpasonan['nama']."' data-telp='".$dpasonan['no_telp']."' data-kelamin='".$kelamin."'>Pilih</button></td>
													</tr>
												";
												$nonoxx++;
											}
										?>
									</tbody>
								</table>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
							</div>
						</div>
					</div>
				</div>
				
				<div id="modalCariDokter" class="modal fade" tabindex="-1">
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header bg-danger">
								<h5 class="modal-title">Cari Data Dokter</h5>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>

							<div class="modal-body">
								<table class="table datatable-basic table-striped table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Nama Dokter</th>
											<th>Kelamin</th>
											<th>No. Telp</th>
											<th>Alamat</th>
											<th class="text-center">Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$nonoxx 	= 1;
											$spasonan2	= $this->db->query("SELECT * FROM dokter WHERE `status` = '1' ORDER BY nama");

											foreach ($spasonan2->result_array() as $dpasonan2) {
												if($dpasonan2['jenis_kelamin'] == 1){
													$kelamin2	= "Laki-laki";
												}else if($dpasonan2['jenis_kelamin'] == 2){
													$kelamin2	= "Perempuan";
												}
												echo"
													<tr>
														<td class='text-center'>" . $nonoxx . "</td>
														<td>" . $dpasonan2['nama'] . "</td>
														<td>" . $kelamin2 . "</td>
														<td>" . $dpasonan2['no_telp'] . "</td>
														<td>" . $dpasonan2['alamat'] . "</td>
														<td><button class='btn btn-sm bg-danger btpilihdokter' data-id='".$dpasonan2['id_dokter']."' data-nama='".$dpasonan2['nama']."' data-telp='".$dpasonan2['no_telp']."'>Pilih</button></td>
													</tr>
												";
												$nonoxx++;
											}
										?>
									</tbody>
								</table>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
							</div>
						</div>
					</div>
				</div>
				
				
				
				
				
				
		<script type="text/javascript">
			$(document).ready(function() {
				$("#f_nm_pasien").hide();
				$("#f_telp").hide();
				$("#f_kelamin").hide();
				$("#f_nm_dokter").hide();
				$(document).on('click', '.btpilihpasien', function() {
					const id 	= $(this).data('id');
					const nama 	= $(this).data('nama');
					const telp 	= $(this).data('telp');
					const kelamin 	= $(this).data('kelamin');
					
					$("#f_nm_pasien").show();
					$("#f_telp").show();
					$("#f_kelamin").show();
				
					$('#id_pasien_tambah').val(id+" - "+nama);
					$('#id_pasien').val(id);
					$('#nm_pasien_tambah').val(nama);
					$('#no_telp_tambah').val(telp);
					$('#kelamin_tambah').val(kelamin);
					$('#modalCariPasien').modal('hide');
					//~ document.getElementById("jns_register_tambah").focus(); 
				});
				
				$(document).on('click', '.btpilihdokter', function() {
					const id 	= $(this).data('id');
					const nama 	= $(this).data('nama');
					
					$("#f_nm_dokter").show();
				
					$('#id_dokter_tambah').val(id+" - "+nama);
					$('#id_dokter').val(id);
					$('#nm_dokter_tambah').val(nama);
					$('#modalCariDokter').modal('hide');
					//document.getElementById("nm_dokter_tambah").innerHTML = nama;
					
					
				});
				
				
				

			});
			

		</script>
		
		
<?php
}else{
	
?>













<?php
}
?>



		




	</body>

	</html>

<?php
}else{
	$this->load->view('errors/403');
}
?>

<?php
defined('BASEPATH') or exit('No direct script access allowed');
$ses_user        = $this->session->userdata('username');
$ses_level       = $this->session->userdata('level');

if ($ses_level == "admin" || $ses_level == "staf" || $ses_level == "dokter" || $ses_level == "perawat") {
	
	$sdata 		= $this->db->query("SELECT MAX(no_rekam_medis) AS next_rekmed FROM pasien");
	$ddata		= $sdata->result_array();
	$autopasien	=  $ddata[0]['next_rekmed']+1;
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Data Pasien</title>
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
				$no_rekam_medis		= $this->input->post('no_rekam_medis');
				$pekerjaan			= $this->input->post('pekerjaan');
				$riwayat_penyakit	= $this->input->post('riwayat_penyakit');
				$alergi_obat		= $this->input->post('alergi_obat');
				$nama				= $this->input->post('nama');
				$alamat				= $this->input->post('alamat');
				$tanggal_lahir		= $this->input->post('tanggal_lahir');
				$jenis_kelamin		= $this->input->post('jenis_kelamin');
				$no_telp			= $this->input->post('no_telp');
				$email				= $this->input->post('email');
				$username			= $this->input->post('username');
				$password			= password_hash($this->input->post('password'), PASSWORD_DEFAULT);
				
				if(empty($username)){
					$scekadakah2			= $this->db->query("SELECT no_rekam_medis FROM pasien WHERE no_rekam_medis = '".$no_rekam_medis."'");
						$hcekadakah2			= $scekadakah2->num_rows();
						if($hcekadakah2 > 0){
						
							echo"
								<script>
									swal({
										title: 'No. Rekam Medis Sudah Digunakan!',
										type: 'error',
										cancelButtonClass: 'btn btn-light',
										confirmButtonClass: 'btn btn-danger',
										text: 'No. Rekam Medis (".$no_rekam_medis.") sudah digunakan oleh orang lain. Mohon gunakan Nomor lain yang belum dipakai.',
										background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
									});
								</script>
							";
						}else{
							$wadafak 	= $this->db->query("INSERT INTO pasien (nama, alamat, tanggal_lahir, jenis_kelamin, no_telp, email, username, password, no_rekam_medis, pekerjaan, riwayat_penyakit, alergi_obat) VALUE ('$nama','$alamat','$tanggal_lahir','$jenis_kelamin','$no_telp','$email','$username','$password','$no_rekam_medis', '$pekerjaan', '$riwayat_penyakit','$alergi_obat')");

							if ($wadafak) {
								$this->session->set_flashdata('pesen', '<script>sukses("tambah");</script>');
								redirect('/m/user/pasien');
							} else {
								$this->session->set_flashdata('pesen', '<script>gagal("tambah");</script>');
								redirect('/m/user/pasien');
							}
						}
				}else{
					$scekadakah			= $this->db->query("SELECT username FROM pasien WHERE username = '$username'");
					$hcekadakah			= $scekadakah->num_rows();
					if($hcekadakah > 0){
					
						echo"
							<script>
								swal({
									title: 'Username Sudah Digunakan!',
									type: 'error',
									cancelButtonClass: 'btn btn-light',
									confirmButtonClass: 'btn btn-danger',
									text: 'Username (".$username.") sudah digunakan oleh orang lain. Mohon gunakan username lain yang belum dipakai.',
									background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
								});
							</script>
						";
					}else{
						$scekadakah2			= $this->db->query("SELECT no_rekam_medis FROM pasien WHERE no_rekam_medis = '$no_rekam_medis'");
						$hcekadakah2			= $scekadakah2->num_rows();
						if($hcekadakah2 > 0){
						
							echo"
								<script>
									swal({
										title: 'No. Rekam Medis Sudah Digunakan!',
										type: 'error',
										cancelButtonClass: 'btn btn-light',
										confirmButtonClass: 'btn btn-danger',
										text: 'No. Rekam Medis (".$no_rekam_medis.") sudah digunakan oleh orang lain. Mohon gunakan Nomor lain yang belum dipakai.',
										background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
									});
								</script>
							";
						}else{
							$wadafak 	= $this->db->query("INSERT INTO pasien (nama, alamat, tanggal_lahir, jenis_kelamin, no_telp, email, username, password, no_rekam_medis, pekerjaan, riwayat_penyakit, alergi_obat) VALUE ('$nama','$alamat','$tanggal_lahir','$jenis_kelamin','$no_telp','$email','$username','$password','$no_rekam_medis', '$pekerjaan', '$riwayat_penyakit','$alergi_obat')");

							if ($wadafak) {
								$this->session->set_flashdata('pesen', '<script>sukses("tambah");</script>');
								redirect('/m/user/pasien');
							} else {
								$this->session->set_flashdata('pesen', '<script>gagal("tambah");</script>');
								redirect('/m/user/pasien');
							}
						}
					}
				}
			}else if (isset($_POST['editin'])) {
				$id_pasien			= $this->input->post('id_pasien');
				$no_rekam_medis		= $this->input->post('no_rekam_medis');
				$pekerjaan			= $this->input->post('pekerjaan');
				$riwayat_penyakit	= $this->input->post('riwayat_penyakit');
				$alergi_obat		= $this->input->post('alergi_obat');
				$nama				= $this->input->post('nama');
				$alamat				= $this->input->post('alamat');
				$tanggal_lahir		= $this->input->post('tanggal_lahir');
				$jenis_kelamin		= $this->input->post('jenis_kelamin');
				$no_telp			= $this->input->post('no_telp');
				$email				= $this->input->post('email');
				$username			= $this->input->post('username');
				$username_lama		= $this->input->post('username_lama');
				
				if(empty($username)){
					$scekadakah2			= $this->db->query("SELECT no_rekam_medis FROM pasien WHERE no_rekam_medis = '".$no_rekam_medis."' AND id_pasien <> '".$id_pasien."'");
					$hcekadakah2			= $scekadakah2->num_rows();
					if($hcekadakah2 > 0){
					
						echo"
							<script>
								swal({
									title: 'NO. Rekam Medis Sudah Digunakan!',
									type: 'error',
									cancelButtonClass: 'btn btn-light',
									confirmButtonClass: 'btn btn-danger',
									text: 'No. Rekam Medis (".$no_rekam_medis.") sudah digunakan oleh orang lain. Mohon gunakan nomor lain yang belum dipakai.',
									background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
								});
							</script>
						";
					}else{
						$wadafak 	= $this->db->query("UPDATE pasien SET nama = '$nama', alamat = '$alamat', tanggal_lahir = '$tanggal_lahir', jenis_kelamin = '$jenis_kelamin', no_telp = '$no_telp', email = '$email', username = '$username', no_rekam_medis = '$no_rekam_medis', pekerjaan = '$pekerjaan', riwayat_penyakit = '$riwayat_penyakit', alergi_obat = '$alergi_obat' WHERE id_pasien = '$id_pasien'");

						if ($wadafak) {
							$this->session->set_flashdata('pesen', '<script>sukses("edit");</script>');
								redirect('/m/user/pasien');
						} else {
							$this->session->set_flashdata('pesen', '<script>gagal("edit");</script>');
							redirect('/m/user/pasien');
						}
					}
				}else{
					$scekadakah			= $this->db->query("SELECT username FROM pasien WHERE username = '$username' AND id_pasien <> '$id_pasien'");
				$hcekadakah			= $scekadakah->num_rows();
				if($hcekadakah > 0){
				
					echo"
						<script>
							swal({
								title: 'Username Sudah Digunakan!',
								type: 'error',
								cancelButtonClass: 'btn btn-light',
								confirmButtonClass: 'btn btn-danger',
								text: 'Username (".$username.") sudah digunakan oleh orang lain. Mohon gunakan username lain yang belum dipakai.',
								background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
							});
						</script>
					";
				}else{
					$scekadakah2			= $this->db->query("SELECT no_rekam_medis FROM pasien WHERE no_rekam_medis = '$no_rekam_medis' AND id_pasien <> '$id_pasien'");
					$hcekadakah2			= $scekadakah2->num_rows();
					if($hcekadakah2 > 0){
					
						echo"
							<script>
								swal({
									title: 'NO. Rekam Medis Sudah Digunakan!',
									type: 'error',
									cancelButtonClass: 'btn btn-light',
									confirmButtonClass: 'btn btn-danger',
									text: 'No. Rekam Medis (".$no_rekam_medis.") sudah digunakan oleh orang lain. Mohon gunakan nomor lain yang belum dipakai.',
									background: '#fff url(../../global/images/backgrounds/seamless.png) repeat'
								});
							</script>
						";
					}else{
						$wadafak 	= $this->db->query("UPDATE pasien SET nama = '$nama', alamat = '$alamat', tanggal_lahir = '$tanggal_lahir', jenis_kelamin = '$jenis_kelamin', no_telp = '$no_telp', email = '$email', username = '$username', no_rekam_medis = '$no_rekam_medis', pekerjaan = '$pekerjaan', riwayat_penyakit = '$riwayat_penyakit', alergi_obat = '$alergi_obat' WHERE id_pasien = '$id_pasien'");

						if ($wadafak) {
							$this->session->set_flashdata('pesen', '<script>sukses("edit");</script>');
								redirect('/m/user/pasien');
						} else {
							$this->session->set_flashdata('pesen', '<script>gagal("edit");</script>');
							redirect('/m/user/pasien');
						}
					}
				}
				}
			}else if (isset($_POST['edipinpass'])) {
				$id_pasien			= $this->input->post('id_pasien');
				$newpass			= password_hash($this->input->post('newpass'), PASSWORD_DEFAULT);
				$wadafak 	= $this->db->query("UPDATE pasien SET `password` = '" . $newpass . "' WHERE id_pasien = '" . $id_pasien . "'");

				if ($wadafak) {
					$this->session->set_flashdata('pesen', '<script>sukses("edit");</script>');
					redirect('/m/user/pasien');
				} else {
					$this->session->set_flashdata('pesen', '<script>gagal("edit");</script>');
					redirect('/m/user/pasien');
				}
			} else if (isset($_POST['hapusin'])) {
				$id_pasien			= $this->input->post('id_pasien');
				$wadafak	= $this->db->delete('pasien', array('id_pasien' => $id_pasien));
				if ($wadafak) {
					$this->session->set_flashdata('pesen', '<script>sukses("hapus");</script>');
					redirect('/m/user/pasien');
				} else {
					$this->session->set_flashdata('pesen', '<script>gagal("hapus");</script>');
					redirect('/m/user/pasien');
				}
			}
			
			echo $this->session->flashdata('pesen');
			?>
		<!-- /main navbar -->


		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<?php
				if($ses_level == "admin"){
					$this->load->view('inc/sidebar/admin');
				}else if($ses_level == "staf" || $ses_level == "perawat" || $ses_level == "dokter"){
					$this->load->view('inc/sidebar/staf');
				}
				
			?>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">
				
				
				<div class="breadcrumb-line breadcrumb-line-dark header-elements-md-inline bg-brown">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo base_url("m");?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
							<span class="breadcrumb-item active">Data Pasien</span>
						</div>
					</div>
				</div>

				<!-- Content area -->
				<div class="content">

					<!-- Basic datatable -->

					

							<div class="card">
								<div class="card-header bg-dark text-white header-elements-inline pt-1 pb-1">
									<h5 class="card-title">Master Data : <b class="text-warning">Pasien</b></h5>
									<div class="header-elements">
										<div class="list-icons">
											<?php if($ses_level == "staf" || $ses_level == "admin"){ ?>
											<a href="#" data-toggle="modal" data-target="#modalTambah" class="list-icons-item"><b><i class="icon-plus2"></i></b> Tambah Data</a>
											<?php } ?>
<!--
											<a class="list-icons-item" data-action="collapse"></a>
-->

										</div>
									</div>
								</div>
								<div class="card-body">







									<table class="table datatable-reorder-realtime table-bordered table-hover table-stripted">
										<thead>
											<tr>
												<th width="5%" class="bg-dark">No.</th>
												<th class="bg-dark">No. Rekmed</th>
												<th class="bg-dark">Nama Pasien</th>
												<th class="bg-dark">Tgl. Lahir</th>
												<th class="bg-dark">Jns. Kelamin</th>
												<th class="bg-dark">No. Telp</th>
												<th class="bg-dark">Username</th>
												<?php if($ses_level == "staf" || $ses_level == "admin"){ ?>
												<th style="width:100px" class="text-center bg-dark">Aksi</th>
												<?php } ?>
											</tr>
										</thead>
										<tbody>
											<?php
												$sdata = $this->db->query("SELECT * FROM pasien ORDER BY no_rekam_medis DESC");
												$nodata	= 1;
												$hdata	= $sdata->num_rows();
												foreach ($sdata->result_array() as $ddata) {
													if($ddata['jenis_kelamin'] == 1){
														$jk	= "Laki-laki";
													}else if($ddata['jenis_kelamin'] == 2){
														$jk = "Perempuan";
													}
													echo "
											<tr>
												<td class='text-center'>" . $nodata . "</td>
												<td>" . $ddata['no_rekam_medis'] . "</td>
												<td>" . $ddata['nama'] . "</td>
												<td>".tgl_indo2($ddata['tanggal_lahir'],"a")."</td>
												<td>" . $jk . "</td>
												<td>" . $ddata['no_telp'] . "</td>
												<td>" . $ddata['username'] . "</td>
												";
												if($ses_level == "staf" || $ses_level == "admin"){
													echo"
												<td class='text-center'>
													<button type='button' class='btn btn-info btn-sm' data-toggle='dropdown'><i class='icon-grid'></i></button>

													<div class='dropdown-menu dropdown-menu-right'>
														<a href='#' data-toggle='modal' data-target='#modalEdit' data-id='".$ddata['id_pasien']."' class='dropdown-item btedit'><i class='icon-pencil'></i> Edit Data</a>
														<a href='#' data-toggle='modal' data-target='#modalHapus' data-id='".$ddata['id_pasien']."' data-nama='".$ddata['nama']."' class='dropdown-item bthapus'><i class='icon-trash'></i> Hapus Data</a>
														<a href='#' data-toggle='modal' data-target='#modalEditPass' data-id='".$ddata['id_pasien']."' data-nama='".$ddata['nama']."' class='dropdown-item bteditpass'><i class='icon-lock'></i> Edit Password</a>
													</div>
												</td>
												";
											}
											echo"
											</tr>
			
			
										";
													$nodata++;
												}
												?>
										</tbody>
									</table>





								</div>
							</div>
				
				</div>
				<!-- /content area -->

				<div id="modalHapus" class="modal fade" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
							<form method="post">
								<input type="hidden" name="id_pasien" id="id_pasienxx">
								<div class="modal-header bg-danger">
									<h5 class="modal-title">Konfirmasi Hapus Data</h5>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<div class="modal-body">
									
									<div class="alert alert-danger">Anda yakin akan menghapus data <b id="namaxx"></b>? Data yang sudah dihapus tidak bisa dikembalikan lagi.</div>	
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
									<button type="submit" name="hapusin" class="btn bg-danger">Ya! Hapus permanen data</button>
								</div>
                            </form>
                        </div>
                    </div>
                </div>
                
                
				<div id="modalTambah" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-teal-600">
							<h4 class="modal-title">Tambah Pasien</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

							<div class="modal-body pb-0">
								<form method="post" class="formulir_tambah">
									
									<div class="form-group">
										<label class="font-weight-bold text-uppercase">No. Rekam Medis :</label>
										<div class="input-group">
											<input type="number" class="form-control" name="no_rekam_medis" id="no_rekam_medis_tambah" placeholder="No. Rekam Medis" required>
											<div class="input-group-append">
												<button type="button" class="btn btn-outline bg-indigo-400 text-indigo-400 border-indigo-400 legitRipple" onclick="Autonumber()">AUTO</button>
												<button type="button" class="btn bg-dark dropdown-toggle btn-icon legitRipple border-dark legitRipple-empty" data-toggle="dropdown" aria-expanded="false"></button>
												<div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(650px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
													<a href="#" class="dropdown-item" onclick="resetauto()">Reset</a>
												</div>
											</div>
										</div>
										<div id="pesan_keypress"></div>
									</div>
									<div class="form-group">
										<label>Nama Pasien :</label>
										<input type="text" name="nama" class="form-control" id="nama_tambah" placeholder="Nama Pasien" required>
									</div>
									<div class="form-group">
										<label>Tgl. Lahir :</label>
										<div class="form-group form-group-feedback form-group-feedback-left">
											<input type="text" class="form-control pickadate-wasem2" placeholder="Tanggal Lahir" name="tanggal_lahir" required>
											<div class="form-control-feedback form-control-feedback-sm">
												<i class="icon-calendar"></i>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Jenis Kelamin :</label>
										<select class="form-control" name="jenis_kelamin" required>
											<option value="">- Pilih Jns Kelamin -</option>
											<option value="1">Laki-laki</option>
											<option value="2">Perempuan</option>
										</select>
									</div>
									<div class="form-group">
										<label>Alamat :</label>
										<input type="text" name="alamat" class="form-control" placeholder="Alamat lengkap" required>
									</div>
									<div class="form-group">
										<label>No. Telp :</label>
										<input type="text" name="no_telp" class="form-control" placeholder="Nomor Telphone" required>
									</div>
									<div class="form-group">
										<label>Pekerjaan :</label>
										<input type="text" name="pekerjaan" class="form-control" placeholder="Pekerjaan" required>
									</div>
									<div class="form-group">
										<label>Riwayat Penyakit :</label>
										<textarea name="riwayat_penyakit" class="form-control" placeholder="Riwayat Penyakit"></textarea>
									</div>
									<div class="form-group">
										<label>Alergi Obat :</label>
										<textarea name="alergi_obat" class="form-control" placeholder="Alergi Obat"></textarea>
									</div>
									<div class="form-group">
										<label>Email :</label>
										<input type="email" name="email" class="form-control" placeholder="Email">
									</div>
									<div class="form-group">
										<label>Username :</label>
										<input type="text" name="username" class="form-control" placeholder="Username">
									</div>
									<div class="form-group">
										<label>Password :</label>
										<input type="password" name="password" class="form-control" id="password" placeholder="Password">
									</div>
									<div class="form-group">
										<label>Ulangi Password :</label>
										<input type="password" name="repeat_password" class="form-control" placeholder="Ulangi Password">
									</div>
									
									<div class="form-group">
										<div class="alert alert-warning">Pastikan data yang anda tambahkan adalah benar.</div>
										<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
										<button type="submit" name="tambahin" class="btn bg-teal-800">Tambah Data</button>
									</div>
									
								</form>
							</div>
						</div>
					</div>
				</div>
				
				
				
				
				<div id="modalEdit" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-teal-600">
							<h4 class="modal-title">Edit Pasien</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

							<div class="modal-body pb-0">
								<form method="post" class="formulir_edit">
									<input type="hidden" name="id_pasien" id="id_pasien_edit">
									<input type="hidden" name="username_lama" id="username_lama">
									<div class="form-group">
										<label>No. Rekam Medis :</label>
										<input type="number" name="no_rekam_medis" id="no_rekam_medis" class="form-control" placeholder="No. Rekam Medis" required>
									</div>
									<div class="form-group">
										<label>Nama Pasien :</label>
										<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Pasien" required>
									</div>
									<div class="form-group">
										<label>Tgl. Lahir :</label>
										<div class="form-group form-group-feedback form-group-feedback-left">
											<input type="text" class="form-control pickadate-wasem2" placeholder="Tanggal Lahir" name="tanggal_lahir" id="tanggal_lahir" required>
											<div class="form-control-feedback form-control-feedback-sm">
												<i class="icon-calendar"></i>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label>Jenis Kelamin :</label>
										<select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
											<option value="">- Pilih Jns Kelamin -</option>
										</select>
									</div>
									<div class="form-group">
										<label>Alamat :</label>
										<input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat lengkap" required>
									</div>
									<div class="form-group">
										<label>No. Telp :</label>
										<input type="text" name="no_telp" class="form-control" id="no_telp" placeholder="Nomor Telphone" required>
									</div>
									<div class="form-group">
										<label>Pekerjaan :</label>
										<input type="text" name="pekerjaan" id="pekerjaan" class="form-control" placeholder="Pekerjaan" required>
									</div>
									<div class="form-group">
										<label>Riwayat Penyakit :</label>
										<textarea name="riwayat_penyakit" class="form-control" id="riwayat_penyakit" placeholder="Riwayat Penyakit"></textarea>
									</div>
									<div class="form-group">
										<label>Alergi Obat :</label>
										<textarea name="alergi_obat" class="form-control" id="alergi_obat" placeholder="Alergi Obat"></textarea>
									</div>
									<div class="form-group">
										<label>Email :</label>
										<input type="email" name="email" class="form-control" id="email" placeholder="Email">
									</div>
									
									<div class="form-group">
										<label>Username :</label>
										<input type="text" name="username" class="form-control" id="username" placeholder="Username">
									</div>
									
									<div class="form-group">
										<div class="alert alert-warning">Pastikan data yang anda tambahkan adalah benar.</div>
										<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
										<button type="submit" name="editin" class="btn bg-teal-800">Edit Data</button>
									</div>
									
								</form>
							</div>
						</div>
					</div>
				</div>
				
				
				<div id="modalEditPass" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header bg-teal-600">
							<h4 class="modal-title">Edit Password Pasien : <b class="text-warning" id="namaxxx"></b></h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

							<div class="modal-body pb-0">
								<form method="post" class="formulir_editpass">
									<input type="hidden" name="id_pasien" id="id_pasien_editpass">
									
									<div class="form-group">
										<label>Password baru :</label>
										<input type="password" id="password2" name="newpass" class="form-control" placeholder="Password Baru" required>
									</div>
									
									<div class="form-group">
										<label>Ulangi Password :</label>
										<input type="password" name="repeat_password2" class="form-control" placeholder="Ulangi Password" required>
									</div>
									
									<div class="form-group">
										<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
										<button type="submit" name="edipinpass" class="btn bg-teal-800">Edit Password</button>
									</div>
									
								</form>
							</div>
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

		




		<script type="text/javascript">
			
			
			
			$("#no_rekam_medis_tambah").on("keypress", function(e){			
				if(event.keyCode == 13) {
					event.preventDefault();
					var no_pasiene = document.getElementById("no_rekam_medis_tambah").value;
					if(no_pasiene == ""){
						document.getElementById("pesan_keypress").innerHTML = "";
						document.getElementById("no_rekam_medis_tambah").focus(); 
					}else{
						$.ajax({
							type: 'get',
							url: "<?php echo base_url('m/ajax/pasien-keypress/'); ?>"+no_pasiene,
							//async: false,
							dataType: 'json',
							success: function(data) {
								if(data.length==0) {
									document.getElementById("pesan_keypress").innerHTML = "";
									document.getElementById("nama_tambah").focus(); 
								}else{
									document.getElementById("pesan_keypress").innerHTML = "<span class='form-text text-danger'>No. Rekam Medis <b>"+no_pasiene+"</b> sudah digunakan untuk : <b>"+data[0].nama+"</b></span>";
									document.getElementById("no_rekam_medis_tambah").value = "";
									document.getElementById("no_rekam_medis_tambah").focus(); 
								}
							}
						});
					}
					return false;
				}
			});

			function Autonumber(){
				$('#no_rekam_medis_tambah').val("<?php echo $autopasien;?>");
				document.getElementById("no_rekam_medis_tambah").focus(); 
			}
			function resetauto(){
				$('#no_rekam_medis_tambah').val("");
				document.getElementById("no_rekam_medis_tambah").focus(); 
			}
			
			
			
			$(document).ready(function() {

				$(document).on('click', '.btedit', function() {
					const id 	= $(this).data('id');
					$('#id_pasien_edit').val(id);
					$.ajax({
						method: 'post',
						//~ url: "<?= site_url('m/jkbyid') ?>",
						url: "<?= site_url('m/user_pasienbyid') ?>",
						data: {
							id: id
						},
						method: 'post',
						dataType: 'json',
						success: function(data) {
							//console.log(data);

							$('#nama').val(data[0].nama);
							$('#alamat').val(data[0].alamat);
							$('#no_rekam_medis').val(data[0].no_rekam_medis);
							$('#tanggal_lahir').val(data[0].tanggal_lahir);
							$('#no_telp').val(data[0].no_telp);
							$('#pekerjaan').val(data[0].pekerjaan);
							$('#email').val(data[0].email);
							//~ document.getElementById("riwayat_penyakit").value = data[0].riwayat_penyakit;
							$('#riwayat_penyakit').append(data[0].riwayat_penyakit);
							$('#alergi_obat').append(data[0].alergi_obat);
							//~ document.getElementById("alergi_obat").value = data[0].alergi_obat;
							$('#username').val(data[0].username);
							$('#username_lama').val(data[0].username);
							
							let jenis_kelamin2 		= data[0].jenis_kelamin;
	
							var html = '<option value="">- Pilih Jenis Kelamin -</option>';
							if(jenis_kelamin2 == "1"){
								html += '<option value="1" selected>Laki-laki</option><option value="2">Perempuan</option>';
							}else if(jenis_kelamin2 == "2"){
								html += '<option value="1">Laki-laki</option><option value="2" selected>Perempuan</option>';
							}else{
								html += '<option value="1">Laki-laki</option><option value="2">Perempuan</option>';
							}
							
							$('#jenis_kelamin').html(html);
							

						}
					});
				});
            
            
            
				
				$(document).on('click', '.bthapus', function() {
					const id 	= $(this).data('id');
					const nama 	= $(this).data('nama');
					$('#id_pasienxx').val(id);
					//$('#nm_userxx').val(nama);
					document.getElementById("namaxx").innerHTML = nama;
					//console.log("data : " + nama);
				});

				$(document).on('click', '.bteditpass', function() {
					const id 	= $(this).data('id');
					const nama 	= $(this).data('nama');
					$('#id_pasien_editpass').val(id);
					//$('#nm_userxx').val(nama);
					document.getElementById("namaxxx").innerHTML = nama;
					//console.log("data : " + nama);
				});

			});
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
		$('.formulir_tambah').validate({
            ignore: 'input[type=hidden], .select2-search__field',
            errorClass: 'validation-invalid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            rules: {
                password: {
                    minlength: 5
                },
                repeat_password: {
                    equalTo: '#password'
                },
                no_rekam_medis: {
					number: true
				},
                no_telp:{
					number: true,
					minlength:5
				},
                repeat_password2: {
                    equalTo: '#password2'
                },
            },
            messages: {
                nama: {
                    required: 'Nama tidak boleh kosong'
                },
                no_rekam_medis: {
					number: 'Mohon isi kolom dengan angka',
					required: 'No. Rekam Medis tidak boleh kosong'
				},
				pekerjaan: {
					required: 'Pekerjaan tidak boleh kosong'
				},
                tempat_lahir: {
					required: 'Tempat lahir tidak boleh kosong'
				},
				tanggal_lahir: {
                    required: 'Tanggal lahir tidak boleh kosong'
                },alamat: {
                    required: 'Alamat tidak boleh kosong'
                },jenis_kelamin: {
                    required: 'Jns. Kelamin tidak boleh kosong'
                },no_telp: {
					number: 'Ketik hanya angka',
					minlength: 'Ketik minimal 5 nomor',
                    required: 'No. Telp tidak boleh kosong'
                }
            }
        });
        
        $('.formulir_edit').validate({
            ignore: 'input[type=hidden], .select2-search__field',
            errorClass: 'validation-invalid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            rules: {
                no_telp:{
					number: true,
					minlength:5
				}
            },
            messages: {
                nama: {
                    required: 'Nama tidak boleh kosong'
                },
                no_rekam_medis: {
					required: 'No. Rekam Medis tidak boleh kosong'
				},
				pekerjaan: {
					required: 'Pekerjaan tidak boleh kosong'
				},
                tempat_lahir: {
					required: 'Tempat lahir tidak boleh kosong'
				},
				no_str:{
					required: 'No. STR tidak boleh kosong'
				},
				tanggal_berlaku_str:{
					required: 'Tanggal Berlaku STR tidak boleh kosong'
				},
				tanggal_lahir: {
                    required: 'Tanggal lahir tidak boleh kosong'
                },alamat: {
                    required: 'Alamat tidak boleh kosong'
                },jenis_kelamin: {
                    required: 'Jns. Kelamin tidak boleh kosong'
                },no_telp: {
					number: 'Ketik hanya angka',
					minlength: 'Ketik minimal 5 nomor',
                    required: 'No. Telp tidak boleh kosong'
                }
            }
        });
        
        $('.formulir_editpass').validate({
            ignore: 'input[type=hidden], .select2-search__field',
            errorClass: 'validation-invalid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            rules: {
                newpass: {
                    minlength: 5
                },
                repeat_password2: {
                    equalTo: '#password2'
                },
            },
            messages: {
                newpass: {
					minlength: 'Password minimal 5 karakter',
					required: 'Password tidak boleh kosong'
				}, repeat_password2: {
					equalTo: 'Password tidak sama',
					required: 'Ulangi password tidak boleh kosong'
				}
            }
        });
		</script>




	</body>

	</html>

<?php
}else{
	$this->load->view('errors/403');
}
?>

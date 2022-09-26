<?php
defined('BASEPATH') or exit('No direct script access allowed');
$ses_user		= $this->session->userdata('id_user');
$ses_group		= $this->session->userdata('id_group');

//FIREX ENKRIPTOR
$firex 			= new FirexGanteng;


if ($ses_group == 1 || $ses_group == 2) {
	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Data Pengguna Member - TV Riau</title>
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
			$this->load->view('inc/admin/navbar');


			if (isset($_POST['tambahin'])) {
				$nm_user			= antixss($_POST['nm_user']);
				$id_jk				= antixss($_POST['id_jk']);
				$id_agama			= antixss($_POST['id_agama']);
				$alamat				= antixss($_POST['alamat']);
				$hp					= antixss($_POST['hp']);
				$email				= antixss($_POST['email']);
				$username			= antixss($_POST['username']);
				$password			= md5($_POST['password']);
				
				$scekadakah			= $this->db->query("SELECT username FROM tv_user WHERE username = '$username'");
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
					$wadafak 	= $this->db->query("INSERT INTO tv_user (nm_user, id_jk, id_agama, alamat, hp, email, username, password, id_group) VALUE ('$nm_user','$id_jk','$id_agama','$alamat','$hp','$email','$username','$password','3')");

					if ($wadafak) {
						echo "
							<script>sukses('tambah');</script>
						";
					} else {
						echo "
							<script>gagal('tambah');</script>
						";
					}
				}
				
			}else if (isset($_POST['editin'])) {
				$id_user			= antixss($_POST['id_user']);
				$nm_user			= antixss($_POST['nm_user']);
				$id_jk				= antixss($_POST['id_jk']);
				$id_agama			= antixss($_POST['id_agama']);
				$alamat				= antixss($_POST['alamat']);
				$hp					= antixss($_POST['hp']);
				$email				= antixss($_POST['email']);
				$username			= antixss($_POST['username']);
				$username_lama		= antixss($_POST['username_lama']);
				
				$scekadakah			= $this->db->query("SELECT username FROM tv_user WHERE username = '$username' AND id_user <> '$id_user'");
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
					$wadafak 			= $this->db->query("UPDATE tv_user SET nm_user = '$nm_user', id_jk = '$id_jk', id_agama = '$id_agama', alamat = '$alamat', hp = '$hp', email = '$email', username = '$username' WHERE id_user = '$id_user'");

					if ($wadafak) {
						echo "
							<script>sukses('edit');</script>
						";
					} else {
						echo "
							<script>gagal('edit');</script>
						";
					}
				}
				
			}else if (isset($_POST['edipinpass'])) {
				$id_user	= $_POST['id_user'];
				$newpass	= md5($_POST['newpass']);
				$wadafak 	= $this->db->query("UPDATE tv_user SET `password` = '" . $newpass . "' WHERE id_user = '" . $id_user . "'");

				if ($wadafak) {
					echo "
						<script>sukses('edit');</script>
					";
				} else {
					echo "
						<script>gagal('edit');</script>
					";
				}
			} else if (isset($_POST['hapusin'])) {
				$id_user	= $_POST['id_user'];
				$wadafak	= $this->db->delete('tv_user', array('id_user' => $id_user));
				if ($wadafak) {
					echo "
						<script>sukses('hapus');</script>
					";
				} else {
					echo "
						<script>gagal('hapus');</script>
					";
				}
			}
			?>
		<!-- /main navbar -->


		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<?php $this->load->view('inc/admin/sidebar');?>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">


				<!-- Content area -->
				<div class="content">

					<!-- Basic datatable -->

					

							<div class="card">
								<div class="card-header bg-dark text-white header-elements-inline pt-1 pb-1">
									<h5 class="card-title">Master Pengguna : <b class="text-warning">Member</b></h5>
									<div class="header-elements">
										<div class="list-icons">

											<a href="#" data-toggle="modal" data-target="#modalTambah" class="list-icons-item"><b><i class="icon-plus2"></i></b> Tambah Data</a>
											
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
												<th class="bg-dark">Nama Pengguna</th>
												<th class="bg-dark">Jns. Kelamin</th>
												<th class="bg-dark">Alamat</th>
												<th class="bg-dark">HP</th>
												<th class="bg-dark">Username</th>
												<th style="width:100px" class="text-center bg-dark">Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$sdata = $this->db->query("SELECT a.*, b.`nm_jk`, c.`nm_agama`, d.`nm_group` FROM tv_user a, tv_jk b, tv_agama c, tv_group d WHERE a.id_jk = b.`id_jk` AND a.`id_agama` = c.`id_agama` AND a.`id_group` = d.`id_group` AND a.id_group = '3' ORDER BY a.`nm_user`");
												$nodata	= 1;
												$hdata	= $sdata->num_rows();
												foreach ($sdata->result_array() as $ddata) {
													echo "
											<tr>
												<td class='text-center'>" . $nodata . "</td>
												<td>" . $ddata['nm_user'] . "</td>
												<td>" . $ddata['nm_jk'] . "</td>
												<td>" . $ddata['alamat'] . "</td>
												<td>" . $ddata['hp'] . "</td>
												<td>" . $ddata['username'] . "</td>
												<td class='text-center'>
													<button type='button' class='btn btn-info btn-sm' data-toggle='dropdown'><i class='icon-grid'></i></button>

													<div class='dropdown-menu dropdown-menu-right'>
														<a href='#' data-toggle='modal' data-target='#modalEdit' data-id='".$ddata['id_user']."' class='dropdown-item btedit'><i class='icon-pencil'></i> Edit Data</a>
														<a href='#' data-toggle='modal' data-target='#modalHapus' data-id='".$ddata['id_user']."' data-nama='".$ddata['nm_user']."' class='dropdown-item bthapus'><i class='icon-trash'></i> Hapus Data</a>
														<a href='#' data-toggle='modal' data-target='#modalEditPass' data-id='".$ddata['id_user']."' data-nama='".$ddata['nm_user']."' class='dropdown-item bteditpass'><i class='icon-lock'></i> Edit Password</a>
													</div>
												</td>
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
								<input type="hidden" name="id_user" id="id_userxx">
								<div class="modal-header bg-danger">
									<h5 class="modal-title">Konfirmasi Hapus Data</h5>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<div class="modal-body">
									
									<div class="alert alert-danger">Anda yakin akan menghapus data <b id="nm_userxx"></b>? Data yang sudah dihapus tidak bisa dikembalikan lagi.</div>	
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
							<h4 class="modal-title">Tambah Pengguna</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

							<div class="modal-body pb-0">
								<form method="post">
									<div class="form-group">
										<label>Nama Pengguna :</label>
										<input type="text" name="nm_user" class="form-control" placeholder="Nama Pengguna" required>
									</div>
									<div class="form-group">
										<label>Jenis Kelamin :</label>
										<select class="form-control" name="id_jk" required>
											<option value="">- Pilih Jns Kelamin -</option>
											<?php
												$sjk = $this->db->query("SELECT * FROM tv_jk");
												foreach ($sjk->result_array() as $djk) {
													echo"<option value='".$djk['id_jk']."'>".$djk['nm_jk']."</option>";
												}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Agama :</label>
										<select class="form-control" name="id_agama" required>
											<option value="">- Pilih Agama -</option>
											<?php
												$sagama = $this->db->query("SELECT * FROM tv_agama");
												foreach ($sagama->result_array() as $dagama) {
													echo"<option value='".$dagama['id_agama']."'>".$dagama['nm_agama']."</option>";
												}
											?>
										</select>
									</div>
									<div class="form-group">
										<label>Alamat :</label>
										<input type="text" name="alamat" class="form-control" placeholder="Alamat lengkap" required>
									</div>
									<div class="form-group">
										<label>Nomor Handphone :</label>
										<input type="text" name="hp" class="form-control" placeholder="Nomor Hanphone" required>
									</div>
									<div class="form-group">
										<label>Email :</label>
										<input type="email" name="email" class="form-control" placeholder="Email" required>
									</div>
									<div class="form-group">
										<label>Username :</label>
										<input type="text" name="username" class="form-control" placeholder="Username" required>
									</div>
									<div class="form-group">
										<label>Password :</label>
										<input type="password" name="password" class="form-control" placeholder="Password" required>
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
							<h4 class="modal-title">Edit Pengguna</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

							<div class="modal-body pb-0">
								<form method="post">
									<input type="hidden" name="id_user" id="id_user_edit">
									<input type="hidden" name="username_lama" id="username_lama">
									<div class="form-group">
										<label>Nama Pengguna :</label>
										<input type="text" name="nm_user" class="form-control" placeholder="Nama Pengguna" id="nm_user" required>
									</div>
									<div class="form-group">
										<label>Jenis Kelamin :</label>
										<select class="form-control" name="id_jk" id="id_jk" required>
											<option value="">- Pilih Agama -</option>
										</select>
									</div>
									<div class="form-group">
										<label>Agama :</label>
										<select class="form-control" name="id_agama" id="id_agama" required>
											<option value="">- Pilih Agama -</option>
										</select>
									</div>
									<div class="form-group">
										<label>Alamat :</label>
										<input type="text" name="alamat" class="form-control" placeholder="Alamat lengkap" id="alamat" required>
									</div>
									<div class="form-group">
										<label>Nomor Handphone :</label>
										<input type="text" name="hp" class="form-control" placeholder="Nomor Hanphone" id="hp" required>
									</div>
									<div class="form-group">
										<label>Email :</label>
										<input type="email" name="email" class="form-control" placeholder="Email" id="email" required>
									</div>
									<div class="form-group">
										<label>Username :</label>
										<input type="text" name="username" class="form-control" placeholder="Username" id="username" required>
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
							<h4 class="modal-title">Edit Password Pengguna : <b class="text-warning" id="nm_userxxx"></b></h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

							<div class="modal-body pb-0">
								<form method="post">
									<input type="hidden" name="id_user" id="id_user_editpass">
									
									<div class="form-group">
										<label>Password baru :</label>
										<input type="text" name="newpass" class="form-control" placeholder="Password Baru" required>
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
			$(document).ready(function() {

				$('.btedit').on('click', function() {
					const id 	= $(this).data('id');
					$('#id_user_edit').val(id);
					$.ajax({
						method: 'post',
						//~ url: "<?= site_url('m/jkbyid') ?>",
						url: "<?= site_url('m/userbyid') ?>",
						data: {
							id: id
						},
						method: 'post',
						dataType: 'json',
						success: function(data) {
							//console.log(data);

							$('#nm_user').val(data[0].nm_user);
							$('#alamat').val(data[0].alamat);
							$('#hp').val(data[0].hp);
							$('#email').val(data[0].email);
							$('#username').val(data[0].username);
							$('#username_lama').val(data[0].username);
							
							let id_jk2 		= data[0].id_jk;
							let id_agama2 	= data[0].id_agama;
							
							//EDIT JK
							$.ajax({
								type: 'get',
								url: "<?php echo site_url('m/ajax/master-jk'); ?>",
								async: false,
								dataType: 'json',
								success: function(data) {
									var html = '<option value="">- Pilih Jenis Kelamin -</option>';
									let xselected;
									let i;
									for (let i = 0; i < data.length; i++) {
										if (id_jk2 == data[i].id_jk) {
											xselected = 'selected';
										} else {
											xselected = '';
										}
										html += '<option value="' + data[i].id_jk + '" ' + xselected + '>' + data[i].nm_jk + '</option>';

									}
									$('#id_jk').html(html);
									//console.log("data : " + data);
								}

							});
							
							//EDIT AGAMA
							$.ajax({
								type: 'get',
								url: "<?php echo site_url('m/ajax/master-agama'); ?>",
								async: false,
								dataType: 'json',
								success: function(data) {
									var html = '<option value="">- Pilih Agama -</option>';
									let xselected;
									let i;
									for (let i = 0; i < data.length; i++) {
										if (id_agama2 == data[i].id_agama) {
											xselected = 'selected';
										} else {
											xselected = '';
										}
										html += '<option value="' + data[i].id_agama + '" ' + xselected + '>' + data[i].nm_agama + '</option>';

									}
									$('#id_agama').html(html);
									//console.log("data : " + data);
								}

							});

						}
					});
				});
            
            
            
				
				$('.bthapus').on('click', function() {
					const id 	= $(this).data('id');
					const nama 	= $(this).data('nama');
					$('#id_userxx').val(id);
					//$('#nm_userxx').val(nama);
					document.getElementById("nm_userxx").innerHTML = nama;
					//console.log("data : " + nama);
				});
				
				$('.bteditpass').on('click', function() {
					const id 	= $(this).data('id');
					const nama 	= $(this).data('nama');
					$('#id_user_editpass').val(id);
					//$('#nm_userxx').val(nama);
					document.getElementById("nm_userxxx").innerHTML = nama;
					//console.log("data : " + nama);
				});

			})
		</script>




	</body>

	</html>

<?php
}else{
	$this->load->view('errors/403');
}
?>

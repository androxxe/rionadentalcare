<?php
defined('BASEPATH') or exit('No direct script access allowed');
$ses_user        = $this->session->userdata('username');
$ses_level       = $this->session->userdata('level');

//FIREX ENKRIPTOR
$firex 			= new FirexGanteng;


if ($ses_level == "admin") {
	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Data Pengguna Administrator</title>
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
				$nama				= $this->input->post('nama');
				$username			= $this->input->post('username');
				$email				= $this->input->post('email');
				$password			= password_hash($this->input->post('password'), PASSWORD_DEFAULT);
				
				$scekadakah			= $this->db->query("SELECT username FROM admin WHERE username = '$username'");
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
					$wadafak 	= $this->db->query("INSERT INTO admin (nama, username, email, password) VALUE ('$nama','$username','$email','$password')");

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
				$id_admin			= $this->input->post('id_admin');
				$nama				= $this->input->post('nama');
				$username			= $this->input->post('username');
				$email				= $this->input->post('email');
				
				$scekadakah			= $this->db->query("SELECT username FROM admin WHERE username = '$username' AND id_admin <> '$id_admin'");
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
					$wadafak 	= $this->db->query("UPDATE admin SET nama = '$nama', username = '$username', email = '$email' WHERE id_admin = '$id_admin'");

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
				$id_admin		= $this->input->post('id_admin');
				$newpass		= password_hash($this->input->post('newpass'), PASSWORD_DEFAULT);
				$wadafak 		= $this->db->query("UPDATE admin SET `password` = '" . $newpass . "' WHERE id_admin = '" . $id_admin . "'");

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
				$id_admin		= $this->input->post('id_admin');
				$wadafak	= $this->db->delete('admin', array('id_admin' => $id_admin));
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
			<?php $this->load->view('inc/sidebar/admin');?>
			<!-- /main sidebar -->


			<!-- Main content -->
			<div class="content-wrapper">
				
				
				<div class="breadcrumb-line breadcrumb-line-dark header-elements-md-inline bg-brown">
					<div class="d-flex">
						<div class="breadcrumb">
							<a href="<?php echo base_url("m");?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Dashboard</a>
							<span class="breadcrumb-item active">Data User Administrator</span>
						</div>
					</div>
				</div>
				

				<!-- Content area -->
				<div class="content">

					<!-- Basic datatable -->

					

							<div class="card">
								<div class="card-header bg-dark text-white header-elements-inline pt-1 pb-1">
									<h5 class="card-title">Master Pengguna : <b class="text-warning">Administrator</b></h5>
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
												<th class="bg-dark">Nama</th>
												<th class="bg-dark">Email</th>
												<th class="bg-dark">Username</th>
												<th style="width:100px" class="text-center bg-dark">Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$sdata = $this->db->query("SELECT * FROM `admin`");
												$nodata	= 1;
												$hdata	= $sdata->num_rows();
												foreach ($sdata->result_array() as $ddata) {
													echo "
											<tr>
												<td class='text-center'>" . $nodata . "</td>
												<td>" . $ddata['nama'] . "</td>
												<td>" . $ddata['email'] . "</td>
												<td>" . $ddata['username'] . "</td>
												<td class='text-center'>
													<button type='button' class='btn btn-info btn-sm' data-toggle='dropdown'><i class='icon-grid'></i></button>

													<div class='dropdown-menu dropdown-menu-right'>
														<a href='#' data-toggle='modal' data-target='#modalEdit' data-id='".$ddata['id_admin']."' class='dropdown-item btedit'><i class='icon-pencil'></i> Edit Data</a>
														<a href='#' data-toggle='modal' data-target='#modalHapus' data-id='".$ddata['id_admin']."' data-nama='".$ddata['nama']."' class='dropdown-item bthapus'><i class='icon-trash'></i> Hapus Data</a>
														<a href='#' data-toggle='modal' data-target='#modalEditPass' data-id='".$ddata['id_admin']."' data-nama='".$ddata['nama']."' class='dropdown-item bteditpass'><i class='icon-lock'></i> Edit Password</a>
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
								<input type="hidden" name="id_admin" id="id_adminxx">
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
							<h4 class="modal-title">Tambah Pengguna</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

							<div class="modal-body pb-0">
								<form method="post" class="formulir_tambah">
									<div class="form-group">
										<label>Nama Pengguna :</label>
										<input type="text" name="nama" class="form-control" placeholder="Nama Pengguna" required>
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
										<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
									</div>
									<div class="form-group">
										<label>Ulangi Password :</label>
										<input type="password" name="repeat_password" class="form-control" placeholder="Ulangi Password" required>
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
								<form method="post" class="formulir_edit">
									<input type="hidden" name="id_admin" id="id_admin_edit">
									<input type="hidden" name="username_lama" id="username_lama">
									<div class="form-group">
										<label>Nama Pengguna :</label>
										<input type="text" name="nama" class="form-control" placeholder="Nama Pengguna" id="nama" required>
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
							<h4 class="modal-title">Edit Password Pengguna : <b class="text-warning" id="namaxxx"></b></h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

							<div class="modal-body pb-0">
								<form method="post" class="formulir_editpass">
									<input type="hidden" name="id_admin" id="id_admin_editpass">
									
									<div class="form-group">
										<label>Password baru :</label>
										<input type="password" name="newpass" class="form-control" id="password2" placeholder="Password Baru" required>
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
			$(document).ready(function() {

				$(document).on('click', '.btedit', function() {
					const id 	= $(this).data('id');
					$('#id_admin_edit').val(id);
					$.ajax({
						method: 'post',
						url: "<?= site_url('m/user_adminbyid') ?>",
						data: {
							id: id
						},
						method: 'post',
						dataType: 'json',
						success: function(data) {
							//console.log(data);

							$('#nama').val(data[0].nama);
							$('#email').val(data[0].email);
							$('#username').val(data[0].username);
							$('#username_lama').val(data[0].username);			

						}
					});
				});
            
            
            
				$(document).on('click', '.bthapus', function() {
					const id 	= $(this).data('id');
					const nama 	= $(this).data('nama');
					$('#id_adminxx').val(id);
					document.getElementById("namaxx").innerHTML = nama;
					//console.log("data : " + nama);
				});
				
				$(document).on('click', '.bteditpass', function() {
					const id 	= $(this).data('id');
					const nama 	= $(this).data('nama');
					$('#id_admin_editpass').val(id);
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
                email: {
                    email: true
                },
                newpass: {
                    minlength: 5
                },
                repeat_password2: {
                    equalTo: '#password2'
                },
            },
            messages: {
                nama: {
                    required: 'Nama tidak boleh kosong'
                },email: {
					email: 'Mohon isi email dengan benar',
                    required: 'Email tidak boleh kosong'
                },username: {
                    required: 'Username tidak boleh kosong'
                }, password: {
					minlength: 'Password minimal 5 karakter',
					required: 'Password tidak boleh kosong'
				}, repeat_password: {
					equalTo: 'Password tidak sama',
					required: 'Ulangi password tidak boleh kosong'
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
                email: {
                    email: true
                }
            },
            messages: {
                nama: {
                    required: 'Nama tidak boleh kosong'
                },email: {
					email: 'Mohon isi email dengan benar',
                    required: 'Email tidak boleh kosong'
                },username: {
                    required: 'Username tidak boleh kosong'
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

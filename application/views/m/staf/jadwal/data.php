<?php
defined('BASEPATH') or exit('No direct script access allowed');
$ses_user        = $this->session->userdata('username');
$ses_level       = $this->session->userdata('level');

if ($ses_level == "staf" || $ses_level == "perawat" || $ses_level == "dokter" || $ses_level == "admin") {

	$post = $this->input->post();

	if(isset($post['hapusin'])){
		$hapus = $this->db->delete("jadwal_dokter", array("id_dokter" => $post['id_dokter']));
		if($hapus){
			$this->session->set_flashdata("pesen","<script>sukses('hapus');</script>");
		}else{
			$this->session->set_flashdata("pesen","<script>sukses('hapus');</script>");
		}
		redirect(base_url("m/jadwaldok"));
	}


	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Jadwal Dokter</title>
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
		?>
		<!-- /main navbar -->


		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<?php 
				if($ses_level == "admin"){
					$this->load->view('inc/sidebar/admin');
				}else{
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
							<span class="breadcrumb-item active">Jadwal Dokter</span>
						</div>
					</div>
				</div>

				<!-- Content area -->
				<div class="content">

					<!-- Basic datatable -->

		
					<?php
                            echo $this->session->flashdata('pesen');
                            unset($_SESSION['pesen']);
                        ?>

							<div class="card">
								
								<div class="card-header bg-dark text-white header-elements-inline pt-1 pb-1">
									<h5 class="card-title">Jadwal Dokter</h5>
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







									<table class="table datatable-reorder-realtime table-bordered table-hover table-stripted">
										<thead>
											<tr>
												<th width="5%" class="bg-dark">No.</th>
												<th class="bg-dark">Nama Dokter</th>
												<th class="bg-dark">Jadwal</th>
												<?php if($ses_level == "staf" || $ses_level == "admin"){ ?>
												<th style="width:100px" class="text-center bg-dark">Aksi</th>
												<?php } ?>
											</tr>
										</thead>
										<tbody>
											<?php
												if($ses_level == "dokter"){
													$sdata = $this->db->query("SELECT * FROM dokter WHERE username = '$ses_user' ORDER BY nama");
												}else{
													$sdata = $this->db->query("SELECT * FROM dokter WHERE status = '1' ORDER BY nama");
												}
												
												$nodata	= 1;
												$hdata	= $sdata->num_rows();
												foreach ($sdata->result_array() as $ddata) {
													echo "
														<tr>
															<td class='text-center'>" . $nodata . "</td>
															<td>" . $ddata['nama'] . "</td>
															<td>";
																$sjadwal = $this->db->query("SELECT a.*, b.`nm_hari`, b.`nm_singkat`, LEFT(a.`jam_mulai`, 5) AS jam_mulaix, LEFT(a.`jam_selesai`, 5) AS jam_selesaix FROM jadwal_dokter a, hari b WHERE a.`id_hari` = b.`id_hari` AND a.id_dokter = '".$ddata['id_dokter']."' ORDER BY b.`id_hari`");
																$hjadwal	= $sjadwal->num_rows();
																if($hjadwal == 0){
																	echo"<span class='badge badge-danger'>Jadwal Belum Diatur</span>";
																	$tomhapus = "";
																}else{
																	$tomhapus = "<a href='#' class='btn bg-danger bthapus' data-toggle='modal' data-target='#modalHapus' data-id='".$ddata['id_dokter']."' data-nama='".$ddata['nama']."'><i class='icon-trash'></i></a>";
																	echo"
																		<table class='table table-hover table-stripted'>
																			<tbody>
																	";
																	foreach ($sjadwal->result_array() as $djadwal) {
																		echo"
																			<tr>
																				<td>".$djadwal['nm_hari']."</td>
																				<td class='font-weight-bold'>".$djadwal['jam_mulaix']." - ".$djadwal['jam_selesaix']."</td>
																			</tr>
																		";
																	}
																	echo"
																			</tbody>
																		</table>
																	";
																}
															
															if($ses_level == "staf" || $ses_level == "admin"){
															echo"</td>
															<td class='text-center'>
																<div class='btn-group'>
																	<a href='".base_url("m/jadwaldok/edit/".$ddata['id_dokter'])."' class='btn bg-dark'>Atur Jadwal</a>
																	".$tomhapus."
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
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
							<form method="post">
								<input type="hidden" name="id_dokter" id="id_dokter_hapus">
								<div class="modal-header bg-danger">
									<h5 class="modal-title">Konfirmasi Hapus Data</h5>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<div class="modal-body">
									
									<div class="alert alert-danger">Anda yakin akan menghapus data <b id="nama_hapus"></b>? Data yang sudah dihapus tidak bisa dikembalikan lagi.</div>	
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
									<button type="submit" name="hapusin" class="btn bg-danger">Ya! Hapus permanen data</button>
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

		




		<script type="text/javascript">
			$(document).ready(function() {

				
				$(document).on('click', '.bthapus', function() {
					const id 	= $(this).data('id');
					const nama 	= $(this).data('nama');
					$('#id_dokter_hapus').val(id);
					document.getElementById("nama_hapus").innerHTML = nama;
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

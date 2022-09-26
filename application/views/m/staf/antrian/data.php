<?php
defined('BASEPATH') or exit('No direct script access allowed');
$ses_user        = $this->session->userdata('username');
$ses_level       = $this->session->userdata('level');

if ($ses_level == "staf" || $ses_level == "perawat" || $ses_level == "dokter" || $ses_level == "admin") {

	$tglx		= trim(@$_GET['tgl']);
	if(empty($tglx)){
		$tanggal = tanggal("tgl");
	}else{
		$tanggal = $tglx;
	}
	$dokter		= trim(@$_GET['dokter']);

	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Data Antrian</title>
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


			if (isset($_POST['prosesantrian'])) {
				$id_antrian			= $this->input->post('id_antrian');
				$eksekusi 			= $this->db->query("UPDATE antrian SET `status` = '1', jam_layan = '".tanggal("jam")."' WHERE id_antrian = '$id_antrian'");

				if ($eksekusi) {
					$this->session->set_flashdata('pesen', '<script>sukses("tambah");</script>');
					redirect(base_url("m/antrian"));
				} else {
					$this->session->set_flashdata('pesen', '<script>gagal("tambah");</script>');
					redirect(base_url("m/antrian?tgl=".$tanggal."&dokter=".$dokter));
				}
			} else if (isset($_POST['hapusin'])) {
				$id_antrian			= $this->input->post('id_antrian');
				$eksekusi	= $this->db->delete('antrian', array('id_antrian' => $id_antrian));
				if ($eksekusi) {
					$this->session->set_flashdata('pesen', '<script>sukses("hapus");</script>');
				} else {
					$this->session->set_flashdata('pesen', '<script>sukses("hapus");</script>');
				}
				redirect(base_url("m/antrian"));
			} else if (isset($_POST['editin'])) {
				$id_antrian			= $this->input->post('id_antrian');
				$post_data = array(
					"id_dokter" => $this->input->post('id_dokter')
				);
				$eksekusi	= $this->db->update('antrian', $post_data, array('id_antrian' => $id_antrian));
				if ($eksekusi) {
					$this->session->set_flashdata('pesen', '<script>sukses("edit");</script>');
				} else {
					$this->session->set_flashdata('pesen', '<script>sukses("edit");</script>');
				}
				redirect(base_url("m/antrian"));
			}


			echo $this->session->flashdata("pesen");
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
							<span class="breadcrumb-item active">Data Antrian</span>
						</div>
					</div>
				</div>

				<!-- Content area -->
				<div class="content">

					<!-- Basic datatable -->

		
					

							<div class="card">
								
								<div class="card-header bg-dark text-white header-elements-inline">
									<h5 class="card-title">Data Antrian</h5>
									<div class="header-elements">
										<div class="list-icons">
											<?php if($ses_level == "staf" || $ses_level == "admin"){?>
											<a href="<?php echo base_url("m/antrian/tambah");?>" class="list-icons-item font-weight-bold text-warning"><b><i class="icon-plus2"></i></b> Tambah Data</a>
											<?php } ?>
											
<!--
											<a class="list-icons-item" data-action="collapse"></a>
-->

										</div>
									</div>
								</div>
								
								<div class="card-body pb-0">



									<form class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="font-weight-bold text-uppercase text-teal">Filter Tanggal:</label>
												<div class="form-group form-group-feedback form-group-feedback-left">
													<input type="text" class="form-control tanggal_filter" onchange="this.form.submit()" placeholder="Tanggal Booking" name="tgl" value="<?= $tanggal ?>" required>
													<div class="form-control-feedback form-control-feedback-sm">
														<i class="icon-calendar"></i>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<?php if($ses_level != "dokter"){ ?>
											<div class="form-group">
												<label class="font-weight-bold text-uppercase text-teal">Filter Dokter:</label>
												<select class="select" name="dokter" data-placeholder="Pilih Dokter" onchange="this.form.submit()" required>
													<option value="all">Semua Dokter</option>
													<?php
														$sdoki = $this->db->get_where("dokter", array("status" => 1));
														foreach($sdoki->result_array() as $ddoki){
															if($ddoki['id_dokter'] == $dokter){
																echo"<option value='".$ddoki['id_dokter']."' selected>".$ddoki['nama']."</option>";
															}else{
																echo"<option value='".$ddoki['id_dokter']."'>".$ddoki['nama']."</option>";
															}
															
														}
													?>
												</select>
											</div>
											<?php } ?>
										</div>
									</form>
								</div>


									<table class="table datatable-reorder-realtime table-bordered table-hover table-stripted">
										<thead>
											<tr>
												<th width="5%" class="bg-dark">No.</th>
												<th class="bg-dark text-center">Tgl. Antrian</th>
												<th class="bg-dark">Nama Pasien</th>
												<th class="bg-dark text-center">Jam Daftar</th>
												<th class="bg-dark text-center">Jam Layan</th>
												<th class="bg-dark text-center">No. Antrian</th>
												<th class="bg-dark">Dokter</th>
												<?php if($ses_level == "staf" || $ses_level == "admin"){?>
												<th style="width:100px" class="text-center bg-dark">Aksi</th>
												<?php } ?>
											</tr>
										</thead>
										<tbody>
											<?php
												if($ses_level == "dokter"){
													$sdata = $this->db->query("SELECT a.*, b.`nama` AS nama_pasien, c.`nama` AS nama_dokter FROM antrian a, pasien b, dokter c WHERE a.`id_pasien` = b.`id_pasien` AND a.`id_dokter` = c.`id_dokter` AND c.username = '$ses_user' ORDER BY a.tanggal DESC, a.`status` ASC, a.`id_antrian` DESC");
												}else{
													$query = "SELECT a.*, b.`nama` AS nama_pasien, c.`nama` AS nama_dokter FROM antrian a, pasien b, dokter c WHERE a.`id_pasien` = b.`id_pasien` AND a.`id_dokter` = c.`id_dokter` AND a.tanggal = '".$tanggal."'";
													if(!empty($dokter) && $dokter != "all"){
														$query .= " AND a.id_dokter = '".$dokter."'";
													}
													$query .= " ORDER BY a.tanggal DESC, a.`status` ASC, a.`id_antrian` DESC";
													$sdata = $this->db->query($query);
												}
												
												$nodata	= 1;
												$hdata	= $sdata->num_rows();
												foreach ($sdata->result_array() as $ddata) {

													// $txtantrian	= "Nomor antrian ".$ddata['no_antrian'];
													// $txtantrian	= rawurlencode(htmlspecialchars($txtantrian));
													// $html		= file_get_contents('https://translate.google.com/translate_tts?ie=UTF-8&client=gtx&q='.$txtantrian.'&tl=id-IN');
													// $player		= "<audio class='cinta' controls='controls' id='".$nodata."' autoplay><source src='data:audio/mpeg;base64,".base64_encode($html)."'></audio>";
													// echo $player;
													// echo"<script>$('#".$nodata."').hide();</script>";

													if($ddata['status'] == 0){
														$tombolsuare	= "<a>" . $ddata['no_antrian'] . "</a>";
														// $tombolsuare	= "<a style='cursor:pointer;' onclick='playaudio(".$nodata.")'>" . $ddata['no_antrian'] . "</a>";
														$tombole	= "
															<div class='btn-group'>
																<a href='".base_url("cetak/pdf/antrian/".$ddata['id_antrian'])."' target='_blank' class='btn bg-dark'><i class='icon-printer'></i></a>
																<a href='#' data-toggle='modal' data-target='#modalHapus' data-id='".$ddata['id_antrian']."' data-nama='".$ddata['nama_pasien']."' class='btn bg-danger bthapus'><i class='icon-trash'></i></a>
																<a href='#' data-toggle='modal' data-target='#modalEdit' data-id='".$ddata['id_antrian']."' data-nama='".$ddata['nama_pasien']."' class='btn bg-primary btedit'><i class='icon-pencil7'></i></a>
																<a href='#' data-toggle='modal' data-target='#modalProsesAntrian' data-id='".$ddata['id_antrian']."' data-nama='".$ddata['nama_pasien']."' class='btn bg-teal btproses'>Proses</a>
															</div>
														";
													}else if($ddata['status'] == 1){
														$tombolsuare	= "<a>" . $ddata['no_antrian'] . "</a>";
														$tombole	= "
															<div class='btn-group'>
																<button class='btn bg-dark' disabled><i class='icon-printer'></i></button>
																<button class='btn bg-danger' disabled><i class='icon-trash'></i></button>
																<button class='btn bg-primary' disabled><i class='icon-pencil7'></i></button>
																<button class='btn bg-teal' disabled>Proses</button>
															</div>
														";
													}
													echo "
											<tr>
												<td class='text-center'>" . $nodata . "</td>
												<td class='text-center'>" . tgl_indo2($ddata['tanggal']) . "</td>
												<td>" . $ddata['nama_pasien'] . "</td>
												<td class='text-center'>" . $ddata['jam_daftar'] . "</td>
												<td class='text-center'>" . $ddata['jam_layan'] . "</td>
												<td class='text-center font-weight-bold text-warning' style='font-size:16pt;'>".$tombolsuare."</td>
												<td>" . $ddata['nama_dokter'] . "</td>
												";
												if($ses_level == "staf" || $ses_level == "admin"){
												echo"<td class='text-center'>".$tombole."</td>";
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
				<!-- /content area -->

				<div id="modalHapus" class="modal fade" tabindex="-1">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
							<form method="post">
								<input type="hidden" name="id_antrian" id="id_antrianxx">
								<div class="modal-header bg-danger">
									<h5 class="modal-title">Konfirmasi Hapus Data</h5>
									<button type="button" class="close" data-dismiss="modal">&times;</button>
								</div>

								<div class="modal-body">
									
									<div class="alert alert-danger">Anda yakin akan menghapus data <b id="nama_pasienxx"></b>? Data yang sudah dihapus tidak bisa dikembalikan lagi.</div>	
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
									<button type="submit" name="hapusin" class="btn bg-danger">Ya! Hapus permanen data</button>
								</div>
                            </form>
                        </div>
                    </div>
                </div>
				
				
				<div id="modalEdit" class="modal fade">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header bg-teal-600">
							<h4 class="modal-title">Edit Data</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

							<div class="modal-body pb-0">
								<form method="post">
									<input type="hidden" name="id_antrian" id="id_antrian_editong">
									
									<div class="form-group">
										<label>Edit Dokter:</label>
										<select class="select" name="id_dokter" data-placeholder="[ Pilih ]" required>
											<option></option>
											<?php
														$sdoki = $this->db->get_where("dokter", array("status" => 1));
														foreach($sdoki->result_array() as $ddoki){
															echo"<option value='".$ddoki['id_dokter']."'>".$ddoki['nama']."</option>";
														}
													?>
										</select>
									</div>
									
									<div class="form-group">
										<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
										<button type="submit" name="editin" class="btn bg-teal-800">Edit Antrian</button>
									</div>
									
								</form>
							</div>
						</div>
					</div>
				</div>


				<div id="modalProsesAntrian" class="modal fade">
					<div class="modal-dialog modal-sm">
						<div class="modal-content">
							<div class="modal-header bg-teal-600">
							<h4 class="modal-title">Proses Antrian : <b class="text-warning" id="nama_pasienxxx"></b></h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

							<div class="modal-body pb-0">
								<form method="post">
									<input type="hidden" name="id_antrian" id="id_antrian_proses">
									
									<div class="alert alert-success">
										Anda yakin akan memproses data antrian <b id="nama_pasienxxx2"></b>? data yang sudah diproses tidak bisa diedit kembali.
									</div>
									
									<div class="form-group">
										<button type="button" class="btn btn-link" data-dismiss="modal">Batal</button>
										<button type="submit" name="prosesantrian" class="btn bg-teal-800">Proses Antrian</button>
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
			function playaudio(songid){
				document.getElementById(songid).load();
				document.getElementById(songid).play();
		}

			$(document).ready(function() {
				
				$('.tanggal_filter').pickadate({
					monthsFull: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
					weekdaysShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
					today: 'Hari ini',
					clear: 'Reset',
					formatSubmit: 'yyyy-mm-dd',
					format: 'yyyy-mm-dd'
				});


				$(document).on('click', '.bthapus', function() {
					const id 	= $(this).data('id');
					const nama 	= $(this).data('nama');
					$('#id_antrianxx').val(id);
					//$('#nm_userxx').val(nama);
					document.getElementById("nama_pasienxx").innerHTML = nama;
					//console.log("data : " + nama);
				});

				$(document).on('click', '.btedit', function() {
					const id 	= $(this).data('id');
					const nama 	= $(this).data('nama');
					$('#id_antrian_editong').val(id);
					//$('#nm_userxx').val(nama);
					// document.getElementById("nama_pasienxx").innerHTML = nama;
					//console.log("data : " + nama);
				});
				
				$(document).on('click', '.btproses', function() {
					const id 	= $(this).data('id');
					const nama 	= $(this).data('nama');
					$('#id_antrian_proses').val(id);
					//$('#nm_userxx').val(nama);
					document.getElementById("nama_pasienxxx").innerHTML = nama;
					document.getElementById("nama_pasienxxx2").innerHTML = nama;
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

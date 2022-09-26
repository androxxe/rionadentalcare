<?php
defined('BASEPATH') or exit('No direct script access allowed');
$ses_user        = $this->session->userdata('username');
$ses_level       = $this->session->userdata('level');

if ($ses_level == "staf" || $ses_level == "perawat" || $ses_level == "dokter" || $ses_level == "admin") {
	$sdata 		= $this->db->query("SELECT MAX(no_rekam_medis) AS next_rekmed, MAX(id_pasien) AS next_pasien FROM pasien");
	$ddata		= $sdata->result_array();
	$autopasien	=  $ddata[0]['next_rekmed']+1;
	$autoidpasien	=  $ddata[0]['next_pasien']+1;
	
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
		<title>Data Booking</title>
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

			$post = $this->input->post();
			if (isset($post['tambahantrian'])) {
				$id_booking			= $this->input->post('id_booking');
				$id_pasien			= $this->input->post('id_pasien');
				$id_dokter			= $this->input->post('id_dokter');
				$status				= $this->input->post('status');
				$ket_tolak			= $this->input->post('ket_tolak');
				$ket_tolak			= $this->input->post('ket_tolak');

				if($status != 2 && $status != 3){
					$eksekusi 			= $this->db->query("INSERT INTO antrian (tanggal, id_pasien, `status`, jam_daftar, id_dokter, no_antrian) VALUE ('".tanggal("tgl")."','$id_pasien','0','".tanggal("jam")."','$id_dokter','".autoantrian()."')");
					$this->db->query("UPDATE booking SET nama_pasien = '".$post['nama']."', no_telp = '".$post['no_telp']."', `status` = '".$status."', ket_tolak = '".$ket_tolak."', id_dokter = '".$id_dokter."' WHERE id_booking = '$id_booking'");

					if($post['jenis'] == "umum"){
						$post_new = array(
							"id_pasien" => $post['id_pasien'],
							"no_rekam_medis" => $post['no_rekam_medis'],
							"nama" => $post['nama'],
							"tanggal_lahir" => $post['tanggal_lahir'],
							"jenis_kelamin" => $post['jenis_kelamin'],
							"alamat" => $post['alamat'],
							"pekerjaan" => $post['pekerjaan'],
							"no_telp" => $post['no_telp'],
							"username" => $post['username'],
							"password" => password_hash($post['password'], PASSWORD_DEFAULT)
						);
						$this->db->insert("pasien", $post_new);
					}

					if ($eksekusi) {
						$this->session->set_flashdata('pesen', '<script>sukses("tambah");</script>');
						redirect(base_url("m/antrian"));
					} else {
						$this->session->set_flashdata('pesen', '<script>gagal("tambah");</script>');
						redirect(base_url("m/booking?tgl=".$tanggal."&dokter=".$dokter));
					}
				}else{
					$eksekusi = $this->db->query("UPDATE booking SET `status` = '".$status."', ket_tolak = '".$ket_tolak."' WHERE id_booking = '$id_booking'");

					if ($eksekusi) {
						$this->session->set_flashdata('pesen', '<script>sukses("tambah");</script>');
						redirect(base_url("m/booking?tgl=".$tanggal."&dokter=".$dokter));
					} else {
						$this->session->set_flashdata('pesen', '<script>gagal("tambah");</script>');
						redirect(base_url("m/booking?tgl=".$tanggal."&dokter=".$dokter));
					}
				}
				
			} else if (isset($_POST['hapusin'])) {
				$id_booking			= $this->input->post('id_booking');
				$eksekusi	= $this->db->delete('booking', array('id_booking' => $id_booking));
				if ($eksekusi) {
					$this->session->set_flashdata('pesen', '<script>sukses("hapus");</script>');
				} else {
					$this->session->set_flashdata('pesen', '<script>sukses("hapus");</script>');
				}
				redirect(base_url("m/booking?tgl=".$tanggal."&dokter=".$dokter));
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
							<span class="breadcrumb-item active">Data Booking</span>
						</div>
					</div>
				</div>

				<!-- Content area -->
				<div class="content">

					<!-- Basic datatable -->

		
					

							<div class="card">
								
								<div class="card-header bg-dark text-white header-elements-inline">
									<h5 class="card-title">Data Booking</h5>
									<div class="header-elements">
										<div class="list-icons">
											<?php if($ses_level == "staf" || $ses_level == "admin"){?>
											<a href="#" data-toggle="modal" data-target="#modalTambah" class="list-icons-item text-warning font-weight-bold"><b><i class="icon-plus2"></i></b> Tambah Data</a>
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
			<th class="bg-dark">Tgl. Booking</th>
			<th class="bg-dark">Nama Pasien</th>
			<th class="bg-dark">No. Telp</th>
			<th class="bg-dark">Dokter</th>
			<th class="bg-dark">Keterangan</th>
			<th class="bg-dark text-center">Status</th>
			<?php if($ses_level == "staf" || $ses_level == "admin"){?>
			<th style="width:100px" class="text-center bg-dark">Aksi</th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php
			if($ses_level == "dokter"){
				$sdata = $this->db->query("SELECT a.*, LEFT(a.jam_booking, 5) AS jam_bok, b.nama AS nama_dokter FROM booking a, dokter b WHERE a.`id_dokter` = b.`id_dokter` AND b.username = '$ses_user' AND a.tanggal_booking = '".$tanggal."' ORDER BY a.`tanggal_booking` DESC,  a.`status` ASC, a.`jam_booking` ASC, a.`id_booking` DESC");
			}else{
				
				$query	= "SELECT a.*, LEFT(a.jam_booking, 5) AS jam_bok FROM booking a WHERE a.tanggal_booking = '".$tanggal."'";
				// $query	= "SELECT a.*, LEFT(a.jam_booking, 5) AS jam_bok, b.nama AS nama_dokter FROM booking a, dokter b WHERE a.`id_dokter` = b.`id_dokter` AND a.tanggal_booking = '".$tanggal."'";
				if(!empty($dokter) && $dokter != "all"){
					$query .= " AND a.id_dokter = '".$dokter."'";
				}
				$query .= " ORDER BY a.`tanggal_booking` DESC, a.`status` ASC, a.`jam_booking` ASC, a.`id_booking` DESC";
				$sdata = $this->db->query($query);
			}
			
			$nodata	= 1;
			$hdata	= $sdata->num_rows();
			foreach ($sdata->result_array() as $ddata) {
				$sdoktor = $this->db->get_where("dokter", array("id_dokter" => $ddata['id_dokter']));
				$hdoktor = $sdoktor->num_rows();
				if($hdoktor > 0){
					$ddoktor = $sdoktor->result_array();
					$doktorno = $ddoktor[0]['nama'];
				}else{
					$doktorno = "";
				}
				if($ddata['status'] == 0){
					// if($ddata['jenis'] == "terdaftar"){
						if($ddata['jenis'] == "terdaftar"){
							$urledit = "";
						}else if($ddata['jenis'] == "umum"){
							$urledit = "-umum";
						}
						if($ddata['tanggal_booking'] == date("Y-m-d")){
							$tombolproses = "<a href='#' data-toggle='modal' data-target='#modalProsesAntrian' data-id='".$ddata['id_booking']."' data-nama='".$ddata['nama_pasien']."' data-pasien='".$ddata['id_pasien']."' data-dokter='".$ddata['id_dokter']."' data-telp='".$ddata['no_telp']."' data-jenis='".$ddata['jenis']."' class='btn bg-dark btproses'>Proses</a>";
						}else{
							$tombolproses = "<button class='btn bg-dark' disabled>Proses</button>";
						}
						

						$tombole	= "
							<div class='btn-group'>
								<a href='#' data-toggle='modal' data-target='#modalHapus' data-id='".$ddata['id_booking']."' data-nama='".$ddata['nama_pasien']."' class='btn bg-danger bthapus'><i class='icon-trash'></i></a>
								<a href='".base_url("m/booking/tambah".$urledit."/".$ddata['id_booking'])."' class='btn bg-primary'><i class='icon-pencil7'></i></a>
								".$tombolproses."
							</div>
						";
						$statusno = "<div class='badge badge-warning'>Booking</div>";
					// }else if($ddata['jenis'] == "umum"){
					// 	$tombole	= "
					// 		<div class='btn-group'>
					// 			<a href='#' data-toggle='modal' data-target='#modalHapus' data-id='".$ddata['id_booking']."' data-nama='".$ddata['nama_pasien']."' class='btn bg-danger bthapus'><i class='icon-trash'></i></a>
					// 			<a href='".base_url("m/booking/tambah-umum/".$ddata['id_booking'])."' class='btn bg-primary'><i class='icon-pencil7'></i></a>
					// 			<button class='btn bg-dark' disabled>Proses</button>
					// 		</div>
					// 	";
					// 	$statusno = "<div class='badge badge-success'>Diproses</div>";
					// }
					
				}else if($ddata['status'] == 1){
					$tombole	= "
						<div class='btn-group'>
						<a href='#' data-toggle='modal' data-target='#modalHapus' data-id='".$ddata['id_booking']."' data-nama='".$ddata['nama_pasien']."' class='btn bg-danger bthapus'><i class='icon-trash'></i></a>
						<a href='".base_url("m/booking/tambah".$urledit."/".$ddata['id_booking'])."' class='btn bg-primary'><i class='icon-pencil7'></i></a>
							<button class='btn bg-dark' disabled>Proses</button>
						</div>
					";
					$statusno = "<div class='badge badge-success'>Diproses</div>";
				}else if($ddata['status'] == 2){
					$tombole	= "
						<div class='btn-group'>
						<a href='#' data-toggle='modal' data-target='#modalHapus' data-id='".$ddata['id_booking']."' data-nama='".$ddata['nama_pasien']."' class='btn bg-danger bthapus'><i class='icon-trash'></i></a>
						<a href='".base_url("m/booking/tambah".$urledit."/".$ddata['id_booking'])."' class='btn bg-primary'><i class='icon-pencil7'></i></a>
							<button class='btn bg-dark btkettolak' data-toggle='modal' data-target='#modalKetTolak' data-ket='".$ddata['ket_tolak']."'><i class='icon-comment'></i></button>
							<button class='btn bg-dark' disabled>Proses</button>
						</div>
					";
					$statusno = "<div class='badge badge-danger'>Cancel</div>";
				}else if($ddata['status'] == 3){
					$tombole	= "
						<div class='btn-group'>
						<a href='#' data-toggle='modal' data-target='#modalHapus' data-id='".$ddata['id_booking']."' data-nama='".$ddata['nama_pasien']."' class='btn bg-danger bthapus'><i class='icon-trash'></i></a>
						<a href='".base_url("m/booking/tambah".$urledit."/".$ddata['id_booking'])."' class='btn bg-primary'><i class='icon-pencil7'></i></a>
							<button class='btn bg-dark btkettolak' data-toggle='modal' data-target='#modalKetTolak' data-ket='".$ddata['ket_tolak']."'><i class='icon-comment'></i></button>
							<button class='btn bg-dark' disabled>Proses</button>
						</div>
					";
					$statusno = "<div class='badge badge-danger'>Tidak Datang</div>";
				}
				echo "
		<tr>
			<td class='text-center'>" . $nodata . "</td>
			<td>" . tgl_indo2($ddata['tanggal_booking']) . " ".$ddata['jam_bok']." WIB</td>
			<td>" . $ddata['nama_pasien'] . "</td>
			<td>" . $ddata['no_telp'] . "</td>
			<td>" . $doktorno . "</td>
			<td>" . $ddata['keterangan'] . "</td>
			<td class='text-center'>" . $statusno . "</td>
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
				<input type="hidden" name="id_booking" id="id_bookingxx">
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
				
				
<div id="modalTambah" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-teal-600">
			<h4 class="modal-title">Pilih Jenis Pasien</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>

			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="btn-group btn-group-justified">
							<a href="<?php echo base_url("m/booking/tambah");?>" class="btn btn-primary btn-float legitRipple"><i class="icon-people icon-2x"></i> <span>Pasien Terdaftar</span></a>
						</div>
					</div>
					<div class="col-md-6">
						<div class="btn-group btn-group-justified">
							<a href="<?php echo base_url("m/booking/tambah-umum");?>" class="btn bg-slate-700 btn-float legitRipple"><i class="icon-people icon-2x"></i> <span>Pasien Umum</span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
				
<div id="modalProsesAntrian" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-teal-600">
			<h4 class="modal-title">Tambah ke Antrian : <b class="text-warning" id="nama_pasienxxx"></b></h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>

			<div class="modal-body pb-0">
				<form method="post">
					<input type="hidden" name="id_booking" id="id_booking_proses">
					<!-- <input type="hidden" name="id_dokter" id="id_dokter_proses"> -->
					<input type="hidden" name="id_pasien" id="id_pasien_proses">
					<input type="hidden" name="jenis" id="jenis_proses">
					<input type="hidden" name="doktersem" id="doktersem_proses">
					

					<div class="form-group">
						<label class="font-weight-bold text-uppercase text-teal">Status :</label>
						<select class="form-control" name="status" id="statusmboh" onchange="cekPilihHopo()" required>
							<option value="">[ Pilih Status ]</option>
							<option value="1">Proses ke Antrian</option>
							<option value="2">Cancel</option>
							<option value="3">Tidak Datang</option>
						</select>
					</div>
					

					<div class="form-group" id="kolom_terimaan">
						<label class="font-weight-bold text-uppercase text-teal">Dokter :</label>
						<select class="form-control" name="id_dokter" id="id_dokter_proses">
							<option value="">[ Pilih Dokter ]</option>
							<?php
								$sdokx = $this->db->get_where("dokter", array("status" => 1));
								foreach($sdokx->result_array() as $ddokx){
									if($dokter == $ddokx['id_dokter']){
										echo"<option value='".$ddokx['id_dokter']."' selected>".$ddokx['nama']."</option>";
									}else{
										echo"<option value='".$ddokx['id_dokter']."'>".$ddokx['nama']."</option>";
									}
									
								}
							?>
						</select>
					</div>




					<div id="form_daftar_baru">
						<h5 class="bg-dark pl-3 text-center">FORM PASIEN BARU</h5>
						<div class="form-group">
							<label class="font-weight-bold text-uppercase">No. Rekam Medis :</label>
							<div class="input-group">
								<input type="number" class="form-control" name="no_rekam_medis" id="no_rekam_medis_tambah" placeholder="No. Rekam Medis" onkeyup="cekNomorRekam()">
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
							<input type="text" name="nama" class="form-control" id="nama_tambah" placeholder="Nama Pasien">
						</div>
						<div class="form-group">
							<label>Tgl. Lahir :</label>
							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="text" class="form-control pickadate-wasem2" placeholder="Tanggal Lahir" name="tanggal_lahir" id="tanggal_lahir_tambah">
								<div class="form-control-feedback form-control-feedback-sm">
									<i class="icon-calendar"></i>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Jenis Kelamin :</label>
							<select class="form-control" name="jenis_kelamin" id="jenis_kelamin_tambah">
								<option value="">- Pilih Jns Kelamin -</option>
								<option value="1">Laki-laki</option>
								<option value="2">Perempuan</option>
							</select>
						</div>
						<div class="form-group">
							<label>Alamat :</label>
							<input type="text" name="alamat" class="form-control" placeholder="Alamat lengkap" id="alamat_tambah">
						</div>
						<div class="form-group">
							<label>No. Telp :</label>
							<input type="text" name="no_telp" id="no_telp_tambah" class="form-control" placeholder="Nomor Telphone">
						</div>
						<div class="form-group">
							<label>Pekerjaan :</label>
							<input type="text" name="pekerjaan" id="pekerjaan_tambah" class="form-control" placeholder="Pekerjaan">
						</div>
						<div class="form-group">
							<label>Username :</label>
							<input type="text" name="username" id="username_tambah" class="form-control" placeholder="Username">
						</div>
						<div class="form-group">
							<label>Password :</label>
							<input type="password" name="password" id="password_tambah" class="form-control" id="password" placeholder="Password">
						</div>
					</div>




					<div class="form-group" id="kolom_tolakan">
						<label class="font-weight-bold text-uppercase text-teal">Keterangan Penolakan :</label>
						<textarea class="form-control" placeholder="Keterangan penolakan" name="ket_tolak"></textarea>
					</div>

					<div class="alert alert-success">
						Anda yakin akan memproses data <b id="nama_pasienxxx2"></b>? data yang sudah diproses tidak bisa diproses ulang.
					</div>
					
					<div class="form-group">
						<button type="reset" class="btn btn-link" data-dismiss="modal">Batal</button>
						<button type="submit" name="tambahantrian" class="btn bg-teal-800"><i class="icon-check pr-2"></i>Proses Data</button>
					</div>
					
				</form>
			</div>
		</div>
	</div>
	</div>



	<div id="modalKetTolak" class="modal fade">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-header bg-dark">
				<h4 class="modal-title">Keterangan Penolakan</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

				<div class="modal-body">
					<div id="kettolakinoh"></div>
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
	function cekNomorRekam(){
		let no_rekam = $("#no_rekam_medis_tambah").val();
		$.ajax({
			url: "<?= base_url("api/cekrekam") ?>",
			method: "post",
			data: {no_rekam_medis : no_rekam},
			success: function(response){
				if(response == "ketemu"){
					$("#pesan_keypress").html("<span class='form-text text-danger'>No. Rekam Medis <b>"+no_rekam+"</b> sudah digunakan.</span>");
					// document.getElementById("no_rekam_medis_tambah").value = "";
					// document.getElementById("no_rekam_medis_tambah").focus(); 
				}else{
					$("#pesan_keypress").html("");
				}
			}
		});
	}

	function selectElement(id, valueToSelect) {    
		let element = document.getElementById(id);
		element.value = valueToSelect;
	}

	function Autonumber(){
		$('#no_rekam_medis_tambah').val("<?php echo $autopasien;?>");
		document.getElementById("no_rekam_medis_tambah").focus(); 
	}
	function resetauto(){
		$('#no_rekam_medis_tambah').val("");
		document.getElementById("no_rekam_medis_tambah").focus(); 
	}


	$(document).ready(function() {
		$("#kolom_terimaan").hide();
		$("#kolom_tolakan").hide();
		$("#form_daftar_baru").hide();

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
			$('#id_bookingxx').val(id);
			//$('#nm_userxx').val(nama);
			document.getElementById("nama_pasienxx").innerHTML = nama;
			//console.log("data : " + nama);
		});
		
		$(document).on('click', '.btproses', function() {
			$("#kolom_terimaan").hide();
			$("#kolom_tolakan").hide();
			$("#form_daftar_baru").hide();
			selectElement("statusmboh","");

			const id 	= $(this).data('id');
			const nama 	= $(this).data('nama');
			const id_dokter 	= $(this).data('dokter');
			const jenis 	= $(this).data('jenis');
			const no_telp 	= $(this).data('telp');
			let id_pasien = "";
			if(jenis == "terdaftar"){
				id_pasien 	= $(this).data('pasien');
			}else if(jenis == "umum"){
				id_pasien 	= "<?= $autoidpasien ?>";
			}
			// alert(jenis);
			$('#id_booking_proses').val(id);
			$('#doktersem_proses').val(id_dokter);
			$('#id_pasien_proses').val(id_pasien);
			$('#jenis_proses').val(jenis);
			$('#nama_tambah').val(nama);
			$('#no_telp_tambah').val(no_telp);

			//$('#nm_userxx').val(nama);
			document.getElementById("nama_pasienxxx").innerHTML = nama;
			document.getElementById("nama_pasienxxx2").innerHTML = nama;
			//console.log("data : " + nama);
		});

		$(document).on('click', '.btkettolak', function() {
			const ket 	= $(this).data('ket');
			$("#kettolakinoh").html(ket);
		});

	})

	function cekPilihHopo(){
		let statushopo = $("#statusmboh").val();
		if(statushopo == "2" || statushopo == "3"){
			$("#kolom_tolakan").show();
			$("#kolom_terimaan").hide();
			$("#id_dokter_proses").removeAttr('required');
			$("#form_daftar_baru").hide();

			$("#no_rekam_medis_tambah").removeAttr('required');
			$("#jenis_kelamin_tambah").removeAttr('required');
			$("#nama_tambah").removeAttr('required');
			$("#tanggal_lahir_tambah").removeAttr('required');
			$("#no_telp_tambah").removeAttr('required');
			$("#alamat_tambah").removeAttr('required');
			$("#pekerjaan_tambah").removeAttr('required');
			$("#username_tambah").removeAttr('required');
			$("#password_tambah").removeAttr('required');
		}else{
			$("#kolom_tolakan").hide();
			$("#kolom_terimaan").show();
			$("#id_dokter_proses").attr('required', '');

			let id_dokter = $('#doktersem_proses').val();
			// alert(id_dokter);
			let jenis = $("#jenis_proses").val();
			console.log(jenis);
			if(jenis == "terdaftar"){
				$("#form_daftar_baru").hide();
				$("#no_rekam_medis_tambah").removeAttr('required');
				$("#jenis_kelamin_tambah").removeAttr('required');
				$("#nama_tambah").removeAttr('required');
				$("#tanggal_lahir_tambah").removeAttr('required');
				$("#no_telp_tambah").removeAttr('required');
				$("#alamat_tambah").removeAttr('required');
				$("#pekerjaan_tambah").removeAttr('required');
				$("#username_tambah").removeAttr('required');
				$("#password_tambah").removeAttr('required');
			}else if(jenis == "umum"){
				$("#form_daftar_baru").show();
				$("#no_rekam_medis_tambah").attr('required', '');
				$("#jenis_kelamin_tambah").attr('required', '');
				$("#nama_tambah").attr('required', '');
				$("#tanggal_lahir_tambah").attr('required', '');
				$("#no_telp_tambah").attr('required', '');
				$("#alamat_tambah").attr('required', '');
				$("#pekerjaan_tambah").attr('required', '');
				//~ $("#username_tambah").attr('required', '');
				//~ $("#password_tambah").attr('required', '');
			}

			selectElement("id_dokter_proses",id_dokter);
			
		}
	}
</script>
</body>
</html>
<?php
}else{
	$this->load->view('errors/403');
}
?>

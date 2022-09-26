<?php
defined('BASEPATH') or exit('No direct script access allowed');
$ses_user        = $this->session->userdata('username');
$ses_level       = $this->session->userdata('level');



if ($ses_level == "staf" || $ses_level == "admin") {
	
	$id_booking	= $this->uri->segment(4);
	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Tambah Data Booking</title>
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
				$post 				= $this->input->post();
				$nama_pasien		= $this->input->post('nm_pasien');
				$no_telp			= $this->input->post('no_telp');
				$id_dokter			= $this->input->post('id_dokter');
				$keterangan			= $this->input->post('keterangan');
				$tanggal_booking	= $this->input->post('tanggal_booking');
				$jam_booking	= $this->input->post('jam_booking');
				// $jam_booking 		= convtime($post['jam_booking'],"to24");
				$jenis				= "umum";
				$token				= $this->input->post('token');
				$tanggal_push		= date('Y-m-d', strtotime('-1 days', strtotime($tanggal_booking)))." 07:30";
				//untuk uji coba
				//~ $tanggal_push		= "2020-10-10 07:30";
				//~ echo $tanggal_push;
				$eksekusi 	= $this->db->query("INSERT INTO booking (tanggal_booking, jam_booking, nama_pasien, no_telp, id_dokter, `status`, keterangan, jenis) VALUE ('".$tanggal_booking."','".$jam_booking."','$nama_pasien','$no_telp','$id_dokter','0','$keterangan', '$jenis')");

				if ($eksekusi) {
					pushPesan("New Booking Notification","Tersedia booking terbaru untuk tanggal ".tgl_indo2($tanggal_booking),$token, $tanggal_push);
					echo "
						<meta http-equiv='refresh' content='2;url=".base_url("m/booking")."'>
						<script>sukses('tambah');</script>
					";
				} else {
					echo "
						<script>gagal('tambah');</script>
					";
				}
				
			}else if (isset($_POST['editin'])) {
				$post 				= $this->input->post();
				$nama_pasien		= $this->input->post('nm_pasien');
				$no_telp			= $this->input->post('no_telp');
				$id_dokter			= $this->input->post('id_dokter');
				$keterangan			= $this->input->post('keterangan');
				$tanggal_booking	= $this->input->post('tanggal_booking');
				$jam_booking	= $this->input->post('jam_booking');
				// $jam_booking 		= convtime($post['jam_booking'],"to24");
				$jenis				= "umum";
				// $token				= $this->input->post('token');
				// $tanggal_push		= date('Y-m-d', strtotime('-1 days', strtotime($tanggal_booking)))." 07:30";
				//untuk uji coba
				//~ $tanggal_push		= "2020-10-10 07:30";
				//~ echo $tanggal_push;
				$post_data = array(
					"nama_pasien" => $nama_pasien,
					"no_telp" => $no_telp,
					"id_dokter" => $id_dokter,
					"keterangan" => $keterangan,
					"tanggal_booking" => $tanggal_booking,
					"jam_booking" => $jam_booking
				);
				$eksekusi 	= $this->db->update("booking", $post_data, array("id_booking" => $id_booking));
				// $eksekusi 	= $this->db->query("INSERT INTO booking (tanggal_booking, jam_booking, nama_pasien, no_telp, id_dokter, `status`, keterangan, jenis) VALUE ('".$tanggal_booking."','".$jam_booking."','$nama_pasien','$no_telp','$id_dokter','0','$keterangan', '$jenis')");

				if ($eksekusi) {
					// pushPesan("New Booking Notification","Tersedia booking terbaru untuk tanggal ".tgl_indo2($tanggal_booking),$token, $tanggal_push);
					echo "
						<meta http-equiv='refresh' content='2;url=".base_url("m/booking")."'>
						<script>sukses('edit');</script>
					";
				} else {
					echo "
						<script>gagal('edit');</script>
					";
				}
				
			}
			
			
			if(empty($id_booking)){
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
							<a href="<?php echo base_url("m/booking");?>" class="breadcrumb-item">Data Booking</a>
							<span class="breadcrumb-item active">Tambah Data Booking</span>
						</div>
					</div>
				</div>
				
				<!-- Content area -->
				<div class="content">

					<!-- Basic datatable -->

					

							<div class="card">
								<div class="card-header bg-dark text-white header-elements-inline">
									<h5 class="card-title">Tambah Data Booking</h5>
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

									<a href="<?php echo base_url("m/booking");?>" class="btn bg-dark"><i class="icon-arrow-left8 pr-2"></i> Kembali</a>

									<hr>
	
									<form method="post" class="row formulir_tambah">
										<div class="col-md-6">
												<div class="form-group" id="f_nm_pasien">
													<label>Nama Pasien :</label>
													<input type="text" class="form-control" name="nm_pasien" id="nm_pasien_tambah" placeholder="Nama Pasien" required>
												</div>
												<div class="form-group" id="f_telp">
													<label>No. Handphone :</label>
													<input type="text" class="form-control" name="no_telp" id="no_telp_tambah" placeholder="No. Handphone" required>
												</div>
												<div class="form-group" id="f_keterangan">
													<label>Keterangan :</label>
													<textarea class="form-control" name="keterangan" id="keterangan_tambah" placeholder="Keterangan" required></textarea>
												</div>
												
										</div>
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Tanggal :</label>
														<div class="form-group form-group-feedback form-group-feedback-left">
															<input type="text" class="form-control tanggal_booking" id="tanggal_booking" placeholder="Tanggal Booking" name="tanggal_booking" required>
															<div class="form-control-feedback form-control-feedback-sm">
																<i class="icon-calendar"></i>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Jam :</label>
														<div class="form-group form-group-feedback form-group-feedback-left">
															<select class="select" name="jam_booking" id="jam_booking" onchange="keluarinDokterNo()" data-placeholder="[ Pilih ]" required>
																<option></option>
																<?php
																	$sjambok = $this->db->query("SELECT *, LEFT(nm_jambok, 5) AS jambe FROM jambok ORDER BY nm_jambok ASC");
																	foreach($sjambok->result_array() as $djambok){
																		echo"<option value='".$djambok['nm_jambok']."'>".$djambok['jambe']."</option>";
																	}
																?>
															</select>
															<!-- <div class="form-control-feedback form-control-feedback-sm">
																<i class="icon-alarm"></i>
															</div> -->
														</div>
													</div>
												</div>
											</div>
											<div  id="kolom_dokter_kosong"></div>
											<div class="form-group" id="kolom_dokter">
												<label class="font-weight-bold text-uppercase">Pilih Dokter :</label>
												<select class="select" name="id_dokter" id="id_dokter" onchange="cekSudahAdaygBooking()" data-placeholder="Pilih Dokter" required>
													<option></option>
												</select>
											</div>
											<div  id="kolom_dokter_sudah_dibooking"></div>
											<input type="hidden" id="token" name="token">
										</div>
										<div class="col-md-12">
											<button type="submit" class="btn bg-dark pull-right mt-3" name="tambahin"><i class="icon-check pr-2"></i> Simpan Data</button>
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

function keluarinDokterNo(){
					if($("#jam_booking").val() != "" && $("#tanggal_booking").val() != ""){
							// alert($("#jam_booking").val());
							$.ajax({
								url: "<?= base_url("api/tampilin_dokter_berdasarkanjadwal") ?>",
								method: "POST",
								data:{tanggal_booking: $("#tanggal_booking").val(), jam_booking: $("#jam_booking").val()},
								success: function(response){
									console.log(response[0].status);
									if(response[0].status == "kosong"){
										$("#id_dokter").html("");
										$("#kolom_dokter_kosong").html("<div class='alert alert-warning'>Dokter tidak tersedia untuk tanggal <b>"+$("#tanggal_booking").val()+" "+$("#jam_booking").val()+"</b></div>");
										$("#id_dokter").append("<option value='0'>Booking tanpa Dokter</option>");
										$("#kolom_dokter_sudah_dibooking").html("");
									}else{
										$("#id_dokter").html("<option></option>");
										$("#kolom_dokter_kosong").html("");
										$("#kolom_dokter_sudah_dibooking").html("");
										for(var key in response){
											$("#id_dokter").append("<option value='"+response[key].id_dokter+"'>"+response[key].nama+"</option>");
										}
									}
								}
							});
							$("#kolom_dokter").show();
						}else{
							$("#kolom_dokter").hide();
						}
				}


			$(document).ready(function() {
				$("#kolom_dokter").hide();
				$('.tanggal_booking').pickadate({
					monthsFull: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
					weekdaysShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
					today: 'Hari ini',
					clear: 'Reset',
					formatSubmit: 'yyyy-mm-dd',
					format: 'yyyy-mm-dd',
					min:true,
					// disable: [
					// 	{from: [0, 0, 0], to: true}
					// ],
					onSet: function(context) {
						keluarinDokterNo();
					}
				});


				$('.jam_booking').pickatime({
					disable: [
						[0,0],
						[0,30],
						[1,0],
						[1,30],
						[2,0],
						[2,30],
						[3,0],
						[3,30],
						[4,0],
						[4,30],
						[5,0],
						[5,30],
						[6,0],
						[6,30],
						[7,0],
						[7,30],
						[8,00],
						[8,30],
						[22,0],
						[22,30],
						[23,0],
						[23,30],
					],
					onSet: function(context) {
						keluarinDokterNo();
					}
				});


				

			});
			
			
			
			function cekSudahAdaygBooking(){
					let tanggal_booking = $("#tanggal_booking").val();
					let jam_booking = $("#jam_booking").val();
					let id_dokter = $("#id_dokter").val();
					// alert(jam_booking);
					$.ajax({
						url: "<?= base_url("api/ceksudahbookingdokter") ?>",
						method: "POST",
						data: {tanggal_booking: tanggal_booking, jam_booking: jam_booking, id_dokter: id_dokter},
						success: function(response){
							console.log(response[0].token);
							$("#token").val(response[0].token);
							if(response[0].status == "kosong"){
								$("#kolom_dokter_sudah_dibooking").html("");
							}else{
								$("#kolom_dokter_sudah_dibooking").html("<div class='alert alert-warning'><b>"+response[0].nm_dokter+"</b> untuk tanggal <b>"+tanggal_booking+" "+jam_booking+"</b> sudah ada yang booking. Anda yakin akan tetap melakukan booking?</div>");
							}
						}
					});
				}
			
			
		$('.formulir_tambah').validate({
            ignore: 'input[type=hidden], .select2-search__field',
            errorClass: 'validation-invalid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            messages: {
                id_dokter_sample: {
					required: 'Silahkan pilih dokter'
				},
				keterangan: {
					required: 'Keterangan tidak boleh kosong'
				},
				tanggal_booking: {
					required: 'Tanggal Booking tidak boleh kosong'
				}
            }
        });
            
            
		</script>
		
		
<?php
}else{

	$dpasi = $this->db->get_where("booking", array("id_booking" => $id_booking, "jenis" => "umum"))->result_array();
	
?>










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
							<a href="<?php echo base_url("m/booking");?>" class="breadcrumb-item">Data Booking</a>
							<span class="breadcrumb-item active">Edit Data Booking</span>
						</div>
					</div>
				</div>
				
				<!-- Content area -->
				<div class="content">

					<!-- Basic datatable -->

					

							<div class="card">
								<div class="card-header bg-dark text-white header-elements-inline">
									<h5 class="card-title">Edit Data Booking</h5>
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

									<a href="<?php echo base_url("m/booking");?>" class="btn bg-dark"><i class="icon-arrow-left8 pr-2"></i> Kembali</a>

									<hr>
	
									<form method="post" class="row formulir_tambah">
										<input type="hidden" name="id_booking" value="<?= $id_booking ?>">
										<div class="col-md-6">
												<div class="form-group" id="f_nm_pasien">
													<label>Nama Pasien :</label>
													<input type="text" class="form-control" value="<?= $dpasi[0]['nama_pasien'] ?>" name="nm_pasien" id="nm_pasien_tambah" placeholder="Nama Pasien" required>
												</div>
												<div class="form-group" id="f_telp">
													<label>No. Handphone :</label>
													<input type="text" class="form-control" value="<?= $dpasi[0]['no_telp'] ?>" name="no_telp" id="no_telp_tambah" placeholder="No. Handphone" required>
												</div>
												<div class="form-group" id="f_keterangan">
													<label>Keterangan :</label>
													<textarea class="form-control" name="keterangan" id="keterangan_tambah" placeholder="Keterangan" required><?= $dpasi[0]['keterangan'] ?></textarea>
												</div>
												
										</div>
										<div class="col-md-6">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Tanggal :</label>
														<div class="form-group form-group-feedback form-group-feedback-left">
															<input type="text" class="form-control tanggal_booking" id="tanggal_booking" placeholder="Tanggal Booking" name="tanggal_booking" value="<?= $dpasi[0]['tanggal_booking'] ?>" required>
															<div class="form-control-feedback form-control-feedback-sm">
																<i class="icon-calendar"></i>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Jam :</label>
														<div class="form-group form-group-feedback form-group-feedback-left">
															<select class="select" name="jam_booking" id="jam_booking" onchange="keluarinDokterNo()" data-placeholder="[ Pilih ]" required>
																<option></option>
																<?php
																	$sjambok = $this->db->query("SELECT *, LEFT(nm_jambok, 5) AS jambe FROM jambok ORDER BY nm_jambok ASC");
																	foreach($sjambok->result_array() as $djambok){
																		if($dpasi[0]['jam_booking'] == $djambok['nm_jambok']){
																			echo"<option value='".$djambok['nm_jambok']."' selected>".$djambok['jambe']."</option>";
																		}else{
																			echo"<option value='".$djambok['nm_jambok']."'>".$djambok['jambe']."</option>";
																		}
																	}
																?>
															</select>
															<!-- <div class="form-control-feedback form-control-feedback-sm">
																<i class="icon-alarm"></i>
															</div> -->
														</div>
													</div>
												</div>
											</div>
											<div  id="kolom_dokter_kosong"></div>
											<div class="form-group" id="kolom_dokter">
												<label class="font-weight-bold text-uppercase">Pilih Dokter :</label>
												<select class="select" name="id_dokter" id="id_dokter" onchange="cekSudahAdaygBooking()" data-placeholder="Pilih Dokter" required>
													<option></option>
												</select>
											</div>
											<div  id="kolom_dokter_sudah_dibooking"></div>
											<input type="hidden" id="token" name="token">
										</div>
										<div class="col-md-12">
											<button type="submit" class="btn bg-dark pull-right mt-3" name="editin"><i class="icon-check pr-2"></i> Simpan Data</button>
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

function keluarinDokterNo(){
					if($("#jam_booking").val() != "" && $("#tanggal_booking").val() != ""){
							// alert($("#jam_booking").val());
							$.ajax({
								url: "<?= base_url("api/tampilin_dokter_berdasarkanjadwal") ?>",
								method: "POST",
								data:{tanggal_booking: $("#tanggal_booking").val(), jam_booking: $("#jam_booking").val()},
								success: function(response){
									console.log(response[0].status);
									if(response[0].status == "kosong"){
										$("#id_dokter").html("");
										$("#kolom_dokter_kosong").html("<div class='alert alert-warning'>Dokter tidak tersedia untuk tanggal <b>"+$("#tanggal_booking").val()+" "+$("#jam_booking").val()+"</b></div>");
										$("#id_dokter").append("<option value='0'>Booking tanpa Dokter</option>");
										$("#kolom_dokter_sudah_dibooking").html("");
									}else{
										$("#id_dokter").html("<option></option>");
										$("#kolom_dokter_kosong").html("");
										$("#kolom_dokter_sudah_dibooking").html("");
										for(var key in response){
											if(response[key].id_dokter == '<?= $dpasi[0]['id_dokter'] ?>'){
												$("#id_dokter").append("<option value='"+response[key].id_dokter+"' selected>"+response[key].nama+"</option>");
											}else{
												$("#id_dokter").append("<option value='"+response[key].id_dokter+"'>"+response[key].nama+"</option>");
											}
										}
									}
								}
							});
							$("#kolom_dokter").show();
						}else{
							$("#kolom_dokter").hide();
						}
				}


			$(document).ready(function() {
				keluarinDokterNo();
				$("#kolom_dokter").show();
				$('.tanggal_booking').pickadate({
					monthsFull: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
					weekdaysShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
					today: 'Hari ini',
					clear: 'Reset',
					formatSubmit: 'yyyy-mm-dd',
					format: 'yyyy-mm-dd',
					disable: [
						{from: [0, 0, 0], to: true}
					],
					onSet: function(context) {
						keluarinDokterNo();
					}
				});


				$('.jam_booking').pickatime({
					disable: [
						[0,0],
						[0,30],
						[1,0],
						[1,30],
						[2,0],
						[2,30],
						[3,0],
						[3,30],
						[4,0],
						[4,30],
						[5,0],
						[5,30],
						[6,0],
						[6,30],
						[7,0],
						[7,30],
						[8,00],
						[8,30],
						[22,0],
						[22,30],
						[23,0],
						[23,30],
					],
					onSet: function(context) {
						keluarinDokterNo();
					}
				});


				

			});
			
			
			
			function cekSudahAdaygBooking(){
					let tanggal_booking = $("#tanggal_booking").val();
					let jam_booking = $("#jam_booking").val();
					let id_dokter = $("#id_dokter").val();
					// alert(jam_booking);
					$.ajax({
						url: "<?= base_url("api/ceksudahbookingdokter") ?>",
						method: "POST",
						data: {tanggal_booking: tanggal_booking, jam_booking: jam_booking, id_dokter: id_dokter},
						success: function(response){
							console.log(response[0].token);
							$("#token").val(response[0].token);
							if(response[0].status == "kosong"){
								$("#kolom_dokter_sudah_dibooking").html("");
							}else{
								$("#kolom_dokter_sudah_dibooking").html("<div class='alert alert-warning'><b>"+response[0].nm_dokter+"</b> untuk tanggal <b>"+tanggal_booking+" "+jam_booking+"</b> sudah ada yang booking. Anda yakin akan tetap melakukan booking?</div>");
							}
						}
					});
				}
			
			
		$('.formulir_tambah').validate({
            ignore: 'input[type=hidden], .select2-search__field',
            errorClass: 'validation-invalid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
            },
            messages: {
                id_dokter_sample: {
					required: 'Silahkan pilih dokter'
				},
				keterangan: {
					required: 'Keterangan tidak boleh kosong'
				},
				tanggal_booking: {
					required: 'Tanggal Booking tidak boleh kosong'
				}
            }
        });
            
            
		</script>









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

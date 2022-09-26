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
				$id_pasien			= $this->input->post('id_pasien');
				$nama_pasien		= $this->input->post('nm_pasien');
				$no_telp			= $this->input->post('no_telp');
				$id_dokter			= $this->input->post('id_dokter');
				$keterangan			= $this->input->post('keterangan');
				$tanggal_booking	= $this->input->post('tanggal_booking');
				$jenis				= "terdaftar";
				$token				= $this->input->post('token');
				$tanggal_push		= date('Y-m-d', strtotime('-1 days', strtotime($tanggal_booking)))." 07:30";
				//untuk uji coba
				//~ $tanggal_push		= "2020-10-10 07:30";
				//~ echo $tanggal_push;
				$eksekusi 	= $this->db->query("INSERT INTO booking (tanggal_booking, id_pasien, nama_pasien, no_telp, id_dokter, status, keterangan, jenis) VALUE ('".$tanggal_booking."','$id_pasien','$nama_pasien','$no_telp','$id_dokter','0','$keterangan', '$jenis')");
				$dtokpasien	= $this->db->get_where("pasien", array("id_pasien" => $id_pasien))->result_array();
				if ($eksekusi) {
					pushPesan("New Booking Notification","Tersedia booking terbaru untuk tanggal ".tgl_indo2($tanggal_booking),$token, $tanggal_push);
					pushPesan("New Booking Notification","Anda memiliki jadwal Booking  untuk tanggal ".tgl_indo2($tanggal_booking),$dtokpasien[0]['token'], $tanggal_push);
					echo "
						<meta http-equiv='refresh' content='2;url=".base_url("m/booking")."'>
						<script>sukses('tambah');</script>
					";
				} else {
					echo "
						<script>gagal('tambah');</script>
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
								<div class="card-header bg-dark text-white header-elements-inline pt-1 pb-1">
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
												<div class="form-group" id="f_keterangan">
													<label>Keterangan :</label>
													<textarea class="form-control" name="keterangan" id="keterangan_tambah" placeholder="Keterangan" required></textarea>
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
											<table class='table table-hover table-stripted table-bordered' id='tabelin_jadwal_header'>
												<thead>
													<tr>
														<th colspan='2' class='bg-dark'>Jadwal Dokter : <b id="nm_dokter_tambah" class='text-warning'></b></th>
													</tr>
												</thead>
											</table>
											<div class="jadwal_dokter"></div>
											
											<div class="form-group mt-3" id="f_tanggal_booking">
												<label>Tgl. Booking :</label>
												<div class="form-group form-group-feedback form-group-feedback-left">
													<input type="text" class="form-control tanggal_booking" placeholder="Tanggal Booking" name="tanggal_booking" required>
													<div class="form-control-feedback form-control-feedback-sm">
														<i class="icon-calendar"></i>
													</div>
												</div>
											</div>
											<input type="hidden" id="token" name="token">
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
														<td class='text-center'>" . $nonoxx . "</td>
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
														<td><button class='btn btn-sm bg-danger btpilihdokter' data-id='".$dpasonan2['id_dokter']."' data-nama='".$dpasonan2['nama']."' data-telp='".$dpasonan2['no_telp']."' data-token='".$dpasonan2['token']."'>Pilih</button></td>
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
				$("#f_tanggal_booking").hide();
				$("#f_keterangan").hide();
				$("#tabelin_jadwal_header").hide();
				$(document).on('click', '.btpilihpasien', function() {
					const id 	= $(this).data('id');
					const nama 	= $(this).data('nama');
					const telp 	= $(this).data('telp');
					const kelamin 	= $(this).data('kelamin');
					
					$("#f_nm_pasien").show();
					$("#f_telp").show();
					$("#f_kelamin").show();
					$("#f_keterangan").show();
				
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
					const token	= $(this).data('token');
					
					$("#f_nm_dokter").show();
					$("#tabelin_jadwal_header").show();
					$("#f_tanggal_booking").show();
				
					$('#id_dokter_tambah').val(id+" - "+nama);
					$('#id_dokter').val(id);
					$('#token').val(token);
					//$('#nm_dokter_tambah').val(nama);
					$('#modalCariDokter').modal('hide');
					document.getElementById("nm_dokter_tambah").innerHTML = nama;
					$('.jadwal_dokter').load("<?php echo base_url('m/ajax/jadwal-dokter/');?>"+id);
					//~ document.getElementById("jns_register_tambah").focus(); 
					
					$.ajax({
						type: "GET",
						url: "<?php echo base_url('m/ajax/jadwal-dokter-json/');?>"+id,
						dataType: 'json',
						success: function(data) {
							var wong_week = [];
							let i;
							for (let i = 0; i < data.length; i++) {
								wong_week.push(parseInt(data[i].id_hari));
							}
							
							var wong_real = [];
							let a;
							for(let a = 1; a < 8; a++){
								var n = wong_week.includes(a);
								if(n == false){
									wong_real.push(parseInt(a));
								}
							}
							
							//console.log(wong_real);
							$('.tanggal_booking').pickadate({
								monthsFull: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
								weekdaysShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
								today: 'Hari ini',
								clear: 'Reset',
								formatSubmit: 'yyyy-mm-dd',
								format: 'yyyy-mm-dd',
								disable: wong_real
								//disable week
								//~ disable: [1, 2, 5]
							});
						}
					});
					
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
            messages: {
                id_pasien_sample: {
                    required: 'Silahkan pilih pasien'
                },
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

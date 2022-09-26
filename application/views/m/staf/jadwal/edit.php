<?php
defined('BASEPATH') or exit('No direct script access allowed');
$ses_user        = $this->session->userdata('username');
$ses_level       = $this->session->userdata('level');

if ($ses_level == "staf" || $ses_level == "admin") {
	
	$id_dokter	= $this->uri->segment(4);
	
	$sdata 		= $this->db->query("SELECT * FROM dokter WHERE id_dokter = '$id_dokter'");
	$hdata		= $sdata->num_rows();
	
	if(empty($id_dokter) || $hdata == 0){
		$this->load->view('errors/404');
	}else{
		$ddata		= $sdata->result_array();
		
	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<title>Jadwal Dokter : <?php echo $ddata[0]['nama'];?></title>
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
			
			if(isset($_POST['editjadwal'])){
				$this->db->query("DELETE FROM jadwal_dokter WHERE id_dokter = '$id_dokter'");
				$id_hari		= $this->input->post('id_hari');
				$jam_mulai		= $this->input->post('jam_mulai');
				$jam_selesai	= $this->input->post('jam_selesai');
				$sudah_berjadawal = 0;
				for($i = 0; $i < count($id_hari); $i++){
					if(empty($jam_mulai[$i])){
						$jam_mulaix		= "";
					}else{
						$jam_mulaix		= $jam_mulai[$i];
						
					}
					
					if(empty($jam_selesai[$i])){
						$jam_selesaix	= "";
					}else{
						$jam_selesaix	= $jam_selesai[$i];
					}
					
					if(!empty($jam_mulaix) && !empty($jam_selesaix)){
						// echo "Hari : ".$id_hari[$i]." Jam Mulai : ".$jam_mulaix.", Jam Selesai : ".$jam_selesaix."<br>";
						$post_data = array(
							"id_dokter" => $id_dokter,
							"id_hari" => $id_hari[$i],
							"jam_mulai" => $jam_mulaix,
							"jam_selesai" => $jam_selesaix
						);

						$hajar = $this->db->insert("jadwal_dokter", $post_data);
						// $query = "SELECT * FROM jadwal_dokter WHERE id_hari = '".$id_hari[$i]."' AND ((jam_mulai BETWEEN '".$jam_mulaix."' AND '".$jam_selesaix."') OR (jam_selesai BETWEEN '".$jam_mulaix."' AND '".$jam_selesaix."'))";
						// $ceking = $this->db->query($query)->num_rows();
						// if($ceking == 0){
						// 	$hajar = $this->db->insert("jadwal_dokter", $post_data);
						// }else{
						// 	$sudah_berjadawal++;
						// 	break;
						// }
					}
				}
				// if($sudah_berjadawal > 0){
				// 	$this->session->set_flashdata("pesen","<div class='alert alert-danger'>Jadwal bentrok.</div>");
				// 	redirect(base_url("m/jadwaldok/edit/".$id_dokter));
				// }else{
				// 	if ($hajar) {
				// 		$this->session->set_flashdata("pesen","<script>sukses('edit');</script>");
				// 	} else {
				// 		$this->session->set_flashdata("pesen","<script>gagal('edit');</script>");
				// 	}
				// 	redirect(base_url("m/jadwaldok"));
				// }
				if ($hajar) {
					$this->session->set_flashdata("pesen","<script>sukses('edit');</script>");
				} else {
					$this->session->set_flashdata("pesen","<script>gagal('edit');</script>");
				}
				redirect(base_url("m/jadwaldok"));
			}
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
							<a href="<?php echo base_url("m/jadwaldok");?>" class="breadcrumb-item">Jadwal Dokter</a>
							<span class="breadcrumb-item active"><?php echo $ddata[0]['nama'];?></span>
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
									<h5 class="card-title">Jadwal Dokter : <b class="text-warning"><?php echo $ddata[0]['nama'];?></b></h5>
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

									<a href="<?php echo base_url("m/jadwaldok");?>" class="btn bg-dark"><i class="icon-arrow-left8 pr-2"></i> Kembali</a>


									<form method="post" class="mt-3">
										<table class="table table-hover table-stripted table-bordered">
											<thead>
												<tr>
													<th class="bg-dark">HARI</th>
													<th class="bg-dark">DARI JAM</th>
													<th class="bg-dark">SAMPAI JAM</th>
												</tr>
											</thead>
											<tbody>
												<?php
													$shari = $this->db->query("SELECT * FROM hari ORDER BY id_hari");
													foreach ($shari->result_array() as $dhari) {
														$sonok 	= $this->db->query("SELECT * FROM jadwal_dokter WHERE id_dokter = '$id_dokter' AND id_hari = '".$dhari['id_hari']."'");
														$donok	= $sonok->result_array();
														if(empty($donok[0]['jam_mulai'])){
															$jam_mulaixxx	= "";
														}else{
															$jam_mulaixxx	= $donok[0]['jam_mulai'];
														}
														
														if(empty($donok[0]['jam_selesai'])){
															$jam_selesaixxx	= "";
														}else{
															$jam_selesaixxx	= $donok[0]['jam_selesai'];
														}
														echo"
															<input type='hidden' name='id_hari[]' value='".$dhari['id_hari']."'>
															<tr>
																<td class='bg-brown text-uppercase font-weight-bold'>".$dhari['nm_hari']."</td>
																<td>
																	<div class='input-group'>
																		<span class='input-group-prepend'>
																			<span class='input-group-text'><i class='icon-alarm'></i></span>
																		</span>
																		<select class='form-control' name='jam_mulai[]' class='select'>
																			<option value=''>Kosong</option>";
																			$sjambok = $this->db->query("SELECT *, LEFT(nm_jambok, 5) AS jambe FROM jambok ORDER BY nm_jambok ASC");
																			foreach($sjambok->result_array() as $djambok){
																				if($djambok['nm_jambok'] == $jam_mulaixxx){
																					echo"<option value='".$djambok['nm_jambok']."' selected>".$djambok['jambe']."</option>";
																				}else{
																					echo"<option value='".$djambok['nm_jambok']."'>".$djambok['jambe']."</option>";
																				}
																			}
																			echo"
																		</select>
																	</div>
																</td>
																<td>
																	<div class='input-group'>
																		<span class='input-group-prepend'>
																			<span class='input-group-text'><i class='icon-alarm'></i></span>
																		</span>
																		<select class='form-control' name='jam_selesai[]' class='select'>
																			<option value=''>Kosong</option>";
																			$sjambok = $this->db->query("SELECT *, LEFT(nm_jambok, 5) AS jambe FROM jambok ORDER BY nm_jambok ASC");
																			foreach($sjambok->result_array() as $djambok){
																				if($djambok['nm_jambok'] == $jam_selesaixxx){
																					echo"<option value='".$djambok['nm_jambok']."' selected>".$djambok['jambe']."</option>";
																				}else{
																					echo"<option value='".$djambok['nm_jambok']."'>".$djambok['jambe']."</option>";
																				}
																			}
																			echo"
																		</select>
																	</div>
																</td>
															</tr>
														";
													}
												?>
												<tr>
													<td colspan="3" class="pb-0">
														<div class="alert alert-warning">
															Anda wajib mengisi <b>Jam Mulai</b> dan <b>Jam Selesai</b> untuk menambahkan jadwal. Biarkan kosong jika tidak tersedia.
														</div>
													</td>
												</tr>
											</tbody>
											<tfooter>
												<tr>
													<td colspan="3">
														<button type="submit" name="editjadwal" class="btn bg-dark pull-right"><i class="icon-pencil7 pr-2"></i> Atur Jadwal</button>
													</td>
												</tr>
											</tfooter>
										</table>


									</form>
								</div>
							</div>
				
				</div>
				<!-- /content area -->

                
                
				<!-- Footer -->
				<?php $this->load->view('inc/footer');?>
				<!-- /footer -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

		




		<script type="text/javascript">
			$(document).ready(function() {
				$('.jam_limit').pickatime({
					min: [7, 30],
					max: [22, 0]
				});
		
				$(document).on('click', '.btedit', function() {
					const id 	= $(this).data('id');
					$('#id_staf_edit').val(id);
					$.ajax({
						method: 'post',
						//~ url: "<?= site_url('m/jkbyid') ?>",
						url: "<?= site_url('m/user_stafbyid') ?>",
						data: {
							id: id
						},
						method: 'post',
						dataType: 'json',
						success: function(data) {
							//console.log(data);

							$('#nama').val(data[0].nama);
							$('#alamat').val(data[0].alamat);
							$('#tanggal_lahir').val(data[0].tanggal_lahir);
							$('#no_telp').val(data[0].no_telp);
							$('#email').val(data[0].email);
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
					$('#id_stafxx').val(id);
					//$('#nm_userxx').val(nama);
					document.getElementById("namaxx").innerHTML = nama;
					//console.log("data : " + nama);
				});
				
				$(document).on('click', '.bteditpass', function() {
					const id 	= $(this).data('id');
					const nama 	= $(this).data('nama');
					$('#id_staf_editpass').val(id);
					//$('#nm_userxx').val(nama);
					document.getElementById("namaxxx").innerHTML = nama;
					//console.log("data : " + nama);
				});

			})
		</script>




	</body>

	</html>

<?php
	}
}else{
	$this->load->view('errors/403');
}
?>

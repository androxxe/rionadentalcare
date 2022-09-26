<!-- Main sidebar -->
<div class="sidebar sidebar-light sidebar-main sidebar-expand-md">

  <!-- Sidebar mobile toggler -->
  <div class="sidebar-mobile-toggler text-center">
    <a href="#" class="sidebar-mobile-main-toggle">
      <i class="icon-arrow-left8"></i>
    </a>
    <span class="font-weight-semibold">Sidebar Staf</span>
    <a href="#" class="sidebar-mobile-expand">
      <i class="icon-screen-full"></i>
      <i class="icon-screen-normal"></i>
    </a>
  </div>
  <!-- /sidebar mobile toggler -->


  <!-- Sidebar content -->
  <div class="sidebar-content">

    <!-- User menu -->
    <div class="sidebar-user-material">
      <div class="sidebar-user-material-body">
		  


        <div class="sidebar-user-material-footer">
          <a href="#user-nav" class="d-flex justify-content-between align-items-center text-shadow-dark dropdown-toggle" data-toggle="collapse"><span><b><?php echo $this->session->userdata('nama'); ?></b></span></a>
        </div>
      </div>

      <div class="collapse" id="user-nav">
        <ul class="nav nav-sidebar">
          <li class="nav-item">
            <a href="#" data-toggle="modal" data-target="#modalEditMyPass" class="nav-link">
              <i class="icon-lock"></i>
              <span>Ubah Password</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url('auth/logout') ?>" class="nav-link">
              <i class="icon-switch2"></i>
              <span>Logout</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!-- /user menu -->



<!--
    <div class="card card-sidebar-mobile">
      <ul class="nav nav-sidebar" data-nav-type="accordion">
        <li class="nav-item">
			<a href="<?php echo base_url('m'); ?>" class="nav-link">
				<i class="icon-home"></i><span>Dashboard</span>
			</a>
        </li>
        <li class="nav-item">
			<a href="<?php echo base_url('m/user/pasien'); ?>" class="nav-link">
				<i class="icon-people"></i><span>Data Pasien</span>
			</a>
        </li>
        
        <li class="nav-item">
			<a href="<?php echo base_url('m/jadwaldok'); ?>" class="nav-link">
				<i class="icon-calendar"></i><span>Jadwal Dokter</span>
			</a>
        </li>


      </ul>
    </div>
-->

	
	
	<div class="card card-body">
			<div class="row row-tile no-gutters shadow-0 border">
				<div class="col-6">
					<a href="<?php echo base_url("m/user/pasien");?>" class="btn btn-light btn-block btn-float m-0 legitRipple">
						<i class="icon-people icon-2x"></i>
						<span class="tulisan_thumb">Data<br>Pasien</span>
					</a>
					<a href="<?php echo base_url("m/booking");?>" class="btn btn-light btn-block btn-float m-0 legitRipple">
						<i class="icon-clipboard6 text-blue-400 icon-2x"></i>
						<span class="tulisan_thumb">Data<br>Booking</span>
					</a>
				</div>
				<div class="col-6">
					<a href="<?php echo base_url('m/jadwaldok'); ?>" class="btn btn-light btn-block btn-float m-0 legitRipple">
						<i class="icon-calendar text-pink-400 icon-2x"></i>
						<span class="tulisan_thumb">Jadwal<br>Dokter</span>
					</button>
					<a href="<?php echo base_url("m/antrian");?>" class="btn btn-light btn-block btn-float m-0 legitRipple">
						<i class="icon-clipboard6 text-success-400 icon-2x"></i>
						<span class="tulisan_thumb">Daftar<br>Antrian</span>
					</a>
				</div>
			</div>
		</div>
		
		
  </div>
  <!-- /sidebar content -->

</div>
<!-- /main sidebar -->


<?php
	$ses_userxxxxx        = $this->session->userdata('username');
	
	if (isset($_POST['editinmypass'])) {
		$newpass		= password_hash($this->input->post('newpass'), PASSWORD_DEFAULT);
		$wadafak 		= $this->db->query("UPDATE staf SET `password` = '" . $newpass . "' WHERE username = '" . $ses_userxxxxx . "'");

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
			
?>

<div class="modal fade" id="modalEditMyPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
		<form method="post" class="formulir_editownpass">
      <div class="modal-header bg-dark">
        <h5 class="modal-title" id="exampleModalLabel">Edit Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<div class="form-group">
			<label>Ketik Password Baru :</label>
			<input type="password" name="newpass" class="form-control" id="passwordown" placeholder="Ketik password baru" required>
		</div>
		<div class="form-group">
			<label>Ulangi Password :</label>
			<input type="password" name="repeat_password2" class="form-control" placeholder="Ulangi Password" required>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" name="editinmypass" class="btn bg-dark">Edit Password</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script>
$('.formulir_editownpass').validate({
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
                    equalTo: '#passwordown'
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

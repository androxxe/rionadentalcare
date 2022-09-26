<?php
defined('BASEPATH') or exit('No direct script access allowed');
$id_level		= $this->session->userdata('id_level');
$id_sekolah		= $this->session->userdata('id_sekolah');


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title>Error 403</title>
	<?php
		$this->load->view('inc/css');
		$this->load->view('inc/js');
	?>
</head>

<body>

	<!-- Main navbar -->
	<?php
	// $this->load->view('admin/includes/navbar.php');



	?>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<?php
		// $this->load->view('admin/includes/sidebar_admin_sekolah.php') 
		?>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<?php
			// $this->load->view('admin/includes/header.php') 
			?>
			<!-- /page header -->




			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Container -->
				<div class="flex-fill">

					<!-- Error title -->
					<div class="text-center mb-3">
						<h1 class="error-title">403</h1>
						<h5>Oops, an error has occurred. Forbidden!</h5>
					</div>
					<!-- /error title -->

					<!-- Error content -->
					<div class="row">
						<div class="col-xl-4 offset-xl-4 col-md-8 offset-md-2">




							<!-- Buttons -->
							<div class="row">
								<div class="col-sm-12">
									<a href="<?php echo base_url(); ?>" class="btn btn-primary btn-block"><i class="icon-home4 mr-2"></i> Dashboard</a>
								</div>
							</div>
							<!-- /buttons -->

						</div>
					</div>
					<!-- /error wrapper -->

				</div>
				<!-- /container -->

			</div>
			<!-- /content area -->





			<!-- Footer -->
			<?php $this->load->view('inc/footer.php') ?>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->


</body>

</html>

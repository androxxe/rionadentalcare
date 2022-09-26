<!DOCTYPE html>
	<html lang="en">

	<head>
		<?php $this->load->view('inc/css');?>
		<title>Beranda</title>
		<?php $this->load->view('inc/js');?>
		
	</head>

	<body>

		<?php $this->load->view('inc/navbar');?>

		<div class="page-content">

			<?php $this->load->view('inc/sidebar/admin');?>

			<div class="content-wrapper">


				<div class="content">
					<div class="row ">
						<div class="col-xl-12">

							<img src="<?php echo base_url('assets/images/beranda.jpg'); ?> " width="100%" height="100%">

						</div>

					</div>

				</div>

				<?php $this->load->view('inc/footer');?>

			</div>
		</div>
		
	</body>

	</html>

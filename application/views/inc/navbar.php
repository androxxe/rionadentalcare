<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-dark bg-primary-800 navbar-static">
	<div class="navbar-brand">
		<a href="<?php echo base_url('m') ?>" class="d-inline-block">
			<img src="<?php echo base_url('assets/images/logo.png') ?>" alt="Riona Dental Care" height="100px">
		</a>
	</div>

	<div class="d-md-none">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
			<i class="icon-tree5"></i>
		</button>
		<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
			<i class="icon-paragraph-justify3"></i>
		</button>
	</div>

	<div class="collapse navbar-collapse" id="navbar-mobile">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
					<i class="icon-paragraph-justify3"></i>
				</a>
			</li>
		</ul>

		<span class="navbar-text ml-md-3">
			<span class="badge badge-mark border-success mr-2"></span>
			<?php echo sambutan($this->session->userdata('nama')); ?>
		</span>
		
		
		<style>
			.wasem_onair{
				margin-top:13px;
			}
		</style>
		<ul class="navbar-nav ml-md-auto">

			<li class="nav-item">
				<a href="<?php echo base_url('auth/logout') ?>" class="navbar-nav-link" data-popup="tooltip-custom" title="Logout" data-placement="bottom" data-delay="600">
					<i class="icon-switch2"></i>
					<span class="d-md-none ml-2">Logout</span>
				</a>
			</li>

		</ul>
	</div>
</div>
<!-- /main navbar -->


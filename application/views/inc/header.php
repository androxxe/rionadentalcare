<!-- Page header -->
<div class="page-header page-header-light">

	<!-- <div class="page-header-content header-elements-md-inline">
					<div class="page-title d-flex">
						<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Home</span> <?php foreach ($this->uri->segments as $segment) : ?>
												<?php
													$url = substr($this->uri->uri_string, 0, strpos($this->uri->uri_string, $segment)) . $segment;
													?>
														- <?php echo ucfirst($segment) ?>
					<?php endforeach; ?></h4>
						<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
					</div>

					<div class="header-elements d-none">
						<div class="d-flex justify-content-center">
							<a href="#" class="btn btn-link btn-float font-size-sm font-weight-semibold text-default">
								<i class="icon-bars-alt text-pink-300"></i>
								<span>Statistics</span>
							</a>
							<a href="#" class="btn btn-link btn-float font-size-sm font-weight-semibold text-default">
								<i class="icon-calculator text-pink-300"></i>
								<span>Invoices</span>
							</a>
							<a href="#" class="btn btn-link btn-float font-size-sm font-weight-semibold text-default">
								<i class="icon-calendar5 text-pink-300"></i>
								<span>Schedule</span>
							</a>
						</div>
					</div>
				</div> -->

	<!-- <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
		<div class="d-flex">
			<div class="breadcrumb">
				<a href="<?php echo base_url('admin/dashboard') ?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
				<?php foreach ($this->uri->segments as $segment) : ?>
					<?php
						$url = substr($this->uri->uri_string, 0, strpos($this->uri->uri_string, $segment)) . $segment;
						$is_active =  $url == $this->uri->uri_string;
						?>
					<a href="<?php echo site_url($url) ?>" class="breadcrumb-item <?php echo $is_active ? 'active' : '' ?>">

						<?php echo ucfirst($segment) ?>

					</a>
				<?php endforeach; ?>
			</div>

			<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
		</div>


	</div> -->
</div>
<!-- /page header -->

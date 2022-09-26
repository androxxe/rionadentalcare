<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Global stylesheets -->


<link rel="apple-touch-icon" href="<?php echo base_url("assets/images/web.png");?>">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url("assets/images/web.png");?>">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url("assets/images/web.png");?>">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url("assets/images/web.png");?>">
	<link rel="icon" type="image/x-icon" href="<?php echo base_url("assets/images/web.png");?>">
	
	
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('global/css/icons/icomoon/styles.css') ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/bootstrap_limitless.min.css') ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/layout.min.css') ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/components.min.css') ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/colors.min.css') ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('global/css/icons/fontawesome/styles.min.css') ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/animate.min.css') ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('global/css/icons/material/icons.css') ?>" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->

<?php
if ($this->session->userdata('authenticated')) { } else {

	redirect(base_url('auth'));
}
?>

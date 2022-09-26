<?php
	defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - Riona Dental Care</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no">
	<script async="" src="<?php echo base_url();?>assets/login/js/analytics.js"></script>
	<script src="<?php echo base_url();?>assets/login/js/QJpHOqznaMvNOv9CGoAdo_yvYKU.js"></script>
	<link rel="stylesheet" href="data:text/css;charset=utf-8;base64,QGltcG9ydCB1cmwoaHR0cHM6Ly9mb250cy5nb29nbGVhcGlzLmNvbS9jc3M/ZmFtaWx5PU1vbnRzZXJyYXQ6NDAwLDcwMCk7CmNsb3VkZmxhcmUtYXBwW2FwcD0iZmxhc2hjYXJkIl0gewogIC13ZWJraXQtZm9udC1zbW9vdGhpbmc6IGFudGlhbGlhc2VkOwogIGJhY2tncm91bmQtY29sb3I6ICNmZmY7CiAgY29sb3I6ICM0NDQ7CiAgZGlzcGxheTogZmxleDsKICBmbGV4LWZsb3c6IGNvbHVtbjsKICBmb250LWZhbWlseTogTW9udHNlcnJhdCwgc2Fucy1zZXJpZjsKICBmb250LXNpemU6IDE0cHg7CiAgZm9udC13ZWlnaHQ6IDQwMDsKICBtYXgtd2lkdGg6IDEwMCU7CiAgbWluLWhlaWdodDogNzBweDsKICBwYWRkaW5nOiAyMHB4IDE1cHg7CiAgcG9zaXRpb246IGZpeGVkOwogIHRleHQtcmVuZGVyaW5nOiBvcHRpbWl6ZUxlZ2liaWxpdHk7CiAgdHJhbnNpdGlvbjogYm90dG9tIC40cyBlYXNlLWluLW91dDsKICB2aXNpYmlsaXR5OiBoaWRkZW47Cn0KCmNsb3VkZmxhcmUtYXBwW2FwcD0iZmxhc2hjYXJkIl1bZGF0YS12aXNpYmlsaXR5PSJ2aXNpYmxlIl0gewogIHZpc2liaWxpdHk6IHZpc2libGU7Cn0KCkBtZWRpYSAobWluLXdpZHRoOiA3NjhweCkgewogIGNsb3VkZmxhcmUtYXBwW2FwcD0iZmxhc2hjYXJkIl0gewogICAgYm90dG9tOiAyMHB4OwogICAgYm9yZGVyOiAxcHggc29saWQgI2NjYzsKICAgIGJvcmRlci1yYWRpdXM6IDNweDsKICAgIGJveC1zaGFkb3c6IDAgM3B4IDdweCByZ2JhKDAsIDAsIDAsIDAuMTIpOwogICAgd2lkdGg6IDMzMHB4OwogIH0KICBjbG91ZGZsYXJlLWFwcFthcHA9ImZsYXNoY2FyZCJdW2RhdGEtcG9zaXRpb249ImxlZnQiXSB7CiAgICBsZWZ0OiAyMHB4OwogIH0KICBjbG91ZGZsYXJlLWFwcFthcHA9ImZsYXNoY2FyZCJdW2RhdGEtcG9zaXRpb249InJpZ2h0Il0gewogICAgcmlnaHQ6IDIwcHg7CiAgfQogIGNsb3VkZmxhcmUtYXBwW2FwcD0iZmxhc2hjYXJkIl0gZmxhc2hjYXJkLWNvbnRlbnQgewogICAgbGluZS1oZWlnaHQ6IDEuNTsKICB9Cn0KCkBtZWRpYSAobWF4LXdpZHRoOiA3NjhweCkgewogIGNsb3VkZmxhcmUtYXBwW2FwcD0iZmxhc2hjYXJkIl0gewogICAgYm9yZGVyLXRvcDogMXB4IHNvbGlkICNjY2M7CiAgICBib3R0b206IDA7CiAgICBsZWZ0OiAwOwogICAgcmlnaHQ6IDA7CiAgfQogIGNsb3VkZmxhcmUtYXBwW2FwcD0iZmxhc2hjYXJkIl0gZmxhc2hjYXJkLWNvbnRlbnQgewogICAgbGluZS1oZWlnaHQ6IDEuNzg1OwogIH0KfQoKY2xvdWRmbGFyZS1hcHBbYXBwPSJmbGFzaGNhcmQiXSBmbGFzaGNhcmQtaGVhZGVyIHsKICBhbGlnbi1pdGVtczogY2VudGVyOwogIGRpc3BsYXk6IGZsZXg7CiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuOwogIGZsZXg6IDEgMSBhdXRvOwp9CgpjbG91ZGZsYXJlLWFwcFthcHA9ImZsYXNoY2FyZCJdIGZsYXNoY2FyZC10aXRsZSB7CiAgZm9udC1zaXplOiAxNnB4OwogIGZvbnQtd2VpZ2h0OiA3MDA7CiAgb3ZlcmZsb3c6IGhpZGRlbjsKICB0ZXh0LW92ZXJmbG93OiBlbGxpcHNpczsKICB3aGl0ZS1zcGFjZTogbm93cmFwOwogIGZsZXg6IDEgMSBhdXRvOwp9CgpjbG91ZGZsYXJlLWFwcFthcHA9ImZsYXNoY2FyZCJdIGZsYXNoY2FyZC1jbG9zZSB7CiAgbWFyZ2luLWxlZnQ6IDFlbTsKICBjb2xvcjogaW5oZXJpdDsKICBjdXJzb3I6IHBvaW50ZXI7CiAgZGlzcGxheTogaW5saW5lLWJsb2NrOwogIGZvbnQtc2l6ZTogMWVtOwogIGZsZXg6IDAgMCBhdXRvOwp9CgpjbG91ZGZsYXJlLWFwcFthcHA9ImZsYXNoY2FyZCJdIGZsYXNoY2FyZC1jb250ZW50IHsKICBkaXNwbGF5OiBmbGV4OwogIGZsZXgtZmxvdzogY29sdW1uOwogIGZsZXg6IDEgMSBhdXRvOwp9CgpjbG91ZGZsYXJlLWFwcFthcHA9ImZsYXNoY2FyZCJdIGZsYXNoY2FyZC1mb290ZXIgewogIG1hcmdpbi10b3A6IDAuNWVtOwogIGRpc3BsYXk6IGZsZXg7CiAgZmxleC1mbG93OiBjb2x1bW47CiAgZmxleDogMCAwIGF1dG87CiAgdGV4dC1hbGlnbjogY2VudGVyOwp9CgpjbG91ZGZsYXJlLWFwcFthcHA9ImZsYXNoY2FyZCJdIGZsYXNoY2FyZC1mb290ZXIgLmZsYXNoY2FyZC1hY3Rpb24gewogIGJhY2tncm91bmQtY29sb3I6ICNmZmYgIWltcG9ydGFudDsKICBib3JkZXItcmFkaXVzOiAzcHggIWltcG9ydGFudDsKICBib3JkZXI6IDFweCBzb2xpZCAhaW1wb3J0YW50OwogIGJveC1zaGFkb3c6IGluaGVyaXQgIWltcG9ydGFudDsKICBjdXJzb3I6IHBvaW50ZXIgIWltcG9ydGFudDsKICBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7CiAgZm9udC1zaXplOiAxZW0gIWltcG9ydGFudDsKICBtYXJnaW4tdG9wOiAxMHB4ICFpbXBvcnRhbnQ7CiAgcGFkZGluZzogNXB4IDAgIWltcG9ydGFudDsKICB0ZXh0LWRlY29yYXRpb246IG5vbmUgIWltcG9ydGFudDsKICB0ZXh0LXNoYWRvdzogaW5oZXJpdCAhaW1wb3J0YW50Owp9CgpjbG91ZGZsYXJlLWFwcFthcHA9ImZsYXNoY2FyZCJdIC5mbGFzaGNhcmQtYWN0aW9uW2hyZWY9IiJdIHsKICBwb2ludGVyLWV2ZW50czogbm9uZSAhaW1wb3J0YW50Owp9CgpjbG91ZGZsYXJlLWFwcFthcHA9ImZsYXNoY2FyZCJdIGZsYXNoY2FyZC1tZXNzYWdlIHsKICBkaXNwbGF5OiBibG9jazsKICBsaW5lLWhlaWdodDogMS40OwogIG1hcmdpbi10b3A6IDEwcHg7CiAgb3ZlcmZsb3c6IGhpZGRlbjsKICBwYWRkaW5nLXJpZ2h0OiAxMHB4OwogIHRleHQtb3ZlcmZsb3c6IGVsbGlwc2lzOwp9CgpjbG91ZGZsYXJlLWFwcFthcHA9ImZsYXNoY2FyZCJdIGZsYXNoY2FyZC1tZXNzYWdlIHA6Zmlyc3QtY2hpbGQgewogIG1hcmdpbi10b3A6IDA7Cn0KCmNsb3VkZmxhcmUtYXBwW2FwcD0iZmxhc2hjYXJkIl0gZmxhc2hjYXJkLW1lc3NhZ2UgcDpsYXN0LWNoaWxkIHsKICBtYXJnaW4tYm90dG9tOiAwOwp9">
	<script src="<?php echo base_url();?>assets/login/js/fmCNL3Jg5WJkvte7PeZ_5mKvapc.js"></script>
	<link rel="apple-touch-icon" href="<?php echo base_url("assets/images/web.png");?>">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url("assets/images/web.png");?>">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url("assets/images/web.png");?>">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url("assets/images/web.png");?>">
	<link rel="icon" type="image/x-icon" href="<?php echo base_url("assets/images/web.png");?>">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-touch-fullscreen" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="default">
	<meta content="" name="description">
	<meta content="" name="author">
	<link href="<?php echo base_url();?>assets/login/css/pace-theme-flash.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/login/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/login/css/font-awesome.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>assets/login/css/jquery.css" rel="stylesheet" type="text/css" media="screen">
	<link href="<?php echo base_url();?>assets/login/css/select2.css" rel="stylesheet" type="text/css" media="screen">
	<link href="<?php echo base_url();?>assets/login/css/switchery.css" rel="stylesheet" type="text/css" media="screen">
	<link href="<?php echo base_url();?>assets/login/css/pages-icons.css" rel="stylesheet" type="text/css">
	<link class="main-stylesheet" href="<?php echo base_url();?>assets/login/css/pages.css" rel="stylesheet" type="text/css">

  
  <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async='async'></script>
  <script>
    var OneSignal = window.OneSignal || [];
    OneSignal.push(["init", {
      appId: "ddb9ef15-34c0-4d02-ac37-cae303c059c2",
      autoRegister: false, /* Set to true to automatically prompt visitors */
      subdomainName: 'Riona',   
      notifyButton: {
          enable: true /* Set to false to hide */
      }
    }]);
  </script>
  
</head>

<body class="fixed-header  unix desktop pace-done">
	<div class="pace  pace-inactive">
		<div class="pace-progress" style="transform: translate3d(100%, 0px, 0px);" data-progress-text="100%" data-progress="99">
			<div class="pace-progress-inner"></div>
		</div>
		<div class="pace-activity"></div>
	</div>
	<div class="login-wrapper ">
		<div class="bg-pic">
			<img src="<?php echo base_url();?>assets/login/images/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" data-src="<?php echo base_url();?>assets/login/images/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" data-src-retina="<?php echo base_url();?>assets/login/images/new-york-city-buildings-sunrise-morning-hd-wallpaper.jpg" alt="" class="lazy">
			
			<div class="bg-caption pull-bottom sm-pull-bottom text-white p-l-20 m-b-20">
				<img src="<?php echo base_url();?>assets/images/web.png" alt="Riona Dental Care" data-src="<?php echo base_url();?>assets/images/web.png" data-src-retina="<?php echo base_url();?>assets/images/web.png" width="230px">
				<h2 class="semi-bold text-white">Riona Dental Care</h2>
				<p class="small">Copyright © 2020 - <?php echo date('Y');?> Riona Dental Care. All right reserved.</p>
			</div>
		</div>
		
		<div class="login-container bg-white">
			<div class="p-l-50 m-l-20 p-r-50 m-r-20 p-t-50 m-t-30 sm-p-l-15 sm-p-r-15 sm-p-t-40">
				<img src="<?php echo base_url();?>assets/images/web.png" alt="Riona Dental Care" data-src="<?php echo base_url();?>assets/images/web.png" data-src-retina="<?php echo base_url();?>assets/images/web.png" width="230px">
<!--
				<p class="p-t-35">Sign into your pages account</p>
-->
				
				<form id="form-login" class="p-t-15" role="form" action="<?php echo base_url('auth/login'); ?>" novalidate="novalidate" method="post">
					<?php
						if($this->session->flashdata('message')) {
							echo"
								<div class='alert alert-danger border-0 alert-dismissible'>".$this->session->flashdata('message')."</div>
							";
						}
					?>
					<div class="form-group form-group-default">
						<label>Login</label>
						<div class="controls">
							<input type="text" name="username" placeholder="Username" class="form-control" required="" aria-required="true">
						</div>
					</div>
					<div class="form-group form-group-default">
						<label>Level Akses</label>
						<div class="controls">
							<select class="form-control" name="level" required>
								<option value=""> - Pilih Level Akses - </option>
								<option value="admin">Administrator</option>
								<option value="staf">Staf</option>
								<option value="dokter">Dokter</option>
								<option value="perawat">Perawat</option>
							</select>
						</div>
					</div>
					<div class="form-group form-group-default">
						<label>Password</label>
						<div class="controls">
							<input type="password" class="form-control" name="password" placeholder="Kata Kunci" required="" aria-required="true">
						</div>
					</div>
					
					<div class="row">
					
<!--
						<div class="col-md-6 d-flex align-items-center justify-content-end">
							<a href="#" class="text-info small">Help? Contact Support</a>
						</div>
-->
					</div>
					<button class="btn btn-primary btn-cons m-t-10" type="submit">Sign in</button>
				</form>
				
<!--
				<div class="pull-bottom sm-pull-bottom">
					<div class="m-b-30 p-r-80 sm-m-t-20 sm-p-r-15 sm-p-b-20 clearfix">
						<div class="col-sm-3 col-md-2 no-padding">
							<img alt="" class="m-t-5" data-src="<?php echo base_url();?>assets/login/images/pages_icon.png" data-src-retina="<?php echo base_url();?>assets/login/images/pages_icon_2x.png" src="<?php echo base_url();?>assets/login/images/pages_icon.png" width="60" height="60">
						</div>
						<div class="col-sm-9 no-padding m-t-10">
							<p>
								<small>
									Create a pages account. If you have a facebook account, log into it for this process. Sign in with <a href="#" class="text-info">Facebook</a> or <a href="#" class="text-info">Google</a>
								</small>
							</p>
						</div>
					</div>
				</div>
-->
				
				
				
			</div>
		</div>
	</div>
	
    
    
    
    
    
	<script src="<?php echo base_url();?>assets/login/js/pace.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/login/js/jquery-3.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/login/js/modernizr.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/login/js/jquery-ui.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/login/js/popper.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/login/js/bootstrap.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/login/js/jquery-easy.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/login/js/jquery_003.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/login/js/jquery_004.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/login/js/jquery.js"></script>
	<script src="<?php echo base_url();?>assets/login/js/jquery_002.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/login/js/select2.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/login/js/classie.js"></script>
	<script src="<?php echo base_url();?>assets/login/js/switchery.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/login/js/jquery_005.js" type="text/javascript"></script>

	<script src="<?php echo base_url();?>assets/login/js/pages.js"></script>
	<script>
		$(function() {
			$('#form-login').validate()
		})
	</script>
  
  
  
</body>

</html>

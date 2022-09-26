
<script>
	$(document).ready(function() {
		var tahunwasem = new Date().getFullYear();
		document.getElementById("tahuninidong").innerHTML = tahunwasem;
	});
</script>
<!-- Footer -->
<div class="navbar navbar-expand-lg navbar-light">
	<div class="text-center d-lg-none w-100">
		<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
			<i class="icon-unfold mr-2"></i>
			Footer
		</button>
	</div>

	<div class="navbar-collapse collapse" id="navbar-footer">
		<span class="navbar-text">
			Copyright &copy; 2020 - <?php echo date('Y');?> Riona Dental Care. All right reserved.
		</span>
	</div>
</div>
<!-- /footer -->

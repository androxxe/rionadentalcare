<?php
	$nilai		= antixss($_POST['nilai']);
	$hajar		= $this->db->query("UPDATE tv_pengaturan SET onair = '$nilai' WHERE id_pengaturan = '1'");
				
?>

<?php
Class Fungsiumum{
			
}

function convtime($data, $jenis){
    if($jenis == "toam"){
        $sabun	= date("h:i A", strtotime($data));
    }else if($jenis == "to24"){
        $sabun	= date("H:i", strtotime($data)).":00";
    }
    return $sabun;
}

function autoantrian(){
    $ci = & get_instance();
    
    date_default_timezone_set('Asia/Jakarta');
    $tglauto			= date("Y-m-d");
    $sdata 				= $ci->db->query("SELECT MAX(RIGHT(no_antrian, 3)) as max_id FROM antrian WHERE tanggal = '".$tglauto."'");
    $hdata				= $sdata->num_rows();
    if ($hdata > 0) {
        $ddata			= $sdata->result_array();
        $id_max_data	= $ddata[0]['max_id'];
        $sort_data 		= (int) substr($id_max_data, 0, 3);
        $sort_data++;
        $new_data 		= sprintf("%03s", $sort_data);
    } else {
        $new_data		= "001";
    }
    return $new_data;
}
?>

<link href="<?php echo base_url();?>assets/css/mpdf-bootstrap.css" rel="stylesheet" type="text/css">
	
    <?php
        $id_antrian	= $this->uri->segment(4);
        
        $sdata		= $this->db->query("SELECT a.`id_antrian`, a.`no_antrian`, a.`tanggal` AS tgl_antrian, LEFT(a.`jam_daftar`,5) AS jam_antrian, b.*, c.`id_dokter`, c.`nama` AS nm_dokter FROM antrian a LEFT JOIN pasien b ON a.`id_pasien` = b.`id_pasien` LEFT JOIN dokter c ON a.`id_dokter` = c.`id_dokter` WHERE a.id_antrian = '".$id_antrian."'");
        $hdata		= $sdata->num_rows();
        if(empty($id_antrian) || $hdata == 0){
            echo "Tidak ada data untuk dicetak!";
        }else{
            $ddata	= $sdata->result_array();
            
            $margin_top		= 20;
            $margin_right	= 5;
            $margin_left	= 5;		
    ?>
    
    <style>
        body{
            margin-top:500px !important;
        }
        .area_gendeng{
            padding:0px 0px;
        }
        
        .tabel_kosong{
            width:100%;
        }
        .tabel_kosong td{
            padding-top:10px;
        }
        .ttd_wong{
            padding-left:320px;
        }
        
        .tabel_gendeng{
            font-size:9pt;
            width:100%;
        }
        .tabel_gendeng th{
            border-color:#000;
            border-width:1px;
        }
        .tabel_gendeng td{
            border-color:#000;
            border-width:1px;
            padding: 2px 0px;
        }
        .table tbody tr td{
            padding:4px 10px;
        }
    </style>
    
    
    <div class="area_gendeng">
        
    
        <div class="" style="background:#000;color:yellow;padding:5px 15px;border-radius:3px;">
            <div style="float:left;width:300px;"><b>KARTU ANTRIAN</b></div>
            <div style="float:right;text-align:right;color:#fff;">Lembar Petugas</div>
        </div>
        
        <br>
        <table class="tabel_gendeng">
            <tr>
                <td class="text-center" style="width:200px;">
                    <div style="color:red;font-size:38px;font-weight:bold;">
                        <?php echo $ddata[0]['no_antrian'];?>
                    </div>
                </td>
                <td rowspan="2">
                    <table class="tabel_gendeng">
                    <tr>
                            <td>Hari, Tanggal</td>
                            <td>:</td>
                            <td><?php echo tgl_indo($ddata[0]['tgl_antrian'],"a");?></td>
                        </tr>
                        <tr>
                            <td>Jam</td>
                            <td>:</td>
                            <td><?php echo $ddata[0]['jam_antrian'];?> Wib</td>
                        </tr>
                        <tr>
                            <td>Nama Pasien</td>
                            <td>:</td>
                            <td><b><?php echo $ddata[0]['nama'];?></b></td>
                        </tr>
                        <tr>
                            <td>Tempat, Tgl. Lahir</td>
                            <td>:</td>
                            <td><?php echo $ddata[0]['tempat_lahir'].", ".tgl_indo2($ddata[0]['tanggal_lahir']);?></td>
                        </tr>
                        <tr>
                            <td>No. Hanphone</td>
                            <td>:</td>
                            <td><?php echo $ddata[0]['no_telp'];?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?php echo $ddata[0]['alamat'];?></td>
                        </tr>
                        <tr>
                            <td>Dokter</td>
                            <td>:</td>
                            <td class="text-uppercase"><?php echo $ddata[0]['nm_dokter'];?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        
        <div style="border-bottom:1px dashed #000;padding-top:20px;"></div>					
                    
    </div>
    
    <br>
    
    <div class="area_gendeng">
        
    
        <div class="" style="background:#000;color:yellow;padding:5px 15px;border-radius:3px;">
            <div style="float:left;width:300px;"><b>KARTU ANTRIAN</b></div>
            <div style="float:right;text-align:right;color:#fff;">Lembar Pasien</div>
        </div>
        <br>
        <table class="tabel_gendeng">
            <tr>
                <td class="text-center" style="width:200px;">
                    <div style="color:red;font-size:38px;font-weight:bold;">
                        <?php echo $ddata[0]['no_antrian'];?>
                    </div>
                </td>
                <td rowspan="2">
                    <table class="tabel_gendeng">
                        <tr>
                            <td>Hari, Tanggal</td>
                            <td>:</td>
                            <td><?php echo tgl_indo($ddata[0]['tgl_antrian'],"a");?></td>
                        </tr>
                        <tr>
                            <td>Jam</td>
                            <td>:</td>
                            <td><?php echo $ddata[0]['jam_antrian'];?> Wib</td>
                        </tr>
                        <tr>
                            <td>Nama Pasien</td>
                            <td>:</td>
                            <td><b><?php echo $ddata[0]['nama'];?></b></td>
                        </tr>
                        <tr>
                            <td>Tempat, Tgl. Lahir</td>
                            <td>:</td>
                            <td><?php echo $ddata[0]['tempat_lahir'].", ".tgl_indo2($ddata[0]['tanggal_lahir']);?></td>
                        </tr>
                        <tr>
                            <td>No. Hanphone</td>
                            <td>:</td>
                            <td><?php echo $ddata[0]['no_telp'];?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td><?php echo $ddata[0]['alamat'];?></td>
                        </tr>
                        <tr>
                            <td>Dokter</td>
                            <td>:</td>
                            <td class="text-uppercase"><?php echo $ddata[0]['nm_dokter'];?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        
        
        <div style="border-bottom:1px dashed #000;padding-top:20px;"></div>					
                    
    </div>
    
    <?php
    }
    ?>
    
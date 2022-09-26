<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') or exit('No direct script access allowed');
class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/m_api');
    }

    public function mybooking()
    {
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');
        //echo json_encode($this->m_api->mybooking($_GET['id']));
        $datane	= array();
        // $sdata	= $this->db->query("SELECT a.*, b.`nama` AS nm_pasien, c.`nama` AS nm_dokter FROM booking a, pasien b, dokter c WHERE a.`id_pasien` = b.`id_pasien` AND a.`id_dokter` = c.`id_dokter` AND a.id_pasien = '$_GET[id]' ORDER BY a.`tanggal_booking` DESC, a.`id_booking` DESC");
        $sdata	= $this->db->query("SELECT a.*, LEFT(a.jam_booking, 5) AS jambok, b.`nama` AS nm_pasien FROM booking a, pasien b WHERE a.`id_pasien` = b.`id_pasien` AND a.id_pasien = '$_GET[id]' ORDER BY a.`tanggal_booking` DESC, a.`id_booking` DESC");
        foreach ($sdata->result_array() as $ddata) {
			$sdoki = $this->db->get_where("dokter", array("id_dokter" => $ddata['id_dokter']));
			$hdoki = $sdoki->num_rows();
			if($hdoki > 0){
				$ddoki = $sdoki->result_array();
				$nm_dokter = $ddoki[0]['nama'];
			}else{
				$nm_dokter = "";
			}
			if($ddata['status'] == 0){
				$statuse	= "<span class='badge badge-warning'>Booking</span>";
			}else if($ddata['status'] == 2){
				$statuse	= "<span class='badge badge-danger'>Cancel</span>";
			}else if($ddata['status'] == 3){
				$statuse	= "<span class='badge badge-danger'>Tidak Datang</span>";
			}else{
				$statuse	= "<span class='badge badge-success'>Diproses</span>";
			}
			array_push($datane, array(
				"id_booking"		=>$ddata['id_booking'],
				"tanggal_booking"	=>tgl_indo2($ddata['tanggal_booking'],"a"),
				"jam_booking"	=>$ddata['jambok'],
				"id_pasien"			=>$ddata['id_pasien'],
				"nm_pasien"			=>$ddata['nm_pasien'],
				"no_telp"			=>$ddata['no_telp'],
				"id_dokter"			=>$ddata['id_dokter'],
				"nm_dokter"			=>$nm_dokter,
				"keterangan"		=>$ddata['keterangan'],
				"ket_tolak"		=>$ddata['ket_tolak'],
				"statusreal"		=>$ddata['status'],
				"status"			=>$statuse,
			));
		}
		echo json_encode($datane);
    }
    
    public function mybooking_detail()
    {
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');
        //echo json_encode($this->m_api->mybooking($_GET['id']));
        $datane	= array();
        $sdata	= $this->db->query("SELECT a.*, b.`nama` AS nm_pasien FROM booking a, pasien b WHERE a.`id_pasien` = b.`id_pasien` AND a.id_booking = '$_GET[id]'");
        // $sdata	= $this->db->query("SELECT a.*, b.`nama` AS nm_pasien, c.`nama` AS nm_dokter FROM booking a, pasien b, dokter c WHERE a.`id_pasien` = b.`id_pasien` AND a.`id_dokter` = c.`id_dokter` AND a.id_booking = '$_GET[id]'");
        foreach ($sdata->result_array() as $ddata) {
			$sdoki = $this->db->get_where("dokter", array("id_dokter" => $ddata['id_dokter']));
			$hdoki = $sdoki->num_rows();
			if($hdoki > 0){
				$ddoki = $sdoki->result_array();
				$nm_dokter = $ddoki[0]['nama'];
			}else{
				$nm_dokter = "";
			}

			// if($ddata['status'] == 0){
			// 	$statuse	= "<span class='badge color-yellow'>Belum diproses</span>";
			// }else if($ddata['status'] == 2){
			// 	$statuse	= "<span class='badge color-red'>Ditolak</span>";
			// }else{
			// 	$statuse	= "<span class='badge color-green'>Selesai</span>";
			// }
			if($ddata['status'] == 0){
				$statuse	= "<span class='badge badge-warning'>Booking</span>";
			}else if($ddata['status'] == 2){
				$statuse	= "<span class='badge badge-danger'>Cancel</span>";
			}else if($ddata['status'] == 3){
				$statuse	= "<span class='badge badge-danger'>Tidak Datang</span>";
			}else{
				$statuse	= "<span class='badge badge-success'>Diproses</span>";
			}

			array_push($datane, array(
				"id_booking"		=>$ddata['id_booking'],
				"tanggal_booking"	=>tgl_indo2($ddata['tanggal_booking'],"a"),
				"id_pasien"			=>$ddata['id_pasien'],
				"nm_pasien"			=>$ddata['nm_pasien'],
				"no_telp"			=>$ddata['no_telp'],
				"id_dokter"			=>$ddata['id_dokter'],
				"nm_dokter"			=>$nm_dokter,
				"keterangan"		=>$ddata['keterangan'],
				"ket_tolak"		=>$ddata['ket_tolak'],
				"statusreal"		=>$ddata['status'],
				"status"			=>$statuse,
			));
		}
		echo json_encode($datane);
    }
    
    public function mybooking_hapus()
    {
		header('Access-Control-Allow-Origin: *');
		$id_booking	= $this->input->post('id_booking');
		$eksekusi	= $this->db->delete('booking', array('id_booking' => $id_booking));
		if($eksekusi){
			echo "sukses";
		}else{
			echo "gagal";
		}
    }
    
    public function mybooking_jumlah(){
		header('Access-Control-Allow-Origin: *');
		$id_pasien	= $this->uri->segment(3);
		$sdata 		= $this->db->query("SELECT id_booking FROM booking WHERE id_pasien = '$id_pasien'");
		echo $sdata->num_rows();
	}
    
    public function data_dokter(){
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');
		echo json_encode($this->m_api->data_dokter());
	}
	
	public function jadwal_dokter(){
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');
		$id_dokter	= $this->uri->segment(3);
		$sjadwal = $this->db->query("SELECT a.*, b.`nm_hari`, b.`nm_singkat`, LEFT(a.`jam_mulai`, 5) AS jam_mulaix, LEFT(a.`jam_selesai`, 5) AS jam_selesaix FROM jadwal_dokter a, hari b WHERE a.`id_hari` = b.`id_hari` AND a.id_dokter = '".$id_dokter."' ORDER BY b.`id_hari`");
			$hjadwal	= $sjadwal->num_rows();
			if($hjadwal == 0){
				echo"
					<div class='data-table card'>
					<table>
						<tbody>
							<tr><td class='label-cell' colspan='2'>Jadwal Belum Tersedia</td></tr>
						</tbody>
					</table>
					</div>
				";
			}else{
				echo"
					<div class='data-table card'>
					<table>
						<thead>
							<th class='label-cell' colspan='2'><b>JADWAL DOKTER</b></th>
						</thead>
						<tbody>
				";
				foreach ($sjadwal->result_array() as $djadwal) {
					echo"
						<tr>
							<td class='label-cell'>".$djadwal['nm_hari']."</td>
							<td class='label-cell'>".$djadwal['jam_mulaix']." - ".$djadwal['jam_selesaix']."</td>
						</tr>
					";
				}
				echo"
						</tbody>
					</table>
					</div>
				";
			}
	}
	
	public function jadwal_dokter_json(){
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');
		$id_dokter	= $this->uri->segment(3);
		echo json_encode($this->m_api->getjadwal_dokter($id_dokter));
	}
	
	
	public function tambah_booking_dokter(){
		header("Access-Control-Allow-Origin:*");
		header("Access-Control-Allow-Credentials: true");
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		$post = $this->input->post();
		$id_dokter			= $this->input->post('id_dokter');
		$tanggal_booking	= $this->input->post('tanggal_booking');
		$jam_booking 		= convtime($post['jam_booking'],"to24");
		$keterangan			= $this->input->post('keterangan');
		$id_pasien			= $this->input->post('id_pasien');
		$nama_pasien		= $this->input->post('nama_pasien');
		$no_telp			= $this->input->post('no_telp');
		$status				= $this->input->post('status');

		$post_data			= array(
			"tanggal_booking"		=> $tanggal_booking,
			"jam_booking"		=> $jam_booking,
			"id_pasien"				=> $id_pasien,
			"nama_pasien"			=> $nama_pasien,
			"no_telp"				=> $no_telp,
			"id_dokter"				=> $id_dokter,
			"status"				=> $status,
			"keterangan"			=> $keterangan
		);
		$eksekusi			= $this->db->insert("booking", $post_data);
		// $eksekusi 			= $this->db->query("INSERT INTO booking (tanggal_booking, jam_booking, id_pasien, nama_pasien, no_telp, id_dokter, `status`, keterangan) VALUE ('$tanggal_booking','$jam_booking','$id_pasien','$nama_pasien','$no_telp','$id_dokter','$status','$keterangan')");
		
		$tanggal_push		= date('Y-m-d', strtotime('-1 days', strtotime($tanggal_booking)))." 07:30";
		//untuk uji coba
		//~ $tanggal_push		= "2020-10-10 02:51";
		
		//CARI TOKEN DOKTER
		// $sonok 	= $this->db->query("SELECT token FROM dokter WHERE id_dokter = '$id_dokter'");
		// $donok	= $sonok->result_array();
		$donok	= $this->db->get_where("dokter", array("id_dokter" => $id_dokter))->result_array();
		$donokpas	= $this->db->get_where("pasien", array("id_pasien" => $id_pasien))->result_array();
		
		if($eksekusi){
			echo"sukses";
			pushPesan("New Booking Notification","Tersedia booking terbaru untuk tanggal ".tgl_indo2($tanggal_booking),$donok[0]['token'], $tanggal_push);
			pushPesan("New Booking Notification","Anda memiliki jadwal Booking untuk tanggal ".tgl_indo2($tanggal_booking),$donokpas[0]['token'], $tanggal_push);
		}else{
			echo"gagal";
		}
	}

	public function tambah_booking_dokter_android(){
		header("Access-Control-Allow-Origin:*");
		header("Access-Control-Allow-Credentials: true");
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		$post = $this->input->post();
		$id_dokter			= $this->input->post('id_dokter');
		$tanggal_booking	= $this->input->post('tanggal_booking');
		$jam_booking 		= $this->input->post('jam_booking');
		$keterangan			= $this->input->post('keterangan');
		$id_pasien			= $this->input->post('id_pasien');
		$nama_pasien		= $this->input->post('nama_pasien');
		$no_telp			= $this->input->post('no_telp');
		$status				= $this->input->post('status');

		$post_data			= array(
			"tanggal_booking"		=> $tanggal_booking,
			"jam_booking"		=> $jam_booking,
			"id_pasien"				=> $id_pasien,
			"nama_pasien"			=> $nama_pasien,
			"no_telp"				=> $no_telp,
			"id_dokter"				=> $id_dokter,
			"status"				=> $status,
			"keterangan"			=> $keterangan
		);
		$eksekusi			= $this->db->insert("booking", $post_data);
		// $eksekusi 			= $this->db->query("INSERT INTO booking (tanggal_booking, jam_booking, id_pasien, nama_pasien, no_telp, id_dokter, `status`, keterangan) VALUE ('$tanggal_booking','$jam_booking','$id_pasien','$nama_pasien','$no_telp','$id_dokter','$status','$keterangan')");
		
		$tanggal_push		= date('Y-m-d', strtotime('-1 days', strtotime($tanggal_booking)))." 07:30";
		//untuk uji coba
		//~ $tanggal_push		= "2020-10-10 02:51";
		
		//CARI TOKEN DOKTER
		// $sonok 	= $this->db->query("SELECT token FROM dokter WHERE id_dokter = '$id_dokter'");
		// $donok	= $sonok->result_array();
		$donok	= $this->db->get_where("dokter", array("id_dokter" => $id_dokter))->result_array();
		$donokpas	= $this->db->get_where("pasien", array("id_pasien" => $id_pasien))->result_array();
		
		if($eksekusi){
			echo"sukses";
			pushPesan("New Booking Notification","Tersedia booking terbaru untuk tanggal ".tgl_indo2($tanggal_booking),$donok[0]['token'], $tanggal_push);
			pushPesan("New Booking Notification","Anda memiliki jadwal Booking untuk tanggal ".tgl_indo2($tanggal_booking),$donokpas[0]['token'], $tanggal_push);
		}else{
			echo"gagal";
		}
	}
	
	
	
	//API UNTUK DOKTER
	public function dok_mybooking_jumlah(){
		header('Access-Control-Allow-Origin: *');
		$id_dokter	= $this->uri->segment(3);
		$sdata 		= $this->db->query("SELECT id_booking FROM booking WHERE id_dokter = '$id_dokter'");
		echo $sdata->num_rows();
	}
	
	public function dok_mybooking()
    {
		header("Access-Control-Allow-Origin:*");
		header('Content-Type: application/json');
        //echo json_encode($this->m_api->mybooking($_GET['id']));
        $datane	= array();
        $sdata	= $this->db->query("SELECT a.*, b.`nama` AS nm_pasien, c.`nama` AS nm_dokter FROM booking a, pasien b, dokter c WHERE a.`id_pasien` = b.`id_pasien` AND a.`id_dokter` = c.`id_dokter` AND a.id_dokter = '$_GET[id]' ORDER BY a.`tanggal_booking` DESC, a.`id_booking` DESC");
        foreach ($sdata->result_array() as $ddata) {
			if($ddata['status'] == 0){
				$statuse	= "<span class='badge color-red'>Belum diproses</span>";
			}else{
				$statuse	= "<span class='badge color-green'>Selesai</span>";
			}
			array_push($datane, array(
				"id_booking"		=>$ddata['id_booking'],
				"tanggal_booking"	=>tgl_indo2($ddata['tanggal_booking'],"a"),
				"id_pasien"			=>$ddata['id_pasien'],
				"nm_pasien"			=>$ddata['nm_pasien'],
				"no_telp"			=>$ddata['no_telp'],
				"id_dokter"			=>$ddata['id_dokter'],
				"nm_dokter"			=>$ddata['nm_dokter'],
				"keterangan"		=>$ddata['keterangan'],
				"status"			=>$statuse,
			));
		}
		echo json_encode($datane);
    }
    
    public function tambah_token_dokter(){
		header("Access-Control-Allow-Origin:*");
		$id_dokter			= $this->input->post('id_dokter');
		$token				= $this->input->post('token');
		$eksekusi 			= $this->db->query("UPDATE dokter SET token = '$token' WHERE id_dokter = '$id_dokter'");
		
		if($eksekusi){
			echo"sukses";
		}else{
			echo"gagal";
		}
	}


	public function tambah_token_pasien(){
		header("Access-Control-Allow-Origin:*");
		$id_pasien			= $this->input->post('id_pasien');
		$token				= $this->input->post('token');
		$eksekusi 			= $this->db->query("UPDATE pasien SET token = '$token' WHERE id_pasien = '$id_pasien'");
		
		if($eksekusi){
			echo"sukses";
		}else{
			echo"gagal";
		}
	}
	
	public function profil_pasien(){
		$id_pasien	= trim(@$_GET['id']);
		header("Access-Control-Allow-Origin:*");
		header('Content-Type: application/json');
		$datane		= array();
		$sdata		= $this->db->get_where("pasien", array("id_pasien" => $id_pasien));
		$hdata		= $sdata->num_rows();
		if($hdata > 0){
			$ddata	= $sdata->result_array();
			echo json_encode($ddata);
		} 
	}
	
	public function edit_profil_user(){
		header("Access-Control-Allow-Origin:*");
		$post	= $this->input->post();
		$post_data	= array(
			"nama"		=> $post['nama'],
			"tempat_lahir"		=> $post['tempat_lahir'],
			"tanggal_lahir"		=> $post['tanggal_lahir'],
			"no_telp"		=> $post['no_telp'],
			"email"		=> $post['email'],
			"alamat"		=> $post['alamat'],
			"pekerjaan"		=> $post['pekerjaan']
		);
		$eksekusi	= $this->db->update("pasien", $post_data, array("id_pasien" => $post['id_pasien']));
		if($eksekusi){
			echo"sukses";
		}else{
			echo"gagal";
		}
	}

	public function tampilin_dokter_berdasarkanjadwal(){
		header("Access-Control-Allow-Origin:*");
		header('Content-Type: application/json');
		$post 				= $this->input->post();
		$tanggal_booking 	= $post['tanggal_booking'];
		$jam_booking 		= $post['jam_booking'];
		$timestamp 			= strtotime($tanggal_booking);
		$day 				= date('D', $timestamp);

		$sdata 				= $this->db->query("SELECT a.*, b.nama, c.nm_hari, c.nm_singkat, c.eng FROM jadwal_dokter a LEFT JOIN dokter b ON a.id_dokter = b.id_dokter LEFT JOIN hari c ON a.id_hari = c.id_hari WHERE c.eng = '".$day."' AND b.status = '1' AND ('".$jam_booking."' BETWEEN a.`jam_mulai` AND a.`jam_selesai`)");
		$hdata 				= $sdata->num_rows();
		if($hdata > 0){
			$ddata = $sdata->result_array();
			echo json_encode($ddata);
		}else{
			echo json_encode([["status" => "kosong"]]);
		}
	}

	public function tampilin_dokter_berdasarkanjadwal_android(){
		header("Access-Control-Allow-Origin:*");
		header('Content-Type: application/json');
		$post 				= $this->input->post();
		$tanggal_booking 	= $post['tanggal_booking'];
		$jam_booking 		= $post['jam_booking'];
		$timestamp 			= strtotime($tanggal_booking);
		$day 				= date('D', $timestamp);

		$sdata 				= $this->db->query("SELECT a.*, b.nama, c.nm_hari, c.nm_singkat, c.eng FROM jadwal_dokter a LEFT JOIN dokter b ON a.id_dokter = b.id_dokter LEFT JOIN hari c ON a.id_hari = c.id_hari WHERE c.eng = '".$day."' AND b.status = '1' AND ('".$jam_booking."' BETWEEN a.`jam_mulai` AND a.`jam_selesai`)");
		$hdata 				= $sdata->num_rows();
		if($hdata > 0){
			$ddata = $sdata->result_array();
			echo json_encode($ddata);
		}else{
			echo json_encode([["status" => "kosong"]]);
		}
	}

	function ceksudahbookingdokter(){
		header("Access-Control-Allow-Origin:*");
		header('Content-Type: application/json');
		$post 				= $this->input->post();
		$tanggal_booking 	= $post['tanggal_booking'];
		$id_dokter 			= $post['id_dokter'];
		$jam_booking 		= convtime($post['jam_booking'],"to24");
		$timestamp 			= strtotime($tanggal_booking);
		$day 				= date('D', $timestamp);

		$ddokter = $this->db->get_where("dokter", array("id_dokter" => $id_dokter))->result_array();

		$sdata = $this->db->get_where("booking", array("tanggal_booking" => $tanggal_booking, "jam_booking" => $jam_booking, "id_dokter" => $id_dokter));
		$hdata = $sdata->num_rows();
		if($hdata > 0){
			echo json_encode([["status" => "ada", "token" => $ddokter[0]['token'], "nm_dokter" => $ddokter[0]['nama']]]);
		}else{
			echo json_encode([["status" => "kosong", "token" => $ddokter[0]['token'], "nm_dokter" => $ddokter[0]['nama']]]);
		}
	}

	function ceksudahbookingdokterandroid(){
		header("Access-Control-Allow-Origin:*");
		header('Content-Type: application/json');
		$post 				= $this->input->post();
		$tanggal_booking 	= $post['tanggal_booking'];
		$id_dokter 			= $post['id_dokter'];
		$jam_booking 		= $post['jam_booking'];
		$timestamp 			= strtotime($tanggal_booking);
		$day 				= date('D', $timestamp);

		$ddokter = $this->db->get_where("dokter", array("id_dokter" => $id_dokter))->result_array();

		$sdata = $this->db->get_where("booking", array("tanggal_booking" => $tanggal_booking, "jam_booking" => $jam_booking, "id_dokter" => $id_dokter));
		$hdata = $sdata->num_rows();
		if($hdata > 0){
			echo json_encode([["status" => "ada", "token" => $ddokter[0]['token'], "nm_dokter" => $ddokter[0]['nama']]]);
		}else{
			echo json_encode([["status" => "kosong", "token" => $ddokter[0]['token'], "nm_dokter" => $ddokter[0]['nama']]]);
		}
	}

	public function jambok(){
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json');
		$mboh = $this->db->query("SELECT *, LEFT(nm_jambok, 5) AS waktu FROM jambok ORDER BY nm_jambok")->result_array();
		echo json_encode($mboh);
	}

	public function cekrekam(){
		header('Access-Control-Allow-Origin: *');
		$post = $this->input->post();
		$ceking = $this->db->get_where("pasien", ["no_rekam_medis" => $post['no_rekam_medis']])->num_rows();
		if($ceking > 0){
			echo "ketemu";
		}else{
			echo "tidak";
		}
	}
}

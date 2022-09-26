<?php
header('Access-Control-Allow-Origin: *');
defined('BASEPATH') or exit('No direct script access allowed');

class M extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library("FirexGanteng");
		$this->load->model('master');
		$this->load->model('Mlogin');
	}


	public function index()
	{
		$this->load->view('m');
	}

	function user($kondisi = "")
	{
		if ($kondisi == "admin") {
			$this->load->view('m/admin/user/admin');
		} else if ($kondisi == "staf") {
			$this->load->view('m/admin/user/staf');
		} else if ($kondisi == "dokter") {
			$this->load->view('m/admin/user/dokter');
		}else if ($kondisi == "perawat") {
			$this->load->view('m/admin/user/perawat');
		}else if ($kondisi == "pasien") {
			$this->load->view('m/admin/user/pasien');
		} else {
			$this->load->view('errors/404');
		}
	}
	
	function jadwaldok($kondisi = "")
	{
		if (empty($kondisi)){
			$this->load->view('m/staf/jadwal/data');
		}else if($kondisi == "edit") {
			$this->load->view('m/staf/jadwal/edit');
		} else {
			$this->load->view('errors/404');
		}
	}
	
	function booking($kondisi = "")
	{
		if (empty($kondisi)){
			$this->load->view('m/staf/booking/data');
		}else if($kondisi == "tambah") {
			$this->load->view('m/staf/booking/tambah');
		}else if($kondisi == "tambah-umum") {
			$this->load->view('m/staf/booking/tambah_umum');
		} else {
			$this->load->view('errors/404');
		}
	}
	
	function antrian($kondisi = "")
	{
		if (empty($kondisi)){
			$this->load->view('m/staf/antrian/data');
		}else if($kondisi == "tambah") {
			$this->load->view('m/staf/antrian/tambah');
		} else {
			$this->load->view('errors/404');
		}
	}
	
	public function user_adminbyid()
    {
        echo json_encode($this->master->getuser_admin($_POST['id']));
    }
    public function user_stafbyid()
    {
        echo json_encode($this->master->getuser_staf($_POST['id']));
    }
    public function user_dokterbyid()
    {
        echo json_encode($this->master->getuser_dokter($_POST['id']));
    }
    public function user_perawatbyid()
    {
        echo json_encode($this->master->getuser_perawat($_POST['id']));
    }
    public function user_pasienbyid()
    {
        echo json_encode($this->master->getuser_pasien($_POST['id']));
    }
    
   
    
	function ajax($kondisi = "")
	{
		if ($kondisi == "jadwal-dokter") {
			$id_dokter	= $this->uri->segment(4);
			$sjadwal = $this->db->query("SELECT a.*, b.`nm_hari`, b.`nm_singkat`, LEFT(a.`jam_mulai`, 5) AS jam_mulaix, LEFT(a.`jam_selesai`, 5) AS jam_selesaix FROM jadwal_dokter a, hari b WHERE a.`id_hari` = b.`id_hari` AND a.id_dokter = '".$id_dokter."' ORDER BY b.`id_hari`");
			$hjadwal	= $sjadwal->num_rows();
			if($hjadwal == 0){
				echo"
					<table class='table table-hover table-stripted table-bordered'>
						<tbody>
							<tr><td colspan='2'><span class='badge badge-danger'>Jadwal Belum Tersedia</span></td></tr>
						</tbody>
					</table>
				";
			}else{
				echo"
					<table class='table table-hover table-stripted table-bordered'>
						<tbody>
				";
				foreach ($sjadwal->result_array() as $djadwal) {
					echo"
						<tr>
							<td>".$djadwal['nm_hari']."</td>
							<td class='font-weight-bold'>".$djadwal['jam_mulaix']." - ".$djadwal['jam_selesaix']."</td>
						</tr>
					";
				}
				echo"
						</tbody>
					</table>
				";
			}
		}
		
		
		
		else if ($kondisi == "jadwal-dokter-json") {
			$id_dokter	= $this->uri->segment(4);
			echo json_encode($this->master->getjadwal_dokter($id_dokter));
		}else if($kondisi == "pasien-keypress"){
			header("Content-Type: application/json; charset=UTF-8");
			$no_rekam_medis	= $this->uri->segment(4);
			if(empty($no_rekam_medis)){
				$datane	= array();
				$sdata 	= $this->db->query("SELECT * FROM pasien ORDER BY no_rekam_medis");
				foreach ($sdata->result_array() as $ddata) {
					array_push($datane, array(
					  "id_pasien"		=>$ddata['id_pasien'],
					  "no_rekam_medis"	=>$ddata['no_rekam_medis'],
					  "nama"			=>$ddata['nama'],
					));
				}
				echo json_encode($datane);
			}else{
				$datane			= array();
				$sdata 			= $this->db->query("SELECT * FROM pasien WHERE no_rekam_medis = '$no_rekam_medis'");
				foreach ($sdata->result_array() as $ddata) {
					array_push($datane, array(
					  "id_pasien"		=>$ddata['id_pasien'],
					  "no_rekam_medis"	=>$ddata['no_rekam_medis'],
					  "nama"			=>$ddata['nama'],
					));
				}
				echo json_encode($datane);
			}
		}else if($kondisi == "andro-login-pasien"){
			header("Content-Type: application/json; charset=UTF-8");
			$username	= $this->input->post('username');
			$password	= $this->input->post('password');
			$user 		= $this->Mlogin->get($username, "pasien");
			$datane		= array();
			if (empty($user)) {
				array_push($datane, array(
					"login_stat" 	=> "gagal",
					"login_pesan" 	=> "Username tidak ditemukan!"
				));
			} else {
				if (password_verify($password, $user->password)) {
					array_push($datane, array(
					  "login_stat"		=> "sukses",
					  "login_pesan"		=> "Login berhasil...",
					  "id_pasien"		=> $user->id_pasien,
					  "no_rekam_medis"	=> $user->no_rekam_medis,
					  "nama"			=> $user->nama,
					  "username"		=> $user->username,
					  "email"			=> $user->email,
					  "alamat"			=> $user->alamat,
					  "tanggal_lahir"	=> $user->tanggal_lahir,
					  "no_telp"			=> $user->no_telp
					));
				} else {
					array_push($datane, array(
						"login_stat" 	=> "gagal", 
						"login_pesan" 	=> "Username dan password tidak cocok!"
					));
				}
			}
			echo json_encode($datane);
		}else if($kondisi == "andro-login-dokter"){
			header("Content-Type: application/json; charset=UTF-8");
			$username	= $this->input->post('username');
			$password	= $this->input->post('password');
			$user 		= $this->Mlogin->get($username, "dokter");
			$datane		= array();
			if (empty($user)) {
				array_push($datane, array(
					"login_stat" 	=> "gagal",
					"login_pesan" 	=> "Username tidak ditemukan!"
				));
			} else {
				if (password_verify($password, $user->password)) {
					array_push($datane, array(
					  "login_stat"		=> "sukses",
					  "login_pesan"		=> "Login berhasil...",
					  "id_dokter"		=> $user->id_dokter,
					  "nama"			=> $user->nama,
					  "username"		=> $user->username,
					  "email"			=> $user->email,
					  "alamat"			=> $user->alamat,
					  "tempat_lahir"	=> $user->tempat_lahir,
					  "tanggal_lahir"	=> $user->tanggal_lahir,
					  "no_telp"			=> $user->no_telp
					));
				} else {
					array_push($datane, array(
						"login_stat" 	=> "gagal", 
						"login_pesan" 	=> "Username dan password tidak cocok!"
					));
				}
			}
			echo json_encode($datane);
		}else {
			$this->load->view('errors/404');
		}
	}
	
}

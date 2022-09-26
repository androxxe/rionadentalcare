<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_api extends CI_Model
{
    public function mybooking($id)
    {
        //return $this->db->get_where('jenjang', array('id_jenjanggrup' => $id))->result();
        return $this->db->query("SELECT a.*, b.`nama` AS nm_pasien, c.`nama` AS nm_dokter FROM booking a, pasien b, dokter c WHERE a.`id_pasien` = b.`id_pasien` AND a.`id_dokter` = c.`id_dokter` AND a.id_pasien = '$id' ORDER BY a.`tanggal_booking` DESC, a.`id_booking` DESC")->result();
    }

    public function data_dokter()
    {
        //~ return $this->db->get('dokter')->result();
        return $this->db->get_where('dokter', array('status' => '1'))->result();
    }
	
	public function getjadwal_dokter($id)
    {
		$this->db->select('id_jadwal, id_dokter, id_hari, jam_mulai, jam_selesai');
        return $this->db->get_where('jadwal_dokter', array('id_dokter' => $id))->result();
    }
}

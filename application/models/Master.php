<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Model
{
    public function getuser($id)
    {
        return $this->db->get_where('tv_user', array('id_user' => $id))->result();
    }
    
    public function getuser_admin($id)
    {
        return $this->db->get_where('admin', array('id_admin' => $id))->result();
    }
    public function getuser_staf($id)
    {
        return $this->db->get_where('staf', array('id_staf' => $id))->result();
    }
    public function getuser_dokter($id)
    {
        return $this->db->get_where('dokter', array('id_dokter' => $id))->result();
    }
    public function getuser_perawat($id)
    {
        return $this->db->get_where('perawat', array('id_perawat' => $id))->result();
    }
    public function getuser_pasien($id)
    {
        return $this->db->get_where('pasien', array('id_pasien' => $id))->result();
    }
    public function getjadwal_dokter($id)
    {
		$this->db->select('id_jadwal, id_dokter, id_hari, jam_mulai, jam_selesai');
        return $this->db->get_where('jadwal_dokter', array('id_dokter' => $id))->result();
    }


}

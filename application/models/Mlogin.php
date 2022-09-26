<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mlogin extends CI_Model
{
    public function get($username, $level)
    {
		if($level == "admin"){
			$this->db->where('username', $username);
			$result = $this->db->get('admin')->row();
			return $result;
		}else if($level == "staf"){
			$this->db->where('username', $username);
			$result = $this->db->get('staf')->row();
			return $result;
		}else if($level == "dokter"){
			$this->db->where('username', $username);
			$result = $this->db->get('dokter')->row();
			return $result;
		}else if($level == "perawat"){
			$this->db->where('username', $username);
			$result = $this->db->get('perawat')->row();
			return $result;
		}else if($level == "pasien"){
			$this->db->where('username', $username);
			$result = $this->db->get('pasien')->row();
			return $result;
		}
        
    }
}

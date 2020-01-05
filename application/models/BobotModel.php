<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BobotModel extends CI_Model {

    public function view() {
        return $this->db->select('bobot, nilai')->from('tbl_bobot')->order_by('bobot', 'DESC')->get()->result();
    }

    public function detail($bobot) {
        return $this->db->select('bobot, nilai')->from('tbl_bobot')->where('bobot', $bobot)->order_by('bobot', 'DESC')->get()->result();
    }
    
}

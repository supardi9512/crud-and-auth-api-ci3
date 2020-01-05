<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BobotModel extends CI_Model {

    public function view() {
        return $this->db->select('bobot, nilai')->from('tbl_bobot')->order_by('bobot', 'DESC')->get()->result();
    }

    public function detail($bobot) {
        return $this->db->select('bobot, nilai')->from('tbl_bobot')->where('bobot', $bobot)->order_by('bobot', 'DESC')->get()->result();
    }

    public function create($data) {
        $this->db->insert('tbl_bobot', $data);
        return ['status' => 201, 'message' => 'Data has been created'];
    }

    public function update($bobot, $data) {
        $this->db->where('bobot', $bobot)->update('tbl_bobot', $data);
        return ['status' => 201, 'message' => 'Data has been updated'];
    }

    public function delete($bobot) {
        $this->db->where('bobot', $bobot)->delete('tbl_bobot');
        return ['status' => 201, 'message' => 'Data has been deleted'];
    }
    
}

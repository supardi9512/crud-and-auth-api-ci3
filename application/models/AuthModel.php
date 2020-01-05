<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

    // variabel untuk request data menggunakan json
    var $client_service = "bagicode-client";
    var $auth_key = "simplerestapi";

    public function check_auth_client() {
        // untuk mengambil header (client service dan auth key) saat ada sesuatu request ke fungsi ini
        $input_client_service = $this->input->get_request_header('Client_Service', TRUE);
        $input_auth_key = $this->input->get_request_header('Auth_Key', TRUE);
        // akan dicocokkan, jika sama akan menjalankan proses, jika tidak tampilkan error
        if($input_client_service == $this->client_service && $input_auth_key == $this->auth_key) {
            return TRUE;
        } else {
            return json_output(401, ['status' => 401, 'message' => 'Unauthorized Headers']);
        }
    }
    
    public function auth() {
        // untuk mengambil header (client service dan auth key) saat ada sesuatu request ke fungsi ini
        $users_id = $this->input->get_request_header('User-ID', TRUE);
        $token = $this->input->get_request_header('Authorization', TRUE);
        if($users_id == "") {
            return ['status' => 204, 'message' => 'Unauthorized Headers'];
        } elseif($token == "") {
            return ['status' => 204, 'message' => 'Unauthorized Headers'];
        } else {
            // mengecek token sudah expired atau belum
            $q = $this->db->select('expired_at')->from('tbl_users_authentication')->where('users_id', $users_id)->where('token', $token)->get()->row();
            if($q == "") {
                return ['status' => 401, 'message' => 'Unauthorized'];
            } else {
                if($q->expired_at < date('Y-m-d H:i:s')) {
                    return ['status' => 401, 'message' => 'Your session has been expired'];
                } else {
                    $updated_at = date('Y-m-d H:i:s');
                    $expired_at = date('Y-m-d H:i:s', strtotime('+12 hours'));
                    $this->db->where('users_id', $users_id)->where('token', $token)->update('tbl_users_authentication', ['expired_at' => $expired_at, 'updated_at' => $updated_at]);
                    return ['status' => 200, 'message' => 'Authorized'];
                }
            }
        }
    }
}

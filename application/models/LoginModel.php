<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModel extends CI_Model {

    public function login($username, $password) {
        // mengecek username dengan database
        $q = $this->db->select('password, id, nim')->from('tbl_users')->where('username', $username)->get()->row();
        if($q == "") {
            return ['status' => 204, 'message' => 'Username not found'];
        } else {
            $hashed_password    = $q->password;
            $id                 = $q->id;
            $nim                = $q->nim;

            $passwordMD5 = substr(md5($password), 0, 32);

            // mengecek password input dengan database
            if(hash_equals($hashed_password, $passwordMD5)) {
                $last_login = date('Y-m-d H:i:s'); // membuat last login
                $token = substr(md5(rand()), 0, 7); // membuat token untuk user dapat mengakses fungsi selanjutnya
                $expired_at = date('Y-m-d H:i:s', strtotime('+12 hours'));

                $this->db->trans_start();
                $this->db->where('id', $id)->update('tbl_users', ['last_login' => $last_login]);
                $this->db->insert('tbl_users_authentication', ['users_id' => $id, 'token' => $token, 'expired_at' => $expired_at]);

                // jika insert gagal tampilkan error, jika berhasil tampilkan sukses
                if($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    return ['status' => 500, 'message' => 'Internal server error'];
                } else {
                    $this->db->trans_commit();
                    return ['status' => 200, 'message' => 'Successfully login', 'id' => $id, 'token' => $token, 'nim' => $nim];
                }
            } else {
                return ['status' => 204, 'message' => 'Wrong password'];
            }
        }
    }
    
    public function logout() {
        // untuk mengambil header (client service dan auth key) saat ada sesuatu request ke fungsi ini
        $users_id = $this->input->get_request_header('User-ID', TRUE);
        $token = $this->input->get_request_header('Authorization', TRUE);
        if($users_id == "") {
            return ['status' => 204, 'message' => 'Headers ID is NULL'];
        } elseif($token == "") {
            return ['status' => 204, 'message' => 'Headers Auth is NULL'];
        } else {
            $this->db->where('users_id', $users_id)->where('token', $token)->delete('tbl_users_authentication');
            return ['status' => 200, 'message' => 'Successfully logout'];
        }
    }
    
}

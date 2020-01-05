<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bobot extends CI_Controller {

	public function index() {

    }
    
    public function view() {
        $method = $_SERVER['REQUEST_METHOD'];
        // jika fungsi bukan GET tampilkan error
        if($method != 'GET') {
            json_output(400, ['status' => 400, 'message' => 'Bad request']);
        } else { // jika GET
            // mengecek haeder
            $check_auth_client = $this->AuthModel->check_auth_client();
            // jika bernilai true
            if($check_auth_client == TRUE) {
                // mengecek token dan user id
                $response = $this->AuthModel->auth();
                // jika valid
                if($response['status'] == 200) {
                    $resp = $this->BobotModel->view();
                    json_output($response['status'], $resp);
                } else {
                    json_output($response['status'], $response);
                }
            }
        }
    }

    public function detail($bobot = '') {
        $method = $_SERVER['REQUEST_METHOD'];
        // jika fungsi bukan GET tampilkan error
        if($method != 'GET') {
            json_output(400, ['status' => 400, 'message' => 'Bad request']);
        } elseif($bobot == '') {
            json_output(401, ['status' => 401, 'message' => 'Unauthorized Value']);
        } else { // jika GET
            // mengecek haeder
            $check_auth_client = $this->AuthModel->check_auth_client();
            // jika bernilai true
            if($check_auth_client == TRUE) {
                // mengecek token dan user id
                $response = $this->AuthModel->auth();
                // jika valid
                if($response['status'] == 200) {
                    $resp = $this->BobotModel->detail($bobot);
                    json_output($response['status'], $resp);
                } else {
                    json_output($response['status'], $response);
                }
            }
        }
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index() {

    }
    
    public function signin() {
        // mengecek request dari method
        $method = $_SERVER['REQUEST_METHOD'];
        // jika menggunakan method selain POST tampilkan error
        // jika method POST jalankan fungsi selanjutnya
        if($method != 'POST') {
            json_output(400, ['status' => 400, 'message' => 'Bad Request']); 
        } else {
            // menampung fungsi AuthModel
            $check_auth_client = $this->AuthModel->check_auth_client();
            // jika berhasil jalankan fungsi
            if($check_auth_client == TRUE) {
                // menampung input berdasarkan json
                $params = json_decode(file_get_contents('php://input'), TRUE);
                $username = $params['username'];
                $password = $params['password'];

                // memanggil LoginModel
                $response = $this->LoginModel->login($username, $password);
                json_output($response['status'], $response);
            }
        }
    }

    public function signout() {
        // mengecek request dari method
        $method = $_SERVER['REQUEST_METHOD'];
        // jika menggunakan method selain POST tampilkan error
        // jika method POST jalankan fungsi selanjutnya
        if($method != 'POST') {
            json_output(400, ['status' => 400, 'message' => 'Bad Request']); 
        } else {
            // menampung fungsi AuthModel
            $check_auth_client = $this->AuthModel->check_auth_client();
            // jika berhasil jalankan fungsi
            if($check_auth_client == TRUE) {
                // memanggil LoginModel
                $response = $this->LoginModel->logout();
                json_output($response['status'], $response);
            }
        }
    }
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>API SIAKAD BY BAGICODE</title>

  <style type="text/css">

  ::selection { background-color: #E13300; color: white; }
  ::-moz-selection { background-color: #E13300; color: white; }

  body {
    background-color: #fff;
    margin: 40px;
    font: 13px/20px normal Helvetica, Arial, sans-serif;
    color: #4F5155;
  }

  a {
    color: #003399;
    background-color: transparent;
    font-weight: normal;
  }

  h1 {
    color: #444;
    background-color: transparent;
    border-bottom: 1px solid #D0D0D0;
    font-size: 19px;
    font-weight: normal;
    margin: 0 0 14px 0;
    padding: 14px 15px 10px 15px;
  }

  code {
    font-family: Consolas, Monaco, Courier New, Courier, monospace;
    font-size: 12px;
    background-color: #f9f9f9;
    border: 1px solid #D0D0D0;
    color: #002166;
    display: block;
    margin: 14px 0 14px 0;
    padding: 12px 10px 12px 10px;
  }

  #body {
    margin: 0 15px 0 15px;
  }

  p.footer {
    text-align: right;
    font-size: 11px;
    border-top: 1px solid #D0D0D0;
    line-height: 32px;
    padding: 0 10px 0 10px;
    margin: 20px 0 0 0;
  }

  #container {
    margin: 10px;
    border: 1px solid #D0D0D0;
    box-shadow: 0 0 8px #D0D0D0;
  }
  </style>
</head>
<body>

<div id="container">
  <h1>Welcome to API</h1>
  <div id="body">
    <p>API SIAKAD merupakan sebuah layanan yang menyediakan informasi data yang ada di Aplikasi SIAKAD. Data ini mencakup semua bidang yang ada di Akademik seperti nilai ujian, data mahasiswa, data dosen, dll. Para pengembang aplikasi dapat menggunakan API ini sesuai kebutuhan development.</p>

    <p>Untuk pengaksesan API user akan diberikan token, dimana token ini hanya akan aktif 24 Jam. Sehingga user harus membuat kembali token jika token telah memasuki masa aktif (Kadaluarsa).</p>

    <code>Authorization : "Token_Anda"</code>

    <p>Untuk setiap Akses API kita juga menggunakan Header sebagai berikut :</p>
    <code>
        Client_Service : bagicode-client</br>
        Auth_Key : simplerestapi</br>
        Content-Type : application/json</br>
    </code>

    <p>Agar lebih Paham, kami akan menguraikannya satu per satu.</p>
    <code>
        [POST] /login/signin json { "username" : "admin", "password" : "Admin123$"}</br>
        [GET] /mahasiswa</br>
        [POST] /mahasiswa/create json { "title" : "x", "author" : "xx"}</br>
        [PUT] /mahasiswa/update/:id json { "title" : "y", "author" : "yy"}</br>
        [GET] /mahasiswa/view</br>
        [GET] /mahasiswa/detail/:id</br>
        [DELETE] /mahasiswa/delete/:id</br>
        [POST] /login/signout</br>
    </code>

    <p>Untuk mengakses API Mahasiswa dan Logout, kita harus menambahkan header dengan</p>
    <code>
        User-ID : "ID USER"</br>
        Authorization : "Token yang didapatkan setelah Login"</br>
    </code>
  </div>
</div>

<div class="row">
  <div id="container" >
  <h1>Contoh /login/signin</h1> 
  <div id="body">
  <p>Value Method :</p>
    <code>
        Post
    </code>
    <p>Value Header :</p>
    <code>
        Client_Service : bagicode-client</br>
        Auth_Key : simplerestapi</br>
        Content-Type : application/json</br>
    </code>
    <p>Value Body :</p>
    <code>
        {</br>
            <font color="red">"username"</font>:<font color="blue">"user"</font>,</br>
            <font color="red">"password"</font>:<font color="blue">"admin123"</font></br>
        }</br>
    </code>
    <p>Value Output is True :</p>
    <code>
        {</br>
            <font color="red">"status"</font>: 200,</br>
            <font color="red">"message"</font>: <font color="blue">"Successfully login."</font>,</br>
            <font color="red">"id"</font>: <font color="blue">"2"</font>,</br>
            <font color="red">"token"</font>: <font color="blue">"$1$iHtHl3.k$9HFYIH9dbFtR6mn1jqCCg0"</font></br>
        }</br>
    </code>
    <p>Value Output is False :</p>
    <code>
        {</br>
            <font color="red">"status"</font>: 204,</br>
            <font color="red">"message"</font>: <font color="blue">"Username not Found."</font>,</br>
        }</br>
    </code>
  </div>
</div>

<div id="container">
  <div id="body"><p align="center">Copyright 2017 By <a href="bagicode.com">Bagicode</p></div>
  <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>
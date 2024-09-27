<?php
defined('BASEPATH') or exit('No direct script access allowed');

function is_logged_in()
{
    // Mengambil instance dari CodeIgniter
    $ci = get_instance();

    // Mengecek apakah pengguna sudah login
    if (!$ci->session->userdata('email')) {
        // Jika belum login, redirect ke halaman auth
        redirect('auth');
    }
}

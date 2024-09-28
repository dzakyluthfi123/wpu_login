<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Role_model'); // Memastikan model di-load
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Role Management';
        $data['roles'] = $this->Role_model->getRoles(); // Ambil data role

        // Load view untuk role management
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('role/index', $data); // Pastikan nama file view benar
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            // Kembali ke halaman index jika validasi gagal
            $this->index();
        } else {
            // Jika validasi berhasil, cek apakah role sudah ada
            $roleName = $this->input->post('role');

            // Cek apakah role sudah ada
            $existingRole = $this->Role_model->getRoleByName($roleName);

            if ($existingRole) {
                // Jika role sudah ada, set flashdata untuk pesan error
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Role already exists!</div>');
                redirect('role'); // Redirect ke halaman role
            } else {
                // Jika role belum ada, tambah role ke database
                $roleData = [
                    'role' => $roleName
                ];
                $this->db->insert('roles', $roleData);
                // Set flashdata untuk pesan sukses
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New role added!</div>');
                redirect('role'); // Redirect ke halaman role
            }
        }
    }
}

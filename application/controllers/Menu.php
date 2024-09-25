<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Menu Management';
        // Mengambil data user berdasarkan email di session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        // Mengambil seluruh data menu dari tabel user_menu
        $data['menu'] = $this->db->get('user_menu')->result_array();

        // Validasi input menu
        $this->form_validation->set_rules('menu', 'Menu', 'required|trim');

        if ($this->form_validation->run() == false) {
            // Load view jika validasi gagal
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            // Menyimpan data menu baru
            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            // Menampilkan pesan sukses setelah berhasil menyimpan
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added successfully!</div>');
            redirect('menu');
        }
    }

    public function submenu()
    {
        $data['title'] = 'SubMenu Management';
        // Mengambil data user berdasarkan email di session
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Menggunakan model Menu_model untuk mengambil data submenu
        $this->load->model('Menu_model', 'menu');
        $data['subMenu'] = $this->menu->getSubMenu();
        // Mengambil data menu utama
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->form_validation->set_rules('title', 'Title', 'required|trim');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required|trim');
        $this->form_validation->set_rules('url', 'URL', 'required|trim');
        $this->form_validation->set_rules('icon', 'icon', 'required|trim');

        // Load view submenu
        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New sub menu added successfully!</div>');
            redirect('menu/submenu');
        }
    }
}

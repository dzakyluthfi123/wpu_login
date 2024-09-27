<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load the Menu_model to use its functions
        $this->load->model('Menu_model'); // Harus sesuai dengan nama model
        $this->load->library('form_validation');
    }

    public function index()
    {
        // Set title dan ambil data user yang login
        $data['title'] = 'Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Ambil data menu dari model
        $data['menu'] = $this->Menu_model->getMenu();

        // Set validasi form untuk menambah menu baru
        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            // Load views jika validasi gagal
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            // Jika validasi berhasil, panggil metode addMenu di model
            $this->Menu_model->addMenu([
                'menu' => $this->input->post('menu') // Data yang akan dimasukkan ke database
            ]);

            // Set flashdata untuk pesan sukses
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New menu added!</div>');
            redirect('menu');
        }
    }





    public function submenu()
    {
        // Set title and fetch logged-in user info
        $data['title'] = 'Submenu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        // Fetch submenu and menu data from the model
        $data['subMenu'] = $this->Menu_model->getSubMenu(); // Harus menggunakan model yang sudah di-load
        $data['menu'] = $this->Menu_model->getMenu();

        // Set form validation rules
        $this->form_validation->set_rules('title', 'Submenu Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        // If validation fails, load the views
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            // If validation succeeds, insert new submenu into the database
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active', true) ? 1 : 0 // Set default is_active to 0 if not checked
            ];

            $this->db->insert('user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New submenu added!</div>');
            redirect('menu/submenu');
        }
    }
}

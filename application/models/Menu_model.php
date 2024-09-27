<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    // Ambil semua data menu dari tabel 'user_menu'
    public function getMenu()
    {
        return $this->db->get('user_menu')->result_array();
    }

    // Tambahkan menu baru ke dalam tabel 'user_menu'
    public function addMenu($data)
    {
        $this->db->insert('user_menu', $data);
    }

    // Ambil semua data sub-menu dari tabel 'user_sub_menu'
    public function getSubMenu()
    {
        // Menjalankan join antara tabel user_sub_menu dan user_menu untuk mendapatkan nama menu terkait
        $this->db->select('user_sub_menu.*, user_menu.menu');
        $this->db->from('user_sub_menu');
        $this->db->join('user_menu', 'user_sub_menu.menu_id = user_menu.id');
        return $this->db->get()->result_array();
    }
}

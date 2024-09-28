<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role_model extends CI_Model
{

    // Tambah role baru
    public function addRole($data)
    {
        return $this->db->insert('roles', $data);
    }

    // Hapus role berdasarkan ID
    public function deleteRole($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('roles');
    }

    // Ambil role berdasarkan ID
    public function getRoleById($id)
    {
        return $this->db->get_where('roles', ['id' => $id])->row_array();
    }

    // Update role berdasarkan ID
    public function updateRole($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('roles', $data);
    }

    public function getRoles()
    {
        return $this->db->get('roles')->result_array(); // Mengambil semua data dari tabel roles
    }

    public function getRoleByName($role)
    {
        return $this->db->get_where('roles', ['role' => $role])->row_array(); // Cek apakah role ada
    }
}

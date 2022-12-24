<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Create By ARYO
 */
class Mod_admin extends CI_Model
{
    public function count_all()
    {

        $this->db->from('aplikasi');
        return $this->db->count_all_results();
    }
    public function admin()
    {
        $query = $this->db->query("
        select * from tbl_user where id_level = '1'
        ");
        return $query;
    }
    public function kecamatan()
    {
        $query = $this->db->query("
        select * from kecamatan
        ");
        return $query->result();
    }
    public function kelurahan()
    {
        $query = $this->db->query("
        select * from kelurahan
        ");
        return $query->result();
    }
    public function kategori()
    {
        $query = $this->db->query("
        select * from kategori_kasur
        ");
        return $query->result();
    }

    public function tempat_industri()
    {
        $query = $this->db->query("
        select * from tempat_industri
        ");
        return $query->result();
    }
    public function industri($id)
    {
        $query = $this->db->query("
        select * from tempat_industri where id_industri = '$id'
        ");
        return $query->row_array();
    }

    public function serach_tempat($tempat)
    {
        $query = $this->db->query("
        select * from tempat_industri where nama_industri like '%$tempat%'
        ");
        return $query->result_array();
    }

    public function serach_kategori($tempat)
    {
        $query = $this->db->query("
        select * from kategori_kasur where merek_kasur like '%$tempat%'
        ");
        return $query->result_array();
    }
}

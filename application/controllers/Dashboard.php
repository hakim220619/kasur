<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_aplikasi');
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->helper('myfunction_helper');

        // backButtonHandle();
    }

    function index()
    {
        $nis = $this->db->get_where('tbl_user', ['id_user' => $this->session->userdata('id_user')])->row_array();
        $data['detail'] = $nis;
        $data['tot_tempat'] = $this->Mod_aplikasi->totindustri()->result_array();
        $data['tot_user'] = $this->Mod_aplikasi->totuser()->result_array();
        $data['tot_ktg'] = $this->Mod_aplikasi->totkategori()->result_array();
        // dead($data['tot_tempat']);
        // dead($data['anggota']);
        $logged_in = $this->session->userdata('logged_in');
        if ($logged_in != TRUE || empty($logged_in)) {
            redirect('login');
        } else {
            $this->template->load('layoutbackend', 'dashboard/dashboard', $data);
        }
    }
}
/* End of file Controllername.php */

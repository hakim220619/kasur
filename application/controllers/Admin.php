<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mod_admin');
        $this->load->model('Mod_user');
        $this->load->library('fungsi');
        $this->load->library('user_agent');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function user_data()
    {
        $data['title'] = "User Data";
        $data['user_level'] = $this->Mod_user->userlevel();
        $data['user'] = $this->Mod_admin->admin()->result();
        // dead($data);
        $this->template->load('layoutbackend', 'admin/user_data', $data);
    }
    public function insert_admin()
    {
        // var_dump($this->input->post('username'));
        $this->_validate();
        $username = $this->input->post('username');
        $cek = $this->Mod_user->cekUsername($username);
        if ($cek->num_rows() > 0) {
            echo json_encode(array("error" => "Username Sudah Ada!!"));
        } else {
            $nama = slug($this->input->post('username'));
            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'id_level'  => $this->input->post('level'),
                    'tlp'  => $this->input->post('tlp'),
                    'is_active' => $this->input->post('is_active'),
                    'image' => $gambar['file_name']
                );
                // dead($save);
                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/user_data');
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );

                $this->Mod_user->insertUser("tbl_user", $save);
                redirect('admin/user_data');
            }
        }
    }

    public function update_admin()
    {
        if (!empty($_FILES['imagefile']['name'])) {
            // $this->_validate();
            $id = $this->input->post('id_user');

            $nama = slug($this->input->post('username'));

            $config['upload_path']   = './assets/foto/user/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();
                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),
                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'id_level'  => $this->input->post('level'),
                        'tlp'  => $this->input->post('tlp'),
                        'is_active' => $this->input->post('is_active'),
                        'image' => $gambar['file_name']
                    );
                }
                // dead($save);

                $g = $this->Mod_user->getImage($id)->row_array();

                if ($g != null) {
                    //hapus gambar yg ada diserver
                    unlink('assets/foto/user/' . $g['image']);
                }

                $this->Mod_user->updateUser($id, $save);
                redirect('admin/user_data');
            } else { //Apabila tidak ada gambar yang di upload

                //Jika Password tidak kosong
                if ($this->input->post('password')) {
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'password'  => get_hash($this->input->post('password')),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                } else { //Jika password kosong
                    $save  = array(
                        'username' => $this->input->post('username'),
                        'full_name' => $this->input->post('full_name'),
                        'tlp'  => $this->input->post('tlp'),
                        'id_level'  => $this->input->post('level'),
                        'is_active' => $this->input->post('is_active')
                    );
                }
                // dead($save);
                $this->Mod_user->updateUser($id, $save);
                redirect('admin/user_data');
            }
        } else {
            $this->_validate();
            $id_user = $this->input->post('id_user');
            if ($this->input->post('password')) {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'password'  => get_hash($this->input->post('password')),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            } else {
                $save  = array(
                    'username' => $this->input->post('username'),
                    'full_name' => $this->input->post('full_name'),
                    'tlp'  => $this->input->post('tlp'),
                    'id_level'  => $this->input->post('level'),
                    'is_active' => $this->input->post('is_active')
                );
            }
            // dead($save);
            $this->Mod_user->updateUser($id_user, $save);
            redirect('admin/user_data');
        }
    }

    public function del_admin()
    {
        $id = $this->input->get('id_user');
        $g = $this->Mod_user->getImage($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/user/' . $g['image']);
        }
        $this->db->delete('tbl_user', array('id_user' => $id));
        $this->session->set_flashdata('message5', '<div class="alert alert-danger" role="alert">
        Hapus Kas User Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('admin/user_data');
    }



    public function backup_data()
    {
        $data["title"]         = "Backup Database Dengan CodeIgniter";
        $this->template->load('layoutbackend', 'admin/backup_data', $data);
    }


    public function kecamatan()
    {
        $data['title'] = "Kecamatan";
        $data['kecamatan'] = $this->Mod_admin->kecamatan();
        $this->template->load('layoutbackend', 'admin/kecamatan', $data);
    }
    public function insert_kec()
    {
        $save  = array(
            'id_kecamatan' => $this->input->post('id_kecamatan'),
            'nama_kecamatan' => $this->input->post('nama_kecamatan'),
        );

        $this->db->insert("kecamatan", $save);
        redirect('admin/kecamatan');
    }
    public function update_kec()
    {
        $id_kecamatan = $this->input->post('id_kecamatan');
        $save  = array(
            'id_kecamatan' => $id_kecamatan,
            'nama_kecamatan' => $this->input->post('nama_kecamatan'),
        );
        $this->db->where('id_kecamatan', $id_kecamatan);
        $this->db->update("kecamatan", $save);
        redirect('admin/kecamatan');
    }
    public function delete_kec()
    {
        $id = $this->input->get('id_kecamatan');
        $this->db->delete('kecamatan', array('id_kecamatan' => $id));
        $this->session->set_flashdata('message5', '<div class="alert alert-danger" role="alert">
        Hapus Kas User Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('admin/kecamatan');
    }

    public function kelurahan()
    {
        $data['title'] = "Kelurahan";
        $data['kecamatan'] = $this->Mod_admin->kecamatan();
        $data['kelurahan'] = $this->Mod_admin->kelurahan();
        $this->template->load('layoutbackend', 'admin/kelurahan', $data);
    }
    public function insert_kel()
    {
        $save  = array(
            'id_kelurahan' => $this->input->post('id_kelurahan'),
            'id_kecamatan' => $this->input->post('id_kecamatan'),
            'nama_kelurahan' => $this->input->post('nama_kelurahan'),
        );

        $this->db->insert("kelurahan", $save);
        redirect('admin/kelurahan');
    }
    public function update_kel()
    {
        $id_kelurahan = $this->input->post('id_kelurahan');
        $save  = array(
            'id_kelurahan' => $id_kelurahan,
            'id_kecamatan' => $this->input->post('id_kecamatan'),
            'nama_kelurahan' => $this->input->post('nama_kelurahan'),
        );
        $this->db->where('id_kelurahan', $id_kelurahan);
        $this->db->update("kelurahan", $save);
        redirect('admin/kelurahan');
    }
    public function delete_kel()
    {
        $id = $this->input->get('id_kelurahan');
        $this->db->delete('kelurahan', array('id_kelurahan' => $id));
        $this->session->set_flashdata('message5', '<div class="alert alert-danger" role="alert">
        Hapus Kas User Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('admin/kelurahan');
    }

    public function kategori()
    {
        $data['title'] = "Kategori";
        $data['kategori'] = $this->Mod_admin->kategori();
        $this->template->load('layoutbackend', 'admin/kategori', $data);
    }

    public function insert_kategori()
    {
        // var_dump($this->input->post('username'));
        $merek_kasur = $this->input->post('merek_kasur');
        $cek = $this->Mod_user->cekmerekkasur($merek_kasur);
        if ($cek->num_rows() > 0) {
            echo json_encode(array("error" => "Kategori Sudah Ada!!"));
        } else {
            $nama = slug($this->input->post('merek_kasur'));
            $config['upload_path']   = './assets/foto/kategori/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save  = array(
                    'id_kasur' => $this->input->post('id_kasur'),
                    'merek_kasur' => $this->input->post('merek_kasur'),
                    'jenis_kasur' => $this->input->post('jenis_kasur'),
                    'bahan_kasur'  => $this->input->post('bahan_kasur'),
                    'harga'  => $this->input->post('harga'),
                    'gambar' => $gambar['file_name']
                );
                // dead($save);
                $this->db->insert("kategori_kasur", $save);
                redirect('admin/kategori');
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'id_kasur' => $this->input->post('id_kasur'),
                    'merek_kasur' => $this->input->post('merek_kasur'),
                    'jenis_kasur' => $this->input->post('jenis_kasur'),
                    'bahan_kasur'  => $this->input->post('bahan_kasur'),
                    'harga'  => $this->input->post('harga'),

                );
                $this->db->insert("kategori_kasur", $save);
                redirect('admin/kategori');
            }
        }
    }
    public function update_kategori()
    {
        // var_dump($this->input->post('username'));
        $id_kasur = $this->input->post('id_kasur');

        $nama = slug($this->input->post('merek_kasur'));
        $config['upload_path']   = './assets/foto/kategori/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']      = '9000';
        $config['max_width']     = '9000';
        $config['max_height']    = '9024';
        $config['file_name']     = $nama;

        $this->upload->initialize($config);

        if ($this->upload->do_upload('imagefile')) {
            $gambar = $this->upload->data();

            $save  = array(
                'id_kasur' => $id_kasur,
                'merek_kasur' => $this->input->post('merek_kasur'),
                'jenis_kasur' => $this->input->post('jenis_kasur'),
                'bahan_kasur'  => $this->input->post('bahan_kasur'),
                'harga'  => $this->input->post('harga'),
                'gambar' => $gambar['file_name']
            );
            // dead($save);
            $this->db->where('id_kasur', $id_kasur);
            $this->db->update("kategori_kasur", $save);
            redirect('admin/kategori');
        } else { //Apabila tidak ada gambar yang di upload
            $save  = array(
                'id_kasur' => $id_kasur,
                'merek_kasur' => $this->input->post('merek_kasur'),
                'jenis_kasur' => $this->input->post('jenis_kasur'),
                'bahan_kasur'  => $this->input->post('bahan_kasur'),
                'harga'  => $this->input->post('harga'),

            );
            // dead($save);
            $this->db->where('id_kasur', $id_kasur);
            $this->db->update("kategori_kasur", $save);
            redirect('admin/kategori');
        }
    }
    public function delete_kategori()
    {
        $id = $this->input->get('id_kasur');
        $g = $this->Mod_user->getImagekategori($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/kategori/' . $g['gambar']);
        }
        $this->db->delete('kategori_kasur', array('id_kasur' => $id));
        $this->session->set_flashdata('message5', '<div class="alert alert-danger" role="alert">
        Hapus Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('admin/kategori');
    }


    public function tempat_industri()
    {
        $data['title'] = "Tempat Industri";
        $data['tempat_industri'] = $this->Mod_admin->tempat_industri();
        $this->template->load('layoutbackend', 'admin/tempat_industri', $data);
    }
    public function add_industri()
    {
        $data['title'] = "Tempat Industri";
        $data['kategori'] = $this->Mod_admin->kategori();
        $data['kelurahan'] = $this->Mod_admin->kelurahan();
        $this->template->load('layoutbackend', 'admin/add_industri', $data);
    }
    public function edit_industri($id)
    {
        $data['title'] = "Tempat Industri";
        $data['industri'] = $this->Mod_admin->industri($id);
        // var_dump($data['industri']);
        // die;
        $data['kategori'] = $this->Mod_admin->kategori();
        $data['kelurahan'] = $this->Mod_admin->kelurahan();
        $this->template->load('layoutbackend', 'admin/edit_industri', $data);
    }

    public function insert_tempatindustri()
    {
        // var_dump($this->input->post('username'));
        $nama_industri = $this->input->post('nama_industri');
        $cek = $this->Mod_user->cektempat($nama_industri);
        if ($cek->num_rows() > 0) {
            echo json_encode(array("error" => "Tempat Sudah Ada!!"));
        } else {
            $nama = slug($this->input->post('nama_industri'));
            $config['upload_path']   = './assets/foto/tempat_industri/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
            $config['max_size']      = '9000';
            $config['max_width']     = '9000';
            $config['max_height']    = '9024';
            $config['file_name']     = $nama;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('imagefile')) {
                $gambar = $this->upload->data();

                $save  = array(
                    'id_industri' => rand(0000, 9999),
                    'nama_industri' => $this->input->post('nama_industri'),
                    'id_kasur' => $this->input->post('id_kasur'),
                    'nama_pemilik'  => $this->input->post('nama_pemilik'),
                    'tlp_pemilik'  => $this->input->post('tlp_pemilik'),
                    'id_kelurahan'  => $this->input->post('id_kelurahan'),
                    'alamat_industri'  => $this->input->post('alamat_industri'),
                    'latitude'  => $this->input->post('latitude'),
                    'longitude'  => $this->input->post('longitude'),
                    'info'  => $this->input->post('info'),
                    'gambar_lokasi' => $gambar['file_name']
                );
                // dead($save);
                $this->db->insert("tempat_industri", $save);
                redirect('admin/tempat_industri');
            } else { //Apabila tidak ada gambar yang di upload
                $save  = array(
                    'id_industri' => rand(0000, 9999),
                    'nama_industri' => $this->input->post('nama_industri'),
                    'id_kasur' => $this->input->post('id_kasur'),
                    'nama_pemilik'  => $this->input->post('nama_pemilik'),
                    'tlp_pemilik'  => $this->input->post('tlp_pemilik'),
                    'id_kelurahan'  => $this->input->post('id_kelurahan'),
                    'alamat_industri'  => $this->input->post('alamat_industri'),
                    'latitude'  => $this->input->post('latitude'),
                    'longitude'  => $this->input->post('longitude'),
                    'info'  => $this->input->post('info'),

                );
                $this->db->insert("tempat_industri", $save);
                redirect('admin/tempat_industri');
            }
        }
    }
    public function update_tempatindustri()
    {
        // var_dump($this->input->post('username'));
        $id_industri = $this->input->post('id_industri');

        $nama = slug($this->input->post('merek_kasur'));
        $config['upload_path']   = './assets/foto/tempat_industri/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png'; //mencegah upload backdor
        $config['max_size']      = '9000';
        $config['max_width']     = '9000';
        $config['max_height']    = '9024';
        $config['file_name']     = $nama;

        $this->upload->initialize($config);

        if ($this->upload->do_upload('imagefile')) {
            $gambar = $this->upload->data();

            $save  = array(
                'id_industri' => $id_industri,
                'nama_industri' => $this->input->post('nama_industri'),
                'id_kasur' => $this->input->post('id_kasur'),
                'nama_pemilik'  => $this->input->post('nama_pemilik'),
                'tlp_pemilik'  => $this->input->post('tlp_pemilik'),
                'id_kelurahan'  => $this->input->post('id_kelurahan'),
                'alamat_industri'  => $this->input->post('alamat_industri'),
                'latitude'  => $this->input->post('latitude'),
                'longitude'  => $this->input->post('longitude'),
                'info'  => $this->input->post('info'),
                'gambar_lokasi' => $gambar['file_name']
            );
            // dead($save);
            $this->db->where('id_industri', $id_industri);
            $this->db->update("tempat_industri", $save);
            redirect('admin/tempat_industri');
        } else { //Apabila tidak ada gambar yang di upload
            $save  = array(
                'id_industri' => $id_industri,
                'nama_industri' => $this->input->post('nama_industri'),
                'id_kasur' => $this->input->post('id_kasur'),
                'nama_pemilik'  => $this->input->post('nama_pemilik'),
                'tlp_pemilik'  => $this->input->post('tlp_pemilik'),
                'id_kelurahan'  => $this->input->post('id_kelurahan'),
                'alamat_industri'  => $this->input->post('alamat_industri'),
                'latitude'  => $this->input->post('latitude'),
                'longitude'  => $this->input->post('longitude'),
                'info'  => $this->input->post('info'),

            );
            // dead($save);
            $this->db->where('id_industri', $id_industri);
            $this->db->update("tempat_industri", $save);
            redirect('admin/tempat_industri');
        }
    }
    public function delete_tempat()
    {
        $id = $this->input->get('id_industri');
        $g = $this->Mod_user->getImagetempatindustri($id)->row_array();
        if ($g != null) {
            //hapus gambar yg ada diserver
            unlink('assets/foto/tempat_industri/' . $g['gambar_lokasi']);
        }
        $this->db->delete('tempat_industri', array('id_industri' => $id));
        $this->session->set_flashdata('message5', '<div class="alert alert-danger" role="alert">
        Hapus Berhasil!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
        <span aria-hidden="true">&times;</span> 
   </button>
      </div>');
        redirect('admin/tempat_industri');
    }

    public function ptempat()
    {
        $data['title'] = "Tempat Industri";


        $this->template->load('layoutbackend', 'admin/ptempat', $data);
    }
    public function load_data()
    {
        $search = $this->input->post("search");
        // dead($tahun);
        if ($search == Null) {
            $data = $this->db->get('tempat_industri')->result_array();
        } else {
            $data = $this->Mod_admin->serach_tempat($search);
            // dead($data['daftar']);
        }
        echo json_encode($data);
    }
    public function pkategori()
    {
        $data['title'] = "Kategori";


        $this->template->load('layoutbackend', 'admin/pkategori', $data);
    }
    public function load_data_kategori()
    {
        $search = $this->input->post("search");
        // dead($tahun);
        if ($search == Null) {
            $data = $this->db->get('kategori_kasur')->result_array();
        } else {
            $data = $this->Mod_admin->serach_kategori($search);
            // dead($data['daftar']);
        }
        echo json_encode($data);
    }

    public function cetak_industri()
    {
        $data['ket'] = 'Tempat Industri';

        $data['tempat_industri'] = $this->db->get('tempat_industri')->result();

        $this->load->view('admin/cetak_industri', $data);
    }



    public function backup()
    {

        $this->load->dbutil();
        $data['setting_school'] = "DATA";
        $prefs = [
            'format' => 'zip',
            'filename' => $data['setting_school']['setting_value'] . '-' . date("Y-m-d H-i-s") . '.sql'
        ];
        $backup = $this->dbutil->backup($prefs);
        $file_name = $data['setting_school']['setting_value'] . '-' . date("Y-m-d-H-i-s") . '.zip';
        $this->zip->download($file_name);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('username') == '') {
            $data['inputerror'][] = 'username';
            $data['error_string'][] = 'Username is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('full_name') == '') {
            $data['inputerror'][] = 'full_name';
            $data['error_string'][] = 'Full Name is required';
            $data['status'] = FALSE;
        }


        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}

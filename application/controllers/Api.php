<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Mod_admin');
    }

    public function industri_get()
    {
        // Users from a data store e.g. database
        $tempat_industri = $this->Mod_admin->tempat_industri();

        $id_industri = $this->get('id_industri');

        if ($id_industri === null) {
            // Check if the users data store contains users
            if ($tempat_industri) {
                // Set the response and exit
                $this->response($tempat_industri, 200);
            } else {
                // Set the response and exit
                $this->response([
                    'status' => false,
                    'message' => 'No tempat_industri were found'
                ], 404);
            }
        } else {
            if (array_key_exists($id_industri, $tempat_industri)) {
                $this->response($tempat_industri[$id_industri], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'No such user found'
                ], 404);
            }
        }
    }
    public function kategori_get()
    {
        // Users from a data store e.g. database
        $kategori = $this->Mod_admin->kategori();

        $id_kasur = $this->get('id_kasur');

        if ($id_kasur === null) {
            // Check if the users data store contains users
            if ($kategori) {
                // Set the response and exit
                $this->response($kategori, 200);
            } else {
                // Set the response and exit
                $this->response([
                    'status' => false,
                    'message' => 'No kategori were found'
                ], 404);
            }
        } else {
            if (array_key_exists($id_kasur, $kategori)) {
                $this->response($kategori[$id_kasur], 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'No such user found'
                ], 404);
            }
        }
    }
}

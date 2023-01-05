  <style>
      .center {
          text-align: center;
      }
  </style>
  <div class="main-panel">
      <div class="content">
          <div class="page-inner">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-header">

                          <div class="d-flex align-items-center">
                              <H1>Laporan</H1>
                              <a href="<?= base_url('admin/cetak_industri') ?>" class="btn btn-primary btn-round ml-auto">
                                  <span class="btn-label">
                                      <i class="fa fa-print"></i>
                                  </span>
                                  Cetak
                              </a>
                          </div>
                      </div>
                      <div class="card-body">
                          <!-- Modal -->
                          <div class="table-responsive">
                              <table id="datatable" class="display table table-striped table-hover">
                                  <thead class="center">
                                      <tr>
                                          <th>NO</th>
                                          <th>ID</th>
                                          <th>Nama Industri</th>
                                          <th>Nama Pemilik</th>
                                          <th>Telepon</th>
                                          <th>Kelurahan</th>
                                          <th>Latitude</th>
                                          <th>Longitude</th>
                                          <th>Gambar</th>
                                      </tr>
                                  </thead>
                                  <tbody class="center">
                                      <?php
                                        $no = 1;
                                        foreach ($tempat_industri as $a) { ?>

                                          <tr>
                                              <td><?= $no++ ?></td>
                                              <td><?= $a->id_industri ?></td>
                                              <td><?= $a->nama_industri ?></td>
                                              <td><?= $a->nama_pemilik ?></td>
                                              <td><?= $a->tlp_pemilik ?></td>
                                              <td><?= $a->id_kelurahan ?></td>
                                              <td><?= $a->latitude ?></td>
                                              <td><?= $a->longitude ?></td>
                                              <td>
                                                  <img class="myImgx" src='<?php echo base_url("assets/foto/tempat_industri/"); ?><?= $a->gambar_lokasi ?> ' width="100px" height="100px">
                                              </td>
                                          </tr>
                                      <?php } ?>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>


  <script>
      $(document).ready(function() {
          $('#datatable').DataTable();
      });
  </script>
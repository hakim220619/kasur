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
                              <h4 class="card-title"><?= $title ?></h4>
                              <a href="add_industri" class="btn btn-primary btn-round ml-auto">
                                  <i class="fa fa-plus"></i>
                                  Add
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
                                          <th>Action</th>
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
                                              <td>
                                                  <div class="form-button-action">
                                                      <a href="edit_industri/<?= $a->id_industri ?>" type="button" title="Edit Data" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                          <i class="fa fa-edit"></i>
                                                      </a>
                                                      <button type="button" class="btn btn-link btn-danger btn-lg" data-toggle="modal" data-target="#delkec<?= $a->id_kasur ?>">
                                                          <i class="fa fa-times"></i>
                                                      </button>
                                                  </div>
                                              </td>
                                          </tr>

                                          <div class="modal fade" id="delkec<?= $a->id_kasur ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="addNewDonaturLabel">Hapus</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">
                                                          <p>Anda yakin ingin menghapus <?= $a->nama_industri ?></p>
                                                      </div>
                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                          <a href="<?= base_url('admin/delete_tempat?id_industri=') ?><?= $a->id_industri ?>" class="btn btn-primary">Hapus</a>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>

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
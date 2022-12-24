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
                              <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#usermodal">
                                  <i class="fa fa-plus"></i>
                                  Add
                              </button>
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
                                          <th>Merek Kasur</th>
                                          <th>Jenis Kasur</th>
                                          <th>Bahan Kasur</th>
                                          <th>Harga</th>
                                          <th>Gambar</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody class="center">
                                      <?php
                                        $no = 1;
                                        foreach ($kategori as $a) { ?>

                                          <tr>
                                              <td><?= $no++ ?></td>
                                              <td><?= $a->id_kasur ?></td>
                                              <td><?= $a->merek_kasur ?></td>
                                              <td><?= $a->jenis_kasur ?></td>
                                              <td><?= $a->bahan_kasur ?></td>
                                              <td><?= $a->harga ?></td>
                                              <td>
                                                  <img class="myImgx" src='<?php echo base_url("assets/foto/kategori/"); ?><?= $a->gambar ?> ' width="100px" height="100px">
                                              </td>
                                              <td>
                                                  <div class="form-button-action">
                                                      <button data-target="#edit-kec<?= $a->id_kasur ?>" type="button" data-toggle="modal" title="Edit Data" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                          <i class="fa fa-edit"></i>
                                                      </button>
                                                      <button type="button" class="btn btn-link btn-danger btn-lg" data-toggle="modal" data-target="#delkec<?= $a->id_kasur ?>">
                                                          <i class="fa fa-times"></i>
                                                      </button>
                                                  </div>
                                              </td>
                                          </tr>
                                          <div class="modal fade" id="edit-kec<?= $a->id_kasur ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header no-bd">
                                                          <h5 class="modal-title">
                                                              <span class="fw-mediumbold">
                                                                  Edit</span>
                                                          </h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">

                                                          <form action="<?= base_url('admin/update_kategori'); ?>" method="post" enctype="multipart/form-data">
                                                              <div class="row">
                                                                  <input type="text" class="form-control" id="id_kasur" name="id_kasur" placeholder="id_kasur" value="<?= $a->id_kasur ?>">
                                                                  <div class="col-sm-12">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Merek Kasur</label>
                                                                          <input type="text" class="form-control" id="merek_kasur" name="merek_kasur" placeholder="Merek Kasur" value="<?= $a->merek_kasur ?>">
                                                                          <?= form_error('merek_kasur', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>

                                                                  <div class="col-sm-12">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Jenis Kasur</label>
                                                                          <input type="text" class="form-control" id="jenis_kasur" name="jenis_kasur" placeholder="Jenis Kasur" value="<?= $a->jenis_kasur ?>">
                                                                          <?= form_error('jenis_kasur', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-sm-12">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Bahan Kasur</label>
                                                                          <input type="text" class="form-control" id="bahan_kasur" name="bahan_kasur" placeholder="Bahan Kasur" value="<?= $a->bahan_kasur ?>">
                                                                          <?= form_error('bahan_kasur', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-sm-12">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Harga</label>
                                                                          <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga" value="<?= $a->harga ?>">
                                                                          <?= form_error('harga', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>
                                                                  <div class="col-sm-12">
                                                                      <div class="form-group form-group-default">
                                                                          <label>gambar</label>
                                                                          <input type="file" class="form-control" id="gambar" name="imagefile" placeholder="Gambar" value="">
                                                                          <?= form_error('gambar', '<small class="text-danger pl-3">', '</small>'); ?>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              <div class="modal-footer no-bd">
                                                                  <button type="submit" id="addRowButton" class="btn btn-primary">Edit</button>
                                                                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                              </div>
                                                          </form>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="modal fade" id="delkec<?= $a->id_kasur ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="addNewDonaturLabel">Hapus Kategori</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">
                                                          <p>Anda yakin ingin menghapus <?= $a->merek_kasur ?></p>
                                                      </div>
                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                          <a href="<?= base_url('admin/delete_kategori?id_kasur=') ?><?= $a->id_kasur ?>" class="btn btn-primary">Hapus</a>
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
  <div class="modal fade" id="usermodal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header no-bd">
                  <h5 class="modal-title">
                      <span class="fw-mediumbold">
                      </span>
                      <span class="fw-light">
                          Add
                      </span>
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <!-- <p class="small">Create a new row using this form, make sure you fill them all</p> -->
                  <form class="admin" method="post" action="<?= base_url('admin/insert_kategori'); ?>" enctype="multipart/form-data">
                      <div class="row">
                          <input hidden type="text" class="form-control" id="id_kasur" name="id_kasur" placeholder="id_kasur" value="<?= rand(0000, 9999) ?>">

                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>Merek Kasur</label>
                                  <input type="text" class="form-control" id="merek_kasur" name="merek_kasur" placeholder="Merek Kasur" value="<?= set_value('merek_kasur'); ?>">
                                  <?= form_error('merek_kasur', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>

                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>Jenis Kasur</label>
                                  <input type="text" class="form-control" id="jenis_kasur" name="jenis_kasur" placeholder="Jenis Kasur" value="<?= set_value('jenis_kasur'); ?>">
                                  <?= form_error('jenis_kasur', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>Bahan Kasur</label>
                                  <input type="text" class="form-control" id="bahan_kasur" name="bahan_kasur" placeholder="Bahan Kasur" value="<?= set_value('bahan_kasur'); ?>">
                                  <?= form_error('bahan_kasur', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>Harga</label>
                                  <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga" value="<?= set_value('harga'); ?>">
                                  <?= form_error('harga', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>gambar</label>
                                  <input type="file" class="form-control" id="gambar" name="imagefile" placeholder="Gambar" value="<?= set_value('gambar'); ?>">
                                  <?= form_error('gambar', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                      </div>
                      <div class="modal-footer no-bd">
                          <button type="submit" id="addRowButton" class="btn btn-primary">Add</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div>
                  </form>
              </div>

          </div>
      </div>
  </div>


  <script>
      $(document).ready(function() {
          $('#datatable').DataTable();
      });
  </script>
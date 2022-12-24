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
                                          <th>Kelurahan</th>
                                          <th>Action</th>
                                      </tr>
                                  </thead>
                                  <tbody class="center">
                                      <?php
                                        $no = 1;
                                        foreach ($kelurahan as $a) { ?>

                                          <tr>
                                              <td><?= $no++ ?></td>
                                              <td><?= $a->id_kelurahan ?></td>
                                              <td><?= $a->nama_kelurahan ?></td>
                                              <td>
                                                  <div class="form-button-action">
                                                      <button data-target="#edit-kec<?= $a->id_kelurahan ?>" type="button" data-toggle="modal" title="Edit Data" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                                          <i class="fa fa-edit"></i>
                                                      </button>
                                                      <button type="button" class="btn btn-link btn-danger btn-lg" data-toggle="modal" data-target="#delkec<?= $a->id_kelurahan ?>">
                                                          <i class="fa fa-times"></i>
                                                      </button>
                                                  </div>
                                              </td>
                                          </tr>
                                          <div class="modal fade" id="edit-kec<?= $a->id_kelurahan ?>" tabindex="-1" role="dialog" aria-hidden="true">
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

                                                          <form action="<?= base_url('admin/update_kel'); ?>" method="post" enctype="multipart/form-data">
                                                              <div class="col-sm-12">
                                                                  <div class="form-group form-group-default">
                                                                      <label>Level</label>
                                                                      <div class="col-sm-12 kosong">
                                                                          <select class="form-control" name="id_kecamatan" id="id_kecamatan">
                                                                              <option value="">Pilih Kecamatan</option>
                                                                              <?php
                                                                                foreach ($kecamatan as $ab) { ?>
                                                                                  <option <?= ($a->id_kecamatan == $ab->id_kecamatan ? 'selected=""' : '') ?>value="<?= $ab->nama_kecamatan; ?>"><?= $ab->nama_kecamatan; ?></option>
                                                                              <?php } ?>
                                                                          </select>
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              <div class="row">
                                                                  <input hidden type="text" class="form-control" id="id_kelurahan" name="id_kelurahan" placeholder="id_kelurahan" value="<?= $a->id_kelurahan ?>">
                                                                  <div class="col-sm-12">
                                                                      <div class="form-group form-group-default">
                                                                          <label>Nama kelurahan</label>
                                                                          <input type="text" class="form-control" id="nama_kelurahan" name="nama_kelurahan" placeholder="nama_kelurahan" value="<?= $a->nama_kelurahan ?>">
                                                                          <?= form_error('nama_kelurahan', '<small class="text-danger pl-3">', '</small>'); ?>
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
                                          <div class="modal fade" id="delkec<?= $a->id_kelurahan ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="addNewDonaturLabel">Hapus kelurahan</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <div class="modal-body">
                                                          <p>Anda yakin ingin menghapus <?= $a->nama_kelurahan ?></p>
                                                      </div>
                                                      <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                          <a href="<?= base_url('admin/delete_kel?id_kelurahan=') ?><?= $a->id_kelurahan ?>" class="btn btn-primary">Hapus</a>
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
                  <form class="admin" method="post" action="<?= base_url('admin/insert_kel'); ?>" enctype="multipart/form-data">
                      <div class="row">
                          <input hidden type="text" class="form-control" id="id_user" name="id_user" placeholder="id_user" value="<?= set_value('id_user'); ?>">

                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>ID kelurahan</label>
                                  <input type="text" class="form-control" id="id_kelurahan" name="id_kelurahan" placeholder="ID kelurahan" value="<?= set_value('id_kelurahan'); ?>">
                                  <?= form_error('id_kelurahan', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group form-group-default">
                                  <label>Level</label>
                                  <div class="col-sm-12 kosong">
                                      <select class="form-control" name="id_kecamatan" id="id_kecamatan">
                                          <option value="">Pilih Kecamatan</option>
                                          <?php
                                            foreach ($kecamatan as $ab) { ?>
                                              <option value="<?= $ab->id_kecamatan; ?>"><?= $ab->nama_kecamatan; ?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="col-sm-12">
                              <div class="form-group form-group-default">
                                  <label>Nama kelurahan</label>
                                  <input type="text" class="form-control" id="nama_kelurahan" name="nama_kelurahan" placeholder="Full Name" value="<?= set_value('nama_kelurahan'); ?>">
                                  <?= form_error('nama_kelurahan', '<small class="text-danger pl-3">', '</small>'); ?>
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
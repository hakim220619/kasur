 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js">
 </script>
 <div class="main-panel">
     <div class="content">
         <div class="page-inner">
             <div class="col-md-12">
                 <div class="card">
                     <div class="card-header">
                         <div class="card-title"><?= $title ?></div>
                     </div>
                     <form class="simpanan" method="post" action="<?= base_url('admin/insert_tempatindustri'); ?>" enctype="multipart/form-data">
                         <div class="card-body">
                             <div class="row">
                                 <!-- <input hidden type="number" class="form-control" id="id" name="id" placeholder="Masukan id"> -->
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="nama_industri">Nama Industri</label>
                                         <input type="text" class="form-control" id="nama_industri" name="nama_industri" placeholder="Masukan Nama Industri" required>
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="nama_industri">Kategori</label>
                                         <select class="form-control" name="id_kasur" id="id_kasur">
                                             <option value="">Pilih Kategori</option>
                                             <?php
                                                foreach ($kategori as $ab) { ?>
                                                 <option value="<?= $ab->id_kasur; ?>"><?= $ab->merek_kasur; ?></option>
                                             <?php } ?>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="nama_industri">Kelurahan</label>
                                         <select class="form-control" name="id_kelurahan" id="id_kelurahan">
                                             <option value="">Pilih Kelurahan</option>
                                             <?php
                                                foreach ($kelurahan as $ab) { ?>
                                                 <option value="<?= $ab->id_kelurahan; ?>"><?= $ab->nama_kelurahan; ?></option>
                                             <?php } ?>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="nama_pemilik">Nama Pemilik</label>
                                         <input type="text" class="form-control" id="nama_pemilik" name="nama_pemilik" placeholder="Masukan Nama Pemilik" required>
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="tlp_pemilik">Telepon</label>
                                         <input type="text" class="form-control" id="tlp_pemilik" name="tlp_pemilik" placeholder="Masukan Telepon" required>
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="alamat_industri">Alamat Industri</label>
                                         <input type="text" class="form-control" id="alamat_industri" name="alamat_industri" placeholder="Masukan Alamat Industri" required>
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="latitude">Latitude</label>
                                         <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Masukan Latitude" required>
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="longitude">Longitude</label>
                                         <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Masukan Longitude" required>
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="gambar_lokasi">Gambar Lokasi</label>
                                         <input type="file" class="form-control" id="gambar_lokasi" name="imagefile" placeholder="Masukan Gambar Lokasi" required>
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                                 <div class="col-md-6 col-lg-6">
                                     <div class="form-group">
                                         <label for="info">Info</label>
                                         <input type="text" class="form-control" id="info" name="info" placeholder="Masukan Info" required>
                                         <small id="emailHelp2" class="form-text text-muted"></small>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="card-action">
                             <button class="btn btn-success">Submit</button>
                             <a href="<?= base_url('admin/tempat_industri') ?>" class="btn btn-danger">Cancel</a>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>
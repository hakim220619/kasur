  <style>
      .center {
          text-align: center;
      }
  </style>
  <div class="main-panel">
      <div class="content">
          <div class="page-inner">
              <div class="col-md-6">
                  <div class="input-group">
                      <input type="text" id="search_" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                      <button type="button" id="search" class="btn btn-outline-primary">search</button>
                  </div><br>
              </div>
              <div class="col-md-12">
                  <div class="card">


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
                                      </tr>
                                  </thead>
                                  <tbody class="center" id="show_data">

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
      $('#search').on('click', function() {
          var search = $('#search_').val();
          $.ajax({
              type: "POST",
              url: "<?php echo site_url('admin/load_data_kategori') ?>",
              data: {
                  search: search
              },
              dataType: 'json',
              success: function(data) {
                  var html = '';
                  var i;
                  var no = 1;
                  for (i = 0; i < data.length; i++) {
                      html += '<tr>' +
                          '<td>' + no++ + '</td>' +
                          '<td>' + data[i].id_kasur + '</td>' +
                          '<td>' + data[i].merek_kasur + '</td>' +
                          '<td>' + data[i].jenis_kasur + '</td>' +
                          '<td>' + data[i].bahan_kasur + '</td>' +
                          '<td>' + data[i].harga + '</td>' +

                          '<td>' +
                          '<img class="myImgx" src="<?php echo base_url("assets/foto/kategori/'+ data[i].gambar +'"); ?> " width="100px" height="100px">'
                      '</td>' +
                      '</tr>';
                  }
                  $('#show_data').html(html);
              }
          });
      });


      $(document).ready(function() {
          tampil_daftar();

          function tampil_daftar() {

              $.ajax({
                  type: 'GET',
                  url: "<?php echo site_url('admin/load_data_kategori') ?>",
                  async: true,
                  dataType: 'json',
                  success: function(data) {
                      var html = '';
                      var i;
                      var no = 1;
                      for (i = 0; i < data.length; i++) {
                          html += '<tr>' +
                              '<td>' + no++ + '</td>' +
                              '<td>' + data[i].id_kasur + '</td>' +
                              '<td>' + data[i].merek_kasur + '</td>' +
                              '<td>' + data[i].jenis_kasur + '</td>' +
                              '<td>' + data[i].bahan_kasur + '</td>' +
                              '<td>' + data[i].harga + '</td>' +

                              '<td>' +
                              '<img class="myImgx" src="<?php echo base_url("assets/foto/kategori/'+ data[i].gambar +'"); ?> " width="100px" height="100px">'
                          '</td>' +
                          '</tr>';
                      }
                      $('#show_data').html(html);
                  }
              });
          }
      })
  </script>

  <script>
      $(document).ready(function() {
          $('#datatable').DataTable();
      });
  </script>
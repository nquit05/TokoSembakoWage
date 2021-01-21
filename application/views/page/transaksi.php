<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Transaksi</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>

  <div class="row">
    <div class="alert alert-success" style="display:none;">

    </div>

    <div class="col-lg-6">
      <button id="btnAdd" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah Transaksi</button>
    </div>
  </div>

  <br>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>No Transaksi</th>
              <th>Pelanggan</th>
              <th>Tanggal Transaksi</th>
              <th>Total Harga</th>
              <th>Admin Login</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody id="showdata">
            <?php
            $no = 1;
            foreach ($qtrans as $row) :
              ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $row->no_transaksi ?></td>
                <td><?= $row->nama_plg ?></td>
                <td><?= $row->tgl_transaksi ?></td>
                <td><?= $row->total_harga ?></td>
                <td><?= $this->session->userdata('USERNAME') ?></td>
                <td><button class="btn btn-default btn-sm show-detail" data="<?= $row->no_transaksi ?>"><span class="fa fa-edit"></span> Detail Pemesanan </button> &nbsp
                </td>
              </tr>

            <?php endforeach ?>
          </tbody>

        </table>
      </div>
    </div>
  </div>

  <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"></h4>
        </div>

        <div class="modal-body">
          <input type="hidden" name="txtId" id="idTransaksi" value="0">
          <input type="hidden" name="txtNoTrans" value="0">

          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>No Transaksi</th>
                <th>Barang</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
              </tr>
            </thead>

            <tbody id="showdatadetail">

            </tbody>

          </table>
        </div>

        <div class="modal-footer">
          <button id="btnClose" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div id="myModalAdd" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"></h4>
        </div>

        <div class="modal-body">



          <form id="myForm" class="form-horizontal" action="<?= base_url() ?>admin/insertTransaksi" method="post">

            <input type="hidden" id="txtDataTransaksi" name="dataTransaksi" value='<?= json_encode($qsessionDetail) ?>'>

            <div class="form-group">
              <label for="name" class="label-control col-md-4">Nama Pelanggan</label>
              <div class="col-md-8">
                <select class="form-control" name="txtPelanggan">
                  <?php foreach ($qpelangganArr as $row) : ?>
                    <option value="<?= $row['id_pelanggan'] ?>">
                      <?= $row['nama_plg'] ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="harga" class="label-control col-md-4">Barang </label>
              <div class="col-md-8">
                <select class="form-control" name="txtBarang">
                  <?php foreach ($qbarangArr as $row) : ?>
                    <option value="<?= $row['id_barang'] ?>">
                      <?= $row['nama_barang'] ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="harga" class="label-control col-md-4">Jumlah </label>
              <div class="col-md-2">
                <input type="number" name="txtJumlah" value="" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label for="harga" class="label-control col-md-4">Total </label>
              <div class="col-md-4">
                <input type="text" name="txtHargaTotal" readonly value="0" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label for="harga" class="label-control col-md-4">Bayar </label>
              <div class="col-md-4">
                <input type="number" name="txtBayar" value="" class="form-control">
              </div>
            </div>

            <button id="btnAddDetail" type="button" class="btn btn-primary">Add Barang</button>
            &nbsp

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>ID_BARANG</th>
                  <th>Barang</th>
                  <th>Jumlah</th>
                  <th>Total Harga</th>
                </tr>
              </thead>

              <tbody id="showsessionadd">
                <?php
                $no = 1;
                foreach ($qsessionDetail as $row) :
                  ?>
                  <tr>
                    <td><?= $row['id_barang'] ?></td>
                    <td><?= $row['nama_barang'] ?></td>
                    <td><?= $row['jumlah'] ?></td>
                    <td><?= $row['total_harga'] ?></td>
                  </tr>

                <?php endforeach ?>
              </tbody>

            </table>


        </div>

        <div class="modal-footer">
          <button id="btnClose" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button id="btnSave" type="submit" class="btn btn-primary">Tambah Transaksi</button>
        </div>
        </form>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


</div>

<script type="text/javascript">
  $(document).ready(function() {
    //add new
    $('#btnAdd').click(function() {
      $('#myModalAdd').modal('show');
      $('#myModalAdd').find('.modal-title').text('Tambah Transaksi');
    });


    $('#btnAddDetail').click(function() {
      var url = $('#myForm').attr('action');
      var data = $('#myForm').serialize();
      $.ajax({
        type: 'ajax',
        method: 'post',
        url: '<?= base_url() ?>admin/addTransaksi',
        data: data,
        async: false,
        dataType: 'json',
        success: function(response) {

          $('#txtDataTransaksi').val();
          var dataTransaksi = $('#txtDataTransaksi').val(JSON.stringify(response));

          var totalBayar = 0;


          $('#showsessionadd').html('');
          $.each(response, function(index, element) {
            $('#showsessionadd').append(
              "<tr><td>" + element.id_barang +
              "</td><td>" + element.nama_barang + "</td>" +
              "</td><td>" + element.jumlah + "</td>" +
              "</td><td>" + element.total_harga + "</td></tr>");
            totalBayar = totalBayar + element.total_harga;
          });

          $('#myModalAdd input[name=txtHargaTotal]').val(totalBayar);


        },
        error: function() {
          alert('Gagal simpan data ! ');
        }
      });

    });




    //Get No transaksi
    $('#showdata').on('click', '.show-detail', function() {
      var id = $(this).attr('data');
      $('#myModal').modal('show');
      $('#myModal').find('.modal-title').text('Detail Transaksi');
      $.ajax({
        type: 'ajax',
        method: 'get',
        url: '<?php echo base_url() ?>admin/cekIdDetail',
        data: {
          id: id
        },
        async: false,
        dataType: 'json',
        success: function(data) {
          $('#myModal input[name=txtId]').val(data.no_transaksi);
          showAllDetail();
        },
        error: function() {
          alert('Gagal edit data  ! ');
        }
      });
    });

    function showAllDetail() {
      $.ajax({
        type: 'ajax',
        url: '<?= base_url() ?>admin/getDataDetail',
        async: false,
        dataType: 'json',
        success: function(data) {
          var html = '';
          var x;
          var no = 1;
          var getid = $("#idTransaksi").val();
          for (x = 0; x < data.length; x++) {
            if (getid == data[x].no_transaksi) {
              html += '<tr>' +
                '<td>' + no + '</td>' +
                '<td>' + data[x].no_transaksi + '</td>' +
                '<td>' + data[x].nama_barang + '</td>' +
                '<td>' + data[x].jumlah + '</td>' +
                '<td>' + data[x].total_harga + '</td>' +
                '</tr>';
              no++;
            }


          }
          $('#showdatadetail').html(html);
        },
        error: function() {
          alert('gagal');
        }

      });
    }
  });
</script>
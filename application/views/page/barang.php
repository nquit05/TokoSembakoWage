<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Barang</h1>
    </div>
    <!-- /.col-lg-12 -->
  </div>

  <div class="row">
    <div class="alert alert-success" style="display:none;">

    </div>

    <div class="col-lg-6">
      <button id="btnAdd" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah Barang</button>
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
              <th>Barang</th>
              <th>Jenis</th>
              <th>Harga</th>
              <th>Expired</th>
              <th>Stok</th>
              <th>Admin</th>
              <th>Action</th>
            </tr>
          </thead>

          <tbody id="showdata">
            <?php
            $no = 1;
            foreach ($qbarang as $row) :
              ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $row->nama_barang ?></td>
                <td><?= $row->nama_jenis ?></td>
                <td>Rp.<?= $row->harga ?></td>
                <td><?= $row->expired ?></td>
                <td><?= $row->stok ?></td>
                <td><?= $this->session->userdata('USERNAME') ?></td>
                <td><button class="btn btn-default btn-sm item-edit" data="<?= $row->id_barang ?>"><span class="fa fa-edit"></span> Edit </button> &nbsp
                  <button class="btn btn-danger btn-sm item-delete" data="<?= $row->id_barang ?>"><span class="fa fa-trash"></span> Delete</button></td>
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
          <form id="myForm" class="form-horizontal" action="" method="post">
            <input type="hidden" name="txtId" value="0">
            <div class="form-group">
              <label for="name" class="label-control col-md-4">Nama Barang</label>
              <div class="col-md-8">
                <input type="text" name="txtNamaBarang" value="" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label for="jenis" class="label-control col-md-4">Jenis</label>
              <div class="col-md-8">
                <select class="form-control" name="txtJenisBarang">
                  <?php foreach ($qjenis as $row) : ?>
                    <option value="<?= $row['id_jenis'] ?>">
                      <?= $row['nama_jenis'] ?>
                    </option>
                  <?php endforeach; ?>
                </select>

              </div>
            </div>

            <div class="form-group">
              <label for="harga" class="label-control col-md-4">Harga Barang </label>
              <div class="col-md-8">
                <input type="number" name="txtHarga" value="" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label for="stok" class="label-control col-md-4">Stok </label>
              <div class="col-md-8">
                <input type="number" name="txtStok" value="" class="form-control">
              </div>
            </div>

            <div class="form-group">
              <label for="expired" class="label-control col-md-4">Expired </label>
              <div class="col-md-8">
                <input type="date" name="txtExpired" value="" class="form-control">
              </div>
            </div>

          </form>
        </div>
        <div class="modal-footer">
          <button id="btnClose" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button id="btnSave" type="button" class="btn btn-primary">Save Data</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Modal title</h4>
        </div>
        <div class="modal-body">
          <button id="btnDelete" type="button" class="btn btn-danger"> <span class="fa fa-trash"></span> Delete</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"> <span class="fa fa-remove"></span> Cancel</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <script type="text/javascript">
    $(document).ready(function() {

      //add new
      $('#btnAdd').click(function() {
        $('#myModal').modal('show');
        $('#myModal').find('.modal-title').text('Tambah Barang');
        $('#myForm').attr('action', '<?= base_url() ?>admin/addBarang');
      });


      $('#btnSave').click(function() {
        var url = $('#myForm').attr('action');
        var data = $('#myForm').serialize();
        // validate myForm

        var namaBarang = $('input[name=txtNamaBarang]');
        var jenis = $('select[name=txtJenisBarang]');
        var harga = $('input[name=txtHarga]');
        var stok = $('input[name=txtStok]');
        var expired = $('select[name=txtExpired]');
        var result = '';

        if (namaBarang.val() == '') {
          namaBarang.parent().parent().addClass('has-error');
        } else {
          namaBarang.parent().parent().removeClass('has-error');
          result += '1';
        }

        if (jenis.val() == '') {
          jenis.parent().parent().addClass('has-error');
        } else {
          jenis.parent().parent().removeClass('has-error');
          result += '2';
        }

        if (harga.val() == '') {
          harga.parent().parent().addClass('has-error');
        } else {
          harga.parent().parent().removeClass('has-error');
          result += '3';
        }

        if (stok.val() == '') {
          stok.parent().parent().addClass('has-error');
        } else {
          stok.parent().parent().removeClass('has-error');
          result += '4';
        }

        if (expired.val() == '') {
          expired.parent().parent().addClass('has-error');
        } else {
          expired.parent().parent().removeClass('has-error');
          result += '5';
        }

        if (result == '12345') {
          $.ajax({
            type: 'ajax',
            method: 'post',
            url: url,
            data: data,
            async: false,
            dataType: 'json',
            success: function(response) {
              if (response.success) {
                window.location.href = "<?= base_url() ?>admin/barang";
                $('#myModal').modal('hide');
                $('#myForm')[0].reset();
                $('.alert-success').html('Barang telah di tambahkan ').fadeIn().delay(4000).fadeOut('slow');

              } else {
                alert('Bermasalah ! ');
              }
            },
            error: function() {
              alert('Gagal simpan data ! ');
            }
          });
        }
      });

      //edit
      $('#showdata').on('click', '.item-edit', function() {
        var id = $(this).attr('data');
        $('#myModal').modal('show');
        $('#myModal').find('.modal-title').text('Edit Barang');
        $('#myForm').attr('action', '<?= base_url() ?>admin/updateBarang');
        $.ajax({
          type: 'ajax',
          method: 'get',
          url: '<?php echo base_url() ?>admin/editBarang',
          data: {
            id: id
          },
          async: false,
          dataType: 'json',
          success: function(data) {
            $('#myModal input[name=txtNamaBarang]').val(data.nama_barang);
            $('#myModal select[name=txtJenisBarang]').val(data.id_jenis);
            $('#myModal input[name=txtHarga]').val(data.harga);
            $('#myModal input[name=txtStok]').val(data.stok);
            $('#myModal select[name=txtExpired]').val(data.expired);
            $('#myModal input[name=txtId]').val(data.id_barang);

          },
          error: function() {
            alert('Gagal edit data  ! ');
          }
        });
      });

      //delete

      $('#showdata').on('click', '.item-delete', function() {
        var id = $(this).attr('data');
        $('#deleteModal').modal('show');
        $('#deleteModal').find('.modal-title').text('Are You Sure To Delete Item?');

        $('#btnDelete').unbind().click(function() {
          $.ajax({
            type: 'ajax',
            method: 'get',
            async: false,
            url: '<?= base_url() ?>admin/deleteBarang',
            data: {
              id: id
            },
            dataType: 'json',
            success: function() {
              window.location.href = "<?= base_url() ?>admin/barang";
              $('#deleteModal').modal('hide');
              $('.alert-success').html('Barang telah di hapus !').fadeIn().delay(4000).fadeOut('slow');
            },
            error: function() {
              alert('Gagal menghapus ! ');
            }
          });
        });
      });

      // Clean Modal
      $('#btnClose').click(function() {
        $('#myModal input[name=txtNamaBarang]').val("");
        $('#myModal select[name=txtJenisBarang]').val("");
        $('#myModal input[name=txtHarga]').val("");
        $('#myModal input[name=txtStok]').val("");
        $('#myModal select[name=txtExpired]').val("");
        $('#myModal input[name=txtId]').val("");
      });

      // EndScriptDocument   
    });
  </script>
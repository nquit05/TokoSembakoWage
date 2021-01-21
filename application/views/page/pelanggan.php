<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Pelanggan</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>


	<div class="row">
		<div class="alert alert-success" style="display:none;">

		</div>

		<div class="col-lg-6">
			<button id="btnAdd" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah Pelanggan</button>
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
							<th>Nama Pelanggan</th>
							<th>Alamat</th>
							<th>No Telpon</th>
							<th>Admin</th>
						</tr>
					</thead>

					<tbody id="showdata">
						<?php
						$no = 1;
						foreach ($dataPelanggan as $row) :
							?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $row->nama_plg ?></td>
								<td><?= $row->alamat ?></td>
								<td><?= $row->no_telp ?></td>
								<td><?= $row->username ?></td>
								<td><button class="btn btn-default btn-sm item-edit" data="<?= $row->id_pelanggan ?>"><span class="fa fa-edit"></span> Edit </button> &nbsp
									<button class="btn btn-danger btn-sm item-delete" data="<?= $row->id_pelanggan ?>"><span class="fa fa-trash"></span> Delete</button></td>
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
						<input type="hidden" name="txtOwner" value="<?= $this->session->userdata('ID_USER') ?>">
						<div class="form-group">
							<label for="name" class="label-control col-md-4">Nama Pelanggan</label>
							<div class="col-md-8">
								<input type="text" name="txtNamaPlg" value="" class="form-control">
							</div>
						</div>

						<div class="form-group">
							<label for="harga" class="label-control col-md-4">Alamat </label>
							<div class="col-md-8">
								<input type="text" name="txtAlamatPlg" value="" class="form-control">
							</div>
						</div>

						<div class="form-group">
							<label for="stok" class="label-control col-md-4">No Telp </label>
							<div class="col-md-8">
								<input type="number" name="txtTelpPlg" value="" class="form-control">
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
				$('#myModal').find('.modal-title').text('Tambah Pelanggan');
				$('#myForm').attr('action', '<?= base_url() ?>admin/addPelanggan');
			});

			$('#btnSave').click(function() {
				var url = $('#myForm').attr('action');
				var data = $('#myForm').serialize();
				// validate myForm

				var namaPelanggan = $('input[name=txtNamaPlg]');
				var alamaPelanggan = $('input[name=txtAlamatPlg');
				var telpPelanggan = $('input[name=txtTelpPlg');
				var owner = $('input[name=txtOwner]');
				var result = '';

				if (namaPelanggan.val() == '') {
					namaPelanggan.parent().parent().addClass('has-error');
				} else {
					namaPelanggan.parent().parent().removeClass('has-error');
					result += '1';
				}

				if (alamaPelanggan.val() == '') {
					alamaPelanggan.parent().parent().addClass('has-error');
				} else {
					alamaPelanggan.parent().parent().removeClass('has-error');
					result += '2';
				}

				if (telpPelanggan.val() == '') {
					telpPelanggan.parent().parent().addClass('has-error');
				} else {
					telpPelanggan.parent().parent().removeClass('has-error');
					result += '3';
				}

				if (result == '123') {
					$.ajax({
						type: 'ajax',
						method: 'post',
						url: url,
						data: data,
						async: false,
						dataType: 'json',
						success: function(response) {
							if (response.success) {
								window.location.href = "<?= base_url() ?>admin/pelanggan";
								$('#myModal').modal('hide');
								$('#myForm')[0].reset();
								$('.alert-success').html('Pelanggan telah di tambahkan ').fadeIn().delay(4000).fadeOut('slow');

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
				$('#myModal').find('.modal-title').text('Edit Pelanggan');
				$('#myForm').attr('action', '<?= base_url() ?>admin/updatePelanggan');
				$.ajax({
					type: 'ajax',
					method: 'get',
					url: '<?php echo base_url() ?>admin/getDataPelanggan',
					data: {
						id: id
					},
					async: false,
					dataType: 'json',
					success: function(data) {
						$('#myModal input[name=txtTelpPlg]').val(data.no_telp);
						$('#myModal input[name=txtNamaPlg]').val(data.nama_plg);
						$('#myModal input[name=txtAlamatPlg]').val(data.alamat);
						$('#myModal input[name=txtId]').val(data.id_pelanggan);

					},
					error: function() {
						alert('Gagal edit data  ! ');
					}
				});
			});

			$('#showdata').on('click', '.item-delete', function() {
				var id = $(this).attr('data');
				$('#deleteModal').modal('show');
				$('#deleteModal').find('.modal-title').text('Are You Sure To Delete Item?');

				$('#btnDelete').unbind().click(function() {
					$.ajax({
						type: 'ajax',
						method: 'get',
						async: false,
						url: '<?= base_url() ?>admin/deletePelanggan',
						data: {
							id: id
						},
						dataType: 'json',
						success: function() {
							window.location.href = "<?= base_url() ?>admin/pelanggan";
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
				$('#myModal input[name=txtTelpPlg]').val("");
				$('#myModal input[name=txtNamaPlg]').val("");
				$('#myModal input[name=txtAlamatPlg]').val("");
			});
		});
	</script>
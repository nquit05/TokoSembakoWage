<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Jenis Barang</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>

	<div class="row">
		<div class="alert alert-success" style="display:none;">

		</div>

		<div class="col-lg-6">
			<button id="btnAdd" class="btn btn-primary"><span class="fa fa-plus"></span> Tambah Jenis</button>
		</div>
	</div>

	<br>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nama Jenis</th>
							<th>Admin</th>
							<th>Action</th>
						</tr>
					</thead>

					<tbody id="showdata">
						<?php
						$no = 1;
						foreach ($dataJenis as $row) :
							?>
							<tr>
								<td><?= $row->id_jenis ?></td>
								<td><?= $row->nama_jenis ?></td>
								<td><?= $this->session->userdata('USERNAME') ?></td>
								<td>
									<button class="btn btn-default btn-sm item-edit" data="<?= $row->id_jenis ?>"><span class="fa fa-edit"></span> Edit </button> &nbsp
									<button class="btn btn-danger btn-sm item-delete" data="<?= $row->id_jenis ?>"><span class="fa fa-trash"></span> Delete</button></td>
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
							<label for="name" class="label-control col-md-4">Nama Jenis</label>
							<div class="col-md-8">
								<input type="text" name="txtNamaJenis" value="" class="form-control">
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
</div>

<script>
	$(document).ready(function() {
		//add new
		$('#btnAdd').click(function() {
			$('#myModal').modal('show');
			$('#myModal').find('.modal-title').text('Tambah Jenis');
			$('#myForm').attr('action', '<?= base_url() ?>admin/addJenis');
		});

		$('#btnSave').click(function() {
			var url = $('#myForm').attr('action');
			var data = $('#myForm').serialize();
			// validate myForm

			var namaJenis = $('input[name=txtNamaJenis]');
			var result = '';

			if (namaJenis.val() == '') {
				namaJenis.parent().parent().addClass('has-error');
			} else {
				namaJenis.parent().parent().removeClass('has-error');
				result += '1';
			}

			if (result == '1') {
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: url,
					data: data,
					async: false,
					dataType: 'json',
					success: function(response) {
						if (response.success) {
							window.location.href = "<?= base_url() ?>admin/jenis";
							$('#myModal').modal('hide');
							$('#myForm')[0].reset();
							$('.alert-success').html('Jenis telah di tambahkan ').fadeIn().delay(4000).fadeOut('slow');

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
			$('#myModal').find('.modal-title').text('Edit Jenis Barang');
			$('#myForm').attr('action', '<?= base_url() ?>admin/updateJenis');
			$.ajax({
				type: 'ajax',
				method: 'get',
				url: '<?php echo base_url() ?>admin/editJenis',
				data: {
					id: id
				},
				async: false,
				dataType: 'json',
				success: function(data) {
					$('#myModal input[name=txtNamaJenis]').val(data.nama_jenis);
					$('#myModal input[name=txtId]').val(data.id_jenis);

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
					url: '<?= base_url() ?>admin/deleteJenis',
					data: {
						id: id
					},
					dataType: 'json',
					success: function() {
						window.location.href = "<?= base_url() ?>admin/jenis";
						$('#deleteModal').modal('hide');
						$('.alert-success').html('Jenis telah di hapus !').fadeIn().delay(10000).fadeOut('slow');
					},
					error: function() {
						alert('Gagal menghapus ! ');
					}
				});
			});
		});

		// Clean Modal
		$('#btnClose').click(function() {
			$('#myModal input[name=txtNamaJenis]').val("");
		});

	});
</script>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Transaksi Hutang</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <div class="row">
		<div class="alert alert-success" style="display:none;">

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
							<th>ID Hutang</th>
							<th>NO Transaksi</th>
							<th>Total Hutang</th>
							<th>Sisa Hutang</th>
							<th>Tanggal Melunasi</th>
							<th>Status</th>
						</tr>
					</thead>

					<tbody id="showdata">
						<?php
						$no = 1;
						foreach ($qhutang as $row):
							?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $row->ID_HUTANG ?></td>
								<td><?= $row->NO_TRANSAKSI ?></td>
								<td><?= $row->JMLH_HUTANG ?></td>
								<td><?= $row->SISA_HUTANG?></td>
								<td><?= $row->TGL_MELUNASI?></td>
								<td><?php
									if($row->STATUS == 0){
										echo "LUNAS";
									}else{
										echo "HUTANG";
									}
								?></td>
								<td><button class="btn btn-default btn-sm item-edit" 
									data="<?= $row ->ID_HUTANG?>"><span class="fa fa-edit"></span> Edit Status </button></td>            
								</tr>

							<?php endforeach?>
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
							<input type="hidden" name="txtOwner" value="<?= $this->session->userdata('ID_USER')?>">
							<div class="form-group">
								<label for="jenis" class="label-control col-md-4">Status</label>
								<div class="col-md-8">
									<select class="form-control" name="txtStatus">
										<option value="0">LUNAS</option>
										<option value="1">HUTANG</option>
									</select>
								</div>
							</div>

						</form>
					</div>
					<div class="modal-footer">
						<button id="btnClose"type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button id="btnSave" type="button" class="btn btn-primary">Save Data</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

		<script type="text/javascript">
			$(document).ready(function(){
  				//edit
				$('#showdata').on('click','.item-edit',function(){
					var id = $(this).attr('data');
					$('#myModal').modal('show');
					$('#myModal').find('.modal-title').text('Edit Status');
					$('#myForm').attr('action', '<?= base_url()?>admin/updateHutang');
					$.ajax({
						type: 'ajax',
						method:'get',
						url: '<?php echo base_url() ?>admin/getDataHutang',
						data:{id: id},
						async: false,
						dataType: 'json',
						success: function(data){
							$('#myModal input[name=txtStatus]').val(data.STATUS);
							$('#myModal input[name=txtId]').val(data.ID_HUTANG);

						},
						error: function(){
							alert('Gagal edit data  ! ');
						}
					});
				});
				
			    $("#btnSave").on('click', function(){
			      var data = $("#myForm").serialize();
			      console.log(data);
			      $.ajax({
			        type : 'ajax',
			        method : 'post',
			        async : false,
			        url : '<?= base_url() ?>admin/updateHutang',
			        data : data,
			        dataType: 'json',
			        success: function(response){
			          if(response.success){
						  window.location.href = "<?= base_url()?>admin/transaksi_hutang";

			              $('#myModalEdit').modal('hide');
			              $('.alert-success').html('Barang telah di edit !').fadeIn().delay(4000).fadeOut('slow');

			          }else{
			            alert('Error ! ');
			          }
			        },

			        error: function(){
			          alert('Gagal edit ! ');
			        }
			    });
			   });
  			});
  		</script>
</div>

   
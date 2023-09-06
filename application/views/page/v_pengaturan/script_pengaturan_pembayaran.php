<div id="modal-tambah" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header clearfix text-left">
		    	<h5 class="modal-title">Edit <?= $halaman ?></h5>
		    	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">×</span>
	            </button>

		    </div>

			<div class="modal-body">
			<form method="POST" action="#" id="formSimpan" enctype="multipart/form-data">
				<br>
				<div class="row">
				  <div class="col-md-12">
				    <div class="form-group form-group-default">
				      <label>Nama pembayaran</label>
				      <input type="text" name="nama_pembayaran" id="nama_pembayaran" class="form-control" required ="">
				    </div>
				  </div>
				</div>

				<div class="row">
				  <div class="col-md-4 m-t-10 sm-m-t-10">
				    <button type="submit" class="btn btn-primary btn-block m-t-5">Simpan</button>
				  </div>
				</div>
			</div>

			
			<?= form_close() ?>
		</div>
	</div>
</div>

<div id="modal-edit" class="modal fade" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header clearfix text-left">
		    	<h5 class="modal-title">Edit <?= $halaman ?></h5>
		    	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">×</span>
	            </button>

		    </div>

			<div class="modal-body">
			<form method="POST" action="#" id="formEdit" enctype="multipart/form-data">
				<br>
				<input type="hidden" name="edit_id" id="edit_id">
				
				<div class="row">
				  <div class="col-md-12">
				    <div class="form-group form-group-default">
				      <label>Nama pembayaran</label>
				      <input type="text" name="e_nama_pembayaran" id="e_nama_pembayaran" class="form-control" required ="">
				    </div>
				  </div>
				</div>

				<div class="row">
				  <div class="col-md-4 m-t-10 sm-m-t-10">
				    <button type="submit" class="btn btn-primary btn-block m-t-5">Simpan</button>
				  </div>
				</div>
			</div>

			
			<?= form_close() ?>
		</div>
	</div>
</div>

<div id="modal-hapus" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header bg-pink">
				<h6 class="modal-title text-white">Hapus Data</h6>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<div class="modal-body">
			<form method="POST" action="#" id="formHapus">
				<div class="row">
					<input type="hidden" id="hapus_id" name="hapus_id">
					<label>Apakah anda ingin menghapus data ini?</label>
				
				</div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
				<button type="submit" class="btn btn-danger">Hapus</button>
			</div>
			<?= form_close() ?>
		</div>
	</div>
</div>

<script>
$(document).ready(function(e){
	
	var base_url = "<?php echo base_url();?>";
	var nm_tabel = "pengaturan_pembayaran";

	var table = $('#datatable').DataTable({
		"pageLength" : 10,
		"serverSide": true,
		"lengthChange": false,
		"order": [[0, "asc" ]],
		"ajax":{
				url :  base_url+nm_tabel+'/show',
				type : 'POST'
				},
		
	}); // End of DataTable
	table.on( "order.dt search.dt processing.dt", function (){ 
        table.column(0,{ search:"applied", order:"applied" }).nodes().each( function (cell, i) 
        {cell.innerHTML = i+1; });
    }).draw();
	// setInterval( function () {
	// 	table.ajax.reload();
	// }, 1000 );
	$('body').tooltip({selector: '[data-toggle="tooltip"]'});

	$('.select2').select2();

	$('#formSimpan').submit('click',function(){
		$.ajax({
			type : "POST",
			url  : base_url+nm_tabel+'/save',
			data:new FormData(this), //this is formData
			processData:false,
			contentType:false,
			cache:false,
			async:false,
			success: function(data){
				$('#modal-tambah').modal('hide');
				$('.form-control').val('');
				table.ajax.reload();
			    $.toast().reset('all');   
				$("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
				$.toast({
					text: '<i class="jq-toast-icon ti-face-smile"></i><p>Data berhasil disimpan.</p>',
					position: 'top-center',
					loaderBg:'#7a5449',
					class: 'jq-has-icon jq-toast-success',
					hideAfter: 3500, 
					stack: 6,
					showHideTransition: 'fade'
		        });
			},
			error: function(data){
			    $.toast().reset('all');   
				$("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
				$.toast({
					text: '<p>Data gagal disimpan.</p>',
					position: 'top-center',
					loaderBg:'#7a5449',
					class: 'jq-toast-danger',
					hideAfter: 3500, 
					stack: 6,
					showHideTransition: 'fade'
		        });
			}
		});
		return false;
    });

	$('#formEdit').submit('click',function(){
		$.ajax({
			type : "POST",
			url  : base_url+nm_tabel+'/edit',
			data:new FormData(this), //this is formData
			processData:false,
			contentType:false,
			cache:false,
			async:false,
			success: function(data){
				$('#modal-edit').modal('hide');
				$('.form-control').val('');
				table.ajax.reload();
			    $.toast().reset('all');   
				$("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
				$.toast({
					text: '<i class="jq-toast-icon ti-face-smile"></i><p>Data berhasil disimpan.</p>',
					position: 'top-center',
					loaderBg:'#7a5449',
					class: 'jq-has-icon jq-toast-success',
					hideAfter: 3500, 
					stack: 6,
					showHideTransition: 'fade'
		        });
			},
			error: function(data){
			    $.toast().reset('all');   
				$("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
				$.toast({
					text: '<p>Data gagal disimpan.</p>',
					position: 'top-center',
					loaderBg:'#7a5449',
					class: 'jq-toast-danger',
					hideAfter: 3500, 
					stack: 6,
					showHideTransition: 'fade'
		        });
			}
		});
		return false;
    });

	$('#formHapus').submit('click',function(){
		$.ajax({
			type : "POST",
			url  : base_url+nm_tabel+'/hapus',
			data:new FormData(this), //this is formData
			processData:false,
			contentType:false,
			cache:false,
			async:false,
			success: function(data){
				$('#modal-hapus').modal('hide');
				table.ajax.reload();
			    $.toast().reset('all');   
				$("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
				$.toast({
					text: '<i class="jq-toast-icon ti-face-smile"></i><p>Data berhasil dihapus.</p>',
					position: 'top-center',
					loaderBg:'#7a5449',
					class: 'jq-has-icon jq-toast-success',
					hideAfter: 3500, 
					stack: 6,
					showHideTransition: 'fade'
		        });
			},
			error: function(data){
			    $.toast().reset('all');   
				$("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
				$.toast({
					text: '<p>Data gagal dihapus.</p>',
					position: 'top-center',
					loaderBg:'#7a5449',
					class: 'jq-toast-danger',
					hideAfter: 3500, 
					stack: 6,
					showHideTransition: 'fade'
		        });
			}
		});
		return false;
    });

	$('#datatable').on('click','.editData',function(){
		$('#edit_id').val($(this).data('id'));           
		$('#e_nama_pembayaran').val($(this).data('nama_pembayaran'));
		$('#modal-edit').modal('show');
    });

	$('#datatable').on('click','.hapusData',function(){
		$('#hapus_id').val($(this).data('id'));           
		$('#modal-hapus').modal('show');
    });

}); // End Document Ready Function
</script>

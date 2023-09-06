<div class="modal fade stick-up" id="modal-cek" tabindex="-1" >
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
	    <div class="modal-header clearfix text-left">
	    	<h5 class="modal-title"><?= $halaman ?></h5>
	    	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>

	    </div>
	    <div class="modal-body">
	      <form method="POST" action="#" id="formCek" enctype="multipart/form-data">
	      	<input type="hidden" name="cek_id" id="cek_id">
	        <div class="form-group-attached">
	          <div class="row">
	            <div class="col-md-6">
	              <div class="form-group form-group-default">
	                <label>Tanggal Kunjungan</label>
	                <input type="text" name="tanggal_kunjungan" id="tanggal_kunjungan" class="form-control" required="" readonly>
	              </div>
	            </div>
	            <div class="col-md-6">
	              <div class="form-group form-group-default">
	                <label>Tujuan Poli</label>
	                <select name="tujuan_poli" id="tujuan_poli" class="form-control select2" required="">
	                	<?php
	                	$result = $this->db->get('pengaturan_poli')->result();
	                	foreach($result as $data){
	                		echo "<option value='$data->id_poli'>$data->nama_poli</option>";
	                	}
	                	?>
	                </select>
	              </div>
	            </div>
	          </div>

	          <div class="row">
	            <div class="col-md-6">
	              <div class="form-group form-group-default">
	                <label>DRM Keluar</label>
	                <input type="datetime" name="drm_keluar" id="drm_keluar" class="form-control" value="now" required="" readonly>
	              </div>
	            </div>
	            <div class="col-md-6">
	              <div class="form-group form-group-default">
	                <label>DRM Masuk</label>
	                <input type="datetime" name="drm_masuk" id="drm_masuk" class="form-control" value="now" required="" readonly>
	              </div>
	            </div>
	          </div>

	          <div class="row">
	            <div class="col-md-6">
	              <div class="form-group form-group-default">
	                <label>No RM</label>
	                <input type="text" name="no_rm" id="no_rm" class="form-control" required="" readonly>
	              </div>
	            </div>
	            <div class="col-md-6">
	              <div class="form-group form-group-default">
	                <label>Nama Pasien</label>
	                <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" required="" readonly>
	              </div>
	            </div>
	          </div>

	          <div class="row">
	            <div class="col-md-12">
	              <div class="form-group form-group-default">
	                <label>Alamat</label>
	                <input type="text" name="alamat" id="alamat" class="form-control" required="" readonly>
	              </div>
	            </div>
	          </div>

	          <div class="row">
	            <div class="col-md-6">
	              <div class="form-group form-group-default">
	                <label>Keterangan DRM</label>
	                <select name="keterangan_drm" id="keterangan_drm" class="form-control select2" required="">
	                	<option>LENGKAP</option>
	                	<option>TIDAK LENGKAP</option>
	                </select>
	              </div>
	            </div>
	          </div>
	          
	        </div>
	      
	      <div class="row">
	        <div class="col-md-4 m-t-10 sm-m-t-10">
	          <button type="submit" class="btn btn-primary btn-block m-t-5">Simpan</button>
	        </div>
	      </div>
	      </form>
	    </div>
	  </div>
	  <!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
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
	var nm_tabel = "cek_kelengkapan";

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

	$('#formCek').submit('click',function(){
		$.ajax({
			type : "POST",
			url  : base_url+nm_tabel+'/save',
			data:new FormData(this), //this is formData
			processData:false,
			contentType:false,
			cache:false,
			async:false,
			success: function(data){
				$('#modal-cek').modal('hide');
				// $('.form-control').val('');
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

    $('#filter_tanggal').on('change',function(){
    	var filter_tanggal = $('#filter_tanggal').val();
		$.ajax({
			type : "GET",
			url  : base_url+nm_tabel+'/filter_tanggal',
			processData:false,
			contentType:false,
            data : "filter_tanggal="+filter_tanggal,
			success: function(data){
				table.ajax.reload();
			    $.toast().reset('all');   
				$("body").removeAttr('class').removeClass("bottom-center-fullwidth").addClass("top-center-fullwidth");
				$.toast({
					text: '<i class="jq-toast-icon ti-face-smile"></i><p>Menampilkan data.</p>',
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
					text: '<p>Data gagal ditampilkan.</p>',
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

	$('#datatable').on('click','.cekData',function(){
		$('#cek_id').val($(this).data('id'));           
		$('#tanggal_kunjungan').val($(this).data('tanggal_kunjungan'));           
		$('#tujuan_poli').val($(this).data('tujuan_poli')).trigger('change');           
		$('#no_rm').val($(this).data('no_rm'));           
		$('#nama_pasien').val($(this).data('nama_pasien'));           
		$('#alamat').val($(this).data('alamat'));           
		$('#drm_masuk').val($(this).data('drm_masuk'));           
		$('#drm_keluar').val($(this).data('drm_keluar'));           
		$('#modal-cek').modal('show');
    });

	$('#datatable').on('click','.hapusData',function(){
		$('#hapus_id').val($(this).data('id'));           
		$('#modal-hapus').modal('show');
    });

}); // End Document Ready Function
</script>

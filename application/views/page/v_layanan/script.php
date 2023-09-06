<div class="modal fade stick-up" id="modal-entri" tabindex="-1" >
	<div class="modal-dialog modal-lg">
	  <div class="modal-content">
	    <div class="modal-header clearfix text-left">
	    	<h5 class="modal-title"><?= $halaman ?></h5>
	    	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>

	    </div>
	    <div class="modal-body">
	      <form method="POST" action="#" id="formSimpan" enctype="multipart/form-data">
	      	<input type="hidden" name="entri_id" id="entri_id">
	        <div class="form-group-attached">

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
	            <div class="col-md-6">
	              <div class="form-group form-group-default">
	                <label>Kepala Keluarga</label>
	                <input type="text" name="kepala_keluarga" id="kepala_keluarga" class="form-control" required="" readonly>
	              </div>
	            </div>
	            <div class="col-md-6">
	              <div class="form-group form-group-default">
	                <label>Tujuan Poli</label>
	                <input type="text" name="poli" id="poli" class="form-control" readonly>
	              </div>
	            </div>
	          </div>

	          <div class="row">
	            <div class="col-md-6">
	              <div class="form-group form-group-default">
	                <label>Diagnosa Utama</label>
	                <select name="diagnosa_utama" id="diagnosa_utama" class="form-control select2" required="">
	                	<option></option>
	                	<?php
	                	$result = $this->db->get('pengaturan_diagnosa')->result();
	                	foreach($result as $data){
	                		echo "<option value='$data->id_diagnosa'>$data->icd - $data->diagnosa</option>";
	                	}
	                	?>
	                </select>
	              </div>
	            </div>
	            <div class="col-md-6">
	              <div class="form-group form-group-default">
	                <label>Keterangan</label>
	                <select name="status_1" id="status_1" class="form-control select2" required="">
	                	<option></option>
	                	<option>BARU</option>
	                	<option>LAMA</option>
	                	<option>KKL</option>
	                </select>
	              </div>
	            </div>
	          </div>

	          <div class="row">
	            <div class="col-md-6">
	              <div class="form-group form-group-default">
	                <label>Diagnosa Sekunder 1</label>
	                <select name="diagnosa_sekunder" id="diagnosa_sekunder" class="form-control select2" >
	                	<option></option>
	                	<?php
	                	$result = $this->db->get('pengaturan_diagnosa')->result();
	                	foreach($result as $data){
	                		echo "<option value='$data->id_diagnosa'>$data->icd - $data->diagnosa</option>";
	                	}
	                	?>
	                </select>
	              </div>
	            </div>
	            <div class="col-md-6">
	              <div class="form-group form-group-default">
	                <label>Keterangan</label>
	                <select name="status_2" id="status_2" class="form-control select2" >
	                	<option></option>
	                	<option>BARU</option>
	                	<option>LAMA</option>
	                	<option>KKL</option>
	                </select>
	              </div>
	            </div>
	          </div>

	          <div class="row">
	            <div class="col-md-6">
	              <div class="form-group form-group-default">
	                <label>Diagnosa Sekunder 2</label>
	                <select name="diagnosa_sekunder_2" id="diagnosa_sekunder_2" class="form-control select2" >
	                	<option></option>
	                	<?php
	                	$result = $this->db->get('pengaturan_diagnosa')->result();
	                	foreach($result as $data){
	                		echo "<option value='$data->id_diagnosa'>$data->icd - $data->diagnosa</option>";
	                	}
	                	?>
	                </select>
	              </div>
	            </div>
	            <div class="col-md-6">
	              <div class="form-group form-group-default">
	                <label>Keterangan</label>
	                <select name="status_3" id="status_3" class="form-control select2" >
	                	<option></option>
	                	<option>BARU</option>
	                	<option>LAMA</option>
	                	<option>KKL</option>
	                </select>
	              </div>
	            </div>
	          </div>

	          <div class="row">
	            <div class="col-md-12">
	              <div class="form-group form-group-default">
	                <label>Terapi</label>
	                <textarea name="terapi" id="terapi" class="form-control" required=""></textarea>
	              </div>
	            </div>
	          </div>

	          <div class="row">
	            <div class="col-md-6">
	              <div class="form-group form-group-default">
	                <label>Dokter</label>
	                <select name="dokter" id="dokter" class="form-control select2" >
	                	<option></option>
	                	<?php
	                	$result = $this->db->get('dokter')->result();
	                	foreach($result as $data){
	                		echo "<option value='$data->id_dokter'>$data->nama_dokter</option>";
	                	}
	                	?>
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
	var nm_tabel = "layanan_umum";

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

	$('#cek_drm_keluar').on('click',function(){
		var d = new Date(),        
		h = d.getHours(),
		m = d.getMinutes();
		if(h < 10) h = '0' + h; 
		if(m < 10) m = '0' + m; 
		$('#drm_keluar').each(function(){ 
			$(this).attr({'value': h + ':' + m});
		});
	});

	$('#cek_drm_masuk').on('click',function(){
		var d = new Date(),        
		h = d.getHours(),
		m = d.getMinutes();
		if(h < 10) h = '0' + h; 
		if(m < 10) m = '0' + m; 
		$('#drm_masuk').each(function(){ 
			$(this).attr({'value': h + ':' + m});
		});
	});

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
				$('#modal-entri').modal('hide');
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

	$('#datatable').on('click','.entriData',function(){
		$('#entri_id').val($(this).data('id'));                     
		$('#no_rm').val($(this).data('no_rm'));           
		$('#nama_pasien').val($(this).data('nama_pasien'));           
		$('#kepala_keluarga').val($(this).data('kepala_keluarga'));           
		$('#poli').val($(this).data('poli'));           
		$('#modal-entri').modal('show');
    });

	$('#datatable').on('click','.hapusData',function(){
		$('#hapus_id').val($(this).data('id'));           
		$('#modal-hapus').modal('show');
    });

}); // End Document Ready Function
</script>

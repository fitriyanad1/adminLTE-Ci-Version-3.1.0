<script type="text/javascript">
	var MyTable = $('#list-data').dataTable({
		  "paging": true,
		  "lengthChange": true,
		  "searching": true,
		  "ordering": true,
		  "info": true,
		  "autoWidth": false,
		});

	window.onload = function() {
		// tampilPegawai();
		// tampilPosisi();
		// tampilKota();
		tampilPerusahaan();
		tampilAdmin();
		tampilProduksi();
		tampilPencadangan();
		tampilKelola();

		<?php
			if ($this->session->flashdata('msg') != '') {
				echo "effect_msg();";
			}
		?>
	}

	function refresh() {
		MyTable = $('#list-data').dataTable();
	}

	function timedRefresh(timeoutPeriod) {
		setTimeout("location.reload(true);",timeoutPeriod);
	}

	function effect_msg_form() {
		// $('.form-msg').hide();
		$('.form-msg').show(1000);
		setTimeout(function() { $('.form-msg').fadeOut(1000); }, 3000);
	}

	function effect_msg() {
		// $('.msg').hide();
		$('.msg').show(1000);
		setTimeout(function() { $('.msg').fadeOut(1000); }, 3000);
	}

	function tampilPegawai() {
		$.get('<?php echo base_url('Pegawai/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-pegawai').html(data);
			refresh();
		});
	}

	var id_pegawai;
	$(document).on("click", ".konfirmasiHapus-pegawai", function() {
		id_pegawai = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataPegawai", function() {
		var id = id_pegawai;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pegawai/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilPegawai();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataPegawai", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pegawai/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-pegawai').modal('show');
		})
	})

	$('#form-tambah-pegawai').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pegawai/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPegawai();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-pegawai").reset();
				$('#tambah-pegawai').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-pegawai', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pegawai/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPegawai();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-pegawai").reset();
				$('#update-pegawai').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	})

	$('#tambah-pegawai').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-pegawai').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Kota
	function tampilKota() {
		$.get('<?php echo base_url('Kota/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-kota').html(data);
			refresh();
		});
	}

	var id_kota;
	$(document).on("click", ".konfirmasiHapus-kota", function() {
		id_kota = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataKota", function() {
		var id = id_kota;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kota/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilKota();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataKota", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kota/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-kota').modal('show');
		})
	})

	$(document).on("click", ".detail-dataKota", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Kota/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-kota').modal('show');
		})
	})

	$('#form-tambah-kota').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kota/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKota();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-kota").reset();
				$('#tambah-kota').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-kota', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Kota/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilKota();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-kota").reset();
				$('#update-kota').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-kota').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-kota').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	//Posisi
	function tampilPosisi() {
		$.get('<?php echo base_url('Posisi/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-posisi').html(data);
			refresh();
		});
	}

	var id_posisi;
	$(document).on("click", ".konfirmasiHapus-posisi", function() {
		id_posisi = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataPosisi", function() {
		var id = id_posisi;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Posisi/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilPosisi();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataPosisi", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Posisi/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-posisi').modal('show');
		})
	})

	$(document).on("click", ".detail-dataPosisi", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Posisi/detail'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#tabel-detail').dataTable({
				  "paging": true,
				  "lengthChange": false,
				  "searching": true,
				  "ordering": true,
				  "info": true,
				  "autoWidth": false
				});
			$('#detail-posisi').modal('show');
		})
	})

	$('#form-tambah-posisi').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Posisi/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPosisi();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-posisi").reset();
				$('#tambah-posisi').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-posisi', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Posisi/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPosisi();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-posisi").reset();
				$('#update-posisi').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-posisi').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-posisi').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

//Perusahaan
	function tampilPerusahaan() {
		$.get('<?php echo base_url('Perusahaan/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-perusahaan').html(data);
			refresh();
		});
	}

	var id_perusahaan;
	$(document).on("click", ".konfirmasiHapus-perusahaan", function() {
		id_perusahaan = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataPerusahaan", function() {
		var id = id_perusahaan;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Perusahaan/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilPerusahaan();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataPerusahaan", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Perusahaan/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-perusahaan').modal('show');
		})
	})

	$('#form-tambah-perusahaan').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Perusahaan/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

	tampilPerusahaan();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-perusahaan").reset();
				$('#tambah-perusahaan').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-perusahaan', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Perusahaan/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPerusahaan();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-perusahaan").reset();
				$('#update-perusahaan').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-perusahaan').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-perusahaan').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

//Admin
	function tampilAdmin() {
		$.get('<?php echo base_url('Admin/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-admin').html(data);
			refresh();
		});
	}

	var id_admin;
	$(document).on("click", ".konfirmasiHapus-admin", function() {
		id_admin = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataAdmin", function() {
		var id = id_admin;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Admin/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilAdmin();
			$('.msg').html(data);
			effect_msg();
		})
	})

	$(document).on("click", ".update-dataAdmin", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Admin/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-admin').modal('show');
		})
	})

	$('#form-tambah-admin').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Admin/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilAdmin();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-admin").reset();
				$('#tambah-admin').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit','#form-update-admin', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Admin/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilAdmin();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-admin").reset();
				$('#update-admin').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

/*	$(document).on('submit','#form-update-admin-pass', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Admin/prosesUpdatePass'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilAdmin();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-admin-pass").reset();
				$('#update-admin').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});*/

	$('#tambah-admin').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-admin').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

//Produksi
	function tampilProduksi() {
		$.get('<?php echo base_url('Produksi/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-produksi').html(data);
			refresh();
		});
	}

	//var id_produksi;
/*	$(document).on("click", ".konfirmasiHapus-produksi", function() {
		id_produksi = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataAdmin", function() {
		var id = id_produksi;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Produksi/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilProduksi();
			$('.msg').html(data);
			effect_msg();
		})
	})
*/
/*	$(document).on("click", ".kelola-dataProduksi", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Produksi/ambilProduksi'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#data-kelolaproduksi').html(data);
			//$('#update-produksi').modal('show');
		})
	})*/

	$('#form-tambah-produksi').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Produksi/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilProduksi();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-produksi").reset();
				$('#tambah-produksi').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-produksi', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Produksi/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilProduksi();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-produksi").reset();
				$('#update-produksi').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-produksi').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-produksi').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

//KelolaProduksi
	var id_get;
	$(document).on("click", ".kelola-dataProduksi", function() {
		id_get = $(this).attr("data-id");
		// console.log('id dari click kelola-dataproduksi :'+id_get);
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('KelolaProduksi/tampil'); ?>",
			data: "id=" +id_get
		})
		.done(function(data) {
			MyTable.fnDestroy();
			$('#data-kelolaproduksi').html(data);
			refresh();
			console.log("Set id get: "+id_get);
			tampilKelola(id_get);
		})
	})

	function tampilKelola(id) {
		// $.get('<?php echo base_url('KelolaProduksi/index'); ?>', function(data) {
		// 	MyTable.fnDestroy();
		// 	$('#data-kelolaproduksi').html(data);
			// refresh();
		// });
		// var id = $(this).attr("data-id");
		// console.log('id from tampilKelola: '+id);
		
		// $.ajax({
		// 	method: "POST",
		// 	url: "<?php echo base_url('KelolaProduksi/tampil'); ?>",
		// 	data: "id=" +id
		// })
		// .done(function(data) {
		// 	MyTable.fnDestroy();
		// 	$('#data-kelolaproduksi').html(data);
		// 	refresh();
		// })
		// console.log("id_get tampilKelola: "+id);
	}


	$(document).on("click", ".update-dataBayar", function() {
		var id = $(this).attr("data-id");
		// console.log("id-klikupdate: "+id);
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('KelolaProduksi/bayar'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-bayar').modal('show');
		})
	})

	$('#form-tambah-pajak').submit(function(e) {
		var data = $(this).serialize();
		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('KelolaProduksi/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			console.log(data);
			var out = jQuery.parseJSON(data);
			// console.log(out);
		// index();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-pajak").reset();
				$('#tambah-pajak').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
				timedRefresh(1500);
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-pajak-bayar', function(e){
		var dataSerialize = $(this).serialize();
		var formdata = new FormData(this);
		// console.log(dataSerialize);
		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('KelolaProduksi/prosesBayar'); ?>',
			data: formdata,
			// dataType: "json",
			processData: false,
			contentType: false,
		})
		.done(function(data) {
			var pre_out = "{"+data.split('{').pop().split('}').shift()+"}";
			var out = jQuery.parseJSON(pre_out);
			// console.log(out);
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-pajak-bayar").reset();
				$('#update-bayar').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
				timedRefresh(1500);
			}
		})
		
		e.preventDefault();
	});

	$('#tambah-pajakproduksi').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

	$('#update-bayar').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

//Pencadangan Wilayah
	function tampilPencadangan() {
		$.get('<?php echo base_url('Pencadangan/tampil'); ?>', function(data) {
			MyTable.fnDestroy();
			$('#data-pencadangan').html(data);
			refresh();
		});
	}

	var id_pencadangan;
	$(document).on("click", ".konfirmasiHapus-pencadangan", function() {
		id_pencadangan = $(this).attr("data-id");
	})
	$(document).on("click", ".hapus-dataPencadangan", function() {
		var id = id_pencadangan;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pencadangan/delete'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#konfirmasiHapus').modal('hide');
			tampilPegawai();
			$('.msg').html(data);
			effect_msg();
		})
	})

/*	var id_pencadangan;
	$(document).on("click", ".approve-dataPencadangan", function() {
		id_pencadangan = $(this).attr("data-id");
	})
	$(document).on("click", ".approve-dataPencadangan", function() {
		var id = id_pencadangan;
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pencadangan/approve'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#approve-pencadangan').modal('hide');
			tampilPencadangan();
			$('.msg').html(data);
			effect_msg();
		})
	})
*/

	$(document).on("click", ".approve-dataPencadangan", function() {
		var id = $(this).attr("data-id");
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pencadangan/approve'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#approve-pencadangan').modal('show');
		})
	})
	
	$(document).on("click", ".update-dataPencadangan", function() {
		var id = $(this).attr("data-id");
		// console.log('id update-dataPencadangan :'+id);
		
		$.ajax({
			method: "POST",
			url: "<?php echo base_url('Pencadangan/update'); ?>",
			data: "id=" +id
		})
		.done(function(data) {
			$('#tempat-modal').html(data);
			$('#update-pencadangan').modal('show');
		})
	})

	$('#form-tambah-pencadangan').submit(function(e) {
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pencadangan/prosesTambah'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPencadangan();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-tambah-pencadangan").reset();
				$('#tambah-pencadangan').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-update-pencadangan', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pencadangan/prosesUpdate'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);

			tampilPencadangan();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-update-pencadangan").reset();
				$('#update-pencadangan').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

	$(document).on('submit', '#form-approve-pencadangan', function(e){
		var data = $(this).serialize();

		$.ajax({
			method: 'POST',
			url: '<?php echo base_url('Pencadangan/prosesApprove'); ?>',
			data: data
		})
		.done(function(data) {
			var out = jQuery.parseJSON(data);
			tampilPencadangan();
			if (out.status == 'form') {
				$('.form-msg').html(out.msg);
				effect_msg_form();
			} else {
				document.getElementById("form-approve-pencadangan").reset();
				$('#approve-pencadangan').modal('hide');
				$('.msg').html(out.msg);
				effect_msg();
			}
		})
		
		e.preventDefault();
	});

$('#tambah-pencadangan').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

$('#update-pencadangan').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})

$('#approve-pencadangan').on('hidden.bs.modal', function () {
	  $('.form-msg').html('');
	})


</script>
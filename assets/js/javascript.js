//JS Menu responsive
$("#menu-toggle").click(function(e) {
	e.preventDefault();
	$("#wrapper").toggleClass("toggled");
	$("#logo-sysindo").toggleClass("d-none");
	$("#content").toggleClass("d-none");
	$("#border-radius").toggleClass("border-radius");
});

$(function() {
	$("#level").change(function() {
		if ($("#perusahaan").is(":selected")) {
			$("#pilih_perusahaan").show();
			$("#notPerusahaan").hide();
		} else {
			$("#pilih_perusahaan").hide();
			$("#notPerusahaan").show();
		}
	}).trigger('change');
});

$(function(){
	$('[data-toggle="tooltip"]').tooltip();
});

//Date Time Picker
$('.datepicker').datepicker({
	maxViewMode: 3,
	language: "id",
	format: 'yyyy-mm-dd',
	calendarWeeks: true,
	autoclose: true,
	todayHighlight: true
});
$(function () {
	$('[data-toggle="tooltip"]').tooltip()
});

//DataTables Satu Kolom
$(document).ready(function(){
	var t = $('.satuKolom').DataTable({
		"columnDefs": [{
			"searchable": false,
			"orderable": false,
			"targets": [0,1]
		}],
		"searching": false,
		"paging": false,
		"info": false,
		"ordering":false,
		"order": [[ 1, 'asc' ]]
	});
	t.on( 'order.dt search.dt', function() {
		t.column(0, {search:'applied', order:'applied'}).nodes().each(function (cell, i) {
			cell.innerHTML = i+1;
		});
	}).draw();
});

//DataTables Dua Kolom
$(document).ready(function(){
	var t = $('.duaKolom').DataTable({
		"columnDefs": [{
			"searchable": false,
			"orderable": false,
			"targets": [0,3]
		}],
		"pageLength": 50,
		"order": [[ 1, 'asc' ]]
	});
	t.on( 'order.dt search.dt', function() {
		t.column(0, {search:'applied', order:'applied'}).nodes().each(function (cell, i) {
			cell.innerHTML = i+1;
		});
	}).draw();
});

//DataTables Dua Kolom Panitia
$(document).ready(function(){
	var t = $('.duaKolomPanitia').DataTable({
		"columnDefs": [{
			"searchable": false,
			"orderable": false,
			"targets": 0
		}],
		"pageLength": 50
	});
	t.on( 'order.dt search.dt', function() {
		t.column(0, {search:'applied', order:'applied'}).nodes().each(function (cell, i) {
			cell.innerHTML = i+1;
		});
	}).draw();
});

//DataTables Tiga Kolom
$(document).ready(function(){
	var t = $('.tigaKolom').DataTable({
		"columnDefs": [{
			"searchable": false,
			"orderable": false,
			"targets": [0,4]
		}],
		"pageLength": 50,
		"order": [[ 0, 'asc' ]]
	});
	t.on( 'order.dt search.dt', function() {
		t.column(0, {search:'applied', order:'applied'}).nodes().each(function (cell, i) {
			cell.innerHTML = i+1;
		});
	}).draw();
});

//DataTables Empat Kolom
$(document).ready(function(){
	var t = $('.empatKolom').DataTable({
		"columnDefs": [{
			"searchable": false,
			"orderable": false,
			"targets": [0,5]
		}],
		"pageLength": 50,
		"order": [[ 0, 'asc' ]]
	});
	t.on( 'order.dt search.dt', function() {
		t.column(0, {search:'applied', order:'applied'}).nodes().each(function (cell, i) {
			cell.innerHTML = i+1;
		});
	}).draw();
});

//FlashData
$(function() {
	//Flashdata Tambah Produk
	$('.modalTambahProduk').on('click', function(){
		$('#modalProdukLabel').html('Tambah Produk');
		$('.modal-footer button[type=submit').html('Tambah');
		$('input').val("");
	});
	//Flashdata Ubah Produk
	$('.modalUbahProduk').on('click', function(){
		$('#modalProdukLabel').html('Ubah Produk');
		$('.modal-footer button[type=submit').html('Ubah');
		$('.modal-dialog .formProduk').attr('action', 'http://localhost/sysindo/admin/ubah_produk');
		
		//Ajax Ubah Produk
		const id = $(this).data('id');
		$.ajax({
			url: 'http://localhost/sysindo/admin/get_produk',
			data: {id : id},
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$('#id').val(data.id);
				$('#kode_produk').val(data.kode_produk);
				$('#nama_produk').val(data.nama_produk);
			}
		});
	});
	//Flashdata Tambah Perusahaan
	$('.modalTambahPerusahaan').on('click', function(){
		$('#modalPerusahaanLabel').html('Tambah Perusahaan');
		$('.modal-footer button[type=submit').html('Tambah');
		$('input').val("");
	});
	//Flashdata Ubah Perusahaan
	$('.modalUbahPerusahaan').on('click', function(){
		$('#modalPerusahaanLabel').html('Ubah Perusahaan');
		$('.modal-footer button[type=submit').html('Ubah');
		$('.modal-dialog .formPerusahaan').attr('action', 'http://localhost/sysindo/admin/ubah_perusahaan');
		
		//Ajax Ubah Perusahaan
		const id = $(this).data('id');
		$.ajax({
			url: 'http://localhost/sysindo/admin/get_perusahaan',
			data: {id : id},
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$('#id').val(data.id);
				$('#nama_perusahaan').val(data.nama_perusahaan);
				$('#id_produk').val(data.id_produk);
				$('#tanggal_kegiatan').val(data.tanggal_kegiatan);
			}
		});
		$.ajax({
			url: 'http://localhost/sysindo/admin/get_jadwal',
			data: {id : id},
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$('#tanggal_kegiatan').val(data.tanggal_kegiatan);
			}
		});
	});
	//Flashdata Tambah Perusahaan
	$('.modalTambahPeserta').on('click', function(){
		$('#modalPesertaLabel').html('Tambah Peserta');
		$('.modal-footer button[type=submit').html('Tambah');
		$('input').val("");
	});
	//Flashdata Ubah Perusahaan
	$('.modalUbahPeserta').on('click', function(){
		$('#modalPesertaLabel').html('Ubah Peserta');
		$('.modal-footer button[type=submit').html('Ubah');
		$('.modal-dialog .formPeserta').attr('action', 'http://localhost/sysindo/admin/ubah_peserta');
		
		//Ajax Ubah Perusahaan
		const id = $(this).data('id');
		$.ajax({
			url: 'http://localhost/sysindo/admin/get_peserta',
			data: {id : id},
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$('#id_peserta').val(data.id);
				$('#nama_peserta').val(data.nama_peserta);
				//$('#id_perusahaan').val(data.id_perusahaan);
				//$('#nomor_sertifikat').val(data.nomor_sertifikat);
				$('#status').val(data.status);
				// $('#tanggal_kehadiran').val(data.tanggal_kehadiran);
			}
		});
	});
	//Flashdata Tambah Jadwal
	$('.modalTambahJadwal').on('click', function(){
		$('#modalJadwalLabel').html('Tambah Jadwal');
		$('.modal-footer button[type=submit').html('Tambah');
		$('input').val("");
	});
	//Flashdata Ubah Jadwal
	$('.modalUbahJadwal').on('click', function(){
		$('#modalJadwalLabel').html('Ubah Jadwal');
		$('.modal-footer button[type=submit').html('Ubah');
		$('.modal-dialog .formJadwal').attr('action', 'http://localhost/sysindo/admin/ubah_jadwal');
		
		//Ajax Ubah Jadwal
		const id = $(this).data('id');
		$.ajax({
			url: 'http://localhost/sysindo/admin/get_jadwal',
			data: {id : id},
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$('#id').val(data.id);
				$('#nama_kegiatan').val(data.nama_kegiatan);
				$('#tanggal_kegiatan').val(data.tanggal_kegiatan);
				$('#id_perusahaan').val(data.id_perusahaan);
			}
		});
	});


	//Flashdata Ubah Perusahaan
	$('.modalUbahPesertaPanitia').on('click', function(){
		$('#modalPesertaLabel').html('Ubah Status Kehadiran Peserta');
		$('.modal-footer button[type=submit').html('Ubah');
		$('.modal-dialog .formPeserta').attr('action', 'http://localhost/sysindo/panitia/ubah_peserta');
		
		//Ajax Ubah Perusahaan
		const id = $(this).data('id');
		$.ajax({
			url: 'http://localhost/sysindo/panitia/get_peserta',
			data: {id : id},
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$('#id').val(data.id);
				$('#status').val(data.status);
				$('#tanggal_kehadiran').val(data.tanggal_kehadiran);
			}
		});
	});



});

$(document).ready(function() {
	var t = $('.dataTable').DataTable({
		"columnDefs": [{
			"searchable": false,
			"orderable": false,
			"targets": 'no-sort',
		}],
		"pageLength": 10,
		"lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
	});
	t.on('draw.dt', function() {
		t.column(0, {search:'applied', order:'applied'}).nodes().each(function (cell, i) {
			cell.innerHTML = i+1+'.';
		});
	}).draw();
});

$('.btn-tambah').on('click', function (){
	$('#tag').html('Tambah')
	$('#btn-aksi').html('Simpan').addClass('btn-success').removeClass('btn-danger')
	$('#_method').attr('value', 'POST')
	$('#id').removeAttr('name').removeAttr('value')

	if(!$(this).data('negara')){
		$('#negara').val('').removeAttr('readonly')
	}
	if(!$(this).data('tanggal')){
		$('#tanggal').val('').removeAttr('readonly').prop('disabled', false)
	}
	if(!$(this).data('kasus')){
		$('#kasus').val('').removeAttr('readonly')
	}
	if(!$(this).data('meninggal')){
		$('#meninggal').val('').removeAttr('readonly')
	}
	if(!$(this).data('sembuh')){
		$('#sembuh').val('').removeAttr('readonly')
	}
	if(!$(this).data('kondisi')){
		$('#kondisi').val('10').removeAttr('readonly').prop('disabled', false)
	}
	if(!$(this).data('rekomendasi')){
		$('#rekomendasi').val('').removeAttr('readonly')
	}
});
$('.btn-ubah').on('click', function (){
	$('#tag').html('Ubah')
	$('#btn-aksi').html('Simpan').addClass('btn-success').removeClass('btn-danger')
	$('#_method').attr('value', 'UPDATE')
	$('#id').attr('name', 'id').attr('value', $(this).data('id'))

	if($(this).data('negara')){
		$('#negara').val($(this).data('negara')).removeAttr('readonly')
	}
	if($(this).data('tanggal')){
		$('#tanggal').val($(this).data('tanggal')).attr('readonly', '').prop('disabled', true)
	}
	if($(this).data('kasus') != null){
		$('#kasus').val($(this).data('kasus')).removeAttr('readonly')
	}
	if($(this).data('meninggal') != null){
		$('#meninggal').val($(this).data('meninggal')).removeAttr('readonly')
	}
	if($(this).data('sembuh') != null){
		$('#sembuh').val($(this).data('sembuh')).removeAttr('readonly')
	}
	if($(this).data('kondisi') != null){
		$('#kondisi').val($(this).data('kondisi')).removeAttr('readonly').prop('disabled', false)
	}
	if($(this).data('rekomendasi') != null){
		$('#rekomendasi').val($(this).data('rekomendasi')).removeAttr('readonly')
	}
	
});
$('.btn-hapus').on('click', function (){
	$('#tag').html('Hapus')
	$('#btn-aksi').html('Hapus').addClass('btn-danger').removeClass('btn-success')
	$('#_method').attr('value', 'DELETE')
	$('#id').attr('name', 'id').attr('value', $(this).data('id'))


	if($(this).data('negara')){
		$('#negara').val($(this).data('negara')).attr('readonly', '')
	}
	if($(this).data('tanggal')){
		$('#tanggal').val($(this).data('tanggal')).attr('readonly', '').prop('disabled', true)
	}
	if($(this).data('kasus') != null){
		$('#kasus').val($(this).data('kasus')).attr('readonly', '')
	}
	if($(this).data('meninggal') != null){
		$('#meninggal').val($(this).data('meninggal')).attr('readonly', '')
	}
	if($(this).data('sembuh') != null){
		$('#sembuh').val($(this).data('sembuh')).attr('readonly', '')
	}
	if($(this).data('kondisi') != null){
		$('#kondisi').val($(this).data('kondisi')).attr('readonly', '').prop('disabled', true)
	}
	if($(this).data('rekomendasi') != null){
		$('#rekomendasi').val($(this).data('rekomendasi')).attr('readonly', '')
	}
});

$('.btn-generate').on('click', function (){
	if($(this).data('id')){
		$('#id').val($(this).data('id'))
	}
	if($(this).data('negara')){
		$('#negara').val($(this).data('negara'))
		$('#modalTitle').html($(this).data('negara'))
	}
});
 
$('.datepicker').datepicker({
	format: "yyyy-mm-dd",
	startDate: new Date('2020-01-22'),
	endDate: new Date(),
	defaultViewDate: {
		year: 2020,
		month: 1,
		day: 22
	},
});

$(document).ready(function() {
    $('.select2').select2()
});

function angkaSeparator(angka) {
    return angka.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ".")
}

function tanggalId(data) {
	data = data.split('-');
	let tahun = data[0];
	let bulan = Number(data[1]);
	let tanggal = Number(data[2]);

	switch(bulan) {
		case 0: bulan = "Januari"; break;
		case 1: bulan = "Februari"; break;
		case 2: bulan = "Maret"; break;
		case 3: bulan = "April"; break;
		case 4: bulan = "Mei"; break;
		case 5: bulan = "Juni"; break;
		case 6: bulan = "Juli"; break;
		case 7: bulan = "Agustus"; break;
		case 8: bulan = "September"; break;
		case 9: bulan = "Oktober"; break;
		case 10: bulan = "November"; break;
		case 11: bulan = "Desember"; break;
	}
	
	id_date = `${tanggal} ${bulan} ${tahun}`
	return id_date
}

$("form").submit(function(e){
	e.preventDefault()
	$.ajax({
		url:$(this).attr("action"),
		data:$(this).serialize(),
		timeout: 0,
		type:$(this).attr("method"),
		dataType: 'html',
		beforeSend: function() {
			console.log('Loading...')
		},
		complete:function() {
			console.log('Done...')
		},
		success:function() {
			location.reload();
		},
		error: function(request, status, error) {
			alert(request.responseText);
		}
	})
})
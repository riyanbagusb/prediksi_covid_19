<?php Flasher::flash(); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Daftar Tanggal</h1>
	<btn class="btn btn-sm btn-success btn-tambah" data-toggle="modal" data-target="#tanggalModal"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Tambah</btn>
</div>
<table class="table table-bordered dataTable">
	<thead class="text-center">
		<tr>
			<th>No.</th>
			<th>Tanggal</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data['tanggal'] as $tanggal): ?>
		<tr>
			<td class="text-center"></td>
			<td><span class="d-none"><?= strtotime($tanggal['tanggal']) ?></span><?= tanggal(date('d-m-Y', strtotime($tanggal['tanggal']))) ?></td>
			<td class="text-center">
				<a href="#" class="badge badge-warning p-1 btn-ubah" data-toggle="modal" data-target="#tanggalModal" data-id="<?= $tanggal['id'] ?>" data-tanggal="<?= $tanggal['tanggal'] ?>">Ubah</a>
				<a href="#" class="badge badge-danger p-1 btn-hapus" data-toggle="modal" data-target="#tanggalModal" data-id="<?= $tanggal['id'] ?>" data-tanggal="<?= $tanggal['tanggal'] ?>">Hapus</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<div class="modal fade" id="tanggalModal" tabindex="-1" role="dialog" aria-labelledby="modalTanggal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span id="tag">Tambah</span> Tanggal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>
	  <form action="" method="POST">
		<div class="modal-body">
			<input type="hidden" name="_method" id="_method" value="POST">
			<input type="hidden" id="id">
			<div class="form-group">
				<label for="negara">Tanggal</label>
				<input type="text" name="tanggal" class="form-control" id="tanggal" placeholder="YYYY-MM-DD" autocomplete="off" required>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-sm btn-success" id="btn-aksi">Simpan</button>
		</div>
	  </form>
    </div>
  </div>
</div>
<?php Flasher::flash(); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Daftar Rekomendasi</h1>
	<btn class="btn btn-sm btn-success btn-tambah" data-toggle="modal" data-target="#rekomendasiModal"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Tambah</btn>
</div>
<table class="table table-bordered dataTable">
	<thead class="text-center">
		<tr>
			<th>No.</th>
			<th>Kondisi <br><span class="small">(Persentase Kenaikan Kasus)</span></th>
			<th>Rekomendasi</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data['rekomendasi'] as $rekomendasi): ?>
		<tr>
			<td class="text-center"></td>
			<td><?= $rekomendasi['kondisi'] ?>%</td>
			<td><?= $rekomendasi['rekomendasi'] ?></td>
			<td class="text-center">
				<a href="#" class="badge badge-warning p-1 btn-ubah" data-toggle="modal" data-target="#rekomendasiModal" data-id="<?= $rekomendasi['id'] ?>" data-kondisi="<?= $rekomendasi['kondisi'] ?>" data-rekomendasi="<?= $rekomendasi['rekomendasi'] ?>">Ubah</a>
				<a href="#" class="badge badge-danger p-1 btn-hapus" data-toggle="modal" data-target="#rekomendasiModal" data-id="<?= $rekomendasi['id'] ?>" data-kondisi="<?= $rekomendasi['kondisi'] ?>" data-rekomendasi="<?= $rekomendasi['rekomendasi'] ?>">Hapus</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<div class="modal fade" id="rekomendasiModal" tabindex="-1" role="dialog" aria-labelledby="modalRekomendasi" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span id="tag">Tambah</span> Rekomendasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>
	  <form action="" method="POST">
		<div class="modal-body">
			<input type="hidden" name="_method" id="_method" value="POST">
			<input type="hidden" id="id">
			<div class="form-group">
                <label for="kondisi">Kondisi (Persentase Kenaikan Kasus)</label>
                <div class="input-group">
				<div class="input-group-prepend">
                        <span class="input-group-text">Peningkatan <=</span>
                    </div>
					<select name="kondisi" class="form-control" id="kondisi">
						<?php for ($i=1; $i <= 20; $i++) : ?>
							<option value="<?= $i*10/2 ?>"><?= $i*10/2 ?>%</option>
						<?php endfor ?>
					</select>
                    
                </div>
			</div>
			<div class="form-group">
				<label for="rekomendasi">Rekomendasi</label>
				<textarea name="rekomendasi" id="rekomendasi" class="form-control" rows="2" autocomplete="off" required></textarea>
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
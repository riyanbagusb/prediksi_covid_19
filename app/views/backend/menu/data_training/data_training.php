<?php Flasher::flash(); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-0 text-gray-800">Daftar Negara</h1>
</div>
<table class="table table-bordered dataTable">
	<thead class="text-center">
		<tr>
			<th>No.</th>
			<th>Nama Negara</th>
			<th>Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data['negara'] as $negara): ?>
		<tr>
			<td class="text-center"></td>
			<td><?= $negara['negara'] ?></td>
			<td class="text-center">
				<a href="<?= base_url; ?>admin/data_detail/<?= $negara['id'] ?>"><span class="badge badge-primary p-1">Detail</span></a>
				<a href="#" class="badge badge-warning p-1 btn-generate" data-toggle="modal" data-target="#dataTrainingModal" data-id="<?= $negara['id'] ?>" data-negara="<?= $negara['negara'] ?>">Generate</a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>
<div class="modal fade" id="dataTrainingModal" tabindex="-1" role="dialog" aria-labelledby="dataTrainingegara" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Otomatis (<span id="modalTitle"></span>)</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
	  </div>
	  <form action="" method="POST">
		<div class="modal-body">
			<input type="hidden" name="_method" id="_method" value="POST">
			<input type="hidden" name="id" id="id">
			<p class="text-justify">Data akan dibuat otomatis yang bersumber dari Center for Systems Science and Engineering (CSSE) Johns Hopkins University.</p>
			<div class="form-group">
				<input type="hidden" name="negara" class="form-control" id="negara" autocomplete="off" required>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-sm btn-success" id="btn-aksi">Generate</button>
		</div>
	  </form>
    </div>
  </div>
</div>

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
				<a href="<?= base_url; ?>admin/prediksi_detail/<?= $negara['id'] ?>"><span class="badge badge-primary p-1">Detail</span></a>
			</td>
		</tr>
		<?php endforeach ?>
	</tbody>
</table>

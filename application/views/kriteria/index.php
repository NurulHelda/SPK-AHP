<?php $this->load->view('layouts/header_admin'); ?>

<script type="text/javascript">
	$(document).ready(function () {
		$("#formcari").submit(function(e){
			e.preventDefault();
			$.ajax({
				type:'get',
				dataType:'html',
				url:"<?=base_url('Kriteria/gethtml');?>",
				data:$(this).serialize(),
				error:function(){
					$("#matrik").html('Gagal mengambil data matrik');
				},
				beforeSend:function(){
					$("#matrik").html('Mengambil data matrik. Tunggu sebentar');
				},
				success:function(x){
					$("#matrik").html(x);
				},
			});
		});
	});
</script>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-cube"></i> Data Kriteria</h1>

	<div>
    <a href="<?= base_url('Kriteria/create'); ?>" class="btn btn-success"> <i class="fa fa-plus"></i> Tambah Data </a>
	<form action="" class="form-horizontal" id="formcari" method="post" accept-charset="utf-8" style="display:inline-block">
		<button type="submit" class="btn btn-primary"><i class="fa fa-eye"></i> Perbandingan Kriteria</button>
	</form>
	</div>
</div>

<?= $this->session->flashdata('message'); ?>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Daftar Data Kriteria</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class="bg-success text-white">
					<tr align="center">
						<th width="5%">No</th>
						<th>Kode Kriteria</th>
						<th>Nama Kriteria</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$no=1;
						foreach ($list as $data => $value) {
					?>
					<tr align="center">
						<td><?=$no ?></td>
						<td><?php echo $value->kode_kriteria ?></td>
						<td><?php echo $value->nama_kriteria ?></td>
						<td>
							<div class="btn-group" role="group">
								<a data-toggle="tooltip" data-placement="bottom" title="Edit Data" href="<?=base_url('Kriteria/edit/'.$value->id_kriteria)?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
								<a  data-toggle="tooltip" data-placement="bottom" title="Hapus Data" href="<?=base_url('Kriteria/destroy/'.$value->id_kriteria)?>" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
							</div>
						</td>
					</tr>
					<?php
						$no++;
						}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div id="matrik"></div>	


<?php $this->load->view('layouts/footer_admin'); ?>
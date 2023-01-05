<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Data Perbandingan Sub Kriteria</h6>
    </div>

    <div class="card-body">
		<div class="row">
			<div class="col-md-3">
				<ul class="list-group">
				  <?php	  
				  if(!empty($kriteria))
				  {
					foreach($kriteria as $rk)
					{
						echo '<li class="list-group-item"><a href="javascript:;" onclick="showsubdata('.$rk->id_kriteria.');">('.$rk->kode_kriteria.') '.$rk->nama_kriteria.'</a></li>';
					}
				  }
				  ?>
				</ul>
			</div>
			<div>
			</div>
			<div class="col-md-9">
				<div id="matriksub"></div>
			</div>
		</div>
	</div>
</div>

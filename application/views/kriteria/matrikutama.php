<?php

$irdata=array(
1=>0.00,
2=>0.00,
3=>0.58,
4=>0.90,
5=>1.12,
6=>1.24,
7=>1.32,
8=>1.41,
9=>1.45,
10=>1.49,
11=>1.51,
12=>1.48,
13=>1.56,
14=>1.57,
15=>1.59,
);

$jumlah=count($arr);

$ir=0.00;
foreach($irdata as $irk=>$irv)
{
	if($irk==$jumlah)
	{
		$ir=$irv;
	}
}
?>
<script type="text/javascript">
$(document).ready(function () {
		
<?php
if(!empty($arr))
{
?>
hitung();
<?php
}
?>

$("#formentri").submit(function(e){
	e.preventDefault();
	$.ajax({
		type:'post',
		dataType:'json',
		url:"<?=base_url();?>Kriteria/updateutama",
		data:$(this).serialize(),
		error:function(){
			shownotice('danger','Gagal menyimpan data');
			$("#formentri select").removeAttr("disabled");
			$("#formentri button").removeAttr("disabled");
		},
		beforeSend:function(){
			$("#formentri select").attr('disabled','disabled');
			$("#formentri button").attr('disabled','disabled');
			shownotice('info','Tunggu sebentar,lagi menyimpan data');
		},
		success:function(x){
			if(x.status=="ok")
			{
				shownotice('success',x.msg);
			}else{
				shownotice('danger',x.msg);
			}
			$("#formentri select").removeAttr("disabled");
			$("#formentri button").removeAttr("disabled");
		},
	});
});

$(".inputnumber").each(function(){
	$(this).change(function(){		
		hitung();
	});
});
	
});

function shownotice(tipe,pesan)
{
	$("#respon").html('<div class="alert alert-'+tipe+'">'+pesan+'</div>');
	$("#respon").show('fadeIn');
	if($("#respon").is(":visible"))
	{
		setTimeout(function(){
			$("#respon").hide('fadeOut');
		},3000);
	}	
}

function contoh()
{
	$("#k1b2").val(9);
	$("#k1b3").val(9);
	$("#k1b4").val(9);
	$("#k1b5").val(9);
	$("#k2b4").val(9);
	$("#k2b5").val(9);
	$("#k3b4").val(9);
	$("#k3b5").val(9);
	$("#k4b5").val(9);
	
}

function hitung()
{
	//contoh();
	
	$(".inputnumber").each(function(){
	//	$(this).change(function(){		
			var dtarget=$(this).attr('data-target');
			var dkolom=$(this).attr('data-kolom');
			var jumlah=$(this).val();
			var rumus=1/parseFloat(jumlah);
			var fx=rumus;
			$("#"+dtarget).val(fx);
			total();			
			mnk();
			mptb();
			rk();
			//alert(dkolom);
	//	});
	});	
}

function showmatrix()
{
	$("#matrikdiv").toggle('fade');
}

function total()
{
	for(i=1;i<=<?=$jumlah;?>;i++)
	{
		var sum=0;
		$(".kolom"+i).each(function(){
			sum+=parseFloat($(this).val());
		});
		var fx=sum;
		$("#total"+i).val(fx);
	}	
}

function mnk()
{	
	for(i=1;i<=<?=$jumlah;?>;i++)
	{
		var jml=0;
		for(x=1;x<=<?=$jumlah;?>;x++)
		{			
			var vtarget=$("#k"+i+"b"+x).val();
			var vkolom=$("#total"+x).val();
			var rumus=parseFloat(vtarget)/parseFloat(vkolom);
			var fx=rumus;			
			jml+=parseFloat(rumus);
			$("#mn-k"+i+"b"+x).val(fx);
			//$("#mn-k"+i+"b"+x).val(i+" "+x);						
		}
		var jumlahmnk=jml;
		var prio=parseFloat(jml)/parseFloat(<?=$jumlah;?>);
		var totprio=prio;
		$("#jml-b"+i).val(jumlahmnk);
		$("#pri-b"+i).val(totprio);		
		
	}
}

function mptb()
{	
	for(i=1;i<=<?=$jumlah;?>;i++)
	{
		var jml=0;
		for(x=1;x<=<?=$jumlah;?>;x++)
		{			
			var prio=$("#pri-b"+x).val();
			var nilai=$("#k"+i+"b"+x).val();
			var rumus=parseFloat(nilai)*parseFloat(prio);
			var fx=rumus;
			jml+=parseFloat(rumus);
			//$("#mptb-k"+i+"b"+x).val(prio+"*"+nilai);
			$("#mptb-k"+i+"b"+x).val(fx);
		}
		var jumlahmnk=jml;
		$("#jmlmptb-b"+i).val(jumlahmnk);
	}
}

function rk()
{
	var total=0;	
	for(i=1;i<=<?=$jumlah;?>;i++)
	{
		var prio=$("#pri-b"+i).val();
		var jml=$("#jmlmptb-b"+i).val();
		var hasil=parseFloat(prio)+parseFloat(jml);
		var fx=hasil;
		total+=hasil;
		$("#jmlrk-b"+i).val(jml);
		$("#priork-b"+i).val(prio);
		$("#prioritas-b"+i).val(prio);
		$("#hasilrk-b"+i).val(fx);
	}
	var fx2=total;
	$("#totalrk").val(fx2);
	$("#sumrk").val(fx2);
	var summaks=parseFloat(total)/parseFloat(<?=$jumlah;?>);
	var fx_summaks=summaks;
	$("#summaks").val(fx_summaks);
	
	var ci_r_1=parseFloat(summaks)-parseFloat(<?=$jumlah;?>);
	var ci=parseFloat(ci_r_1)/parseFloat(<?=$jumlah;?>);
	var fx_ci=ci;
	$("#sumci").val(fx_ci);
	var cr=parseFloat(ci)/parseFloat(<?=$ir;?>);
	var fx_cr=cr;
	$("#sumcr").val(fx_cr);
	$("#crvalue").val(fx_cr);
}
</script>

<div id="respon"></div>

<div id="entri">
<?php
echo form_open('#',array('class'=>'form-horizontal','id'=>'formentri'));
?>
<input type="hidden" name="crvalue" id="crvalue"/>

<div class="alert alert-info">
	Setelah mengisi nilai matrik perbandingan silahkan klik tombol <b>SIMPAN NILAI KRITERIA</b> untuk meyimpan nilai matrik. Selanjutnya menekan tombol <b>SIMPAN NILAI PRIORITAS</b> untuk menyimpan nilai prioritas yang telah dihasilkan.
</div>

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Matrik Perbandingan Berpasangan</h6>
    </div>

    <div class="card-body">	
		<div class="table-responsive">
		<table class="table table-bordered">
		<thead align="center" class="bg-success text-white">
			<th>Kriteria</th>
			<?php
			foreach($arr as $k=>$v)
			{
			?>
			<th><?=$v;?></th>
			<?php
			}
			?>	
		</thead>
		<tbody>
			<?php
			$noUtama=0;	
			foreach($arr as $k2=>$v2)
			{		
				$noUtama+=1;				
				//array_shift($xxx);
				echo '<tr>';
				echo '<th class="bg-success text-white text-center">'.$v2.'</th>';
				$noSub=0;				
				$xxx='';				
				for($i=1;$i<=$jumlah;$i++)
				{
					$keys = array_keys($arr);
					$xxx=$keys[array_search("gsda",$keys)+($i-1)];
					$newname=$k2."[".$xxx."]";
					$noSub+=1;
					if($noSub==$noUtama)
					{
						echo '<td><input type="number" id="k'.$noUtama.'b'.$noSub.'" class="form-control kolom'.$noSub.'" value="1" readonly="" title="kolom'.$noSub.'"/></td>';
					}else{
						
						if($noUtama > $noSub)
						{									
							echo '<td><input type="text" id="k'.$noUtama.'b'.$noSub.'" class="form-control kolom'.$noSub.'" value="0" readonly="" title="kolom'.$noSub.'"/></td>';
						}else{
							echo '<td>';
							echo '<select name="'.$newname.'" id="k'.$noUtama.'b'.$noSub.'" data-target="k'.$noSub.'b'.$noUtama.'" data-kolom="'.$noSub.'" class="form-control inputnumber kolom'.$noSub.'" title="kolom'.$noSub.'">';
							for($x=1;$x<=9;$x++)
							{
								$nilai=ambil_nilai_kriteria($k2,$xxx);
								$sl='';
								if($nilai==$x)
								{
									$sl='selected="selected"';
								}
								echo '<option value="'.$x.'" '.$sl.'>'.$x.'</option>';
							}
							echo '</select>';
						}				
					}
				}
				echo '</tr>';
			}
			?>	
		</tbody>
		<tfoot>
			<tr>
				<th class="bg-success text-white text-center">Jumlah</th>
				<?php
				for($h=1;$h<=$jumlah;$h++)
				{
				?>
				<td><input type="text" id="total<?=$h;?>" class="form-control" value="0" title="total<?=$h;?>"  readonly=""/></td>
				<?php
				}
				?>
			</tr>
		</tfoot>
		</table>
		</div>
	</div>
	<div class="card-footer">
		<div class="text-right">
			<a href="javascript:;" onclick="showmatrix();" class="btn btn-info"><i class="fa fa-eye"></i> Lihat Matriks</a>	
			<button type="submit" name="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan Nilai Kriteria</button>	
			<?php
			echo form_close();
			?>
			<form style="display:inline-block" action="<?=base_url("")?>Kriteria/simpan_prioritas" method="post" accept-charset="utf-8">
				<?php
					$noUtama4=0;	
					foreach($arrs as $k4=>$v4)
					{
						$noUtama4+=1;	
						echo '<input type="hidden" class="form-control" name="id_kriteria[]" value="'.$v4.'"/>';
						echo '<input type="hidden" class="form-control" name="perioritas[]" id="prioritas-b'.$noUtama4.'"/>';
					}
				?>
				<button type="submit" name="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Nilai Prioritas</button>	
			</form>
		</div>
	</div>
</div>



</div>

<div id="matrikdiv" style="display: none">

<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Matrik Nilai Kriteria</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
		<table class="table table-bordered">
		<thead class="bg-success text-white" align="center">
			<th>Kriteria</th>
			<?php
			foreach($arr as $k=>$v)
			{
			?>
			<th><?=$v;?></th>
			<?php
			}
			?>
			<th>Jumlah</th>
			<th>Prioritas</th>
		</thead>
		<tbody>
			<?php
			$noUtama2=0;	
			foreach($arr as $k2=>$v2)
			{
				$noUtama2+=1;
				echo '<tr>';
				echo '<th class="bg-success text-white text-center">'.$v2.'</th>';
				$noSub2=0;
				for($i=1;$i<=$jumlah;$i++)
				{
					$noSub2+=1;
					echo '<td><input type="text" id="mn-k'.$noUtama2.'b'.$noSub2.'" class="form-control" value="0" readonly=""/></td>';
				}
				echo '<td><input type="text" class="form-control" id="jml-b'.$noUtama2.'" value="0" readonly=""/></td>';
				echo '<td><input type="text" class="form-control" id="pri-b'.$noUtama2.'" value="0" readonly=""/></td>';
				echo '</tr>';
			}
			?>	
		</tbody>
		</table>
		</div>
	</div>
</div>


<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Matrik Penjumlahan Tiap Baris</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
		<table class="table table-bordered">
		<thead class="bg-success text-white" align="center">
			<th>Kriteria</th>
			<?php
			foreach($arr as $k=>$v)
			{
			?>
			<th><?=$v;?></th>
			<?php
			}
			?>
			<th>Jumlah</th>
		</thead>
		<tbody>
			<?php
			$noUtama3=0;	
			foreach($arr as $k3=>$v3)
			{
				$noUtama3+=1;
				echo '<tr>';
				echo '<th class="bg-success text-white text-center">'.$v3.'</th>';
				$noSub3=0;
				for($i=1;$i<=$jumlah;$i++)
				{
					$noSub3+=1;
					echo '<td><input type="text" id="mptb-k'.$noUtama3.'b'.$noSub3.'" class="form-control" value="0" readonly=""/></td>';
				}
				echo '<td><input type="text" class="form-control" id="jmlmptb-b'.$noUtama3.'" value="0" readonly=""/></td>';
				echo '</tr>';
			}
			?>	
		</tbody>
		</table>
		</div>
	</div>
</div>


<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Rasio Konsistensi</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
		<table class="table table-bordered">
		<thead class="bg-success text-white" align="center">
			<th>Kriteria</th>	
			<th>Jumlah Per Baris</th>
			<th>Prioritas</th>
			<th>Hasil</th>
		</thead>
		<tbody>
			<?php
			$noUtama4=0;	
			foreach($arr as $k4=>$v4)
			{
				$noUtama4+=1;
				echo '<tr>';
				echo '<td align="center">'.$v4.'</td>';		
				echo '<td><input type="text" class="form-control" id="jmlrk-b'.$noUtama4.'" value="0" readonly=""/></td>';
				echo '<td><input type="text" class="form-control" id="priork-b'.$noUtama4.'" value="0" readonly=""/></td>';
				echo '<td><input type="text" class="form-control" id="hasilrk-b'.$noUtama4.'" value="0" readonly=""/></td>';
				echo '</tr>';
			}
			?>	
		</tbody>
		<tfoot>
			<tr>
				<td colspan="3" align="center"><b>TOTAL</b></td>
				<td>
					<input type="text" class="form-control" id="totalrk" value="0" readonly=""/>
				</td>
			</tr>
		</tfoot>
		</table>
		</div>
	</div>
</div>


<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Hasil Perhitungan</h6>
    </div>

    <div class="card-body">
		<div class="table-responsive">
		<table class="table table-bordered">
		<thead class="bg-success text-white" align="center">
			<th>Keterangan</th>
			<th>Nilai</th>
		</thead>
		<tbody>
			<tr>
				<td>Jumlah</td>
				<td>
					<input type="text" class="form-control" id="sumrk" value="0" readonly=""/>
				</td>
			</tr>
			<tr>
				<td>n(Jumlah Kriteria)</td>
				<td>
					<input type="text" class="form-control" id="sumkriteria" value="<?=$jumlah;?>"  readonly=""/>
				</td>
			</tr>
			<tr>
				<td>Maks(Jumlah/n)</td>
				<td>
					<input type="text" class="form-control" id="summaks" value="0"  readonly=""/>
				</td>
			</tr>
			<tr>
				<td>CI((Maks-n)/n)</td>
				<td>
					<input type="text" class="form-control" id="sumci" value="0"  readonly=""/>
				</td>
			</tr>
			<tr>
				<td>CR(CI/IR)</td>
				<td>
					<input type="text" class="form-control" id="sumcr" value="0" readonly=""/>
				</td>
			</tr>
		</tbody>
		</table>
		</div>
	</div>
</div>

</div>
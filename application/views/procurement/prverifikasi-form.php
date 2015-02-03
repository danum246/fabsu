<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?#=script('jquery-1.7.2.min.js')?>
<?=script('jquery.easyui.min.js')?>




<script type="text/javascript">
	//FUNGSI LOAD DATA		
	/*$('#formAdd')
	.validationEngine()
	.ajaxForm({
		success:function(response){
			//alert(response);
			//$('#btnReset').click();
			if(response=='sukses'){
				alert(response);
				refreshTable();
			}else{
				alert(response);
			}
		}
	});	*/

</script>



<form method="post" id="formAdd" action="<?=site_url('prverifikasi/verifikasi_pr')?>">	

<div class="easyui-tabs" style="width:750px;height:350px;">
	<div title="Budget Ref" style="padding:10px;">
			<!--input type="hidden" name="id_divisi" value="<?=$div?>"/>
			<input type="hidden" name="id_pt" value="<?=$pt?>"/-->
			<input type="hidden" name="idpr" value="<?=$data->id_pr?>"/>
		   <table>
			<tr>
				<td>Budget Name</td>
				<td colspan="3"><input type="text" name="bgtnm" value="<?=$data->description?>" id="bgtnm" size="40" readonly="true"/></td>
			</tr>
			<tr>
				<td>Tgl. xPR</td>
				<td><input type="text" name="tglpr" id="tglpr" value="<?=gettgl(); ?>" readonly="true"/></td>
				<td>Amount</td>
				<td><input type="text" name="amountpr" id="amountpr" readonly="true" value="<?=number_format($data->amount)?>" style="text-align:right"/></td>
			</tr>
			
			<tr>
				<td>No. PR</td>
				<td><input type="text" name="nopr" id="nopr" value="<?=$data->no_pr?>" style="width:200px" readonly="true"/></td>
				<td>Divisi</td>
				<td><input type="text" name="divisipr" value="<?=$data->divisi_nm?>" id="divisipr" readonly="true"/></td>
			</tr>
			
			<tr>
				<td>User Requestor</td>
				<td><input type="text" name="reqpr" id="reqpr" value="<?=$nama?>" readonly="true"/></td>
			</tr>		
			<tr>
				<td>Keterangan</td>
				<td colspan= "3">
				<input type="text" name="ketpr" value="<?=$data->ket_pr?>" id="ketpr" readonly="true" class="xinput validate[required]" >
	 
				</td>
			</tr>
			</table>		
	</div>
	<div title="Request PR" style="padding:10px;">
			<table width="600px">
				<tr>
					<td width="120px"><b>Nama Barang</b></td>
					<td width="80px"><b>Unit</b></td>
					<td width="50px"><b>QTY</b></td>
					<td width="200px"><b>Vendor</b></td>
				</tr>
					<?php foreach($cekord as $row):?>
						<input type="hidden" name="nm_brg[]" value="<?=$row->nm_brg?>"/>
						<input type="hidden" name="unit_brg[]" value="<?=$row->unit_brg?>"/>
						<input type="hidden" name="qty_brg[]" value="<?=$row->qty_brg?>"/>
						<input type="hidden" name="rec_brg[]" value="<?=$row->recvendor?>"/>
						<tr>
						<td><?=$row->nm_brg?></td>
						<td><?=$row->unit_brg?></td>
						<td><?=$row->qty_brg?></td>
						<td><?=$row->recvendor?></td>
						</tr>
					<?php endforeach;?>	
			</table>
	</div>	
</div>
	<label>Alasan</label> <input type="text" name="alasan" id="alasan" size="20"/>
	<input type="submit" name="save" value="Verification"/>
</form>



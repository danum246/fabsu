<?#=script('jquery-1.7.2.min.js')?>
<?=link_tag(CSS_PATH.'easyui.css')?>
<?=link_tag(CSS_PATH.'icon.css')?>
<?=link_tag(CSS_PATH.'demo.css')?>
<?=script('jquery.easyui.min.js')?>

<?php
$attr = array('class' => 'block-content form', 'id' => 'formAdd');
echo form_open(site_url('workinginst/saveprop'), $attr);
?>
<div class="easyui-tabs" style="width:900px;height:300px;">
		<input type="hidden" name="id_kontrak" id="id_kontrak" value="<?=$data->id_kontrak?>"/>
		<div title="Working Instruction" style="padding:10px;">
			<table border="0" width="600px">
				<tr>
					<td>Date</td>
					<td><input type="text" name="date" value="<?=gettgl()?>" readonly="true"/></td>
				</tr>
				<tr>
					<td>SPK.No</td>
					<td><input type="text" name="no_spk" id="no_spk" value="<?=$data->no_spk?>" maxlength="20" readonly="true" style="width:220px"/></td>
				</tr>
				<tr>
					<td>Contract .No</td>
					<td><input type="text" name="no_contr" id="no_contr" value="<?=$data->no_kontrak?>"  readonly="true" maxlength="20" style="width:220px"/></td>
				</tr>						
				<tr>
					<td>Mainjob</td>
					<td><input type="text" name="job" value="<?=$data->mainjob_desc?>" style="width:200px" readonly="true"/></td>
				</tr>
				<tr>
					<td>Contract.Amount</td>
					<td><input type="text" name="date" style="width:180px" class="input" value="<?=number_format($data->contract_amount)?>" readonly="true"/></td>
				</tr>
				<tr>
					<td>Start Date</td>
					<td><input type="text" name="date" value="<?=indo_date($data->start_date)?>" readonly="true"/></td>
				</tr>
				<tr>
					<td>End Date</td>
					<td><input type="text" name="date" value="<?=indo_date($data->end_date)?>" readonly="true"/></td>
				</tr>												
			</table>    
		</div>	
		<div title="Payment" style="padding:10px;">
			<table width="400px">
				<tr>
					<td>Currency</td><td><input type="text" value="<?=$data->currency?>" style="width:40px" readonly="true"/></td>
				</tr>
				<tr>
					<td>Contract (Incl.Tax)</td><td><input type="text" value="<?=number_format($data->contract_amount)?>" class="input" readonly="true"/></td>
				</tr>
				<tr>	
					<td>Contract (Excl.Tax)</td><td><input type="text" value="<?=number_format($data->contract_bftax)?>" class="input" readonly="true"/></td>
				</tr>
				<tr>	
					<td>DP</td><td><input type="text" value="<?=number_format($data->dp_amount)?>" class="input" readonly="true"/></td>
				</tr>
			
				<tr>	
					<td>Retension</td><td><input type="text" value="<?=number_format($data->retensi_amount)?>" class="input" readonly="true"/></td>
				</tr>
				<tr>	
					<td>PPN</td><td><input type="text" value="<?=number_format($data->ppn_amount)?>"  class="input" readonly="true"/></td>
				</tr>
				<tr>	
					<td>PPH</td><td><input type="text" value="<?=number_format($data->pph_amount)?>" class="input"  readonly="true"/></td>
				</tr>
				
				
			</table>
		</div>  
		<div title="Contractor" style="padding:10px;">	
			<table width="400px">
				<tr>
					<td>Name</td>
					<td><input type="text" value="<?=$data->nm_supplier?>" readonly="true"/></td>
				</tr>
				<tr>
					<td>Address</td>
					<td><input type="text" value="<?=$data->alamat?>" readonly="true"/></td>
				</tr>				
				<tr>
					<td>PIC</td>
					<td><input type="text" value="<?=$data->kontak?>" readonly="true"/></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td><input type="text" value="<?=$data->telepon?>" readonly="true"/></td>
				</tr>				
				<tr>
					<td>Email</td>
					<td><input type="text" value="" readonly="true"/></td>
				</tr>
			</table>    
		</div>
		<div title="Signing" style="padding:10px;">		
			<table width="400px">
				<tr>
					<td colspan="2">Pihak I</td>
				</tr>
				<tr>
					<td>Name</td>
					<td><input type="text" value="<?=$data->sign_1?>" readonly="true"/></td>
				</tr>
				<tr>
					<td>Position</td>
					<td><input type="text" value="<?=$data->sign1_level?>" readonly="true"/></td>
				</tr>				
				<tr>
					<td colspan="2">Pihak II</td>
				</tr>
				<tr>
					<td>Name</td>
					<td><input type="text" value="<?=$data->sign_2?>" readonly="true"/></td>
				</tr>
				<tr>
					<td>Position</td>
					<td><input type="text" value="<?=$data->sign2_level?>" readonly="true"/></td>
				</tr>
			</table>
		</div>
</div>
<input type="submit" name="save" value="Approval"/>
<?=form_close()?>

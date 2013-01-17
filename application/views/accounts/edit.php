<h1>Edit Account</h1>
<p>Please make the necessary changes</p>
<?php if(isset($_POST['uptacc'])): ?>
<div class="ui-widget">
	<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
		<strong>Error:</strong><?php echo validation_errors(); ?></p>
	</div>
</div>		
<?php endif; ?>
<?php echo form_open('accounts/update'); ?>
<form>
	<table>
		<tr>
			<td><label for='accname'>Account Name :</label></td>
			<td><input type='text' name='accname' value='<?php echo $account->name; ?>' /></td>
		</tr>
		<tr>
			<td><label for='acctype'>Account Type :</label></td>
			<td><select name='acctype'>
				<?php $types = $this->acc->getTypes();
				foreach ($types as $row){
					echo "<option value='".$row->id."'";
					if($account->acc_type==$row->id){ echo 'selected';}
					echo">".$row->type."</option>";
					}?>		
			</select></td>
		</tr>
		<tr>
			<td><label for='status'>Account Status :</label></td>
			<td><select name='status'>

				<option value='1' <?php if ($account->status=='1'){ echo 'selected';}?>>Activated</option>
				<option value='0' <?php if ($account->status=='0'){ echo 'selected';}?>>Disabled</option>			
			</select></td>
		</tr>
		<tr>
			<td colspan='2'>
				<input type='hidden' name='accid' value='<?php echo $account->id ?>'/>
				<input type='submit' value='Update' name='uptacc'/>
				<a href='<?php echo site_url('accounts'); ?>' class='btn'>Cancel</a>
			</td>
		</tr>
					
	</table>				
</form>

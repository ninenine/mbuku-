<h1>New Account Registration</h1>
<p>Please fill in the form to register</p>
<?php if(isset($_POST['regacc'])): ?>
<div class="ui-widget">
	<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
		<strong>Error:</strong><?php echo validation_errors(); ?></p>
	</div>
</div>		
<?php endif; ?>
<?php echo form_open('accounts/add'); ?>
<form>
	<table>
		<tr>
			<td><label for='accname'>Account Name :</label></td>
			<td><input type='text' name='accname' value='<?php echo set_value('accname'); ?>' /></td>
		</tr>
		<tr>
			<td><label for='acctype'>Account Type :</label></td>
			<td><select name='acctype'>
				<option value='' selected>Select account type...</option>
				<?php $types = $this->acc->getTypes();
				foreach ($types as $row){
					echo "<option value='".$row->id."'>".$row->type."</option>";
					}?>		
			</select></td>
		</tr>
		<tr>
			<td><label for='status'>Account Status :</label></td>
			<td><select name='status'>
				<option value='' selected>Select account status...</option>
				<option value='1'>Activated</option>
				<option value='0'>Disabled</option>			
			</select></td>
		</tr>
		<tr>
			<td colspan='2'><input type='submit' value='Add Account' name='regacc'/></td>
		</tr>
					
	</table>				
</form>

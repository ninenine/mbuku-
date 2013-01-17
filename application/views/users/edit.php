<h1>Edit User</h1>
<p>Please make the necessary changes</p>
<?php if(isset($_POST['updtuser'])): ?>
<div class="ui-widget">
	<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
		<strong>Error:</strong><?php echo validation_errors(); ?></p>
	</div>
</div>		
<?php endif; ?>
<?php echo form_open('users/update'); ?>
<form>
	<table>
		<tr>
			<td><label for='fullname'>Full Name :</label></td>
			<td><input type='text' name='fullname' value='<?php echo $user->fullname; ?>' /></td>
		</tr>
		<tr>
			<td><label for='username'>User Name :</label></td>
			<td><input type='text' name='username' value='<?php echo $user->uname; ?>' /></td>
		</tr>
		
		<?php if($this->session->userdata('user_role')>2): ?>
		<tr>
			<td><label for='oldpassword'>Old Password :</label></td>
			<td><input type='password' name='oldpassword'/></td>
		</tr>
		<?php endif; ?>
		<tr>
			<td><label for='password'>New Password :</label></td>
			<td><input type='password' name='password'/></td>
		</tr>
		<tr>
			<td><label for='cpassword'>Confrim Password :</label></td>
			<td><input type='password' name='cpassword'/></td>
		</tr>
		<?php if($this->session->userdata('user_role')<=2): ?>
		<tr>
			<td><label for='status'>Status :</label></td>
			<td><select name='status'>
				<option value='1' <?php if ($user->status=='1'){ echo 'selected';}?> >Activated</option>
				<option value='0' <?php if ($user->status=='0'){ echo 'selected';}?> >Dectivated</option>			
			</select></td>
		</tr>
		<tr>
			<td><label for='role'>User Role :</label></td>
			<td><select name='role'>
				<?php $roles = $this->user->getRoles();
				foreach ($roles as $row){
					echo "<option value='".$row->id."'";
					if ($user->role==$row->id){ echo 'selected';}
					echo ">".$row->type."</option>";
					}?>		
			</select></td>
		</tr>
		<?php endif; ?>
		<tr>
			
			<td colspan='2'>
				<input type='hidden' name='userid' value='<?php echo $user->id ?>'/>
				<input type='submit' value='Update' name='updtuser'/>
				<a href='<?php echo site_url('users'); ?>' class='btn'>Cancel</a>
			</td>
		</tr>
					
	</table>				
</form>

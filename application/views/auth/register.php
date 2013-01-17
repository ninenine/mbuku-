<h1>New User Registration</h1>
<p>Please fill in the form to register</p>
<?php if(isset($_POST['reguser'])): ?>
<div class="ui-widget">
	<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
		<strong>Error:</strong><?php echo validation_errors(); ?></p>
	</div>
</div>		
<?php endif; ?>
<?php echo form_open('auth/register'); ?>
<form>
	<table>
		<tr>
			<td><label for='fullname'>Full Name :</label></td>
			<td><input type='text' name='fullname' value='<?php echo set_value('fullname'); ?>' /></td>
		</tr>
		<tr>
			<td><label for='username'>User Name :</label></td>
			<td><input type='text' name='username' value='<?php echo set_value('username'); ?>' /></td>
		</tr>
		<tr>
			<td><label for='password'>Password :</label></td>
			<td><input type='password' name='password'/></td>
		</tr>
		<tr>
			<td><label for='cpassword'>Confrim Password :</label></td>
			<td><input type='password' name='cpassword'/></td>
		</tr>
		<tr>
			<td colspan='2'><input type='submit' value='Register' name='reguser'/></td>
		</tr>
					
	</table>				
</form>

<h3>Login</h3>

<?php if(isset($_POST['frmlogin'])): ?>
<div class="ui-widget">
	<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
		<strong>Error:</strong><?php echo validation_errors(); ?></p>
	</div>
</div>		
<?php endif; ?>
<?php echo form_open('auth/login'); ?>
<input type='text' name='usrname' title='Enter Your Username' placeholder='Enter Username'/>
<input type='password' name='pword' title='Enter Your Password' placeholder='Enter Password' autocomplete='off'/>
<br /><input type='submit' value='Login' name='frmlogin'/>
</form>
<?php echo anchor('auth/forget','Forget your password?','Password Recovery'); ?>

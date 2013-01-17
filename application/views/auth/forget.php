<h2>Password reset</h2>
<p>Please Enter a valid <b>E-mail</b> address</p>
<?php if(isset($_POST['frmfroget'])): ?>
<div class="ui-widget">
	<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
		<strong>Error:</strong><?php echo validation_errors(); ?></p>
	</div>
</div>		
<?php endif; ?>
<?php echo form_open('auth/forget'); ?>
<input type='text' name='email' value='<?php echo set_value('fname'); ?>' placeholder='Enter Your E-mail address'/>
<input type='submit' value='Send Email' name='frmfroget'/>
</form>


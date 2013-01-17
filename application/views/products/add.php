<h1>New Product Registration</h1>
<p>Please fill in the form to register</p>
<?php if(isset($_POST['addprod'])): ?>
<div class="ui-widget">
	<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"> 
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
		<strong>Error:</strong><?php echo validation_errors(); ?></p>
	</div>
</div>		
<?php endif; ?>
<?php echo form_open('products/add'); ?>
<form>
	<table>
		<tr>
			<td><label for='prodname'>Product Name :</label></td>
			<td><input type='text' name='prodname' value='<?php echo set_value('prodname'); ?>' /></td>
		</tr>
		<tr>
			<td><label for='prodtype'>Product Type :</label></td>
			<td><select name='prodtype'>
				<option value='' selected>Select product type...</option>
				<?php $types = $this->product->getTypes();
				foreach ($types as $row){
					echo "<option value='".$row->id."'>".$row->type."</option>";
					}?>		
			</select></td>
		</tr>
		<tr>
			<td><label for='price'>Product price :</label></td>
			<td><input type='text' name='price' value='<?php echo set_value('price'); ?>' /></td>
		</tr>
		<tr>
			<td><label for='description'>Product description :</label></td>
			<td><textarea name='description' style='width:400px;height:100px;'><?php echo set_value('description'); ?> </textarea></td>
		</tr>
		<tr>
			<td colspan='2'><input type='submit' value='Add Product' name='addprod'/></td>
		</tr>
					
	</table>				
</form>

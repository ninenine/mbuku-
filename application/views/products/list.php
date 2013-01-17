
<div id='breadcrumbs'>

</div>
<div id=''>
<a href='<?php echo site_url('products/add'); ?>' title='Add a new Product'>Add New Product</a>
</div>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.css" media="screen">
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
<script>
  $(function () {
    $('#userlist').dataTable({
		"bJQueryUI": true
		});
  } );
</script>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="userlist" width="100%">
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Type</th>
			<th>Price(Ksh.)</th>					
			<th style='display:none;'></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($products as $row){
		echo '<tr>'.
			 '<td style="width:50px;">'.$row->id.'</td>'.
			 '<td>'.$row->name.'</td>'.
			 '<td>'.$this->product->getProductType($row->type).'</td>'.
			 '<td>'.$row->price.'</td>';
			 echo "<td>".
					anchor('products/edit/'.$row->id,'Edit')." | ".
					anchor('products/delete/'.$row->id,'Delete',array('onClick'=>'return delCheck(\' '.site_url('products/delete/'.$row->id).'\')')).
					"</td>";		
		echo '</tr>';		
	}
	?>
	</tbody>
</table>
<script>
function delCheck(link){
    var answer = confirm('Are you sure you want to delete this Product?')
    if (answer){
        window.location = link;
    }    
    return false;  
};
</script>


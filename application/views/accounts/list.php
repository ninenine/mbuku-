
<div id='breadcrumbs'>

</div>
<div id=''>
<a href='<?php echo site_url('accounts/add'); ?>' title='Add a new Account'>Add New Account</a>
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
			<th>Account Name</th>
			<th>Account Type</th>
			<th>Status</th>
			<th>Date Created</th>						
			<th style='display:none;'></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($accounts as $row){
		echo '<tr>'.
			 '<td style="width:50px;">'.$row->id.'</td>'.
			 '<td>'.$row->name.'</td>'.
			 '<td>'.$this->acc->getAccType($row->acc_type).'</td>'.
			 '<td>';
			 if($row->status == 0){
				 echo 'Disabled';
				 }else{
					 echo'Active';
				} 
			echo '</td>'.
			 '<td>'.unix_to_human($row->datecreated,"true","us").'</td>';
			 echo "<td>".
					anchor('accounts/edit/'.$row->id,'Edit')." | ".
					anchor('accounts/delete/'.$row->id,'Delete',array('onClick'=>'return delCheck(\' '.site_url('accounts/delete/'.$row->id).'\')')).
					"</td>";		
		echo '</tr>';		
	}
	?>
	</tbody>
</table>
<script>
function delCheck(link){
    var answer = confirm('Are you sure you want to delete this Account?')
    if (answer){
        window.location = link;
    }    
    return false;  
};
</script>


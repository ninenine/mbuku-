<div id='breadcrumbs'>

</div>
<div id=''>
<a href='<?php echo site_url('users/add'); ?>' title='Add a new User'>Add new User</a>
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
			<th>Username</th>
			<th>Full Name</th>
			<th>Role</th>
			<th>Status</th>
			<th>Last Login</th>
			<th>Date Created</th>						
			<th style='display:none;'></th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($users as $row){
		echo '<tr>'.
			 '<td>'.$row->uname.'</td>'.
			 '<td style="width:100px;">'.$row->fullname.'</td>'.
			 '<td>'.$this->user->getUserRole($row->role).'</td>'.
			 '<td>';
			 if($row->status == 0){
				 echo 'Not Activated';
				 }else{
					 echo'Active';
				} 
			echo '</td>'.
			 '<td>';
			 if($row->lastlogin == 0){
				 echo'   -';}else{ echo unix_to_human($row->lastlogin,"true","us");}
				 echo'</td>'.
			 '<td>'.unix_to_human($row->datecreated,"true","us").'</td>';
			 echo "<td style='width:75px;'>".
					anchor('users/edit/'.$row->id,'Edit')." | ".
					anchor('users/delete/'.$row->id,'Delete',array('onClick'=>'return delCheck(\' '.site_url('users/delete/'.$row->id).'\')')).
					"</td>";		
		echo '</tr>';		
	}
	?>
	</tbody>
</table>
<script>
function delCheck(link){
    var answer = confirm('Are you sure you want to delete this user?')
    if (answer){
        window.location = link;
    }    
    return false;  
};
</script>


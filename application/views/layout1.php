<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title> Mbuku Invoices | {title}</title>
<!-- favicon -->
<link rel="shortcut icon" href="<?php echo base_url();?>assets/img/favicon.png">
<!-- css -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/ui/jquery.ui.all.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/colorbox/colorbox.css" media="screen">

<!-- js -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui-1.8.12.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/colorbox/jquery.colorbox-min.js"></script>

</head>	
<body>
	<div id='wrapper'>
		<div id='header'>
			<img class='logo' src='<?php echo base_url();?>assets/img/logo.png' title="Mbuku Invoice`s Logo" alt="Mbuku Invoice`s Logo" />
		</div><!-- end of header -->
		<div class='clear'></div>
		<div id='container'>
			{content}
			<div class='clear'></div>
			
		</div><!-- end of Container -->
		<div id='sidebar'>
			<?php if($this->session->userdata('user_id')){
				echo '<b>'.$this->session->userdata('user_name').'</b> | '.anchor('auth/logout','Logout');
			}?>
			<script>
				$(function() {
					$( "#quicklinks" ).accordion({
						collapsible: true
					});
				});
			</script>

			<h2>Quick Links</h2>
			<div id="quicklinks">
				<h3><a href="javascript:;">Accounts</a></h3>
				<div>
					<ul>
						<li>New Account</li>
						<li>View Accounts</li>
					</ul>
				</div>
				<h3><a href="javascript:;">Invoices</a></h3>
				<div>
					<ul>
						<li>New Invoice</li>
						<li>View Invoices</li>
					</ul>
				</div>
				<h3><a href="javascript:;">Products</a></h3>
				<div>
					<ul>
						<li>View Products</li>
					</ul>
				</div>
				<h3><a href="javascript:;">Reports</a></h3>
				<div>
					<ul>
						<li>View Reports</li>
					</ul>
				</div>
				<h3><a href="javascript:;">Users</a></h3>
				<div>
					<ul>
						<li><a href='<?php echo site_url("users/add"); ?>' title ='Add New System Users'>Add New</a></li>
						<li><a href='<?php echo site_url("users"); ?>' title ='Manage System Users'>Manage users</a></li>
					</ul>
				</div>
			</div>			
		</div><!-- end of Sidebar -->
		<div class='clear'> </div>
		<div id='footer'>
			<p>Copyright 2012</p>
		</div><!-- end of Footer -->
	
	</div>
	<!-- end of wrapper -->
</body>
<html>

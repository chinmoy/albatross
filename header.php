<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Albatross Communications</title>

    <!-- Bootstrap -->
	<link href="style.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrapValidator.min.css" rel="stylesheet">
	<link href="css/bootstrap.vertical-tabs.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">

   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/bootstrapValidator.min.js"></script>
	<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="js/dataTables.bootstrap.js"></script>
	<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
	
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script>
		$(document).ready(function() {
			$('#example').dataTable(); 
			/*$(".clvnd").change(function() {
				$("#mfilter").val('1');
				$("#frm1").submit();
			}); 
			$(".category").change(function() {
				$("#mfilter").val('2');
				$("#frm1").submit();
			}); */
			$.fn.datepicker.defaults.format = "dd-mm-yyyy";
			$('.input-group.date').datepicker({ });
		});
	</script>
  </head>
  <body>
    <div class="container">
		  <div class="row container hdr">
		   		<div class="col-sm-4">
					<p class="logo"><a href="index.php">Albatross</a></p>
				</div>
				<div class="col-sm-8" style="padding-top:20px;text-align:right">
					  <div class="clearfix brand-warning"><?php if(isset($_SESSION['user']['uid']))echo '<div class="clearfix"><label>Welcome <a href="profile.php">'. $_SESSION['user']['fname'].' '.$_SESSION['user']['lname'].'</a></label></div>'; ?>	</div>
					  <ul class="nav nav-pills navbar-right">
					  	 <?php if(isset($_SESSION['user']['uid'])): ?>
							<li><a style="padding:0" href="logout.php"><button type="button" class="btn btn-primary">Log out</button></a></li>
						 <?php else: ?>
							<li><a style="padding:0" href="login.php"><button type="button" class="btn btn-primary">Login</button></a></li>
						<?php endif; ?>
					  </ul>					  
		  		 </div>
		  </div>
		  
		  <div class="blog-masthead">
		  <div class="container">
			<nav class="blog-nav">
			  <a class="blog-nav-item" href="index.php">Client</a>
			  <a class="blog-nav-item" href="vendor.php">Vendor</a>
			  <a class="blog-nav-item" href="rate.php">Rates</a>
			</nav>
		  </div>
		</div>
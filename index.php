<?php 
require_once('lib/function.php'); 
require_once('header.php');

$sql="select * from ".CLIENT." order by client_name";
$data=getdata($sql);
?>
		
	

		  <div class="blog-header">
			<h1 class="blog-title">Client Lists</h1>
		  </div>
 
	  	  <div class="row">
        	<div class="col-sm-12 blog-main">
			<div class="table-responsive">
									<table class="table table-striped table-bordered" width="100%" cellspacing="0" id="example">
									  <thead>
										<tr>
										  <th>Client Name</th>
										  <th>Address</th>
										</tr>
									  </thead>
									  <tfoot>
										<tr>
										  <th>Client Name</th>
										  <th>Address</th>
										</tr>
									  </tfoot>
									  <tbody>
										<?php foreach($data as $v): ?>
										<tr>
										  <td><?php echo $v['client_name']; ?></td>
										  <td><?php echo $v['address']; ?></td>
										</tr>
									   <?php endforeach; ?>
									   
									  </tbody>
									</table>
									
								</div>
			
			</div>
		  </div>
		  
		    

	 </div>  
	<?php	require_once('footer.php'); ?>
<?php 
$pageName='addrate';
require_once('../lib/function.php'); 
require_once('header.php');
//print_r($_POST);
if(isset($_POST['addRate'])):	
	$data=array();
	$data['category']=$_POST['category'];
	$data['destination_name']=$_POST['destination_name'];
	$data['country_code']=$_POST['country_code'];
	$data['area_code']=$_POST['area_code'];
	$data['rate']=$_POST['rate'];
	$data['tech_prefix']=$_POST['tech_prefix'];
	$data['billing_increment']=$_POST['billing_increment'];
	$data['status']=$_POST['status'];
	$data['client_id']=$_POST['client_id'];
	$data['vendor_id']=$_POST['vendor_id'];
	$data['seltype']=$_POST['rate_type'];
	
	$data['effective_date']=date("Y-m-d",strtotime($_POST['effective_date']));
	insertsql(RATE,$data); 
	
	$info='success';
	$msg='Successfully Inserted';
endif;

$sql="select * from ".CLIENT;
$client=getdata($sql);
		
$sql="select * from ".VENDOR;
$vendor=getdata($sql);		//$tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL); 							
?>
<link href="../css/datepicker3.css" rel="stylesheet">
<script type="text/javascript" src="../js/bootstrap-datepicker.js"></script>
    <div class="container-fluid">
      <div class="row">
        <?php require_once('sidebar.php'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <!--<h2 class="sub-header">Add Page</h2>-->
          <form class="form-horizontal" method="post" role="form" enctype="multipart/form-data">
				<div class="row">
					<h2 class="admincaption">Add New Rate</h2>
				    <div class="col-md-7">
						  
						  <div class="form-group">
							<label>Destination Name</label>
							<div>
							   <input type="text" class="form-control" name="destination_name" value=""  placeholder="Enter Destination Name here" />
							</div>
						  </div>
						  						 
						  
						  <div class="form-group">
							<label>Rate</label>
							<div>
							   <input type="text" class="form-control" name="rate" value=""  placeholder="Enter Rate here" />
							</div>
						  </div>
						  
						  <div class="form-group">
							<label>Country Code</label>
							<div>
							   <input type="text" class="form-control" name="country_code" value=""  placeholder="Enter Country Code here" />
							</div>
						  </div>
						  
						   <div class="form-group">
							<label>Area Code</label>
							<div>
							   <input type="text" class="form-control" name="area_code" value=""  placeholder="Enter Area Code here" />
							</div>
						  </div>
						  
						   <div class="form-group">
							<label>Tech Prefix</label>
							<div>
							   <input type="text" class="form-control" name="tech_prefix" value=""  placeholder="Enter Area Code here" />
							</div>
						  </div>
						  <div class="form-group">
							<label>Billing Increment</label>
							<div>
							   <input type="text" class="form-control" name="billing_increment" value=""  placeholder="Enter Area Code here" />
							</div>
						  </div>
						  <div class="form-group">
								 	<button type="submit" name="addRate" class="btn btn-primary">Add Rate</button>
								 </div> 
					
					</div>
					<div class="col-md-5">
						 <div class="row">
							<div class="col-md-11 col-md-offset-1">
								  
							 <div class="form-group">
									<label>Select Type</label>
									<div>
										<label class="radio-inline">
										  <input type="radio" name="rate_type" class="radiosel1" value="1">Client
										</label>
										<label class="radio-inline">
										  <input type="radio" name="rate_type" class="radiosel2" value="2">Vendor
										</label>
										
									</div>
								</div>
								  
								   <div class="form-group clientdiv collapse"  id="client_id">
									<label>Client</label>
									<div>
									  	<select class="form-control" name="client_id">
											<option value="-1">Select Client</option>
											<?php foreach($client as $v): ?>
												<option value="<?php echo $v['clientId']; ?>"><?php echo $v['client_name']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								 </div>
								 
								  
								 
								 <div class="form-group vendordiv collapse"  id="vendor_id">
									<label>Vendor</label>
									<div>
									  	<select class="form-control required" name="vendor_id">
											<option value="-1">Select Vendor</option>
											<?php foreach($vendor as $v): ?>
												<option value="<?php echo $v['vendorId']; ?>"><?php echo $v['vendor_name']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								 </div>
								 
								 <div class="form-group">
									<label>Status</label>
									<div>
									  	<select class="form-control" name="status">
											<option value="No Change">No Change</option>
											<option value="Decreased">Decreased</option>
											<option value="Increased">Increased</option>
										</select>
									</div>
								 </div>
								  
								 <div class="form-group">
									<label>Category</label>
									<div>
										<select class="form-control required" name="category">
										<?php
											$sql="select * from ".CATEGORY." order by cat";
											$data1=getdata($sql);
											foreach($data1 as $v):
										?>
										  <option  value="<?php echo $v['catId']; ?>"><?php echo $v['cat']; ?></option>
										<?php endforeach; ?>
									</select>
									</div>
								</div>
								 <div class="form-group">
									<label>Effective Date</label>
									<div>
									  	<input name="effective_date" data-provide="datepicker" class="datepicker" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y');?>">
									</div>
								 </div>
								 
							</div>
						 </div>
						 
						
					</div>
				</div>
			</form>		  
        </div>
      </div>
    </div>

<?php require_once('footer.php'); ?>
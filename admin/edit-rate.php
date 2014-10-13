<?php 
$pageName='rate';
require_once('../lib/function.php'); 
require_once('header.php');
//print_r($_POST);
if(isset($_POST['updateRate'])):	
	$data=array();
	$sql="select * from ".RATE." where rateId=".$_POST['rateId'];
	$prevRate=getdata($sql);
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
	$data['previous_rate']=$prevRate[0]['rate'];
	$data['previous_effective_date']=$prevRate[0]['effective_date'];
	$cond=" rateId=".$_POST['rateId'];
	updatesql(RATE,$data,$cond);
	$info='success';
	$msg='Successfully Updated';
endif;

if(isset($_GET['editId'])):
$sql="select * from ".RATE." where rateId=".$_GET['editId'];
$rate=getdata($sql);
$data=$rate[0];
endif;

$sql="select * from ".CLIENT;
$client=getdata($sql);
		
$sql="select * from ".VENDOR;
$vendor=getdata($sql);									
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
					<h2 class="admincaption">Edit Rate</h2>
				    <div class="col-md-7">
						
						  <div class="form-group">
							<label>Destination Name</label>
							<div>
							   <input type="text" class="form-control" name="destination_name" value="<?php echo $data['destination_name']; ?>"  placeholder="Enter Destination Name here" />
							</div>
						  </div>
						   
						  
						  <div class="form-group">
							<label>Area Code</label>
							<div>
							   <input type="text" class="form-control" name="area_code" value="<?php echo $data['area_code']; ?>"  placeholder="Enter Area Code here" />
							</div>
						  </div>
						  
						  <div class="form-group">
							<label>Rate</label>
							<div>
								<input name="rateId" type="hidden" value="<?php echo $data['rateId']; ?>" />
							   <input type="text" class="form-control" name="rate" value="<?php echo $data['rate']; ?>"  placeholder="Enter Rate here" />
							</div>
						  </div>
						   <div class="form-group">
									<label>Country Code</label>
									<div>
									   <input type="text" class="form-control" name="country_code" value="<?php echo $data['country_code']; ?>"  placeholder="Enter Country Code here" />
									</div>
								  </div>
						  <div class="form-group">
							<label>Tech Prefix</label>
							<div>
							   <input type="text" class="form-control" name="tech_prefix" value="<?php echo $data['tech_prefix']; ?>"  placeholder="Enter Tech Prefix here" />
							</div>
						  </div>
						  <div class="form-group">
							<label>Billing Increment</label>
							<div>
							   <input type="text" class="form-control" name="billing_increment" value="<?php echo $data['billing_increment']; ?>"  placeholder="Enter Billing Increment here" />
							</div>
						  </div>
						  <div class="form-group">
							<button type="submit" name="updateRate" class="btn btn-primary">Update Rate</button>
						 </div> 
					
					</div>
					<div class="col-md-5">
						 <div class="row">
							<div class="col-md-11 col-md-offset-1">
								 
								  
							  <div class="form-group">
									<label>Select Type</label>
									<div>
										<label class="radio-inline">
										  <input type="radio" name="rate_type" <?php if(1==$data['seltype'])echo 'checked="checked"'; ?> class="radiosel1" value="1">Client
										</label>
										<label class="radio-inline">
										  <input type="radio" name="rate_type"  <?php if(2==$data['seltype'])echo 'checked="checked"'; ?> class="radiosel2" value="2">Vendor
										</label>
										
									</div>
								</div>
								
								   <div class="form-group clientdiv <?php if(2==$data['seltype'])echo 'collapse';?>"  id="client_id">
									<label>Client</label>
									<div>
									  	<select class="form-control" name="client_id">
											<option value="-1">Select Client</option>
											<?php foreach($client as $v): ?>
												<option <?php if($v['clientId']==$data['client_id'])echo 'selected="selected"';?> value="<?php echo $v['clientId']; ?>"><?php echo $v['client_name']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								 </div>
								  
								 <div class="form-group vendordiv  <?php if(1==$data['seltype'])echo 'collapse';?>" id="vendor_id">
									<label>Vendor</label>
									<div>
									  	<select class="form-control required" name="vendor_id">
											<option value="-1">Select Vendor</option>
											<?php foreach($vendor as $v): ?>
												<option <?php if($v['vendorId']==$data['vendor_id'])echo 'selected="selected"';?>  value="<?php echo $v['vendorId']; ?>"><?php echo $v['vendor_name']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								 </div>
								 
								  <div class="form-group">
									<label>Status</label>
									<div>
									  	<select class="form-control" name="status">
											<option <?php if($v['status']=='No Change')echo 'selected="selected"';?> value="No Change">No Change</option>
											<option <?php if($v['status']=='Decreased')echo 'selected="selected"';?> value="Decreased">Decreased</option>
											<option <?php if($v['status']=='Increased')echo 'selected="selected"';?> value="Increased">Increased</option>
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
										  <option <?php if($v['catId']==$data['category'])echo 'selected="selected"';?>  value="<?php echo $v['catId']; ?>"><?php echo $v['cat']; ?></option>
										<?php endforeach; ?>
									</select>
									</div>
								</div>
								
								<div class="form-group">
									<label>Effective Date</label>
									<div>
									  	<input name="effective_date" data-provide="datepicker" class="datepicker" data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y',strtotime($data['effective_date']));?>">
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
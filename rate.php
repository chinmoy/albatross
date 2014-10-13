<?php 
require_once('lib/function.php'); 
require_once('header.php');

if(isset($_POST['SubmitFilter1'])):
	$filter='';
	$flag=0;
	$concat='';
	
	if($_POST['client_id']!=-1):
		$filter.=$concat.'client_id='.$_POST['client_id'];
		$concat=' and ';
	endif;
	
	if($_POST['vendor_id']!=-1):
		$filter.=$concat.'vendor_id='.$_POST['vendor_id'];
		$concat=' and ';
	endif;
	
	if($_POST['category']!=-1):
		$filter.=$concat."category=".$_POST['category'];
		$concat=' and ';
	endif;
	
	if($_POST['country_code']!=''):
		$filter.=$concat."country_code=".$_POST['country_code'];
		$concat=' and ';
	endif;
	
	if($_POST['rate_price']!=''):
		$symbol='';
		
		if($_POST['rate_type']=='1')$symbol='>';
		if($_POST['rate_type']=='2')$symbol='>=';
		if($_POST['rate_type']=='3')$symbol='=';
		if($_POST['rate_type']=='4')$symbol='<=';
		if($_POST['rate_type']=='5')$symbol='<';

		$filter.=$concat." CAST(rate AS DECIMAL(6,5))".$symbol.'CAST('.$_POST['rate_price']." AS DECIMAL(6,5))";
		$concat=' and ';
	endif;
	
	if($_POST['seltype']!=''):
		$filter.=$concat."seltype=".$_POST['seltype'];
		$concat=' and ';
		$type=$_POST['seltype'];
	endif;
	
	if($_POST['destination']!=''):
		$filter.=$concat."lower(destination_name) like lower('".$_POST['destination']."%')";
		$concat=' and ';	
	endif;
endif;
if(isset($_POST['SubmitFilter2'])):
	$filter1='';
	$flag=0;
	$concat='';
	
	if($_POST['dt1']!='' && $_POST['dt2']!=''):
		$dt1=date('Y-m-d',strtotime($_POST['dt1']));
		$dt2=date('Y-m-d',strtotime($_POST['dt2']));
		$filter1="effective_date between '$dt1' and '$dt2' order by effective_date";
	elseif($_POST['dt1']!=''):
		$dt1=date('Y-m-d',strtotime($_POST['dt1']));
		$filter1="effective_date >= $dt1 order by effective_date";	
	elseif($_POST['dt2']!=''):
		$dt2=date('Y-m-d',strtotime($_POST['dt2']));
		$filter1="effective_date <= $dt2 order by effective_date";	
	endif;
	//echo $filter1;
endif;


if($filter!='')
$sql="select * from ".RATE." where ".$filter;
elseif($filter1!='')
$sql="select * from ".RATE." where ".$filter1;
else
$sql="select * from ".RATE;

$data=getdata($sql);

$sql="select * from ".CLIENT;
$client1=$temp=getdata($sql);
$client=array();
foreach($temp as $v):
	$client[$v['clientId']]=$v['client_name'];
endforeach;

$sql="select * from ".VENDOR;
$vendor1=$temp=getdata($sql);
$vendor=array();
foreach($temp as $v):
	$vendor[$v['vendorId']]=$v['vendor_name'];
endforeach;

$sql="select * from ".CATEGORY;
$temp=getdata($sql);
$cat=array();
foreach($temp as $v):
	$cat[$v['catId']]=$v['cat'];
endforeach;
?>
		  <div class="blog-header">
			<h1 class="blog-title">Rate</h1>
		  </div>
 
	  	  <div class="row">
			<div class="col-sm-12 blog-main">	
				<div class="panel panel-warning">
				   <div class="panel-heading">Filter</div>
				   <div class="panel-body">
				   <div class="row">
					  <div class="col-md-8">
					 	 
						  <form action="" method="post" class="form-horizontal" role="form" id="frm1">
						   <div class="row">		
								<div class="col-md-3">			
									<div class="form-group">
											<!--<select name="seltype"  class="form-control clvnd">
												<option  value="1">Client</option>
												<option <?php if($type==2)echo 'selected="selected"';?> value="2">Vendor</option>
											</select>-->
											<div class="radio-inline" style="padding-left:30px;">
											  <label>
												<input type="radio" name="seltype" id="optionsRadios1" value="1" <?php if($_POST['seltype']==1)echo 'checked';?> >
												Client
											  </label>
											</div>
											<div class="radio-inline">
											  <label>
												<input type="radio" name="seltype" id="optionsRadios2" value="2" <?php if($_POST['seltype']==2)echo 'checked';?> >
												Vendor
											  </label>
											</div>
									</div>			
								</div>
								<div class="col-md-3">
									<div class="form-group">
											<select class="form-control category" name="category">
												<option value="-1">Select Category</option>
												<?php
													$sql="select * from ".CATEGORY." order by cat";
													$data1=getdata($sql);
													foreach($data1 as $v):
												?>
												  <option <?php if($_POST['category']==$v['catId'])echo 'selected="selected"';?> value="<?php echo $v['catId']; ?>"><?php echo $v['cat']; ?></option>
												<?php endforeach; ?>
											</select>
									</div>
								<input type="hidden" id="mfilter" name="filter" value="0" /><br />
							</div>						
								<div class="col-md-6">			
									<div class="form-group">
										
										<div class="col-md-6">
											<select class="form-control" name="client_id">
												<option value="-1">Select Client</option>
												<?php foreach($client1 as $v): ?>
													<option <?php if($v['clientId']==$_POST['client_id'])echo 'selected="selected"';?> value="<?php echo $v['clientId']; ?>"><?php echo $v['client_name']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="col-md-6">
											 <select class="form-control required" name="vendor_id">
												<option value="-1">Select Vendor</option>
												<?php foreach($vendor1 as $v): ?>
													<option <?php if($v['vendorId']==$_POST['vendor_id'])echo 'selected="selected"';?>  value="<?php echo $v['vendorId']; ?>"><?php echo $v['vendor_name']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										
									</div>			
								</div>
							</div>
									
									<!--<div class="col-md-5">
										<select name="searchtype" class="form-control">
											<option <?php if($_POST['searchtype']==1)echo 'selected="selected"';?> value="1">Destination</option>
											<option <?php if($_POST['searchtype']==2)echo 'selected="selected"';?> value="2">Date</option>
										</select>
									</div>-->
							<div class="row">			
								<div class="col-md-2">										
									<div class="input-group">
										<div class="input-group-addon">Rate</div>
											<select class="form-control" name="rate_type" style="width:60px">
												<option <?php if($_POST['rate_type']==1)echo 'selected="selected"';?> value="1">></option>
												<option <?php if($_POST['rate_type']==2)echo 'selected="selected"';?> value="2">>=</option>
												<option <?php if($_POST['rate_type']==3)echo 'selected="selected"';?> value="3">=</option>
												<option <?php if($_POST['rate_type']==4)echo 'selected="selected"';?> value="4"><=</option>
												<option <?php if($_POST['rate_type']==5)echo 'selected="selected"';?> value="5"><</option>											
											</select>												
									</div>
								</div>
								<div class="col-md-2">			
									<input class="form-control" name="rate_price" type="text" value="<?php if(isset($_POST['rate_price']))echo $_POST['rate_price'];?>" placeholder="Type Rate">
								</div>
								<div class="col-md-3">			
									<input class="form-control" name="country_code" value="<?php if(isset($_POST['country_code']))echo $_POST['country_code'];?>" type="text" placeholder="Country Code">
								</div>
								<div class="col-md-3">
										<input type="text" class="form-control" placeholder="Destination" value="<?php if($_POST['destination']!='')echo $_POST['destination']; ?>" name="destination" id="srch-term">
										<!--<div class="input-group-btn">
											<button class="btn btn-default" name="srcbtn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
										</div>-->
								</div>
								<div class="col-md-2">	
									<div class="form-group">
										<button type="submit" name="SubmitFilter1" value="filter" class="btn btn-primary">Apply Filter</button>
									</div>
								</div>	
									
							</div>	
						</form>						
					  </div>	
					  <div class="col-md-4" style="border-left:1px solid #faebcc">	
					  	  <form class="form-horizontal" method="post" role="form">
						  <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">From</label>
							<div class="col-sm-10">
								  <div class="input-group date">
									<input type="text" class="form-control" value="<?php if($_POST['dt1']!='')echo $_POST['dt1']; ?>" name="dt1">
									<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
									</div>
							</div>
						  </div>
						  <div class="form-group">
							<label for="inputPassword3" class="col-sm-2 control-label">To</label>
							<div class="col-sm-10">
							  <div class="input-group date">
									<input type="text" class="form-control" value="<?php if($_POST['dt1']!='')echo $_POST['dt2']; ?>" name="dt2">
									<span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
						      </div>
							</div>
						  </div>
  
						  <div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
							  <button type="submit" name="SubmitFilter2" class="btn btn-primary">Filter</button>
							</div>
						  </div>
						</form>
					  </div>
					</div>
				  </div>				 
			</div>			
				
				
				<div class="table-responsive">
					<table class="table table-striped table-bordered" width="100%" cellspacing="0" id="example">
					  <thead>
						<tr>
						   <th><input type="checkbox" class="allchk"  /></th>
						   <th>Destination Name</th>
						   <th>Country code</th>
						   <th>Area Code</th>
						   <th>Rate</th>
						   <?php if($type==1): ?>
						   <th>Client</th>
						   <?php endif; ?>
						   <?php if($type==2): ?>
						   <th>Vendor</th>
						   <?php endif; ?>
						   <th>Category</th>										  
						   <th>Effective_date</th>
						   <th>Previous Rate</th>
						   <th>Previous Effective Date</th> 	 	 
						</tr>
					  </thead>
					  <tfoot>
						<tr>
						   <th><input type="checkbox" class="allchk"  /></th>
						   <th>Destination Name</th>
						   <th>Country code</th>
						   <th>Area Code</th>
						   <th>Rate</th>
						   <?php if($type==1): ?>
						   <th>Client</th>
						   <?php endif; ?>
						   <?php if($type==2): ?>
						   <th>Vendor</th>
						   <?php endif; ?>
						   <th>Category</th>										  
						   <th>Effective_date</th>
						   <th>Previous Rate</th>
						   <th>Previous Effective Date</th> 	 
						</tr>
					</tfoot>
					  <tbody>
						<?php foreach($data as $v): ?>
						<tr>
						   <td><input type="checkbox" class="chkbox" name="trans[]" value="1"  /></td>
						   <td><?php echo $v['destination_name']; ?></td>
						   <td><?php echo $v['country_code']; ?></td>
						   <td><?php echo $v['area_code']; ?></td>
						   <td><?php echo $v['rate']; ?></td>
						   <?php if($type==1): ?>
						   <td><?php echo $client[$v['client_id']]; ?></td>
						   <?php endif; ?>
						   <?php if($type==2): ?>
						   <td><?php echo $vendor[$v['vendor_id']]; ?></td>
						   <?php endif; ?>
						   <td><?php echo $cat[$v['category']]; ?></td>
						   <td><?php echo date('d-m-Y',strtotime($v['effective_date'])); ?></td>
						   <td><?php echo $v['previous_rate']; ?></td>
						   <td><?php echo $v['previous_effective_date']; ?></td>
						</tr>
					   <?php endforeach; ?>
					   
					  </tbody>
					</table>									
				</div>
			
			</div>
		  </div>

	 </div>  
<?php	require_once('footer.php'); ?>
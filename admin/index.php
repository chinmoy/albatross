<?php
require_once('excel/excel.php');
require_once('../lib/function.php'); 
require_once('header.php');

$msg='';
if(isset($_POST['clientUpload'])): 
	$path=uploadFiles($_FILES,'tmp');
	$Filepath= BASEPATH.$path['client_data'];
	$exldata=readExcel($Filepath);
	$success_cnt=0;
	$fail_cnt=0;
	$start=0;
	foreach($exldata as $v):
		$start++;
		if($start==1)continue;
		$sql="select * from ".CLIENT." where client_name='$v[0]'";
		$tmp=getdata($sql);
		$data=array();
		if(empty($tmp)):
			$data['client_name']=$v[0];
			$data['address']=$v[1];
			$data['email']=$v[2];
			$data['phone']=$v[3];
			insertsql(CLIENT,$data);
			$success_cnt++;
		else:
			$fail_cnt++;
		endif;
	endforeach;
	$tabselect=0;
	$msg="<strong>Client Import File Successfully Uploaded.</strong><br > Total Row: ".($success_cnt + $fail_cnt )."<br >";
	$msg.='Successfully Inserted: '.$success_cnt."<br >";
	$msg.='Failed to Insert: '.$fail_cnt;
endif;

if(isset($_POST['vendorUpload'])):  
	$path=uploadFiles($_FILES,'tmp');
	$Filepath= BASEPATH.$path['vendor_data'];
	$exldata=readExcel($Filepath);
	$success_cnt=0;
	$fail_cnt=0;
	$start=0;
	foreach($exldata as $v):
		$start++;
		if($start==1)continue;
		$sql="select * from ".VENDOR." where vendor_name='$v[0]'";
		$tmp=getdata($sql);
		$data=array();
		if(empty($tmp)):
			$data['vendor_name']=$v[0];
			$data['vendor_address']=$v[1];
			$data['email']=$v[2];
			$data['phone']=$v[3];
			insertsql(VENDOR,$data);
			$success_cnt++;
		else:
			$fail_cnt++;
		endif;
	endforeach;
	$tabselect=1;
	$msg="<strong>Vendor Import File Successfully Uploaded.</strong><br > Total Row: ".($success_cnt + $fail_cnt )."<br >";
	$msg.='Successfully Inserted: '.$success_cnt."<br >";
	$msg.='Failed to Insert: '.$fail_cnt;
endif;

if(isset($_POST['rateUpload'])):  
	$path=uploadFiles($_FILES,'tmp');
	$Filepath= BASEPATH.$path['rate_data'];
	$exldata=readExcel($Filepath);
	if(!array_diff($exldata[0],$storevalid1)):
		$exldata=readExcelByIndex($exldata);
		$success_cnt=0;
		$fail_cnt=0;
		$start=0;
		foreach($exldata as $v):
			$start++;
			if($start==1)continue;
			
			$data=array();
				$sql="select * from ".CATEGORY." where cat='$v[Category]'";
				$tmp1=getdata($sql);
				if(empty($tmp1)):
					$data1=array();
					if($v['Category']!=''):
						$data1['cat']=$v['Category'];
						$catId=insertsql(CATEGORY,$data1);
					endif;
				else:
					$catId=$tmp1[0]['catId'];
				endif;
				
			$data['category']=$catId;
			$data['destination_name']=$v['Destination Name'];
			$data['country_code']=$v['Country Code'];
			$data['area_code']=$v['Area Code'];
			$data['rate']=$v['Rate'];
			$data['tech_prefix']=$v['Tech Prefix'];
			$data['billing_increment']=$v['Billing Increment'];
			$data['status']=$v['status'];
			$data['client_id']=$_POST['client_id'];
			$data['vendor_id']=$_POST['vendor_id'];
			$data['seltype']=$_POST['rate_type'];
			$data['effective_date']=date("Y-m-d",strtotime($v['Effective Date']));
			
			insertsql(RATE,$data);
			$success_cnt++;
			
		endforeach;
		$tabselect=2;
		$msg="<strong>Rate Import File Successfully Uploaded.</strong><br > Total Row: ".($success_cnt + $fail_cnt )."<br >";
		$msg.='Successfully Inserted: '.$success_cnt."<br >";
	else:
		$tabselect=2;
		$msg="<strong>File Format not matched!!!.</strong><br > ";
		$msg.="Please upload data with correct file format.<a href='file/rate.xlsx'>Click here</a> to get the format file.<br >";
	endif;
endif;
$sql="select * from ".CLIENT;
$client=getdata($sql);
		
$sql="select * from ".VENDOR;
$vendor=getdata($sql);
?>
<script>
	$(document).ready(function() {
		<?php if(isset($tabselect) && $tabselect>0):?>
			$('#myTab li:eq(<?php echo $tabselect; ?>) a').tab('show');
		<?php endif; ?>
		$(".rateUpload").click(function() {
				var c=$("#client_id select").val();
				var v=$("#vendor_id select").val();
				if(c=="-1" && v=="-1"){
				alert("Please select a Vendor or Client");
				return false;
			}
		});
	});
</script>
    <div class="container-fluid">
      <div class="row">
        <?php require_once('sidebar.php'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard</h1>          
			  <ul id="myTab" class="nav nav-tabs" role="tablist">
				  <li class="active"><a href="#clienttab" role="tab" data-toggle="tab">Import Client</a></li>
				  <li><a href="#vendortab" role="tab" data-toggle="tab">Import Vendor</a></li>	
				  <li><a href="#ratetab" role="tab" data-toggle="tab">Import Rate</a></li>				
				</ul>
			 
			  <div class="tab-content">
  				  <div class="tab-pane  fade in  active innerportion" id="clienttab">
					  <?php if($tabselect==0)displaymsg($msg,'warning') ?>
					  <form class="form-horizontal" method="post" role="form" action="" enctype="multipart/form-data">
							<div class="form-group">
								<label>Upload Client Data</label>
								<div>
								  <input type="file" name="client_data" required />
								  <p class="help-block">Please upload xlsx / xls / csv Format.<a href="file/client.xlsx">Click here</a> to get the format file.</p>		
								</div>
								<div>
								 <button type="submit" name="clientUpload" class="btn btn-primary">Upload Client Data</button>			  
								</div>
							  </div>
					  </form>
					 </div>
					 <div class="tab-pane fade innerportion" id="vendortab">
					 	<?php if($tabselect==1)displaymsg($msg,'warning') ?>
						 <form class="form-horizontal" method="post" role="form" action="" enctype="multipart/form-data">
								<div class="form-group">
									<label>Upload Vendor Data</label>
									<div>
									  <input type="file" name="vendor_data" required />
									  <p class="help-block">Please upload xlsx / xls / csv Format.<a href="file/vendor.xlsx">Click here</a> to get the format file.</p>		
									</div>
									<div>
									 <button type="submit" name="vendorUpload" class="btn btn-primary">Upload Client Data</button>			  
									</div>
								  </div>
						  </form>
					 </div>  
					 <div class="tab-pane fade innerportion" id="ratetab">
					 	<?php if($tabselect==2)displaymsg($msg,'warning') ?>
						<form class="form-horizontal" method="post" role="form" action="" enctype="multipart/form-data">
							<div class="form-group">
									<label>Select Type</label>
									<div>
										<label class="radio-inline">
										  <input type="radio" name="rate_type" class="radiosel1" value="1" required>Client
										</label>
										<label class="radio-inline">
										  <input type="radio" name="rate_type" class="radiosel2" value="2" required>Vendor
										</label>
										
									</div>
								</div>
							<div class="row">
							<div class="form-group clientdiv collapse col-md-4"  id="client_id">
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
								 
								 
								 <div class="form-group vendordiv collapse col-md-4"  id="vendor_id">
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
							</div>
							<div class="clearfix"></div>
							<div class="form-group">
								<label>Upload Rate Data</label>
								<div>
								  <input type="file" name="rate_data" required />
								  <p class="help-block">Please upload xlsx / xls / csv Format.<a href="file/rate.xlsx">Click here</a> to get the format file.</p>		
								</div>
								<div>
								 <button type="submit" name="rateUpload" class="btn btn-primary rateUpload">Upload Client Data</button>			  
								</div>
							  </div>
					  </form>
					 </div>  
				</div>
			  
        </div>
      </div>
    </div>


<?php require_once('footer.php'); ?>
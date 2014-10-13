<?php 
$pageName='category';
require_once('../lib/function.php'); 
require_once('header.php'); 
if(isset($_POST['addCategory'])):
	$sql="select * from ".CATEGORY." where cat='$_POST[cat]'";
	$tmp=getdata($sql);
	if(empty($tmp)):
		$data['cat']=$_POST['cat'];
		$data['odr']=$_POST['odr'];
		insertsql(CATEGORY,$data);
		$info='success';
		$msg='Successfully Added';
	else:
		$info='error';
		$msg='Duplicate Category Name!!!';
	endif;
endif;
if(isset($_POST['updatebtn'])):
	$sql="select * from ".CATEGORY." where cat='$_POST[cat]' and catId!=".$_POST['catId'];
	$tmp=getdata($sql);
	if(empty($tmp)):
		$data['cat']=$_POST['cat'];
		$data['odr']=$_POST['odr'];
		$cond=" catId=".$_POST['catId'];
		updatesql(CATEGORY,$data,$cond);
		$info='success';
		$msg='Successfully Updated';
	else:
		$info='error';
		$msg='Duplicate Category Name!!!';
	endif;
endif;
if(isset($_POST['btnDelete'])):
	$sql="delete from ".CATEGORY." where catId=".$_POST['btnDelete'];
	runquery($sql);
endif;
if(isset($_GET['editId'])):
$sql="select * from ".CATEGORY." where catId=".$_GET['editId'];
$cat=getdata($sql);
$cat=$cat[0];
endif;
?>
    <div class="container-fluid">
      <div class="row">
        <?php require_once('sidebar.php'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h3 style="margin-left:-15px">Add New Category</h3>
          <form class="form-horizontal" method="post" role="form" action="category.php">
				<div class="row">
				    <div class="col-md-4">
						  <div class="form-group">
						  <?php if($info=='success') echo '<div class="bg-success csuccess">'.$msg.'</div>'; ?>
						  <?php if($info=='error') echo '<div class="bg-danger csuccess">'.$msg.'</div>'; ?>
						  </div>
						  <?php if(isset($_GET['editId'])):  ?>
							  <div class="form-group">
								<label>Name</label>
								<div>
								  <input type="text" class="form-control" name="cat" value="<?php echo $cat['cat']; ?>" />					  
								</div>
								
							  </div>
							  <div class="form-group">
								<label>Order</label>
								<div>
								  <input type="text" class="form-control" name="odr" value="<?php echo $cat['odr']; ?>" />		
								  <input type="hidden" name="catId" value="<?php echo $cat['catId']; ?>"  />			  
								</div>
								
							  </div>
							  <div class="form-group">
								<button type="submit" name="updatebtn" class="btn btn-primary">Update Category</button>
							   </div>
						   <?php else: ?>
						   		<div class="form-group">
								<label>Name</label>
								<div>
								  <input type="text" class="form-control" name="cat" value="" />					  
								</div>
								
							  </div>
							  <div class="form-group">
								<label>Order</label>
								<div>
								  <input type="text" class="form-control" name="odr" value="" />					  
								</div>
								
							  </div>
							  <div class="form-group">
								<button type="submit" name="addCategory" class="btn btn-primary">Add New Category</button>
							   </div>
						   
						   <?php endif; ?>
					</div>
					<div class="col-md-8">
						 <div class="row">
							<div class="col-md-11 col-md-offset-1">
								<div class="table-responsive">
									<table class="table table-striped">
									  <thead>
										<tr>
										  <th width="5%"><input type="checkbox"  /></th>
										  <th width="50%">Category Name</th>
										  <th width="15%">Order</th>
										  <th width="15%">Edit</th>
										  <th width="15%">Delete</th>
										</tr>
									  </thead>
									  <tbody>
										<?php
											$sql="select * from ".CATEGORY." order by cat";
											$data=getdata($sql);
											
											foreach($data as $v):
										?>
										<tr>
										  <td><input type="checkbox"  /></td>
										  <td><?php echo $v['cat']; ?></td>
										  <td><?php echo $v['odr']; ?></td>
										  <td><a href="category.php?editId=<?php echo $v['catId']; ?>">Edit</a></td>
										  <td><a class="del" href="javascript:void(0)" name="<?php echo $v['catId']; ?>">Delete</a></td>
										</tr>
									   <?php endforeach; ?>
									   
									  </tbody>
									</table>
									
								</div>
							</div>
						 </div>
						 
						
					</div>
				</div>
			</form>	
			<form id="catDelFrm" method="post" role="form" action="">
				<input type="hidden" name="btnDelete"  value="" id="catDelete" />
			</form>	  
        </div>
      </div>
    </div>
<script>
	jQuery(document).ready(function() {
		jQuery(".del").click(function() {
			var r = confirm("Are you sure you want to delete that Category?");
			if (r == true) {		
				$("#catDelete").val($(this).attr('name'));
				$("#catDelFrm").submit();
			}
		});
	});
</script>
<?php require_once('footer.php'); ?>
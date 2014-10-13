<?php 
$pageName='client';
require_once('../lib/function.php'); 
require_once('header.php'); 
if(isset($_POST['addBtn'])):
	$sql="select * from ".CLIENT." where client_name='$_POST[client_name]'";
	$tmp=getdata($sql);
	if(empty($tmp)):
		$data['client_name']=$_POST['client_name'];
		$data['address']=$_POST['address'];
		$data['email']=$_POST['email'];
		$data['phone']=$_POST['phone'];
		insertsql(CLIENT,$data);
		$info='success';
		$msg='Successfully Added';
	else:
		$info='error';
		$msg='Duplicate Client Name!!!';
	endif;
endif;
if(isset($_POST['updateBtn'])):
	$sql="select * from ".CLIENT." where client_name='$_POST[client_name]' and clientId!=".$_POST['clientId'];
	$tmp=getdata($sql);
	if(empty($tmp)):
		$data['client_name']=$_POST['client_name'];
		$data['address']=$_POST['address'];
		$data['email']=$_POST['email'];
		$data['phone']=$_POST['phone'];
		$cond=" clientId=".$_POST['clientId'];
		updatesql(CLIENT,$data,$cond);
		$info='success';
		$msg='Successfully Updated';
	else:
		$info='error';
		$msg='Duplicate Client Name!!!';
	endif;
endif;
if(isset($_POST['btnDelete'])):
	$sql="delete from ".CLIENT." where clientId=".$_POST['btnDelete'];
	runquery($sql);
endif;
if(isset($_GET['editId'])):
$sql="select * from ".CLIENT." where clientId=".$_GET['editId'];
$client=getdata($sql);
$client=$client[0];
endif;
?>
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
        mode : "textareas",
        editor_selector : "mceEditor",
        plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons template textcolor paste textcolor colorpicker textpattern"
        ],
        toolbar1: "bold italic underline | formatselect | bullist numlist code",
        menubar: false,
        toolbar_items_size: 'small',
        style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ]
});
</script>

    <div class="container-fluid">
      <div class="row">
        <?php require_once('sidebar.php'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
         
          <form class="form-horizontal" method="post" role="form" action="client.php">
				<div class="row"> 
				    <div class="col-md-4">
						  <div class="row"><h3 class="bottombar">Add New Client</h3></div>
						  <div class="form-group">
						  <?php if($info=='success') echo '<div class="bg-success csuccess">'.$msg.'</div>'; ?>
						  <?php if($info=='error') echo '<div class="bg-danger csuccess">'.$msg.'</div>'; ?>
						  </div>
						  <?php if(isset($_GET['editId'])):  ?>
							  <div class="form-group">
								<label>Client Name</label>
								<div>
								  <input type="text" class="form-control" name="client_name" value="<?php echo $client['client_name']; ?>" />					  
								</div>
								
							  </div>
							  <div class="form-group">
								<label>Client Address</label>
								<div>
								 <!-- <input type="text" class="form-control" name="address" value="<?php echo $client['address']; ?>" />-->
								  <textarea name="address" class="mceEditor" style="width:100%;" rows="6"><?php echo $client['address']; ?></textarea>			
								  <input type="hidden" name="clientId" value="<?php echo $client['clientId']; ?>"  />			  
								</div>
								
							  </div>
							   <div class="form-group">
								<label>Email</label>
								<div>
								  <input type="text" class="form-control" name="email" value="<?php echo $client['email']; ?>" />					  
								</div>								
							  </div>
							   <div class="form-group">
								<label>Phone</label>
								<div>
								  <input type="text" class="form-control" name="phone" value="<?php echo $client['phone']; ?>" />					  
								</div>
								
							  </div>
							  <div class="form-group">
								<button type="submit" name="updateBtn" class="btn btn-primary">Update Client</button>
							   </div>
						   <?php else: ?>
						   		<div class="form-group">
								<label>Name</label>
								<div>
								  <input type="text" class="form-control" name="client_name" value="" />					  
								</div>
								
							  </div>
							  <div class="form-group">
								<label>Client Address</label>
								<div>
								  <textarea name="address" class="mceEditor" style="width:100%;" rows="6"></textarea>					  
								</div>
								
							  </div>
							  <div class="form-group">
								<label>Email</label>
								<div>
								  <input type="text" class="form-control" name="email" />					  
								</div>
								
							  </div>
							   <div class="form-group">
								<label>Phone</label>
								<div>
								  <input type="text" class="form-control" name="phone" />					  
								</div>
								
							  </div>
							  <div class="form-group">
								<button type="submit" name="addBtn" class="btn btn-primary">Add New Client</button>
							   </div>
						   
						   <?php endif; ?>
					</div>
					<div class="col-md-8">
						 <div class="row"> 
							<div class="col-md-12 col-md-offset-1">
								<h3 class="bottombar">Client Lists</h3>
								<div class="table-responsive">
									<table class="table table-striped">
									  <thead>
										<tr>
										  <th width="5%"><input type="checkbox"  /></th>
										  <th width="50%">Client Name</th>
										  <th width="15%">Edit</th>
										  <th width="15%">Delete</th>
										</tr>
									  </thead>
									  <tbody>
										<?php
											$sql="select * from ".CLIENT;
											$data=getdata($sql);
											
											foreach($data as $v):
										?>
										<tr>
										  <td><input type="checkbox"  /></td>
										  <td><?php echo $v['client_name']; ?></td>
										  <td><a href="client.php?editId=<?php echo $v['clientId']; ?>">Edit</a></td>
										  <td><a class="del" href="javascript:void(0)" name="<?php echo $v['clientId']; ?>">Delete</a></td>
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
			<form id="clientDelFrm" method="post" role="form" action="">
				<input type="hidden" name="btnDelete"  value="" id="clientDelete" />
			</form>	  
        </div>
      </div>
    </div>
<script>
	jQuery(document).ready(function() {
		jQuery(".del").click(function() {
			var r = confirm("Are you sure you want to delete that Client?");
			if (r == true) {		
				$("#clientDelete").val($(this).attr('name'));
				$("#clientDelFrm").submit();
			}
		});
	});
</script>
<?php require_once('footer.php'); ?>
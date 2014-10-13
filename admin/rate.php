<?php 
$pageName='rate';
require_once('../lib/function.php'); 
require_once('header.php');
if(isset($_POST['btnDelete'])):
	$sql="delete from ".RATE." where rateId=".$_POST['btnDelete'];
	runquery($sql);
endif;
?>
    <div class="container-fluid">
      <div class="row">
        <?php require_once('sidebar.php'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h2 class="sub-header">Rates</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                 
				  <th width="15%">Destination Name</th>
                  <th width="9%">Country code</th>
				  <th width="9%">Area Code</th>
				   <th width="15%">Effective Date</th>
				   <th width="9%">Rate</th>
				  <th width="10%">Edit</th>
				  <th width="10%">Delete</th>
                </tr>
              </thead>
              <tbody>
			  	<?php
					$sql="select * from ".RATE;
					$data=getdata($sql);
					
					foreach($data as $v):
				?>
                <tr>
                
				  <td><?php echo $v['destination_name']; ?></td>
				  <td><?php echo $v['country_code']; ?></td>
				  <td><?php echo $v['area_code']; ?></td>
				  <td><?php echo date('d-m-Y',strtotime($v['effective_date'])); ?></td>
                  <td><?php echo $v['rate']; ?></td>				  
				  <td><a href="edit-rate.php?editId=<?php echo $v['rateId']; ?>">Edit</a></td>
				  <td><a class="del" href="javascript:void(0)" name="<?php echo $v['rateId']; ?>">Delete</a></td>
                </tr>
               <?php endforeach; ?>
               
              </tbody>
            </table>
			<form id="catDelFrm" method="post" role="form" action="">
				<input type="hidden" name="btnDelete"  value="" id="catDelete" />
			</form>	  
          </div>
        </div>
      </div>
    </div>
<script>
	jQuery(document).ready(function() {
		jQuery(".del").click(function() {
			var r = confirm("Are you sure you want to delete that Rate?");
			if (r == true) {		
				$("#catDelete").val($(this).attr('name'));
				$("#catDelFrm").submit();
			}
		});
	});
</script>

<?php require_once('footer.php'); ?>
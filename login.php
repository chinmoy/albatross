<?php 
require_once('lib/function.php'); 
$info='';
if(isset($_POST['username'])):
	$username=($_POST['username']);
	$sql="select * from ".USER." where username='$username' and password='".md5(($_POST['password']))."'";
	$tmp=getdata($sql);
	if(!empty($tmp)):
		$info='success';
		$_SESSION['user']['uid']=$tmp[0]['id'];
		$_SESSION['user']['fname']=$tmp[0]['username'];
		header('location:admin/index.php');
	else:
		$info='error';
		$msg='Invalid Username or Password!!!';
	endif;
endif;
require_once('header.php'); 
?>
		
		  <div class="blog-header">
			<h1 class="blog-title">Login</h1>
			<hr />
		  </div>
 
	  	  <div class="row">
        	<div class="col-sm-12 blog-main">
				<?php if($info=='error') echo '<div class="bg-danger csuccess">'.$msg.'</div>'; ?>
				<form action="" method="post" class="form-signin" id="loginForm" role="form" data-toggle="validator">
					<h2 class="form-signin-heading">Please sign in</h2>
					<input type="text" class="form-control" name="username" placeholder="User Name" required autofocus>
					<input type="password" class="form-control" name="password" placeholder="Password" required>
					<!--<label class="checkbox">
					  <input type="checkbox" value="remember-me"> Remember me
					</label>-->
					<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
				</form>
			</div>
			
		  </div>
		  
		    

	 </div>  
	<?php	require_once('footer.php'); ?>
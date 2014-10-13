<?php
function sendmailFunction($to,$from="",$subject, $message){
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: BUET 85-92 Club <info@buet85-92.com>' . "\r\n";
	mail($to, $subject, $message, $headers);
}
function userMailBody($data,$opt){
if($opt==1) {
	$body='<table border="0" align="center" cellpadding="0" cellspacing="0" width="60%" style="font-family:Verdana, Arial, Helvetica, sans-serif">
		<tr>
			<td style="background:#3B5998;padding:10px;color:#FFFFFF;text-align:center;font-size:14px;font-weight:bold;">
				BUET 85-92 Club
			</td>
		</tr>
		<tr>
			<td style="background:#fff;padding:10px;color:#222222;text-align:left;font-size:13px;">
				<p><b>Welcome, '.$data['first_name'].'!</b></p>
				<p>Thank you for registering  at our site (BUET  85-92 Club). Your Registration must be approved by the Admin. You will get a confirmation email once the Admin approves your request.</p>
				<p>Please find your account details below</p>
				<p>Email: '.$data['email'].'<br  />
				   Password: '.$data['password'].'</p>
			</td>
		</tr>
		<tr>
			<td style="background:#F2F2F2;padding:10px;color:#222222;text-align:left;font-size:13px;border-bottom:1px solid #CCCCCC;border-top:1px solid #CCCCCC">
				<a href="http://buet85-92.com/" style="padding:5px 10px;display:block;background:#5B74A8;border:1px solid #29447E;width:120px;color:#fff;text-decoration:none">BUET 85-92 Club</a>
			</td>
		</td>
	</table>';
}
if($opt==2) {
	$body='<table border="0" align="center" cellpadding="0" cellspacing="0" width="60%" style="font-family:Verdana, Arial, Helvetica, sans-serif">
		<tr>
			<td style="background:#3B5998;padding:10px;color:#FFFFFF;text-align:center;font-size:14px;font-weight:bold;">
				BUET 85-92 Club
			</td>
		</tr>
		<tr>
			<td style="background:#fff;padding:10px;color:#222222;text-align:left;font-size:13px;">
				<p><b>Dear Admin</b></p>
				<p>'.$data['first_name'].' '.$data['last_name'].' has submitted a request to be a member of your site.You need to review the request. Please find the below link to approve the user</p>
				<p><a href="http://buet85-92.com/admin/pending.php">Approve User</a></p>
			</td>
		</tr>
		<tr>
			<td style="background:#F2F2F2;padding:10px;color:#222222;text-align:left;font-size:13px;border-bottom:1px solid #CCCCCC;border-top:1px solid #CCCCCC">
				<a href="" style="padding:5px 10px;display:block;background:#5B74A8;border:1px solid #29447E;width:120px;color:#fff;text-decoration:none">BUET 85-92 Club</a>
			</td>
		</td>
	</table>';
}
if($opt==3) {
	$body='<table border="0" align="center" cellpadding="0" cellspacing="0" width="60%" style="font-family:Verdana, Arial, Helvetica, sans-serif">
		<tr>
			<td style="background:#3B5998;padding:10px;color:#FFFFFF;text-align:center;font-size:14px;font-weight:bold;">
				BUET 85-92 Club
			</td>
		</tr>
		<tr>
			<td style="background:#fff;padding:10px;color:#222222;text-align:left;font-size:13px;">
				<p><b>Congratulations, '.$data['first_name'].'!</b></p>
				<p>Your Request has been approved by the admin. Thanks for joining our Buet 85-92 Club!</p>
				<p>Please find your account details below</p>
				<p>Email: '.$data['email'].'<br  />
				   Password: '.$data['password'].'</p>
			</td>
		</tr>
		<tr>
			<td style="background:#F2F2F2;padding:10px;color:#222222;text-align:left;font-size:13px;border-bottom:1px solid #CCCCCC;border-top:1px solid #CCCCCC">
				<a href="http://buet85-92.com/" style="padding:5px 10px;display:block;background:#5B74A8;border:1px solid #29447E;width:120px;color:#fff;text-decoration:none">BUET 85-92 Club</a>
			</td>
		</td>
	</table>';
	}
return $body;
}


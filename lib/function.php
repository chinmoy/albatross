<?php 
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
require_once('db.php'); 
define('ADMIN','admin');
define('SITEURL',str_replace('/'.ADMIN,'',dirname( url())) .'/');
define('BASEPATH',dirname(dirname( __FILE__)).'/');
define('THIMTHUMB',SITEURL.'timthumb.php?src='.SITEURL);
$global_month=array('January','February','March','April','May','June','July','August','September','October','November','December');
$storevalid1=array('Destination Name','Country Code','Area Code','Rate','Tech Prefix','Billing Increment','status','Category','Effective Date');
function initialEntry($tbl,$uid){
	$sql="select * from ".$tbl." where uid='$uid'";
	$tmp=getdata($sql);
	$insertId=0;
	if(empty($tmp)):
		$data['uid']=$uid;
		$insertId=insertsql($tbl,$data);
	endif;
	return $insertId;
}
function getIndustryId($industry){
	$tbl=INDUSTRY;
	$sql="select  * from ".$tbl." where industry='".$industry."'";
	$res=getdata($sql);
	$data=array('industry'=>$industry);
	if(empty($res)):
		return insertsql($tbl,$data);	
	else:
		return $res[0]['id'];
	endif;
}
function uploadFiles($file,$uploadpath=""){
	$uploadFiles=array();
	if(isset($file))
	foreach($file as $k=>$v):
		if($v['error']==0):
			$tmp_name = $v["tmp_name"];
			$name = $v["name"];
			$name = checkDuplicate($name,$uploadpath);			
			if($uploadpath=='')
			$uploadpath="upload/$name";
			else
			$uploadpath="upload/".$uploadpath."/$name";
			move_uploaded_file($tmp_name, BASEPATH."$uploadpath");
			$uploadFiles[$k]=$uploadpath;
		endif;
	endforeach;
	return $uploadFiles;
}
function url(){
  return sprintf(
    "%s://%s%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME'],
    $_SERVER['REQUEST_URI']
  );
}

function checkDuplicate($name,$uploadpath=""){
	 $tmpName=$name;
	if($uploadpath=='')
		$Finaluploadpath="upload/$name";
	else
		$Finaluploadpath="upload/".$uploadpath."/$name";
	if (file_exists(BASEPATH.$Finaluploadpath)):
		$tmp=explode('.',$name);
		for($i=1;;$i++){
			$tmpName=$tmp[0].'_'.$i.'.'.$tmp[1];
			$Finaluploadpath=BASEPATH."upload/".$uploadpath.'/'.$tmpName;
			if (!file_exists($Finaluploadpath))break;
		}
	endif;
	return $tmpName;
}
function generateRandomNumber(){
	$rand=rand(1,9).','.rand(0,9).','.rand(0,9).','.rand(0,9);
	return explode(',',$rand);
}
function displaymsg($msg,$theme='primary'){
if($msg!=''):
	echo '<br  />
	<div class="alert alert-'.$theme.' alert-dismissible" role="alert">
	  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	  '.$msg.'
	</div>';
endif; 
}
?>
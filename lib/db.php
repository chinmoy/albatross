<?php
define('COUNTRY','countries');
define('USER','user');
define('CLIENT','client');
define('VENDOR','vendor');
define('RATE','rate');

function connect(){	
	//$link = mysql_connect('localhost', 'root', '');
	$DBServer='localhost';
	$DBUser='root';
	$DBPass='';
	$DBName='albatross';
	$conn = new mysqli($DBServer, $DBUser, $DBPass, $DBName);
	if ($conn->connect_error) {
	  trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
	return $conn;
}
function runquery($sql){
	$db = connect();
	$db->query($sql);	
	return $last_inserted_id = $db->insert_id;
}
function getdata($sql){ //echo $sql;
	$db = connect();
	$result = $db->query($sql);	
	$data=array();
	$cnt=0;
	while($row = $result->fetch_assoc()){
		$data[]=$row;
		$cnt++;
	}
	return $data;
}
function insertsql($tbl,$data){
	$sql1=array();
	$sql2=array();
	$db = connect();
	foreach($data as $k=>$v):
		$sql1[]=$k;
		$sql2[]="'".mysqli_real_escape_string($db,$v)."'";
	endforeach;
	$sql="insert into $tbl (".implode(',',$sql1).") values(".implode(',',$sql2).")";
	return runquery($sql);
}
function updatesql($tbl,$data,$cond){
	$sql2='';
	$len=count($data);
	$i=0;
	$db = connect();
	foreach($data as $k=>$v):
		$i++;
		$sql2.=$k."='".mysqli_real_escape_string($db,$v)."'";
		if($len>$i)$sql2.=',';
	endforeach;
	$sql="update $tbl set ".$sql2." where ".$cond;
	return runquery($sql);
}
<?php
require('php-excel-reader/excel_reader2.php');
require('SpreadsheetReader.php');

function readExcel($Filepath){
$Spreadsheet = new SpreadsheetReader($Filepath);
$Sheets = $Spreadsheet -> Sheets();
$RetData=array();
foreach ($Sheets as $Index => $Name)
		{
		$Spreadsheet -> ChangeSheet($Index);

			foreach ($Spreadsheet as $Key => $Row)
			{
				if($Row)
				$RetData[]=$Row;
			}
		
	}
	return $RetData;
}
function readExcelByIndex($RetData){
	$key=$RetData[0];
	$cnt=0;
	foreach($RetData as $k=>$v):
		foreach($v as $k1=>$v1):
			$RetData1[$cnt][$key[$k1]]=$v1;
		endforeach;
		$cnt++;
	endforeach; 
return $RetData1;
}
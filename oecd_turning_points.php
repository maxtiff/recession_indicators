<?php
/**
 * Class OECD Download
 * 
 * 
 * 
 */
require_once('c:/users/tmay/workspace/recession_indicators/config.php');

Class oecd_downloader extends	Communicator {


require_once($cfg['recession_functions'].'handlerFileType.php');

$directory = __DIR__;
$file = "turning_points.csv";
$data = fileTypeReferrer($directory."/downloads/", $file);

$country_codes = get_country_codes($directory."/country_codes.txt");

$sheets = count($data);

xls_reader($data)


function xls_reader($path) {
	xls_sheet_compare($sheets) 
}

function xls_sheets_compare($sheets) {
	$sheet = 0;
	
	//loop through sheets
	while ($sheet <= $sheets) { 
		
		//count rows
		$rows = count($data[$sheet])
		
		//count columns
		$columns = count($data[$sheet][$row]);
		
		//loop through columns
		for ($column = 0; $column < $columns; $column++) {
	}
	
function get_country_codes($file) {
	fopen($dir)	
}

function placeholder() {
	if (!empty($data[$sheet][$row][$column])) {
		if (isset($country_codes[$data[$sheet][$row][$column]])) {
			$country_colums[$column] = $data[$sheet][$row][$column];
			//print $sheet."\t".$row."\t".$column."\t".$data[$sheet][$row][$column]."\n";
		} elseif (preg_match("/^(\d{2})\-(\d{2})\-(\d{4})$/", trim($data[$sheet][$row][$column]), $matches)) {
			$dates[$row] = $matches[3]."M".$matches[2];
			//print $sheet."\t".$row."\t".$column."\t".$data[$sheet][$row][$column]."\n";
		} elseif ($data[$sheet][$row][$column] == -1) {
			file_put_contents($directory."/downloads/".$country_codes[$country_colums[$column]].".txt", "Trough"."\t".$dates[$row]."\n", FILE_APPEND);
		} elseif ($data[$sheet][$row][$column] == 1) {
			file_put_contents($directory."/downloads/".$country_codes[$country_colums[$column]].".txt", "Peak"."\t".$dates[$row]."\n", FILE_APPEND);
		}
}
}
?>
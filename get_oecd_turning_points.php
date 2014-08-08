<?php

require_once('P:/DATADESK/keith/workspace/fred_datadesk_config.php');
require_once($cfg['fred_datadesk_classes'].'handlerFileType.php');

$directory = __DIR__;
$file = "turning_points.csv";
$data = fileTypeReferrer($directory."/internet_downloads/", $file);

$country_codes = get_country_codes($directory."/country_codes.txt");

$sheets = count($data);  // get count of the number of sheets; $arrayData has 3 indexes:  sheets, rows, and columns; non-Excel files all have sheet 0 and Excel files can have sheet 0 through infinity

for ($sheet = 0; $sheet < $sheets; $sheet++) {  // loop through sheets
	$rows = count($data[$sheet]);  // count number of rows
	for ($row = 0; $row < $rows; $row++){ //loop through rows
    	$columns = count($data[$sheet][$row]); //count columns
    	for ($column = 0; $column < $columns; $column++) {//loop through columns
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
	}
}

function get_country_codes($path)
{

    $fh = fopen($path, "r") or die("can't open file");
    while($temp = fgetcsv($fh, 0, "\t")) {
        $data[trim($temp[0])] = trim($temp[1]);
    }
    fclose($fh);
    return $data;

}

?>
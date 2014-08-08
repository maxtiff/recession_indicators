<?php

function fileTypeReferrer($directory, $file) {
	/* Determine file type and refer to appropriate function.
	 * Function handles csv, xls, xlsx, xml, and txt files.
	 * (Changed from if-else chain to case statement.)
	 */
	preg_match("/\.(.*)$/", $file, $temp);
	$extension = $temp[1];
	
	switch ($extension) {
		case $extension == "txt" && filesize($directory.$file > 0):
			return filetxt($directory, $file);
		case $extension == "csv" && filesize($directory.$file) > 0:
			return filecsv($directory, $file);
		case $extension == "xls" && filesize($directory.$file) > 0:
			return filexls($directory, $file);
		case $extension == "xlsx" && filesize($directory.$file) > 0:
			return filexlsx($directory, $file);
		case $extension == "xml" && filesize($directory.$file) > 0;
			return filexml($directory, $file);
		case filesize($directory.$file) > 0:
			return return filetxt($directory, $file);
		case NULL:
			$notArrayData = NULL;
			return $notArrayData; 
	}
	

	/*
	if ($extension == "txt" && filesize($directory.$file) > 0) {
		return filetxt($directory, $file);  // tab delimited file
	} elseif ($extension == "csv" && filesize($directory.$file) > 0) {
		return filecsv($directory, $file);  // csv file
	} elseif ($extension == "xls" && filesize($directory.$file) > 0) {
		return filexls($directory, $file);  // pre-Excel 2007 file
	} elseif ($extension == "xlsx" && filesize($directory.$file) > 0) {
		return filexlsx($directory, $file);  // Excel 2007 and later file
	} elseif ($extension == "xml" && filesize($directory.$file) > 0) {
		return filexml($directory, $file);  // xml file
	} elseif (filesize($directory.$file) > 0) {
		return filetxt($directory, $file);  // no file extension or file extension different from above, treated as tab delimited
	} else {
		$notArrayData = NULL;
		return $notArrayData;
	}*/
	
}

function filetxt($directory, $file) {
	
	$fh = fopen($directory.$file, "r") or die("can't open file");
	$row = 0;
	
	while($arrayTemp = fgetcsv($fh, 0, "\t")) {
		$columns = count($arrayTemp);
		
		for ($column=0; $column < $columns; $column++) {  // Assign dummy sheet index so that loop always works the same
			$arrayData[0][$row][$column] = $arrayTemp[$column]; 
		}
		
		$row++;
		
	}
	
	fclose($fh);
	return $arrayData;
	
}

function filecsv($directory, $file) {
	
	$fh = fopen($directory.$file, "r") or die("can't open file");
	$row = 0;
	
	while($arrayTemp = fgetcsv($fh, 0, ",")) {
		$columns = count($arrayTemp);
		
		for ($column=0; $column < $columns; $column++) {  // Assign dummy sheet index so that loop always works the same
			$arrayData[0][$row][$column] = $arrayTemp[$column]; 
		}
		
		$row++;
		
	}
	
	fclose($fh);
	return $arrayData;
	
}


function filexls($directory, $file) {

	require_once "C:/php/PEAR/pear/Spreadsheet/Excel/Reader/reader.php";
  $username = strtolower(exec("ECHO %USERNAME%", $output_temp, $return_temp));
   
	// Create new Excel object
	$data = new Spreadsheet_Excel_Reader();
	
	// Set output Encoding.
	$data->setOutputEncoding('CP1251');
	
	// Read Excel file into variable
	$data->read($directory.$file);
	// Determine the number of sheets for the excel file
	$sheets = count($data->sheets);
	for ($sheet = 0; $sheet < $sheets; $sheet++) {
		$sheetName = $data->boundsheets[$sheet]['name'];
		$rows = $data->sheets[$sheet]['numRows'];
		for ($row = 0; $row < $rows; $row++) {  // reader.php uses 0 for first sheet and 1 for first column and row; this loop standardizes all objects to start at 0
			$allValuesNull = TRUE;
			$columns = $data->sheets[$sheet]['numCols'];
			for ($column = 0; $column < $columns; $column++) {
				if (isset($data->sheets[$sheet]['cells'][$row + 1][$column + 1])) {
					$allValuesNull = FALSE;
					$arrayData[$sheet][$row][$column] = $data->sheets[$sheet]['cells'][$row + 1][$column + 1];
				} else {
					// continue;  // use to skip storing blank cells
					$arrayData[$sheet][$row][$column] = NULL;
				}				
			}
			// use to stop the function in the event of a blank row
			/*
			if ($allValuesNull == TRUE) {  // if all values in the row are null, stop the loop and go to the next worksheet
				unset($arrayData[$sheet][$row]);
				break;
			}
			*/
		}
	}
	return $arrayData;
}

function filexlsx($directory, $file) {
	$arrayData = NULL;
	return $arrayData;
}

function filexml($directory, $file) {
	/*
	$fh = fopen($directory.$file, "r") or die("can't open file");
	preg_match("/total=\"(\d*)\"/", $fh, $columns);
	$row = 0;
	for ($column = 0; $column <= $columns[1]; $column++) {
		$xml = new SimpleXMLElement($fh);
		foreach ($xml->children() as $observation){
			$arrayData[0][$row][$columns] = $observation['wb:value'];
			$row++; 
		}
	}
	*/
	$arrayData = NULL;
	return $arrayData;
}

// a function to strip blank or null values from the end of an array when all values from an assigned value until the end are blank or null 
function removeEndingBlankValues($array) {
	
	return $arrayReturn;
}

?>
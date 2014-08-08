<?php
/*
 * Configuration file for recession_indicators.php.
 * This file sets directories and certain variables for the functions, objects and any input files that are used to process OECD and NBER Recession Shading Data
 */

$cfg = array();

//define root directory
$cfg['recession_shading_root'] = __DIR__;

//classes directory
$cfg['recession_classes'] = $cfg['recession_shading_root'].'/classes/';

//functions directory
$cfg['recession_functions'] = $cfg['recession_shading_root'].'/functons/';

//downloads directory
$cfg['recession_downloads'] = $cfg['recession_shading_root'].'/downloads/';

//logs directory
$cfg['recession_logs'] = $cfg['recession_shading_root'].'/logs/';

//archive directory
$cfg['recession_archive'] = $cfg['recession_shading_root'].'/archive/';

//series-to-add directory
$cfg['recession_new_series'] = $cfg['recession_shading_root'].'/check/';

//output directory
$cfg['recession_output'] = $cfg['recession_shading_root'].'/output/';

//define api key
$cfg['api_key'] = '76bb1186e704598b725af0a27159fdfc';








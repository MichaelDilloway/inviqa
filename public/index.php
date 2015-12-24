<?php
	
	namespace inviqa;
	
	require("../vendor/autoload.php");
	
	$aOptions = getopt("", array("s:", "f:", "o:"));
	
	// Get the starting date
	$iStartDate = (array_key_exists("s", $aOptions) and strtotime($aOptions["s"]))
		? strtotime($aOptions["s"])
		: strtotime("first day of this month");
		
	// Get the end date
	$iEndData = (array_key_exists("f", $aOptions) and strtotime($aOptions["f"]))
		? strtotime($aOptions["f"])
		: strtotime("+11 months", $iStartDate);
	
	// Get the output file name
	$sOutputFilename = (array_key_exists("o", $aOptions) and strlen($aOptions["o"]) > 0)
		? $aOptions["o"]
		: "output";
	
	// Generate the pay data
	$oPayroll = new Payroll();
	$aDates = $oPayroll->generate($iStartDate, $iEndData);
	
	// Output the data in the required format
	$oOutput = new Output\Csv();
	if($oOutput->output($aDates, $sOutputFilename)) {
		echo("Success" . PHP_EOL);
	}

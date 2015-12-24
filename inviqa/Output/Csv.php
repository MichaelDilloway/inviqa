<?php
	
	namespace inviqa\Output;
	
	class Csv extends Base {
		
		/**
		 * Make sure the output file has the correct extension
		 */
		public function addFileExtension($sFilename) {
			// Make sure the file has the correct extension
			if(substr($sFilename, -4) !== ".csv") {
				$sFilename .= ".csv";
			}
			
			return $sFilename;
		}
		
		/**
		 * Output the data in the required format
		 * @param		array		$aData			An array containing pay dates
		 * @param		strong		$sFilename		A string to use as the output filename
		 */
		public function output(array $aData, $sFilename = "output") {
			$aFormattedData = $this->formatDates($aData);
			
			$sFilename = $this->addFileExtension($sFilename);
			
			try {
				// Open the target file
				$rFile = @fopen($sFilename, "w");
				if($rFile === false) {
					throw new \exception("Failed to open output file for writing");
				}
				
				// Write each line of data into the file
				foreach($aFormattedData as $i => $aDataItem) {
					fputcsv($rFile, $aDataItem);
				}
				
				// Close the file handle
				fclose($rFile);
			} catch(\exception $oException) {
				echo("An error occured: " . $oException->getMessage() . PHP_EOL);
				return false;
			}
			
			return true;
		}
		
	}

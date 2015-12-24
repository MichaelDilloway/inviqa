<?php
	
	namespace inviqa\Output;
	
	abstract class Base {
		
		/**
		 * Output the data in the required format
		 * @param		array		$aData			An array containing pay dates
		 * @param		strong		$sFilename		A string to use as the output filename
		 */
		abstract public function output(array $aData, $sFilename = "output");
		
		/**
		 * Change timestamps into string dates
		 * @param		array		$aData			An array containing pay dates
		 */
		public function formatDates(array $aData) {
			$sPaymentDateFormat = "d/m/Y";
			
			foreach($aData as $i => $aDataItem) {
				$aData[$i]["date"] = date("F", $aData[$i]["date"]);
				$aData[$i]["salaryDate"] = date($sPaymentDateFormat, $aData[$i]["salaryDate"]);
				$aData[$i]["bonusDate"] = date($sPaymentDateFormat, $aData[$i]["bonusDate"]);
			}
			return $aData;
		}
		
	}

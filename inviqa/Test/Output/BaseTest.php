<?php

	namespace inviqa\Test\Output;
	
	class BaseTest extends \PHPUnit_Framework_TestCase {
		
		public function testFormatDates() {
			$oStub = $this->getMockForAbstractClass("\inviqa\Output\Base");
			$aData = array(
				array(
					"date"			=> 1448969347,
					"salaryDate"	=> 1451561347,
					"bonusDate"		=> 1450137600
				)
			);
			$aFormattedData = $oStub->formatDates($aData);
			$this->assertEquals("December", $aFormattedData[0]["date"]);
			$this->assertEquals("31/12/2015", $aFormattedData[0]["salaryDate"]);
			$this->assertEquals("15/12/2015", $aFormattedData[0]["bonusDate"]);
		}
		
	}

<?php

	namespace inviqa\Test;
	
	class PayrollTest extends \PHPUnit_Framework_TestCase {
		
		/**
		 * Test that the salary day falls on a week day
		 */
		public function testSalaryDateNotWeekend() {
			$oPayroll = new \inviqa\Payroll();
			
			// Assert that the pay day is a weekday
			$iMonth = strtotime("31st Jan 2016");
			$this->assertLessThanOrEqual(5, date("N", $oPayroll->getSalaryDate($iMonth)));
			
			// Assert that the pay day is a weekday
			$iMonth = strtotime("1st May 2016");
			$this->assertLessThanOrEqual(5, date("N", $oPayroll->getSalaryDate($iMonth)));
			
			// Assert that the pay day is a weekday
			$iMonth = strtotime("1st Jan 2050");
			$this->assertLessThanOrEqual(5, date("N", $oPayroll->getSalaryDate($iMonth)));
		}
		
		/**
		 * Test that a bonus day either falls on a week day or the following Wednesday
		 */
		public function testBonusDateNotWeekend() {
			$oPayroll = new \inviqa\Payroll();
			
			$iMonth = strtotime("15th May 2016");
			// Assert that the bonus day is a Wednesday
			$this->assertEquals(3, date("N", $oPayroll->getBonusDate($iMonth)));
			// Assert that the bonus day is after the 15th
			$this->assertEquals(18, date("d", $oPayroll->getBonusDate($iMonth)));
			
			$iMonth = strtotime("1st Dec 2016");
			// Assert that the bonus day is a week day
			$this->assertLessThanOrEqual(5, date("N", $oPayroll->getBonusDate($iMonth)));
			// Assert that the bonus day is the 15th
			$this->assertEquals(15, date("d", $oPayroll->getBonusDate($iMonth)));
		}
		
		/**
		 * Test that Payroll::getSalaryDate returns the dates expected
		 */
		public function testGetSalaryDate() {
			$oPayroll = new \inviqa\Payroll();
			
			// Assert that the correct salary date is returned
			$iMonth = strtotime("1st Dec 1995");
			$iSalaryDate = $oPayroll->getSalaryDate($iMonth);
			$this->assertEquals(820195200, $iSalaryDate);
			
			// Assert that the correct salary date is returned
			$iMonth = strtotime("2nd Dec 2005");
			$iSalaryDate = $oPayroll->getSalaryDate($iMonth);
			$this->assertEquals(1135900800, $iSalaryDate);
			
			// Assert that the correct salary date is returned
			$iMonth = strtotime("3rd Dec 2050");
			$iSalaryDate = $oPayroll->getSalaryDate($iMonth);
			$this->assertEquals(2555971200, $iSalaryDate);
		}
		
		/**
		 * Test that Payroll::getBonusDate returns the dates expected
		 */
		public function testGetBonusDate() {
			$oPayroll = new \inviqa\Payroll();
			
			// Assert that the correct bonus date is returned
			$iMonth = strtotime("1st Dec 1995");
			$iSalaryDate = $oPayroll->getBonusDate($iMonth);
			$this->assertEquals(818985600, $iSalaryDate);
			
			// Assert that the correct bonus date is returned
			$iMonth = strtotime("2nd Dec 2005");
			$iSalaryDate = $oPayroll->getBonusDate($iMonth);
			$this->assertEquals(1134604800, $iSalaryDate);
			
			// Assert that the correct bonus date is returned
			$iMonth = strtotime("3rd Dec 2050");
			$iSalaryDate = $oPayroll->getBonusDate($iMonth);
			$this->assertEquals(2554675200, $iSalaryDate);
		}
		
		/**
		 * Test that Payroll::generate returns the number of results expected
		 */
		public function testGenerate() {
			$oPayroll = new \inviqa\Payroll();
			
			// Assert that one record is created
			$iStartMonth = strtotime("1st Jan 1995");
			$aData = $oPayroll->generate($iStartMonth, $iStartMonth);
			$this->assertEquals(1, count($aData));
			
			// Assert that twelve records are created
			$iStartMonth = strtotime("1st Jan 1995");
			$iEndMonth = strtotime("1st Dec 1995");
			$aData = $oPayroll->generate($iStartMonth, $iEndMonth);
			$this->assertEquals(12, count($aData));
			
			// Assert that 672 records are created
			$iStartMonth = strtotime("1st Jan 1995");
			$iEndMonth = strtotime("1st Dec 2050");
			$aData = $oPayroll->generate($iStartMonth, $iEndMonth);
			$this->assertEquals(672, count($aData));
		}
		
	}

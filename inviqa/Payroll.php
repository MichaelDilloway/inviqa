<?php
	
	namespace Inviqa;
	
	class Payroll {
		
		/**
		 * Work out the base salary pay date for the month supplied
		 * @param		int			$iMonth		A timestamp in the month required
		 * @return		int			A timestamp of the last day of the month (or the last friday if month ends on a weekend)
		 */
		public function getSalaryDate($iMonth) {
			$iLastDayOfMonth = strtotime("last day of this month", $iMonth);
			
			// If the last day is a weekend then find the previous Friday
			if((int)date("N", $iLastDayOfMonth) >= 6) {
				$iLastDayOfMonth = strtotime("last friday", $iLastDayOfMonth);
			}
			
			return $iLastDayOfMonth;
		}
		
		/**
		 * Work out the bonus pay date for the month supplied
		 * @param		int			$iMonth		A timestamp in the month required
		 * @return		int			A timestamp of the 15th of the month (or the following Wednesday if on a weekend)
		 */
		public function getBonusDate($iMonth) {
			$iBonusDay = strtotime(date("15 M Y", $iMonth));
			
			// If the 15th is a weekend then find the next Wednesday
			if((int)date("N", $iBonusDay) >= 6) {
				$iBonusDay = strtotime("next wednesday", $iBonusDay);
			}
			
			return $iBonusDay;
		}
		
		/**
		 * Generate the pay dates between the two dates supplied
		 * @param		int			$iStartDate		A timestamp to start generating dates from
		 * @param		int			$iEndDate		A timestamp to generate dates up to
		 */
		public function generate($iStartDate, $iEndDate) {
			$iCurrentMonth = $iStartDate;
			
			// Loop over each month between the dates
			$aDates = array();
			while($iCurrentMonth <= $iEndDate) {
				//
				$aDates[] = array(
					"date" => $iCurrentMonth,
					"salaryDate" => $this->getSalaryDate($iCurrentMonth),
					"bonusDate" => $this->getBonusDate($iCurrentMonth)
				);
				
				// Step to the next month
				$iCurrentMonth = strtotime("+1 month", $iCurrentMonth);
			}
			
			return $aDates;
		}
		
	}

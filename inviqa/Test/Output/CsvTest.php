<?php

	namespace inviqa\Test\Output;
	
	class CsvTest extends \PHPUnit_Framework_TestCase {
		
		public $altOutputFilename = "unit-test-output";
		
		public function setUp() {
			// Make sure test files are not present
			@unlink("output.csv");
			@unlink($this->altOutputFilename . ".csv");
			
			// Remove test files after the tests have run
			register_shutdown_function(function() {
				@unlink("output.csv");
				@unlink($this->altOutputFilename . ".csv");
			});
		}
		
		/**
		 * Test that Payroll::output creates a file
		 */
		public function testAddFileExtension() {
			$oOutput = new \inviqa\Output\Csv();
			
			// Assert that an extension is added when doesn't exist
			$sFilename = "no-extension";
			$sFilenameResult = $oOutput->addFileExtension($sFilename);
			$this->assertEquals($sFilename . ".csv", $sFilenameResult);
			
			// Assert that an extension isn't added when one exist
			$sFilename = "extension.csv";
			$sFilenameResult = $oOutput->addFileExtension($sFilename);
			$this->assertEquals($sFilename, $sFilenameResult);
		}
		
		/**
		 * Test that Payroll::output creates a file
		 */
		public function testOutput() {
			$oOutput = new \inviqa\Output\Csv();
			$aData = array(
				array(
					"date"			=> 1448969347,
					"salaryDate"	=> 1451561347,
					"bonusDate"		=> 1450137600
				),
				array(
					"date"			=> 1451647747,
					"salaryDate"	=> 1454025600,
					"bonusDate"		=> 1452816000
				),
				array(
					"date"			=> 1454326147,
					"salaryDate"	=> 1456745347,
					"bonusDate"		=> 1455494400
				)
			);
			
			// Make sure the default file is created
			$oOutput->output($aData);
			$this->assertFileExists("output.csv");
			
			// Make sure the custom file is created
			$oOutput->output($aData, $this->altOutputFilename);
			$this->assertFileExists($this->altOutputFilename . ".csv");
		}
		
	}

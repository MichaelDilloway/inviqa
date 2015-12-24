Running unit tests (from root dir)
	
	$ php vendor/bin/phpunit

Running the app (from public dir)
	
	$ php index.php									// Run with default options
	$ php index.php -s 01/12/2015 -f 01/12/2016		// Manually set the date range
	$ php index.php -o myfile						// Manually set the output file name
	
	The output file will be saved in the public directory

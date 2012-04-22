<?php
// get data from the telnet server of horizons.jpl.nasa.gov
// still very buggy and a lot to improve!

require_once "php-telnet/telnet.class.php";

$telnet = new Telnet('horizons.jpl.nasa.gov',6775);

$telnet->exec("");
$telnet->exec("");

if (true) {
	
	$telnet->setPrompt("Select ... [E]phemeris, [F]tp, [M]ail, [R]edisplay, ?, <cr>:");
	$result = $telnet->exec('Mars Barycenter');
	sleep(1);

	$telnet->setPrompt("Observe, Elements, Vectors  [o,e,v,?] :");
	$result = $telnet->exec('E');

	$telnet->setPrompt(":");
	$result = $telnet->exec('v');

	//echo $result;
	$result = $telnet->exec('coord');

	//echo $result;
	$result = $telnet->exec('g');

	//echo $result;
	$result = $telnet->exec("1,2,3");

	//echo $result;
	$result = $telnet->exec("eclip");

	//echo $result;
	$result = $telnet->exec("2001-01-01 {00:00}");

	//echo $result;
	$result = $telnet->exec("2001-06-01 {00:00}");

	//echo $result;
	$telnet->setPrompt("Output interval [ex: 10m, 1h, 1d, ? ] :");

	$result = $telnet->exec("1 d");

	//echo $result;
	$telnet->setPrompt(":");
	$telnet->setPrompt(">>>");
	$result = $telnet->exec("y");
	sleep(2);
	//echo $result;
	//$telnet->setPrompt("[R]edisplay, ? :");

	//$telnet->setPrompt(">>> Select... [A]gain, [N]ew-case, [F]tp, [K]ermit, [M]ail, [R]edisplay, ? :");

	//$result = $telnet->exec("q");

	//echo $result;
	$result = $telnet->exec("F");
	
	//echo $result;
	$telnet->disconnect();

	sleep(1);

	preg_match("[ftp://ssd.jpl.nasa\.gov/pub/ssd/.*]", $result, $file);

	print_r($file);

	if ( count($file) > 0 && strlen($file[0]))
	{
		echo $file[0];
		$contents = file_get_contents(trim($file[0]));
	
		// between this two lines is the data saved
		$k = strpos($contents,"\$\$SOE");
		$l = strpos($contents,"\$\$EOE");

		$contents = substr($contents,$k,$l-$k+5);

		$filename = "tmp.data"; // change here to another filename
		$handle = fopen($filename, "w");

		$parts = explode ("\n",$contents);

		for ($k = 0; $k < count($parts)/4-1; $k++ )
		{
			fwrite($handle,$parts[ $k*4 + 2 ]); // position
			fwrite($handle,$parts[ $k*4 + 3 ]."\r\n"); // velocity
		}

		fclose($handle);
	} else {
		echo "nothing to parse";
	}
} else {
	echo "no connection";
}
?>

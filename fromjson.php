<?
// get some data from the webservice, parse it and save it for matlab/ocatve
//
// a lot to do here....

$contents = file_get_contents("http://nasa.apphb.com/coords/399");
$res = json_decode($contents);
print_r($res);

$filename = "tmp.data";
$handle = fopen($filename, "w");

for ($k = 0; $k < count($res); $k++ )
{
	fwrite($handle,$res[$k]->X." ".$res[$k]->Y." ".$res[$k]->Z."\r\n"); // position
}
fclose($handle);
?>

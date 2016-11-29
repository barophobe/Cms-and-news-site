<?php
function show_ip_info($ip){

	$url = 'http://freegeoip.net/csv/' . $ip;

	$fp = fopen($url,'$r');

	$read = fgetcsv($fp);
	fclose($fp);

echo "<p>IP Address: $ip<br>
Country:$read[2]<br>
city, State: $read[5], $read[3]<br>
Latitude: $read[7]<br>
Longitude: $read[8]</p>"
}
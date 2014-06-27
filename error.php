<?php 

$url = 'http://openstates.org/api/v1/legislators/?';
$apikey = '&apikey=546db95e534f4b6b860f57ecb41f0f98';

$query = $url . '?full_name=' . $full_name . $apikey;
$data = json_decode(file_get_contents($query), true);



?>
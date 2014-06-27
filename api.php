<?php 

$url = 'http://openstates.org/api/v1/legislators/?';
$apikey = '&apikey=546db95e534f4b6b860f57ecb41f0f98';

# User input variables

if (isset($_GET['full_name'])) {
   $full_name = trim($_GET['full_name']);
}
else{
   $full_name = '';
}
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$inputparty = $_POST['party'];
$inputstate = $_POST['state'];

# Params to create query url

$params = array();

if ($fname !== '') {
	$params[] = 'first_name=' . strtolower($fname);
}
if ($lname !== '') {
	$params[] = 'last_name=' . strtolower($lname);
}
if ($inputparty !== '') {
	if (strtolower($inputparty) === 'gop') {
		$params[] = 'party=republican';
	}
	else {
		$params[] = 'party=' . strtolower($inputparty);
	}
}
if ($inputstate !== '') {
	$params[] = 'state=' . strtolower($inputstate);
}
if ($lname === '' && $fname === '' && $inputparty === '' && $inputstate === '') {
	print 'No names entered';
}


if ($full_name === '') {
	$query = $url . implode('&', $params) . $apikey;
} else {
	$query = $url . 'full_name=' . urlencode($full_name) . $apikey;
}

$data = json_decode(file_get_contents($query), true);
$numpeople = substr_count(json_encode($data), 'full_name');


if ($numpeople > 1) {
	$list = array();
	for ($i=0; $i < $numpeople; $i++) { 
		$list[] = '<a href="api.php?full_name=' . $data[$i]['full_name'] . '">' . $data[$i]['full_name'] . '</a>';
	}
	$list = 'Multiple matches found' . '<br><br>' . 'Did you mean ' . implode(', ', $list) . '?';
	print $list;
} else {
	print "hi";
	print_r($data);
	$name = $data[0]['full_name'];
	$state = $data[0]['state'];
	$district = $data[0]['district'];
}




?>


<html>
<head>
	<title>Leg Info</title>
</head>
<body>
<div id="info">
    <div id="error"></div>
    <div id="info-nested">
	    <h2 id="name"><?php echo $name ?></h2>
	    <div id="state"></div>
	    <div id="district"></div>
	    <div id="party"></div>
	    <div id="email"></div>
	    <div id="photo"></div>
	    <div id="website"></div>
	    <div id="chamber"></div>
	    <div id="address"></div>
	    <div id="phone"></div>
	</div>
</div>
</body>
</html>
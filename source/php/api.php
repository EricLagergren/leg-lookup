<?php 

$url = 'http://openstates.org/api/v1/legislators/?';
$congressUrl = 'congress.json';
$apikey = '&apikey=546db95e534f4b6b860f57ecb41f0f98';

# User input variables

$full_name = urlencode(@$_GET['full_name']);
$fname = @$_POST['fname'];
$lname = @$_POST['lname'];
$inputparty = @$_POST['party'];
$inputstate = @$_POST['state'];

# Params to create query url

$params = array();

if ($full_name !== null) {
    $params[] = 'full_name=' . strtolower($full_name);
}
if ($fname !== '') {
	$params[] = 'first_name=' . ucfirst($fname);
}
if ($lname !== '') {
	$params[] = 'last_name=' . ucfirst($lname);
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
	exit('No names entered' . ' <a href="javascript:void(0);" onclick="window.history.go(-1);">Go back</a>' );
}

$query = $url . implode('&', $params) . $apikey;

$data = json_decode(file_get_contents($query), true);

if (empty($data)) {
    $query = 'https://congress.api.sunlightfoundation.com/legislators/?' . implode('&', $params) . $apikey;
	$data = json_decode(file_get_contents($query), true);
    $other = true;
}


$numpeople = substr_count(json_encode($data), 'full_name');

if ($numpeople > 1) {
	$list = array();
	for ($i=0; $i < $numpeople; $i++) { 
		$list[] = '<a href="api.php?full_name=' . $data[$i]['full_name'] . '">' . $data[$i]['full_name'] . '</a>';
	}
	$list = 'Multiple matches found' . '<br><br>' . 'Did you mean ' . implode(', ', $list) . '?';
	print $list;
} elseif (@$other != true) {
	$name = $data[0]['full_name'];
	$state = $data[0]['state'];
	$district = $data[0]['district'] . ordinal_suffix($data[0]['district']) . ' district';
	$party = $data[0]['party'];
	$contact = '<a href="mailto:' . $data[0]['email'] . '">Email ' . $name . '</a>';
	$photo = $data[0]['photo_url'];
	$website = $data[0]['url'];
	$level = $data[0]['level'];
	$chamber = getChamber($data[0]['chamber'], $state);
    $title = getPrefix($data[0]['chamber'], $state);
	$address = nl2br($data[0]['offices'][0]['address']);
	$state = $data[0]['state'];
} else {
    $name = $data['results'][0]['first_name'] . ' ' . $data['results'][0]['last_name'];
    $title = $data['results'][0]['title'];
    $role = $data['results'][0]['leadership_role'];
    $state = $data['results'][0]['state'];
    $party = $data['results'][0]['party'];
    $photo = 'http://theunitedstates.io/images/congress/original/' . $data['results'][0]['bioguide_id'] . '.jpg';
    $contact = '<a href="' . $data['results'][0]['contact_form'] . '">Contact ' . $name . '</a>';
    $website = $data['results'][0]['website'];
    $level = $data['results'][0]['level'];
    $chamber = ucfirst($data['results'][0]['chamber']);
    $address = nl2br($data['results'][0]['offices'][0]['address']);
    $state = $data['results'][0]['state'];
    $phone = $data['results'][0]['phone'];
}


$states = array(
    'AL'=>'Alabama',
    'AK'=>'Alaska',
    'AZ'=>'Arizona',
    'AR'=>'Arkansas',
    'CA'=>'California',
    'CO'=>'Colorado',
    'CT'=>'Connecticut',
    'DE'=>'Delaware',
    'DC'=>'District of Columbia',
    'FL'=>'Florida',
    'GA'=>'Georgia',
    'HI'=>'Hawaii',
    'ID'=>'Idaho',
    'IL'=>'Illinois',
    'IN'=>'Indiana',
    'IA'=>'Iowa',
    'KS'=>'Kansas',
    'KY'=>'Kentucky',
    'LA'=>'Louisiana',
    'ME'=>'Maine',
    'MD'=>'Maryland',
    'MA'=>'Massachusetts',
    'MI'=>'Michigan',
    'MN'=>'Minnesota',
    'MS'=>'Mississippi',
    'MO'=>'Missouri',
    'MT'=>'Montana',
    'NE'=>'Nebraska',
    'NV'=>'Nevada',
    'NH'=>'New Hampshire',
    'NJ'=>'New Jersey',
    'NM'=>'New Mexico',
    'NY'=>'New York',
    'NC'=>'North Carolina',
    'ND'=>'North Dakota',
    'OH'=>'Ohio',
    'OK'=>'Oklahoma',
    'OR'=>'Oregon',
    'PA'=>'Pennsylvania',
    'RI'=>'Rhode Island',
    'SC'=>'South Carolina',
    'SD'=>'South Dakota',
    'TN'=>'Tennessee',
    'TX'=>'Texas',
    'UT'=>'Utah',
    'VT'=>'Vermont',
    'VA'=>'Virginia',
    'WA'=>'Washington',
    'WV'=>'West Virginia',
    'WI'=>'Wisconsin',
    'WY'=>'Wyoming',
);

function getPartySite($input, $iparty) {

$gopparties = array(
    'AL' => 'http://www.algop.org/',
    'AK' => 'http://alaskarepublicans.com/',
    'AZ' => 'http://www.azgop.org/',
    'AR' => 'http://www.arkansasgop.org/',
    'CA' => 'http://www.cagop.org/',
    'CO' => 'http://www.cologop.org/',
    'CT' => 'http://www.ctgop.org/',
    'DE' => 'http://www.delawaregop.com/',
    'FL' => 'http://www.rpof.org/',
    'GA' => 'http://www.gagop.org/',
    'HI' => 'http://www.gophawaii.com/',
    'ID' => 'http://www.idgop.org/',
    'IL' => 'http://www.ilgop.org/',
    'IN' => 'http://www.indgop.org/',
    'IA' => 'http://www.iowagop.org/',
    'KS' => 'http://www.ksgop.org/',
    'KY' => 'http://www.rpk.org/',
    'LA' => 'http://www.lagop.com/',
    'ME' => 'http://www.mainegop.com/',
    'MD' => 'http://www.mdgop.org/',
    'MA' => 'http://www.massgop.com/',
    'MI' => 'http://www.migop.org/',
    'MN' => 'http://www.mngop.com/',
    'MS' => 'http://www.msgop.org/',
    'MO' => 'http://www.mogop.org/',
    'MT' => 'http://www.mtgop.org/',
    'NE' => 'http://www.negop.org/',
    'NV' => 'http://www.nevadagop.org/',
    'NH' => 'http://www.nhgop.org/',
    'NJ' => 'http://www.njgop.org/',
    'NM' => 'http://www.gopnm.org/',
    'NY' => 'http://www.nygop.org/',
    'NC' => 'http://www.ncgop.org/',
    'ND' => 'http://www.ndgop.com/',
    'OH' => 'http://www.ohiogop.org/',
    'OK' => 'http://www.okgop.com/',
    'OR' => 'http://www.orgop.org/',
    'PA' => 'http://www.pagop.org/',
    'RI' => 'http://www.rigop.org/',
    'SC' => 'http://www.scgop.com/',
    'SD' => 'http://www.southdakotagop.com/',
    'TN' => 'http://www.tngop.org/',
    'TX' => 'http://www.texasgop.org/',
    'UT' => 'http://www.utgop.org/',
    'VT' => 'http://www.vtgop.org/',
    'VA' => 'http://www.vagop.com/',
    'WA' => 'http://www.wsrp.org/',
    'WV' => 'http://www.wvgop.org/',
    'WI' => 'http://www.wisgop.org/',
    'WY' => 'http://www.wygop.org/'
);

$demparties = array(
    'AL' => 'http://www.aladems.org/',
    'AK' => 'http://www.alaskademocrats.org/',
    'AZ' => 'http://www.democratsabroad.org/',
    'AR' => 'http://www.azdem.org/',
    'CA' => 'http://www.arkdems.org/',
    'CO' => 'http://www.cadem.org/',
    'CT' => 'http://www.coloradodems.org/',
    'DE' => 'http://www.deldems.org/',
    'FL' => 'http://www.fladems.com/',
    'GA' => 'http://www.democraticpartyofgeorgia.org/',
    'HI' => 'http://www.hawaiidemocrats.org/',
    'ID' => 'http://www.idaho-democrats.org/',
    'IL' => 'http://www.ildems.com/',
    'IN' => 'http://www.indems.org/',
    'IA' => 'http://www.iowademocrats.org/',
    'KS' => 'http://www.ksdp.org/',
    'KY' => 'http://www.kydemocrat.com/',
    'LA' => 'http://www.lademo.org/',
    'ME' => 'http://www.mainedems.org/',
    'MD' => 'http://www.mddems.org/',
    'MA' => 'http://www.massdems.org/',
    'MI' => 'http://www.michigandems.com/',
    'MN' => 'http://www.dfl.org/',
    'MS' => 'http://www.msdemocrats.net/',
    'MO' => 'http://www.missouridems.org/',
    'MT' => 'http://www.montanademocrats.org/',
    'NE' => 'http://www.nebraskademocrats.org/',
    'NV' => 'http://www.nvdems.com/',
    'NH' => 'http://www.nh-democrats.org/',
    'NJ' => 'http://www.njdems.org/',
    'NM' => 'http://www.nmdemocrats.org/',
    'NY' => 'http://www.nydems.org/',
    'NC' => 'http://www.ncdp.org/',
    'ND' => 'http://www.demnpl.com/',
    'OH' => 'http://www.ohiodems.org/',
    'OK' => 'http://www.okdemocrats.org/',
    'OR' => 'http://www.oregondemocrats.org/',
    'PA' => 'http://www.padems.com/',
    'RI' => 'http://www.ridemocrats.org/',
    'SC' => 'http://www.scdp.org/',
    'SD' => 'http://www.sddp.org/',
    'TN' => 'http://www.tndp.org/',
    'TX' => 'http://www.txdemocrats.org/',
    'UT' => 'http://www.utdemocrats.org/',
    'VT' => 'http://www.vtdemocrats.org/',
    'VA' => 'http://www.vademocrats.org/',
    'WA' => 'http://www.wa-democrats.org/',
    'WV' => 'http://www.wvdemocrats.com/',
    'WI' => 'http://www.wisdems.org/',
    'WY' => 'http://www.wyomingdemocrats.com/'
);

    if ($iparty === "Democratic" || $iparty === "D" || $iparty === "Democrat") return $demparties[strtoupper($input)];
    if ($iparty === "Republican" || $iparty === "R") return $gopparties[strtoupper($input)];

}

function getChamber($upperlower, $istate) {
    if ($upperlower === "upper") return "Senate";
    elseif ($upperlower === "lower") {
        if ($istate === "ca" || $istate === "ny" || $istate === "wi" || $istate === "nj" || $istate === "nv") {
            if ($istate === "nv") {
                return "Nevada Assembly";
            }
            return "State Assembly";
        }
        if ($istate === "md" || $istate === "va" || $istate === "wv") {
            return "House of Delegates";
        } else return "House of Representatives";
    }

}

function getPrefix($pchamber, $vstate) {
    if ($pchamber === "upper") return "Sen";
    elseif ($pchamber === "lower") {
        if ($vstate === "ca" || $vstate === "ny" || $vstate === "wi" || $vstate === "nj" || $vstate === "nv") {
            return "Asm";
        }
        if ($vstate === "md" || $vstate === "va" || $vstate === "wv") {
            return "Del";
        } else return "Rep";
    }
}

function ordinal_suffix($num){
    if($num < 4 || $num > 20){
         switch($num % 10){
            case 1: return 'st';
            case 2: return 'nd';
            case 3: return 'rd';
        }
    }
    return 'th';
}

$longstate = $states[strtoupper($state)];

if (strtolower($party) === "r" || strtolower($party) === "gop" ) {
    $party = "Republican";
}
if (strtolower($party) === "d" || strtolower($party) === "democrat" ) {
    $party = "Democratic";
}


?>


<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv='cleartype' content='on'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimal-ui">
    <meta name="robots" content="index, follow">
    <title>Legislator Info</title>
    <link href="/css/normalize.min.css" rel="stylesheet">
    <link href="/css/results.css" rel="stylesheet">
</head>
<body>
<div id="info">
    <div id="error"></div>
    <div id="info-nested" style="text-align:center;margin-top:2em;">
	    <h2 id="name"><?php echo ucfirst($title) . '. ' . $name ?></h2>
        <div id="chamber"><?php echo $chamber . ' ' . $role ?></div>
	    <div id="state"><?php echo $longstate . ' (' . strtoupper($state) . ')' ?></div>
	    <div id="district"><?php echo $district ?></div>
	    <div id="party"><?php echo '<a href="' . getPartySite($state, $party) . '" target="_blank">' . $party . '</a>' ?></div>
	    <div id="photo"><?php echo '<img style="width:200px;height:auto;" src="' . $photo . '">'?></div>
	    <div id="website"><?php echo '<a href="' . $website . '" target="_blank">Website</a>' ?></div>
        <div id="contact"><?php echo $contact ?></div>
	    <div id="address"><?php echo $address ?></div>
	    <div id="phone"><?php echo @$phone ?></div>
	</div>
</div>
</body>
</html>
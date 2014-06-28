<html>

<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv='cleartype' content='on'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimal-ui">
    <meta name="robots" content="index, follow">
    <title>Find Legislators</title>
    <link href="/css/normalize.min.css" rel="stylesheet">
    <link href="/css/styles.css" rel="stylesheet">
</head>

<body>

    <form name="form" method="POST" action="api.php">
        <h1>Legislator Lookup</h1>
        <select name="state" class="clearfix styled-select">
        	<option value="">State</option>
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
            <option value="AZ">Arizona</option>
            <option value="AR">Arkansas</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="DC">District Of Columbia</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
            <option value="IA">Iowa</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="ME">Maine</option>
            <option value="MD">Maryland</option>
            <option value="MA">Massachusetts</option>
            <option value="MI">Michigan</option>
            <option value="MN">Minnesota</option>
            <option value="MS">Mississippi</option>
            <option value="MO">Missouri</option>
            <option value="MT">Montana</option>
            <option value="NE">Nebraska</option>
            <option value="NV">Nevada</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NY">New York</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VT">Vermont</option>
            <option value="VA">Virginia</option>
            <option value="WA">Washington</option>
            <option value="WV">West Virginia</option>
            <option value="WI">Wisconsin</option>
            <option value="WY">Wyoming</option>
        </select>
        <br>
        <br>
        <input class="clearfix" type="text" name="fname" placeholder="First" />
        <input class="clearfix" type="text" name="lname" placeholder="Last" />
        <input class="clearfix" type="text" name="party" placeholder="Party" />
        <input class="clearfix" type="submit" value="submit" />
    </form>
    <div id="info">
	    <div id="error"></div>
	    <div id="info-nested">
		    <h2 id="name"></h2>
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
/*546db95e534f4b6b860f57ecb41f0f98*/

function val() {
    var url = 'http://openstates.org/api/v1/legislators/?';
    var apikey = "&apikey=546db95e534f4b6b860f57ecb41f0f98";

    var fname = document.form["fname"].value;
    var lname = document.form["lname"].value;
    var inputparty = document.form["party"].value;
    var inputstate = document.form["state"].value;
    var params = [];

    if (inputstate !== '') {
        params.push("state=" + inputstate.toLowerCase());
    }
    if (fname !== '') {
        params.push("first_name=" + fname.toLowerCase());
    }
    if (lname !== '') {
        params.push("last_name=" + lname.toLowerCase());
    }
    if (inputparty !== '') {
        if (inputparty === "gop" || "GOP" || "Gop") {
            params.push("party=republican");
        } else {
            params.push("party=" + inputparty.toLowerCase());
        }
    }
    if (lname === '' && fname === '' && inputparty === '' && inputstate === '') {
        alert("No names entered");
        window.location.reload(true);
    }

    var query = url + params.join("&") + apikey;

    if (params.length > 0) {
        $.ajax({
            async: false,
            global: false,
            url: query,
            success: checkData
        });
    }

    function error(string) {
        alert(string);
    }

    function checkData(data) {
        console.log(JSON.stringify(data));
        if ($.isEmptyObject(data)) {
            error("Nobody Found");
        }

        index = parseInt(JSON.stringify(data).match(/full_name/g).length, 10);

        if (index > 1) {
            var list = [];
            for (var i = 0; i < index; i++) {
                list.push(data[i]["full_name"]);
            }
            var list = "Multiple matches found" + "<br><br>" + "Did you mean " + list.join(", ") + "?";
            document.getElementById("error").innerHTML = list;
            document.getElementById("info-nested").innerHTML = "";
        } else {
            id = data[0];
            two = id["offices"][0];

            name = id["full_name"];
            district = id["district"];
            phone = id["office_phone"];
            party = id["party"];
            email = id["email"];
            photo = id["photo_url"];
            website = id["url"];
            level = id["level"];
            chamber = id["chamber"];
            address = two["address"].replace(/\n/g, "<br>");
            state = id["state"];
        }
    }

    function suffix(i) {
        var j = i % 10,
            k = i % 100;
        if (j == 1 && k != 11) {
            return i + "st";
        }
        if (j == 2 && k != 12) {
            return i + "nd";
        }
        if (j == 3 && k != 13) {
            return i + "rd";
        }
        return i + "th";
    }

    var states = {
        "AL": "Alabama",
        "AK": "Alaska",
        "AS": "American Samoa",
        "AZ": "Arizona",
        "AR": "Arkansas",
        "CA": "California",
        "CO": "Colorado",
        "CT": "Connecticut",
        "DE": "Delaware",
        "DC": "District Of Columbia",
        "FM": "Federated States Of Micronesia",
        "FL": "Florida",
        "GA": "Georgia",
        "GU": "Guam",
        "HI": "Hawaii",
        "ID": "Idaho",
        "IL": "Illinois",
        "IN": "Indiana",
        "IA": "Iowa",
        "KS": "Kansas",
        "KY": "Kentucky",
        "LA": "Louisiana",
        "ME": "Maine",
        "MH": "Marshall Islands",
        "MD": "Maryland",
        "MA": "Massachusetts",
        "MI": "Michigan",
        "MN": "Minnesota",
        "MS": "Mississippi",
        "MO": "Missouri",
        "MT": "Montana",
        "NE": "Nebraska",
        "NV": "Nevada",
        "NH": "New Hampshire",
        "NJ": "New Jersey",
        "NM": "New Mexico",
        "NY": "New York",
        "NC": "North Carolina",
        "ND": "North Dakota",
        "MP": "Northern Mariana Islands",
        "OH": "Ohio",
        "OK": "Oklahoma",
        "OR": "Oregon",
        "PW": "Palau",
        "PA": "Pennsylvania",
        "PR": "Puerto Rico",
        "RI": "Rhode Island",
        "SC": "South Carolina",
        "SD": "South Dakota",
        "TN": "Tennessee",
        "TX": "Texas",
        "UT": "Utah",
        "VT": "Vermont",
        "VI": "Virgin Islands",
        "VA": "Virginia",
        "WA": "Washington",
        "WV": "West Virginia",
        "WI": "Wisconsin",
        "WY": "Wyoming"
    };

    function getParty(input) {

        var input = input.toUpperCase();

        var gopparties = {
            "AL": "http://www.algop.org/",
            "AK": "http://alaskarepublicans.com/",
            "AZ": "http://www.azgop.org/",
            "AR": "http://www.arkansasgop.org/",
            "CA": "http://www.cagop.org/",
            "CO": "http://www.cologop.org/",
            "CT": "http://www.ctgop.org/",
            "DE": "http://www.delawaregop.com/",
            "FL": "http://www.rpof.org/",
            "GA": "http://www.gagop.org/",
            "HI": "http://www.gophawaii.com/",
            "ID": "http://www.idgop.org/",
            "IL": "http://www.ilgop.org/",
            "IN": "http://www.indgop.org/",
            "IA": "http://www.iowagop.org/",
            "KS": "http://www.ksgop.org/",
            "KY": "http://www.rpk.org/",
            "LA": "http://www.lagop.com/",
            "ME": "http://www.mainegop.com/",
            "MD": "http://www.mdgop.org/",
            "MA": "http://www.massgop.com/",
            "MI": "http://www.migop.org/",
            "MN": "http://www.mngop.com/",
            "MS": "http://www.msgop.org/",
            "MO": "http://www.mogop.org/",
            "MT": "http://www.mtgop.org/",
            "NE": "http://www.negop.org/",
            "NV": "http://www.nevadagop.org/",
            "NH": "http://www.nhgop.org/",
            "NJ": "http://www.njgop.org/",
            "NM": "http://www.gopnm.org/",
            "NY": "http://www.nygop.org/",
            "NC": "http://www.ncgop.org/",
            "ND": "http://www.ndgop.com/",
            "OH": "http://www.ohiogop.org/",
            "OK": "http://www.okgop.com/",
            "OR": "http://www.orgop.org/",
            "PA": "http://www.pagop.org/",
            "RI": "http://www.rigop.org/",
            "SC": "http://www.scgop.com/",
            "SD": "http://www.southdakotagop.com/",
            "TN": "http://www.tngop.org/",
            "TX": "http://www.texasgop.org/",
            "UT": "http://www.utgop.org/",
            "VT": "http://www.vtgop.org/",
            "VA": "http://www.vagop.com/",
            "WA": "http://www.wsrp.org/",
            "WV": "http://www.wvgop.org/",
            "WI": "http://www.wisgop.org/",
            "WY": "http://www.wygop.org/"
        };

        var demparties = {
            "AL": "http://www.aladems.org/",
            "AK": "http://www.alaskademocrats.org/",
            "AZ": "http://www.democratsabroad.org/",
            "AR": "http://www.azdem.org/",
            "CA": "http://www.arkdems.org/",
            "CO": "http://www.cadem.org/",
            "CT": "http://www.coloradodems.org/",
            "DE": "http://www.deldems.org/",
            "FL": "http://www.fladems.com/",
            "GA": "http://www.democraticpartyofgeorgia.org/",
            "HI": "http://www.hawaiidemocrats.org/",
            "ID": "http://www.idaho-democrats.org/",
            "IL": "http://www.ildems.com/",
            "IN": "http://www.indems.org/",
            "IA": "http://www.iowademocrats.org/",
            "KS": "http://www.ksdp.org/",
            "KY": "http://www.kydemocrat.com/",
            "LA": "http://www.lademo.org/",
            "ME": "http://www.mainedems.org/",
            "MD": "http://www.mddems.org/",
            "MA": "http://www.massdems.org/",
            "MI": "http://www.michigandems.com/",
            "MN": "http://www.dfl.org/",
            "MS": "http://www.msdemocrats.net/",
            "MO": "http://www.missouridems.org/",
            "MT": "http://www.montanademocrats.org/",
            "NE": "http://www.nebraskademocrats.org/",
            "NV": "http://www.nvdems.com/",
            "NH": "http://www.nh-democrats.org/",
            "NJ": "http://www.njdems.org/",
            "NM": "http://www.nmdemocrats.org/",
            "NY": "http://www.nydems.org/",
            "NC": "http://www.ncdp.org/",
            "ND": "http://www.demnpl.com/",
            "OH": "http://www.ohiodems.org/",
            "OK": "http://www.okdemocrats.org/",
            "OR": "http://www.oregondemocrats.org/",
            "PA": "http://www.padems.com/",
            "RI": "http://www.ridemocrats.org/",
            "SC": "http://www.scdp.org/",
            "SD": "http://www.sddp.org/",
            "TN": "http://www.tndp.org/",
            "TX": "http://www.txdemocrats.org/",
            "UT": "http://www.utdemocrats.org/",
            "VT": "http://www.vtdemocrats.org/",
            "VA": "http://www.vademocrats.org/",
            "WA": "http://www.wa-democrats.org/",
            "WV": "http://www.wvdemocrats.com/",
            "WI": "http://www.wisdems.org/",
            "WY": "http://www.wyomingdemocrats.com/"
        };

        if (party === "Democratic") return demparties[input];
        if (party === "Republican") return gopparties[input];

    }

    function getChamber(input) {
        if (input === "upper") return "Upper Chamber/Senate";
        else if (input === "lower") {
            if (state === "ca" || state === "ny" || state === "wi" || state === "nj" || state === "nv") {
                if (state === "nv") {
                    return "Nevada Assembly";
                }
                return "State Assembly";
            }
            if (state === "md" || state === "va" || state === "wv") {
                return "House of Delegates";
            } else return "House of Representatives";
        }

    }

    console.log(query);


    if (index === 1) {
        document.getElementById("name").innerHTML = name;
        document.getElementById("district").innerHTML = suffix(parseInt(district)) + " District";
        document.getElementById("state").innerHTML = states[state.toUpperCase()] + " (" + state.toUpperCase() + ")";
        if (phone === '' || !level || level === 'undefined') {
            document.getElementById("phone").innerHTML = "No Phone Number Data";
        } else if (state === "wa") {
            document.getElementById("phone").innerHTML = ""
        } else {
            document.getElementById("phone").innerHTML = phone;
        }
        document.getElementById("party").innerHTML = '<a href="' + getParty(state) + '">' + party + '</a>';
        document.getElementById("email").innerHTML = '<a href="mailto:' + email + '">' + email + '</a>';
        document.getElementById("photo").innerHTML = '<img style="width:200px;height:auto;" src="' + photo + '">';
        document.getElementById("website").innerHTML = '<a href="' + website + '">Website</a>';
        if (level === '' || !level || level === 'undefined') {
            document.getElementById("chamber").innerHTML = "No Chamber Data";
        } else {
            document.getElementById("chamber").innerHTML = level.charAt(0).toUpperCase() + level.slice(1) + " " + getChamber(chamber);
        }
        document.getElementById("address").innerHTML = address;
        document.getElementById("error").innerHTML = "";
    }

}

window.onload = function() {
    document.getElementsByTagName("form")[0].onsubmit = function(evt) {
        evt.preventDefault();
        val();
    };
};
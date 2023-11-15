<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title></title>
</head>

<body>
  <div id="container">
    <select name="country" id="country" class="inputCombo">
        <option sortname="">Select an item...</option>
        <option sortname="AF">Afghanistan</option>
        <option sortname="AL">Albania</option>
        <option sortname="DZ">Algeria</option>
        <option sortname="GB">United Kingdom</option>
        <option sortname="US">United States</option>
        <option sortname="IN">India</option>
    </select>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
  <script>
    var url = 'http://www.geoplugin.net/json.gp?jsoncallback=?';

    $(document).ready(function() {
        $.getJSON(url)
            .success(function(data){
                var country_code = data.geoplugin_countryCode;
                console.log()
                var $country = $('#country');
                $country.find('option[sortname="'+country_code+'"]').prependTo($country);
                $country.find('option[sortname=""]').text('--------------');
                $country.val(country_code);
            });
    });
    
  </script>

</body>
</html> 
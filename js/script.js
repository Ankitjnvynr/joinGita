var userIP;
var userCountry;

function selectOptionByCountry(countryCode) {
  // Get the select element
  var selectElement = document.getElementById("countrySelect");

  // Iterate over options
  for (var i = 0; i < selectElement.options.length; i++) {
    var option = selectElement.options[i];
    var coddde = option.getAttribute("sortname");
    // var coddde = coddde.toLowerCase();
    // console.log(coddde);


    // Check if the option's sortname attribute matches the user's country code
    if (coddde == countryCode) {
      console.log(option.getAttribute("sortname"), countryCode)
      // Set the selected attribute to true
      option.selected = true;
      break; // Stop iterating once found
    }
  }
}

fetch("https://api.ipify.org?format=json")
  .then(response => response.json())
  .then(data => {
    userIP = data.ip;

    // Use userIP to get the country using a service like ipinfo.io
    var url = "https://ipinfo.io/" + userIP + "/country";

    fetch(url)
      .then(response => response.text())
      .then(country => {
        console.log(country)
        userCountry = country;
        // Select the option based on the user's country
        selectOptionByCountry(userCountry);
      })
      .catch(error => console.error("Error:", error));
  })
  .catch(error => console.error("Error:", error));



// alert("sdsd")
loadState = (e) => {
  document.getElementById('stateSelect').disabled = false;
  $.ajax({
    url: "selectOptions/_state.php",
    type: "GET",
    data: {
      country: e.value
    },
    success: (response) => {
      // console.log(response)
      $("#stateSelect").html(response)

    }
  })
}
loadDistrict = (e) => {
  document.getElementById('citySelect').disabled = false;
  $.ajax({
    url: "selectOptions/_district.php",
    type: "GET",
    data: {
      country: e.value
    },
    success: (response) => {
      $("#citySelect").html(response)
    }
  })
}
loadTehsil = (e) => {
  document.getElementById('tehsilSelect').disabled = false;
  $.ajax({
    url: "selectOptions/_tehsilOption.php",
    type: "GET",
    data: {
      country: e.value
    },
    success: (response) => {
      // console.log(response)
      $("#tehsilSelect").html(response)
    }
  })
}
setTimeout(() => {
  var selectedCountry = document.getElementById('countrySelect');
  
  loadState(selectedCountry)
}, 700);
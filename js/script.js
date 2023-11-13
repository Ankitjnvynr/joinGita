let ourcountry = ['Australia', 'Canada', 'United Kingdom', 'India', 'Japan', 'New Zealand', 'United Arab Emirates', 'United States'];

document.addEventListener('DOMContentLoaded', function () {
    const countrySelect = document.getElementById('countrySelect');
    const stateSelect = document.getElementById('stateSelect');
    const citySelect = document.getElementById('citySelect');

    // Replace this URL with the correct path to your JSON file containing countries, states, and cities

    // Fetch countries from the JSON
    fetch('js/countries.json')
        .then((response) => response.json())
        .then((data) => {

            data.countries.forEach((country) => {
                if (ourcountry.includes(country.name)) {
                    // console.log(country.name)
                    const option = document.createElement('option');
                    option.value = country.name;
                    option.textContent = country.name;
                    option.setAttribute("dataValue", country.id)
                    option.setAttribute("sortname", country.sortname)
                    // option.dataValue = country.id;
                    countrySelect.appendChild(option);
                }
            });
        })
        .catch((error) => console.error('Error:', error));

    var url = 'http://www.geoplugin.net/json.gp?jsoncallback=?';
    console.log(url)
    $.getJSON(url)
        .success(function (data) {
            var country_code = data.geoplugin_countryCode;
            // console.log(country_code)
            var $country = $('#countrySelect');
            $country.find('option[sortname="' + country_code + '"]').prependTo($country);
            $country.find('option[sortname=""]').text('--------------');
            $country.val(country_code);



            // On country selection change, load respective states
            //   countrySelect.addEventListener('change', function () {
            stateSelect.disabled = false;
            citySelect.disabled = true;
            stateSelect.innerHTML = '<option value="">-- Select State --</option>';

            var selectedCountry = countrySelect.options[countrySelect.selectedIndex].getAttribute('dataValue');
            // console.log(selectedCountry);


            // console.log("hii");

            // Fetch states based on the selected country
            fetch('js/states.json')
                .then((response) => response.json())
                .then((data1) => {
                    data1.states.forEach(state => {
                        if (state.country_id == selectedCountry) {
                            // console.log(state)
                            const option = document.createElement('option');
                            option.value = state.name;
                            option.setAttribute("dataValue", state.id)
                            option.textContent = state.name;
                            stateSelect.appendChild(option);
                        }
                    });

                }
                )
                .catch((error) => console.error('Error:', error));
            //   });
        });

    // On state selection change, load respective cities
    stateSelect.addEventListener('change', function () {
        citySelect.disabled = false;
        citySelect.innerHTML = '<option value="">-- Select City --</option>';

        var selectedState = stateSelect.options[stateSelect.selectedIndex].getAttribute('dataValue');
        // console.log(selectedState);
        // Fetch cities based on the selected state and country
        fetch('js/cities.json')
            .then((response) => response.json())
            .then((data3) => {
                // console.log(data3)
                data3.cities.forEach((city) => {
                    if (city.state_id == selectedState) {
                        const option = document.createElement('option');
                        option.value = city.name;
                        option.textContent = city.name;
                        citySelect.appendChild(option);
                    }
                });

            })
            .catch((error) => console.error('Error:', error));
    });
});




$(document).ready(function () {

});

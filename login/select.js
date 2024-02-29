
let ourcountry = [
  "Australia",
  "Canada",
  "United Kingdom",
  "India",
  "Japan",
  "New Zealand",
  "United Arab Emirates",
  "United States",
];

// On state selection change, load respective cities
stateSelect.addEventListener("change", function () {
  citySelect.disabled = false;
  citySelect.innerHTML = '<option value="">-- Select City --</option>';

  var selectedState =
    stateSelect.options[stateSelect.selectedIndex].getAttribute("dataValue");
  // console.log(selectedState);
  // Fetch cities based on the selected state and country
  fetch("../js/cities.json")
    .then((response) => response.json())
    .then((data3) => {
      // console.log(data3)
      data3.cities.forEach((city) => {
        if (city.state_id == selectedState) {
          const option = document.createElement("option");
          option.value = city.name;
          option.textContent = city.name;
          citySelect.appendChild(option);
        }
      });
    })
    .catch((error) => console.error("Error:", error));
});


setTimeout(() => {

  var selectedCountry = countrySelect.options[countrySelect.selectedIndex].getAttribute("dataValue");

  fetch("../js/states.json")
    .then((response) => response.json())
    .then((data1) => {
      stateSelect.innerHTML = "<option value>state</option>";
      data1.states.forEach((state) => {
        if (state.country_id == selectedCountry) {
          console.log(state);
          const option = document.createElement("option");
          option.value = state.name;
          // option.setAttribute("dataValue", state.id);
          // option.textContent = state.name;
          stateSelect.appendChild(option);
        }
      });
    })
    .catch((error) => console.error("Error:", error));

}, 1000);



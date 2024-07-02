
let SelectState = (e) => {
    $.ajax({
        url: '../_selectState.php',
        type: 'POST',
        data: {
            country: e.value
        },
        success: function (response) {
            let stateSelect = document.getElementById('stateSelect')
            // console.log(response)
            stateSelect.innerHTML = response;
        }
    })
}
let selectingdistrict = (e) => {
    $.ajax({
        url: '../_selectDistrict.php',
        type: 'POST',
        data: {
            country: e.value
        },
        success: function (response) {
            let stateSelect = document.getElementById('districtSelect')
            // console.log(response)
            stateSelect.innerHTML = response;
        }
    })
}
let selectingtehsil = (e) => {
    $.ajax({
        url: '../_selectTehsil.php',
        type: 'POST',
        data: {
            country: e.value
        },
        success: function (response) {
            let stateSelect = document.getElementById('tehsilSelect')
            // console.log(response)
            stateSelect.innerHTML = response;
        }
    })
}
$('.totalCount').load('../_totalProfiles.php');
setInterval(() => {
    $('.totalCount').load('../_totalProfiles.php');
}, 3000);



$(document).ready(()=>{
    const form = document.getElementById('getDataForm');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const formData = new FormData(form);
        const selectedMedia = [];
        document.querySelectorAll('input[name="selectedMedia[]"]:checked').forEach(checkbox => {
            selectedMedia.push(checkbox.value);
        });
        formData.append('selectedMedia', JSON.stringify(selectedMedia));

        fetch('getData.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            // Handle the JSON data
        })
        .catch(error => console.error('Error:', error));
    });
});

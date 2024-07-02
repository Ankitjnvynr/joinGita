
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




// function to send message with api


async function sendWaMessages( phone, message, filePath, caption) {
    

    // API URL
    const baseUrl = 'https://app.jflindia.co.in/api/v1/message/create';

    // Data to be sent as query parameters
    const data = {
        username: 'gieo2024',
        password: 'Gieo@2024',
        receiverMobileNo: phone,
        message: message,
        filePathUrl: filePath,
        caption: caption
    };

    // Build the full URL with query parameters
    const url = `${baseUrl}?${new URLSearchParams(data).toString()}`;

    try {
        // Send the request
        const response = await fetch(url, {
            method: 'GET',
        });

        // Check if the response is successful
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        // Parse the JSON response
        const responseData = await response.json();
        return responseData;
    } catch (error) {
        return { error: error.message };
    }
}




// message sending script 


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
            // console.log(typeof data);
            // console.log(data);
            // console.log(data.mediaPaths)
            // console.log(data.users)
            // console.log()
            console.log(sendWaMessages(data.users[0].phone,data.users[0].message,data.mediaPaths,data.mediaCaptions))
        })
        .catch(error => console.error('Error:', error));
    });
});

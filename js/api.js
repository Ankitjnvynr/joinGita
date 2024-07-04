
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


// async function sendWaMessages(phone, message, filePath, caption) {
//     const baseUrl = 'https://app.jflindia.co.in/api/v1/message/create';
//     const data = {
//         username: 'gieo2024',
//         password: 'Gieo@2024',
//         receiverMobileNo: phone,
//         message: message,
//         filePathUrl: filePath,
//         caption: caption
//     };

//     const url = `${baseUrl}?${new URLSearchParams(data).toString()}`;

//     try {
//         const response = await fetch(url, { method: 'GET' });

//         if (!response.ok) {
//             throw new Error(`HTTP error! status: ${response.status}`);
//         }

//         const responseData = await response.json();
//         return responseData;
//     } catch (error) {
//         return { error: error.message };
//     }
// }



// message sending script 
// Function to send message asynchronously
const sendMsg = (phone, message, filePath, caption) => {
    const data = {
        phone: phone,
        message: message,
        filePath: filePath,
        caption: caption
    };

    return new Promise((resolve, reject) => {
        $.ajax({
            url: '_api_config.php',
            data: data,
            type: 'POST',
            success: function (res) {
                resolve(res); // Resolve with the response from the AJAX call
            },
            error: function (xhr, status, error) {
                reject(error); // Reject with the error message
            }
        });
    });
};

// Document ready function
$(document).ready(() => {
    // Form submission event listener
    $('#getDataForm').submit(async function (event) {
        event.preventDefault();
        $('#sendBtn').prop('disabled', true);
        $('#sendBtn').html('Loading......');
        // Construct FormData object from the form
        const formData = new FormData(this);

        // Retrieve selected media items
        const selectedMedia = Array.from(document.querySelectorAll('input[name="selectedMedia[]"]:checked'))
            .map(checkbox => checkbox.value);
        formData.append('selectedMedia', JSON.stringify(selectedMedia));

        try {
            // Fetch data from getData.php
            const response = await fetch('getData.php', { method: 'POST', body: formData });
            if (!response.ok) {
                throw new Error('Failed to fetch data');
            }

            // Parse JSON response
            const data = await response.json();
            const users = data.users;

            // Process each user asynchronously
            for (const user of users) {
                try {
                    const result = await sendMsg(user.phone, user.message, data.mediaPaths, data.mediaCaptions);

                    console.log("Response from sendMsg:", result.message);
                    $('resultData').


                } catch (error) {
                    console.error('Error sending message:', error);
                }
            }
            $('#sendBtn').prop('disabled', false);
            $('#sendBtn').html('Send');
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    });
});
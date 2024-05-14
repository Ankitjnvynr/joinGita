// loading more profiles with the button load more 
var moreloader = document.getElementById('moreloader')
let showloader = () => {
    moreloader.innerHTML = `
                <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            `;
}

// this function is used to create hash of phone number for creating profile link 
let createhash = (phone) => {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: "_createhash.php",
            type: "POST",
            data: {
                phone: phone
            },
            success: (response) => {
                resolve(response); // Resolve the promise with the response data
            },
            error: (error) => {
                reject(error); // Reject the promise if there's an error
            }
        });
    });
};


//  creating select message changing for messages
selectMessage = async (e) => {
    const secondChild = e.parentNode.childNodes[3];
    const memberName = e.parentNode.parentNode.parentNode.childNodes[3].innerHTML;
    // console.log(memberName)
    const phoneNumber = e.parentNode.parentNode.parentNode.childNodes[5].childNodes[3].childNodes[3].innerHTML
    console.log(phoneNumber)
    const newText = e.value;
    let src = secondChild.getAttribute('href');
    let link = src.split('&');
    let myhash = await createhash(phoneNumber);
    console.log(myhash)


    for (let i = 0; i < link.length; i++) {
        if (link[i].startsWith('text=')) {
            link[i] = 'text=' + 'गीता प्रिय ' + memberName + ' जी %0A🌹जय श्री कृष्ण🌹%0A' + encodeURIComponent(newText) + ' %0A %0ATo view profile Click here- ' + 'https://parivaar.gieogita.org/member.php?member=' + myhash;
            break;
        }
    }
    href = link.join('&');
    secondChild.setAttribute('href', href);
}


function tt() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
}
tt();
const toastElList = document.querySelectorAll('.toast')[0]
const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastElList);

let toastmsg = document.getElementById('toastmsg');
toastmsg.innerHTML = "Updated Success!";
// toastBootstrap.show();




$(document).ready(function () {
    var limit = 20;
    var start = 0;

    $('.totalCount').load('_totalProfiles.php');
    setInterval(() => {
        $('.totalCount').load('_totalProfiles.php');
    }, 3000);


    function deleteScript() {
        let dels = document.getElementsByClassName('del');
        $.each(dels, function (e, item) {
            $(item).off('click').on('click', function (e) {
                cardid = $(this).attr('data-id');
                if (confirm("Are you sure to Delete ?")) {
                    a = item.parentElement.parentElement.parentElement
                    let imgd = {
                        img: cardid
                    }
                    $.ajax({
                        url: "_deletecard.php",
                        type: "GET",
                        data: imgd,
                        success: function (data) {
                            // console.log(data)
                            $('#toastmsg').text(data)
                            toastBootstrap.show();

                            a.classList.add('op')
                            setTimeout(() => {
                                a.style.display = 'none';
                            }, 1000);
                            // loadpics(start, limit);
                            var fltr = {
                                filterName: $('#filterName').val(),
                                phone: $('#filterPhone').val(),
                                filterEmail: $('#filterEmail').val(),
                                filterCountry: $('#countrySelect').val(),
                                filterState: $('#stateSelect').val(),
                                filterDistrict: $('#districtSelect').val(),
                                filterTehsil: $('#tehsilSelect').val(),
                                limit: "20",
                                start: start,
                            }
                            $.ajax({
                                url: '_filteredCardsNumber.php',
                                type: 'POST',
                                // cache: false,
                                data: fltr,
                                success: function (response) {
                                    // console.log(response)
                                    $('.showing').html(response)

                                }
                            })

                        }
                    })
                } else {
                    console.log("no")
                }
            })
        })
    }


    deleteScript()

    var action = 'inactive';
    // select optoion value after update
    findFilter = (selectId, myValue) => {
        var select = document.getElementById(selectId); // Get the select element
        for (var i = 0; i < select.options.length; i++) {
            if (select.options[i].value === myValue) {
                select.options[i].selected = true; // Set the selected attribute to true for the matching option
                break; // Exit the loop since we found the match
            }
        }
    }


    loadpics = (start, limit) => {
        console.log(start, limit)
        var fltr = {
            filterName: $('#filterName').val(),
            phone: $('#filterPhone').val(),
            filterEmail: $('#filterEmail').val(),
            filterCountry: $('#countrySelect').val(),
            filterState: $('#stateSelect').val(),
            filterDistrict: $('#districtSelect').val(),
            filterTehsil: $('#tehsilSelect').val(),
            limit: "20",
            start: start,
        }
        if (sessionStorage.getItem('isFilter')) {
            // Retrieve the string from session storage
            var retrievedFltrString = sessionStorage.getItem('filterObject');
            var fltr = JSON.parse(retrievedFltrString); // Convert the string back to an object
            console.log(fltr)
            findFilter("countrySelect", fltr.filterCountry)
            SelectState(fltr.filterCountry)
            // findFilter("filterState", fltr.filterState)

            // SelectState(fltr.filterCountry);


            // findFilter("filterState", fltr.filterState)
            $('#filterName').val(fltr.filterName)
            $('#filterPhone').val(fltr.phone)
            $('#filterEmail').val(fltr.filterEmail)
        }

        // findFilter("districtSelect", fltr.filterDistrict)

        $.ajax({
            url: '_loadcard.php',
            type: 'POST',
            // cache: false,
            data: fltr,
            success: function (response) {
                // console.log(response)
                $('.cardbox').html(response);
                deleteScript()
                // Clear all data from session storage
                sessionStorage.clear();
            }
        })
        $.ajax({
            url: '_filteredCardsNumber.php',
            type: 'POST',
            // cache: false,
            data: fltr,
            success: function (response) {
                // console.log(response)
                $('.showing').html(response)

            }
        })

    }
    loadMore = (start, limit) => {
        showloader();
        let dels = document.getElementsByClassName('del');
        start = dels.length;

        var fltr = {
            filterName: $('#filterName').val(),
            phone: $('#filterPhone').val(),
            filterEmail: $('#filterEmail').val(),
            filterCountry: $('#countrySelect').val(),
            filterState: $('#stateSelect').val(),
            filterDistrict: $('#districtSelect').val(),
            filterTehsil: $('#tehsilSelect').val(),
            limit: "50",
            start: start,
        }
        $.ajax({
            url: '_loadcard.php',
            type: 'POST',
            // cache: false,
            data: fltr,
            success: function (response) {
                if (response == ' ') {
                    $('#loadMore').html("No More Data")
                    moreloader.innerHTML = "";
                    console.log("no more data")
                } else {
                    $('.cardbox').append(response);
                    deleteScript()
                    moreloader.innerHTML = "";
                }
            }
        })


    }
    // loadpics()
    resetTop = false;
    restwindowtop = () => {
        resetTop = true;
    }

    if (action == 'inactive') {
        action = 'active';
        loadpics(start, limit);
    }


})


let SelectState = (e) => {
    $.ajax({
        url: '_selectState.php',
        type: 'POST',
        data: {
            country: e
        },
        success: function (response) {
            let stateSelect = document.getElementById('stateSelect')
            // console.log(response)
            stateSelect.innerHTML = response;
            loadpics(0, 5)
        }
    })
}
let selectingdistrict = (e) => {

    $.ajax({
        url: '_selectDistrict.php',
        type: 'POST',
        data: {
            country: e.value
        },
        success: function (response) {
            let stateSelect = document.getElementById('districtSelect')
            // console.log(response)
            stateSelect.innerHTML = response;
            loadpics(0, 5)
        }
    })
}
let selectingtehsil = (e) => {

    $.ajax({
        url: '_selectTehsil.php',
        type: 'POST',
        data: {
            country: e.value
        },
        success: function (response) {
            let stateSelect = document.getElementById('tehsilSelect')
            console.log(response)
            stateSelect.innerHTML = response;
            loadpics(0, 5)
        }
    })
}

// profile picture updating cropper js modal

$(document).ready(() => {

    const cropperModal = new bootstrap.Modal(document.getElementById('cropperModal'));
    let cropper;
    // Show modal and initialize cropper when it is shown
    $("#cropperModal").on("shown.bs.modal", function () {
        const image = document.getElementById("cropperImage");
        const cropperContainer = document.querySelector(".cropper-container");

        // Create a new canvas element
        var canvas = document.createElement("canvas");
        var ctx = canvas.getContext("2d");

        // Set the desired width and height for the resized image
        var maxWidth = 700; // Set your maximum width
        var maxHeight = 700; // Set your maximum height

        // Ensure the image dimensions fit within the maximum dimensions while preserving aspect ratio
        var width = image.width;
        var height = image.height;

        if (width > height) {
            if (width > maxWidth) {
                height *= maxWidth / width;
                width = maxWidth;
            }
        } else {
            if (height > maxHeight) {
                width *= maxHeight / height;
                height = maxHeight;
            }
        }

        // Set the canvas dimensions to the resized image dimensions
        canvas.width = width;
        canvas.height = height;

        // Draw the resized image onto the canvas
        ctx.drawImage(image, 0, 0, width, height);

        // Replace the original image source with the resized image data URL
        image.src = canvas.toDataURL("image/jpeg"); // Change 'image/jpeg' to the desired image format if needed

        // Initialize Cropper with the resized image
        if (cropper) {
            cropper.destroy();
        }
        cropper = new Cropper(image, {
            aspectRatio: 1, // Adjust aspect ratio as needed
            viewMode: 1,
            rotatable: true,
            rotator: true,
            checkOrientation: true, // Set to 1 to ensure the cropped image fits within the container

            crop: function (event) {
                // Apply circular mask to cropper container
                $(".cropper-view-box, .cropper-face").css("border-radius", "50%");
                $(".cropper-container").css("overflow", "hidden");
            },
        });
        $("#cropperModal").on("hidden.bs.modal", function (e) {
            // Check if Cropper instance exists

            if (cropper) {
                // Destroy Cropper instance
                console.log("destroyed the cropper");
                cropper.destroy();
            }
        });

        // Set the Cropper container's width and height explicitly
        cropperContainer.style.width = "100%";
        cropperContainer.style.height = "400px"; // Adjust height as needed
    });

    // When user clicks the "Upload Profile Photo" button, show the modal
    $("#changeImg").on("change", function (event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $("#cropperImage").attr("src", e.target.result);
                cropperModal.show();
            };
            reader.readAsDataURL(input.files[0]);
        }
    });

    // When user clicks the "Save" button, save the cropped image
    getPicId = (e, picId) => {
        currentImageUrl = e.src;
        var picId = picId;
        console.log(picId);
        document.getElementById("changeImg").click();

        $("#saveCroppedImage").on("click", function () {
            if (cropper) {
                const canvas = cropper.getCroppedCanvas();
                const croppedImageDataURL = canvas.toDataURL("image/png");

                document.getElementById("changeImg").src = croppedImageDataURL; // Update the original image with the cropped image

                // Get the member ID
                var memberId = picId; // Assuming you're passing member ID as a query parameter
                // AJAX request to send cropped image data to PHP script
                $.ajax({
                    type: "POST",
                    url: "../partials/_updateprofilePic.php", // Update with the correct PHP script path
                    data: {
                        croppedImage: croppedImageDataURL, // Use croppedImageDataURL instead of croppedImageData
                        memberId: memberId,
                    },
                    // dataType: 'json',
                    success: function (response) {
                        console.log(response);
                        responseObject = JSON.parse(response);
                        console.log(responseObject);
                        var currentImageName = currentImageUrl.match(/\/([^\/]+)$/)[1]; // Extract current image name
                        var newImageName = responseObject.newImageName;
                        var newUrl = currentImageUrl.replace(
                            currentImageName,
                            newImageName
                        );
                        e.src = newUrl;
                        console.log(newUrl);
                        let changeImg = document.getElementById("changeImg");
                        console.log(changeImg);
                        changeImg.src = "";
                    },
                    error: function (xhr, status, error) {
                        // Handle AJAX error
                        console.error(error);
                    },
                });

                // Close the modal
                cropperModal.hide();
            } else {
                console.error("Cropper is not initialized.");
            }
        });
    };
})





const edituerModal = new bootstrap.Modal('#edituerModal')

editUser = (id) => {
    edituerModal.show()
    $.ajax({
        url: 'update2.php',
        type: 'GET',
        data: {
            user: id
        },
        success: (res) => {
            $('#edituser').html(res)
        }
    })
}

// storing the filter before going to update page

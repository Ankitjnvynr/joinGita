
const cropperModal = new bootstrap.Modal(document.getElementById('cropperModal'))

function fileValidation(event) {
    var fileInput = document.getElementById('pic');
    var filePath = fileInput.value;
    // Allowing file type
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if (!allowedExtensions.exec(filePath)) {
        alert('File must be jpg, jpeg or png');
        fileInput.value = '';
        return false;
    }
}


document.addEventListener('DOMContentLoaded', function () {
    const cropperModal = new bootstrap.Modal(document.getElementById('cropperModal'));
    let cropper;

    $('#cropperModal').on('shown.bs.modal', function () {
        const image = document.getElementById('cropperImage');
        const cropperContainer = document.querySelector('.cropper-container');

        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 1,
            rotatable: true,
            crop: function (event) {
                $('.cropper-view-box, .cropper-face').css('border-radius', '50%');
                $('.cropper-container').css('overflow', 'hidden');
            }
        });

        $('#cropperModal').on('hidden.bs.modal', function (e) {
            if (cropper !== undefined) {
                cropper.destroy();
            }
        });

        cropperContainer.style.width = '100%';
        cropperContainer.style.height = '400px';
    });

    $('#pic').on('change', function (event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const tempImg = new Image();
                tempImg.src = e.target.result;
                tempImg.onload = function () {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    const maxWidth = 700;
                    const maxHeight = 700;
                    let width = tempImg.width;
                    let height = tempImg.height;

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

                    canvas.width = width;
                    canvas.height = height;

                    pica().resize(tempImg, canvas)
                        .then(result => pica().toBlob(result, 'image/jpeg', 0.9))
                        .then(blob => {
                            const resizedImageURL = URL.createObjectURL(blob);
                            $('#cropperImage').attr('src', resizedImageURL);
                            cropperModal.show();
                        });
                };
            }
            reader.readAsDataURL(input.files[0]);
        }
    });

    // When user clicks the "Save" button, save the cropped image
    $('#saveCroppedImage').on('click', function () {
        if (cropper) {
            const canvas = cropper.getCroppedCanvas();
            const croppedImageDataURL = canvas.toDataURL("image/png");

            // Update the original image with the cropped image
            $('#image').attr('src', croppedImageDataURL);

            // Assuming you're passing member ID as a query parameter


            // AJAX request to send cropped image data to PHP script
            $.ajax({
                type: 'POST',
                url: 'partials/_updateprofilePic.php', // Update with the correct PHP script path
                data: {
                    croppedImage: croppedImageDataURL, // Use croppedImageDataURL instead of croppedImageData
                    memberId: memberId
                },
                // dataType: 'json',
                success: function (response) {
                    console.log(response)
                    if (response.success) {
                        // Display success message or perform any other actions
                        // console.log(response.message);
                        console.log(response)
                    } else {
                        // Display error message or handle error case
                        // console.error(response.message);
                        console.log(response)
                    }
                },
                error: function (xhr, status, error) {
                    // Handle AJAX error
                    console.error(error);
                }
            });

            // Close the modal
            cropperModal.hide();
        } else {
            console.error('Cropper is not initialized.');
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    loadSongs = () => {
        $.ajax({
            type: 'POST',
            url: 'partials/_loadsongs.php',
            success: (res) => {
                // console.log(res)
                $('#songlist').html(res)
            }

        })
    }
    document.querySelectorAll('.list-group-item').forEach(item => {
        item.addEventListener('mouseenter', () => {
            item.scrollLeft = 0; // Ensure the scroll position is reset when re-entering
            item.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });

    loadSongs();
});


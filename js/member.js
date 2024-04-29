
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
    // Show modal and initialize cropper when it is shown
    $('#cropperModal').on('shown.bs.modal', function () {
        const image = document.getElementById('cropperImage');
        const cropperContainer = document.querySelector('.cropper-container');

        // Create a new canvas element
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');

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
        image.src = canvas.toDataURL('image/jpeg'); // Change 'image/jpeg' to the desired image format if needed

        // Initialize Cropper with the resized image


        cropper = new Cropper(image, {
            aspectRatio: 1, // Adjust aspect ratio as needed
            viewMode: 1,
            rotatable: true,
            rotator: true,
            checkOrientation: true, // Set to 1 to ensure the cropped image fits within the container
            crop: function (event) {
                // Apply circular mask to cropper container
                $('.cropper-view-box, .cropper-face').css('border-radius', '50%');
                $('.cropper-container').css('overflow', 'hidden');
            }
        });
        $('#cropperModal').on('hidden.bs.modal', function (e) {
            // Check if Cropper instance exists

            if (cropper !== undefined) {
                // Destroy Cropper instance
                cropper.destroy();
            }
        });

        // Set the Cropper container's width and height explicitly
        cropperContainer.style.width = '100%';
        cropperContainer.style.height = '400px'; // Adjust height as needed
    });

    // When user clicks the "Upload Profile Photo" button, show the modal
    $('#pic').on('change', function (event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $('#cropperImage').attr('src', e.target.result);
                cropperModal.show();
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
    loadSongs();
});


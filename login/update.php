<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true)
{
  header("location: index.php");
  exit;
}

include ("../partials/_db.php");
$user_id = $_GET['user'];

$sr = 0;

$sql = "SELECT * FROM `users` WHERE `id` = '$user_id' ";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
  $sr++;
  $country = $row['country'];
  $name = $row['name'];
  $phone = $row['phone'];
  $hash_id = $row['hash_id'];
  $designation = $row['designation'];
  $email = $row['email'];
  $dikshit = $row['dikshit'];
  $marital_status = $row['marital_status'];
  $state = $row['state'];
  $district = $row['district'];
  $tehsil = $row['tehsil'];
  $address = $row['address'];
  $wing = $row['interest'];
  $occupation = $row['occupation'];
  $education = $row['education'];
  $dob = $row['dob'];
  $aniver_date = $row['aniver_date'];
  $star = $row['star'];
  $pic = $row['pic'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
  <style>
    body {
      background: #f7e092;
    }

    .container {
      /* max-width: 900px; */
      background: rgba(255, 255, 255, 0.9);
      position: relative;

    }

    .form-floating>label {
      left: 10px;
    }



    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;

    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="../style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.css" integrity="sha512-bs9fAcCAeaDfA4A+NiShWR886eClUcBtqhipoY5DM60Y1V3BbVQlabthUBal5bq8Z8nnxxiyb1wfGX2n76N1Mw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" integrity="sha512-hvNR0F/e2J7zPPfLC9auFe3/SE0yG4aJCOd/qxew74NN7eyiSKjr7xJJMu1Jy2wf7FXITpWS1E/RY8yzuXN7VA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>GIEO Gita : Updating Profile
    <?php $name ?>
  </title>
  <style>
    .loading {
      height: 100vh;
      width: 100%;
      display: flex;
      /* overflow: hidden; */
      position: absolute;
      z-index: 100;
      justify-content: center;
      align-items: center;
      background-color: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(5px);
      top: 0;
      scroll-behavior: none;
    }

    .l-box {
      height: 100px;
      width: 100px;
      border-top: 5px solid green;
      /* border-right: 5px solid red ; */
      border-radius: 50%;
      /* transition: all 0.1s ease-in-out; */
      animation: rotation 1s infinite;
    }

    @keyframes rotation {

      /* from{transform: rotate(0deg);} */
      to {
        transform: rotate(360deg);
      }
    }
  </style>
  <style>
    #joinForm {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }

    #joinForm>div,
    span {
      flex: 1 0 300px;
    }

    .cropper-container {
      width: 100% !important;
    }
  </style>
</head>

<body class="ov">



  <!-- Modal -->
  <div class="modal fade" id="cropperModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Crop Image</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body ">
          <div class="cropper-container">
            <img id="cropperImage" src="" alt="Image to crop">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" id="saveCroppedImage" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>


  <!-- ========================= -->

  <div style="min-height:100vh" class="d-flex justify-content-center align-items-center">
    <div class="container my-3 rounded ">
      <h2 class="text-center my-2 text-danger">Updating Profile</h2>
      <div class="row ">
        <div class="col-md-3 py-3 ">
          <div class="d-flex flex-column bg-warning-subtle py-1 gap-2 rounded">
            <p class="text-left mx-3">Photo:-</p>
            <img class="m-auto shadow rounded-circle" width="60%" src="../imgs/<?php echo $pic ?>"
              alt="<?php echo $name ?>">
            <p class="text-center"><label class="btn btn-outline-danger" for="changeImg">Change Imgae</label></p>
            <input id="changeImg"  type="file" class="form-control " hidden>
          </div>
        </div>
        <div class="col-md-9 py-3">
          <form method="POST" action="submit.php" id="joinForm">
            <input name="memberid" value="<?php echo $user_id; ?>" type="text" hidden>
            <div class="bg-warning-subtle p-2 py-2 rounded">
              <label class="form-label form-label-sm" for="countrySelect">Change Country</label>
              <select id="countrySelect" name="country" class="form-select " aria-label="Small select example">
                <option selected>---Country---</option>
              </select>
            </div>
            <div class="bg-warning-subtle p-2 py-2 rounded">
              <label class="form-label form-label-sm" for="name"> Name</label>
              <input value="<?php echo $name ?>" name="name" id="name" type="text" class="form-control">
            </div>
            <div class="bg-warning-subtle p-2 py-2 rounded">
              <label class="form-label form-label-sm" for="phone">WhatsApp Number(without country code)</label>
              <!-- <input id="phone" name="phone" type="text" value="<?php echo $phone ?>" class="form-control" > -->
              <input id="phone" name="phone" type="text" value="<?php echo $phone ?>" class="form-control" >
            </div>
            <div class="bg-warning-subtle p-2 py-2 rounded">
              <label class="form-label form-label-sm" for="email">Enter Email</label>
              <input id="email" name="email" type="email" value="<?php echo $email ?>" class="form-control">
            </div>
            <div class="bg-warning-subtle p-2 py-2 rounded">
              <label class="form-label form-label-sm" for="dikshit">Dikshit</label>
              <select id="dikshit" name="dikshit" class="form-control " aria-label="Small select example">
                <option value="" selected>---Dikshit/दीक्षित परिवार---</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="No But Interested">No, But Intrested</option>
                <option value="<?php echo $dikshit ?>" selected>
                  <?php echo $dikshit ?>
                </option>
              </select>
            </div>
            <div class="bg-warning-subtle p-2 py-2 rounded">
              <label class="form-label form-label-sm" for="stateSelec">Change State</label>
              <input list="stateSelect" id="stateSelec" name="state" class="form-select" value="<?php echo $state; ?>">
              <datalist id="stateSelect">
                <option value="">-- Region --</option>
              </datalist>
            </div>
            <div class="bg-warning-subtle p-2 py-2 rounded">
              <label class="form-label form-label-sm" for="citySelec">Change District</label>
              <input id="citySelec" list="citySelect" name="district" class="form-control" value="<?php echo $district; ?>">
              <datalist id="citySelect">
                <option value="">-- District --</option>
              </datalist>
            </div>
            <div class="bg-warning-subtle p-2 py-2 rounded">
              <label class="form-label form-label-sm" for="citySelec">Change Tehsil</label>
              <input id="selecttehsil" list="citySelect" name="tehsil" class="form-control" value="<?php echo $tehsil; ?>">
              <datalist id="citySelect">
                <option value="">-- tehsil --</option>
              </datalist>
            </div>

            <div class="bg-warning-subtle p-2 py-2 rounded">
              <label class="form-label form-label-sm" for="city">Address</label>
              <input value="<?php echo $address ?>" name="address" id="city" type="text" class="form-control">
            </div>

            <div class="bg-warning-subtle p-2 py-2 rounded">
              <label class="form-label form-label-sm" for="occupation">Occupation</label>
              <select name="occupation" id="occupation" class="form-select " aria-label="Small select example">
                <option value="" disabled="" selected="">---Occupation---</option>
                <option value="Business" aria-selected="false">Business</option>
                <option value="Home Maker" aria-selected="false">Home Maker</option>
                <option value="Private Job" aria-selected="false">Private Job</option>
                <option value="Govt. Job" aria-selected="false">Govt. Job</option>
                <option value="Student" aria-selected="false">Student</option>
                <option value="Politician" aria-selected="false">Politician</option>
                <option value="Farmer" aria-selected="false">Farmer</option>
                <option value="Teacher" aria-selected="false">Teacher</option>
                <option value="Doctor" aria-selected="false">Doctor</option>
                <option value="Govt. Job, Retired" aria-selected="false">Govt. Job, Retired</option>
                <option value="Retired" aria-selected="false">Retired</option>
                <option value="<?php echo $occupation ?>" aria-selected="false" selected>
                  <?php echo $occupation ?>
                </option>
              </select>
            </div>
            <div class="bg-warning-subtle p-2 py-2 rounded">
              <label class="form-label form-label-sm" for="education">Education</label>
              <select name="education" id="education" class="form-select " aria-label="Small select example">
                <option value="" disabled="" class="F8vzy2 HDqSrI" selected="">---Education---</option>
                <option value="B.Com" aria-selected="false">B.Com</option>
                <option value="M.Com" aria-selected="false">M.Com</option>
                <option value="M.Com" aria-selected="false">B.Tech</option>
                <option value="M.Com" aria-selected="false">M.Tech</option>
                <option value="LLB" aria-selected="false">LLB</option>
                <option value="MBBS" aria-selected="false">MBBS</option>
                <option value="CA" aria-selected="false">CA</option>
                <option value="CS" aria-selected="false">CS</option>
                <option value="PhD" aria-selected="false">PhD</option>
                <option value="M.Ed." aria-selected="false">M.Ed.</option>
                <option value="B.Ed." aria-selected="false">B.Ed.</option>
                <option value="MBA" aria-selected="false">MBA</option>
                <option value="JBT" aria-selected="false">JBT</option>
                <option value="Post Graduation" aria-selected="false">Post Graduation</option>
                <option value="Graduation" aria-selected="false">Graduation</option>
                <option value="12th Pass" aria-selected="false">12th Pass</option>
                <option value="10th Pass" aria-selected="false">10th Pass</option>
                <option value="Others" aria-selected="false">Others</option>
                <option value="<?php echo $education ?>" aria-selected="false" selected>
                  <?php echo $education ?>
                </option>
              </select>
            </div>
            <div class="bg-warning-subtle p-2 py-2 rounded">
              <label class="form-label form-label-sm" for="married">Marital Status</label>
              <select name="married" id="married" class="form-select " onchange="aniver()">
                <option value="">-- select Marital Status --</option>
                <option value="Married" aria-selected="false">Married</option>
                <option value="Single" aria-selected="false">Single</option>
                <option value="<?php echo $marital_status ?>" aria-selected="false" selected>
                  <?php echo $marital_status ?>
                </option>
              </select>
            </div>
            <div class="bg-warning-subtle p-2 py-2 rounded">
              <label class="form-label form-label-sm" for="dob">Date of Birth</label>
              <input name="dob" id="dob" type="date" class="form-control" value="<?php echo $dob ?>">
            </div>
            <div class="bg-warning-subtle p-2 py-2 rounded">
              <label class="form-label form-label-sm" for="star">Star</label>
              <select name="star" id="star" class="form-select " >
                <option value="">-- Star --</option>
                <option value="Trustee" aria-selected="false">Trustee</option>
                <option value="Patern Trustee" aria-selected="false">Patern Trustee</option>
                <option value="Corporate Trustee" aria-selected="false">Corporate Trustee</option>
                <option value="<?php echo $star ?>" aria-selected="false" selected>
                  <?php echo $star ?>
                </option>
              </select>
            </div>
            <span id="aniversry">
              <?php
              if ($aniver_date != "0000-00-00")
              {
                echo '
                <div class="bg-warning-subtle p-2 py-2 rounded ">
                  <label class="form-label " for="anniversary">Aniversary</label>
                  <input name="aniver_date" value="' . $aniver_date . '" id="anniversary" type="date" class="form-control" >
                </div>
                ';
              } else

              ?>
            </span>

            <div class="text-center mt-4 my-3">
              <button type="submit" name="updatesubmit" class="btn btn-danger">Update ></button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
  <script src="../statelist.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js" integrity="sha512-9KkIqdfN7ipEW6B6k+Aq20PV31bjODg4AA52W+tYtAE0jE0kMx49bjJ3FgvS56wzmyfMUHbQ4Km2b7l9+Y/+Eg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.js" integrity="sha512-Zt7blzhYHCLHjU0c+e4ldn5kGAbwLKTSOTERgqSNyTB50wWSI21z0q6bn/dEIuqf6HiFzKJ6cfj2osRhklb4Og==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="select.js"></script>
  <script src="../js/another.js"></script>




  <?php
echo '
    <script>
      let cnntry = document.getElementById("countrySelect")
      const newOption = new Option("' . $country . '","' . $country . '");
      newOption.setAttribute("datavalue", "101");
      newOption.setAttribute("selected", "true");
      cnntry.add(newOption,undefined);
      
      
  </script>
    ';
  ?>

  <script>
    // let changingImage = (e) => {
    //   console.log(e.value)
    // }
    $(document).ready(() => {
      const cropperModal = new bootstrap.Modal(document.getElementById('cropperModal'));
      let cropper;
      // Show modal and initialize cropper when it is shown
      $('#cropperModal').on('shown.bs.modal', function() {
        const image = document.getElementById('cropperImage');
        const cropperContainer = document.querySelector('.cropper-container');

        // Create a new canvas element
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');

        // Set the desired width and height for the resized image
        var maxWidth = 3000; // Set your maximum width
        var maxHeight = 3000; // Set your maximum height

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

          crop: function(event) {
            // Apply circular mask to cropper container
            $('.cropper-view-box, .cropper-face').css('border-radius', '50%');
            $('.cropper-container').css('overflow', 'hidden');
          }
        });
        $('#cropperModal').on('hidden.bs.modal', function(e) {
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
      $('#changeImg').on('change', function(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
          const reader = new FileReader();
          reader.onload = function(e) {
            $('#cropperImage').attr('src', e.target.result);
            cropperModal.show();
          }
          reader.readAsDataURL(input.files[0]);
        }
      });


      // When user clicks the "Save" button, save the cropped image
      $('#saveCroppedImage').on('click', function() {
        if (cropper) {
          const canvas = cropper.getCroppedCanvas();
          const croppedImageDataURL = canvas.toDataURL("image/png");

          // Update the original image with the cropped image
          document.getElementById('changeImg').src = croppedImageDataURL
          // $('#changeImg').attr('src', croppedImageDataURL);


          // Get the member ID
          var memberId = "<?php echo $hash_id ?>"; // Assuming you're passing member ID as a query parameter


          // AJAX request to send cropped image data to PHP script
          $.ajax({
            type: 'POST',
            url: '../partials/_updateprofilePic.php', // Update with the correct PHP script path
            data: {
              croppedImage: croppedImageDataURL, // Use croppedImageDataURL instead of croppedImageData
              memberId: memberId
            },
            // dataType: 'json',
            success: function(response) {
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
            error: function(xhr, status, error) {
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
    })
  </script>

</body>

</html>
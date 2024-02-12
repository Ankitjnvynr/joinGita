<?php
include("../partials/_db.php");
$user_id = $_GET['user'];
$sr = 0;

$sql = "SELECT * FROM `users` WHERE `id` = '$user_id' ";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_array($result)) {
  $sr++;
  $country = $row['country'];
  $name = $row['name'];
  $phone = $row['phone'];
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
  $message = $row['message'];
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
      max-width: 900px;
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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>

  <link rel="stylesheet" href="../style.css" />
  <title>Join GIEO Gita</title>
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
</head>

<body class="ov">

  <div class="container p-2 p-md-4  shadow-lg  my-3 rounded " style="padding-bottom: 1%;">




    <div class="container " id="main">
      <div class="d-flex align-items-center justify-content-end float-end" style="width: 500px;">
        <span class="mr-2">Language:</span>
        <select class="form-control-sm  mx-2" id="lang">
          <option value="ENG" selected>ENG</option>
          <option value="HIN">HIN</option>
        </select>
      </div>
    </div>



    <form id="updateForm" class="" style="padding-bottom: 1%;" method="POST" action="submit.php">
      <h2 class="text-center text-danger mb-4">Updating Profile</h2>
      <div class="form-group col-md mb-3 d-flex justify-content-center ">
        <select value="india" max-width="600px" id="countrySelect" value=<?php echo $country; ?> name="country"
          class='form-control'>
          <option>-- Country --</option>
        </select>
      </div>
      <div class="row">
        <div class="form-floating mb-3 col-md ">
          <input type="text" class="form-control" name="name" placeholder="name@example.com" value="<?php echo $name ?>"
            required>
          <label for="floatingInput">Name</label>
        </div>



        <div class="form-floating mb-3 col-md ">
          <input type="number" class="form-control" id="phone" name="phone" maxlength="20"
            placeholder="name@example.com" value="<?php echo $phone ?>" required>
          <label for="floatingInput">Phone No(without country code)</label>
        </div>

      </div>
      <div class="row">
        <div class="form-floating mb-3 col-md">
          <input type="email" class="form-control" name="email" placeholder="name@example.com"
            value="<?php echo $email ?>" required>
          <label for="floatingInput">Email </label>
        </div>
        <div class="form-group col-md mb-3 fill">
          <select name="dikshit" class="form-control" id="inputDistrict" aria-label="Default select example" required>

            <option value="" aria-selected="false">--Dikshit--</option>
            <option value="Yes" aria-selected="false">Yes</option>
            <option value="No" aria-selected="false">No</option>
            <option value="No, but interested" aria-selected="false">No, but interested</option>
            <option value="<?php echo $dikshit ?>" selected>
              <?php echo $dikshit ?>
            </option>

          </select>
        </div>

      </div>
      <div class="row">



      </div>
      <div class="row">
        <div class=" mb-3 col-md">
          <select id="stateSelect" name="state" class='form-control' required>
            <option value="">-- Region --</option>
            
          </select>

        </div>
        <div class=" mb-3 col-md">
          <select id="citySelect" name="district" class='form-control' required>
            <option value="">-- City --</option>
          </select>

        </div>
      </div>



      <div class="row">

        <div class="form-floating mb-3 col-md">
          <input name="tehsil" type="text" class="form-control" placeholder="name@example.com"
            value="<?php echo $tehsil ?>" required>
          <label for="floatingInput">Tehsil</label>
        </div>
        <div class="form-floating mb-3 col-md">
          <input name="address" type="text" class="form-control" id="Village" placeholder="name@example.com"
            value="<?php echo $address ?>" required>
          <label for="Village">Address</label>
        </div>
      </div>

      <div class="row">
        <div class="form-group col-md mb-3 fill">
          <select name="intrest" class="form-control" data-testid="select-trigger" required="" aria-required="true"
            aria-invalid="false" required>
            <option value="" disabled="" selected="">Interested Field</option>
            <option value="श्री कृष्ण कृपा सेवा समिति" aria-selected="false">श्री कृष्ण कृपा सेवा समिति</option>
            <option value="जीओ गीता" aria-selected="false">जीओ गीता</option>
            <option value="सेवा समूह" aria-selected="false">सेवा समूह</option>
            <option value="सूचना समूह" aria-selected="false">सूचना समूह</option>
            <option value="सत्संग समूह" aria-selected="false">सत्संग समूह</option>
            <option value="प्रचार समूह" aria-selected="false">प्रचार समूह</option>
            <option value="पत्रिका समूह" aria-selected="false">पत्रिका समूह</option>
            <option value="यज्ञ समूह" aria-selected="false">यज्ञ समूह</option>
            <option value="शिक्षा समूह" aria-selected="false">शिक्षा समूह</option>
            <option value="चिकित्सा समूह" aria-selected="false">चिकित्सा समूह</option>
            <option value="अधिवक्ता समूह" aria-selected="false">अधिवक्ता समूह</option>
            <option value="युवा चेतना समूह" aria-selected="false">युवा चेतना समूह</option>
            <option value="ग्राम संपर्क समूह" aria-selected="false">ग्राम संपर्क समूह</option>
            <option value="विप्रजन समूह" aria-selected="false">विप्रजन समूह</option>
            <option value="मन्दिर सेवा समूह" aria-selected="false">मन्दिर सेवा समूह</option>
            <option value="महिला समूह" aria-selected="false">महिला समूह</option>
            <option value="समन्वय समूह" aria-selected="false">समन्वय समूह</option>
            <option value="सोशल मीडिया समूह" aria-selected="false">सोशल मीडिया समूह</option>
            <option value="निधि समूह" aria-selected="false">निधि समूह</option>
            <option value="गौ सेवा समूह" aria-selected="false">गौ सेवा समूह</option>
            <option value="<?php echo $wing ?>" aria-selected="false" selected><?php echo $wing ?></option>
          </select>
        </div>
        <div class="form-group col-md mb-3">

          <select name="occupation" class="form-control" data-testid="select-trigger" required="" aria-required="true"
            aria-invalid="false" required>
            <option value="" disabled="" selected="">Occupation</option>
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
            <option value="<?php echo $occupation ?>" aria-selected="false" selected><?php echo $occupation ?></option>

          </select>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md mb-3">
          <select name="education" class="form-control" data-testid="select-trigger" required="" aria-required="true"
            aria-invalid="false" required>
            <option value="" disabled="" class="F8vzy2 HDqSrI" selected="">Education</option>
            <option value="B.Com" aria-selected="false">B.Com</option>
            <option value="M.Com" aria-selected="false">M.Com</option>
            <option value="LLB" aria-selected="false">LLB</option>
            <option value="MBBS" aria-selected="false">MBBS</option>
            <option value="CA" aria-selected="false">CA</option>
            <option value="CS" aria-selected="false">CS</option>
            <option value="Post Graduation" aria-selected="false">Post Graduation</option>
            <option value="Graduation" aria-selected="false">Graduation</option>
            <option value="12th Pass" aria-selected="false">12th Pass</option>
            <option value="10th Pass" aria-selected="false">10th Pass</option>
            <option value="Others" aria-selected="false">Others</option>
            <option value="<?php echo $education ?>" aria-selected="false" selected><?php echo $education ?></option>

          </select>
        </div>
        <div class="form-floating mb-3 col-md ">
          <input name="dob" type="date" class="form-control" value="<?php echo $dob ?>" required>
          <label for="dob">Birth Date</label>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md mb-3">
          <select name="married" id="married" class="form-control" onchange="aniver()" required>
            <option value="">-- select Marital Status --</option>
            <option value="Married" aria-selected="false">Married</option>
            <option value="Unmarried" aria-selected="false">Unmarried</option>
            <option value="<?php echo $marital_status ?>" aria-selected="false" selected>
              <?php echo $marital_status ?>
            </option>
          </select>
        </div>

        <div id="aniversry" class="form-floating mb-3 col-md">

        </div>
        
      </div>

      <div class="d-flex justify-content-center"><button name="updatesubmit" type="submit" class="btn btn-danger p-4 py-2 p"><b>Update Profile</b></button></div>
  </div>
  </form>


  </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
    integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
    integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
  <script src="../statelist.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>

  <script src="select.js"></script>
  <script src="../js/another.js"></script>


  <?php
  if (isset($_GET['dphoneExiit'])) {

    $pnot = false;
    $pnot = $_GET['dphoneExiit'];
    if ($pnot == true) {
      echo '
            <script>
                const toastLiveExample = document.getElementById("phtoast")
                const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
                toastBootstrap.show()
            </script>
                ';
    }
  }
  ?>


  <?php
  echo '
    <script>
      let cnntry = document.getElementById("countrySelect")
      const newOption = new Option("' . $country . '","' . $country . '");
      newOption.setAttribute("selected", "true");
      cnntry.add(newOption,undefined);
      
      // let cnntry = document.getElementById("countrySelect")
      // const newOption = new Option("' . $country . '","' . $country . '");
      // newOption.setAttribute("selected", "true");
      // cnntry.add(newOption,undefined);
  </script>
    ';
  ?>

</body>

</html>
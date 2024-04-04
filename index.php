<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GIEO Gita : Join GIEO Gita</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/header.css">
  <style>
    body {
      background: #f7e092;
    }

    form {
      max-width: 900px;
      margin: auto;
    }

    .form-label {
      font-size: 1rem;
    }

    .background-frame {
      height: 100vh;
      width: 100vw;
      z-index: -1;
      position: fixed;
      top: 0;

    }

    .background-frame iframe {
      height: 100%;
      min-width: 100%;
      opacity: 0.2;
      pointer-events: none;

    }

    #joinForm>div {

      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      justify-content: center;
      align-items: center;
    }

    #joinForm>div>div,
    span {
      flex: 1 0 300px;
    }
  </style>
</head>

<body class="position-relative">
  <div class="background-frame position-fixed top-0 right-0">
    <iframe id="myIframe" src="https://gieogita.org/auto-tour/" frameborder="0"></iframe>
  </div>

  <!-- ================Toast =========== -->
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="phtoast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <img width="20px"
          src="https://static.vecteezy.com/system/resources/thumbnails/017/172/379/small/warning-message-concept-represented-by-exclamation-mark-icon-exclamation-symbol-in-triangle-png.png"
          class="rounded me-2" alt="...">
        <strong class="me-auto text-danger">Phone No Error!</strong>
        <small>1 mins ago</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        Mobile Number Already Exist.
      </div>
    </div>
  </div>
  <!-- ====================Toast End======================================== -->



  <?php
  include 'partials/_header.php';
  ?>


  <div class="container shadow-sm py-3 rounded my-2">
    <div class="text-center">
      <h4>
        Already a member - <a href="view-profile.php" class="btn btn-danger p-4 py-2 p"><b>View Profile</b></a>
      </h4>
    </div>
  </div>

  <div class="container shadow py-3 rounded my-2">
    <h2 class="text-center text-danger  py-3 fw-bold">Join GIEO Gita</h2>
    <form method="POST" action="submit.php" id="joinForm">
      <div>
        <div class="bg-warning-subtle p-2 py-2 rounded ">
          <label class="form-label form-label-sm" for="countrySelect">Select Country</label>
          <select id="countrySelect" name="country" class="form-select " aria-label="Small select example" required="">
            <option selected="">---Country---</option>
            <option value="Australia" datavalue="13" sortname="AU">Australia</option>
            <option value="Canada" datavalue="38" sortname="CA">Canada</option>
            <option value="India" datavalue="101" sortname="IN" selected="true">India</option>
            <option value="Japan" datavalue="109" sortname="JP">Japan</option>
            <option value="New Zealand" datavalue="157" sortname="NZ">New Zealand</option>
            <option value="United Arab Emirates" datavalue="229" sortname="AE">United Arab Emirates</option>
            <option value="United Kingdom" datavalue="230" sortname="GB">United Kingdom</option>
            <option value="United States" datavalue="231" sortname="US">United States</option>
          </select>
        </div>
        <div class="bg-warning-subtle p-2 py-2 rounded ">
          <label class="form-label form-label-sm" for="name">Enter Name</label>
          <input name="name" id="name" type="text" max="10" class="form-control"
            onkeypress="return blockNumbers(event)">
        </div>
        <div class="bg-warning-subtle p-2 py-2 rounded ">
          <label class="form-label form-label-sm" for="phone">WhatsApp Number(without country code)</label>
          <input id="phone" name="phone" type="text" class="form-control" inputmode="numeric" pattern="[0-9]*"
            onkeypress="return blockChars(event)" required>
        </div>
        <div class="bg-warning-subtle p-2 py-2 rounded ">
          <label class="form-label form-label-sm" for="email">Enter Email</label>
          <input id="email" name="email" type="email" class="form-control" oninput="convertToLowercase(this)">
        </div>
        <div class="bg-warning-subtle p-2 py-2 rounded ">
          <label class="form-label form-label-sm" for="dikshit">Dikshit</label>
          <select id="dikshit" name="dikshit" class="form-select " aria-label="Small select example">
            <option value="" selected>---Dikshit/दीक्षित परिवार---</option>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
            <option value="No But Interested">No, But Intrested</option>
          </select>
        </div>
        <div class="bg-warning-subtle p-2 py-2 rounded ">
          <label class="form-label form-label-sm" for="stateSelect">Select State</label>
          <select id="stateSelect" name="state" class="form-select " aria-label="Small select example">
            <option selected>---State---</option>
          </select>
        </div>
        <div class="bg-warning-subtle p-2 py-2 rounded ">
          <label class="form-label form-label-sm" for="citySelect">Select District</label>
          <input list="citySelect" type="text" name="district" class="form-select " aria-label="Small select example">
          <datalist id="citySelect">
          </datalist>
        </div>
        <div class="bg-warning-subtle p-2 py-2 rounded ">
          <label class="form-label form-label-sm" for="tehsilSelect">Select Tehsil</label>
          <input list="tehsilSelect" type="text" name="tehsil" class="form-select " aria-label="Small select example">
          <datalist id="tehsilSelect">
          </datalist>
        </div>

        <div class="bg-warning-subtle p-2 py-2 rounded ">
          <label class="form-label form-label-sm" for="address">Address</label>
          <input name="address" id="address" type="text" class="form-control">
        </div>
        <div class="bg-warning-subtle p-2 py-2 rounded ">
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
          </select>
        </div>
        <div class="bg-warning-subtle p-2 py-2 rounded ">
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
          </select>
        </div>
        <div class="bg-warning-subtle p-2 py-2 rounded ">
          <label class="form-label form-label-sm" for="married">Marital Status</label>
          <select name="married" id="married" class="form-select " onchange="aniver()">
            <option value="">-- select Marital Status --</option>
            <option value="Married" aria-selected="false">Married</option>
            <option value="Single" aria-selected="false">Single</option>
          </select>
        </div>
        <div class="bg-warning-subtle p-2 py-2 rounded ">
          <label class="form-label form-label-sm" for="dob">Date of Birth</label>
          <input name="dob" id="dob" type="date" class="form-control" required>
        </div>
        <span id="aniversry">

        </span>
      </div>
      <div class="text-center mt-4 my-3">
        <button type="submit" name="joinsubmit" class="btn btn-danger">Join Now</button>
      </div>
    </form>
  </div>
  <?php
  // include 'partials/_footer.php';
  ?>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
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
  <script src="statelist.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
  <script src="js/script.js"></script>
  <script src="js/another.js"></script>
  <!-- <script src="js/formLang.js"></script> -->
  <script>
    window.onload = function () {
      var iframe = document.getElementById('myIframe');
      var innerDoc = iframe.contentDocument || iframe.contentWindow.document;
      var audioElements = innerDoc.getElementsByTagName('audio');

      // Mute all audio elements within the iframe
      for (var i = 0; i < audioElements.length; i++) {
        audioElements[i].muted = true;
      }
    };
  </script>
  <?php
  if (isset($_GET['dphoneExiit']))
  {
    $pnot = false;
    $pnot = $_GET['dphoneExiit'];
    if ($pnot == true)
    {
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
</body>

</html>
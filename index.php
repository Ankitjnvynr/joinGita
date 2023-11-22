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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="style.css" />
  <title>Join GIEO Gita</title>
</head>

<body>
  <!-- ================Toast =========== -->
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="phtoast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <img width="20px" src="https://static.vecteezy.com/system/resources/thumbnails/017/172/379/small/warning-message-concept-represented-by-exclamation-mark-icon-exclamation-symbol-in-triangle-png.png" class="rounded me-2" alt="...">
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
  <div class="container p-2 p-md-4  shadow-lg  my-3 rounded " style="padding-bottom: 1%;">
    <div class="text-center">
      <h4>
        Already a member - <a href="view-profile.php" class="btn btn-danger p-4 py-2 p"><b>View Profile</b></a>
      </h4>
    </div>
    <hr>



    <div class="container " id="main">
      <div class="d-flex align-items-center justify-content-end float-end" style="width: 500px;">
        <span class="mr-2">Language:</span>
        <select class="form-control-sm  mx-2" id="lang">
          <option value="ENG" selected>ENG</option>
          <option value="HIN">HIN</option>
        </select>
      </div>
    </div>



    <form id="joinForm" class="" style="padding-bottom: 1%;" method="POST" action="submit.php"></form>


    </form>
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
  <script src="statelist.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
  <script src="js/script.js"></script>
  <script src="js/another.js"></script>
  <script src="js/formLang.js"></script>


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

</body>

</html>
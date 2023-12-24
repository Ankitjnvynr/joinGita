<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body {
      background: #f7e092;
    }

    .picbg {
      background: rgb(34, 193, 195);
      background: linear-gradient(0deg, rgba(34, 193, 195, 0) 52%, rgba(255, 0, 0, 0.2) 53%);
    }
  </style>
</head>


<body>
  <div class="container">
    <div class="row mt-3">
      <div class="card p-0 overflow-hidden" style="width: 18rem;">
        <div class="d-flex picbg">
          <div style="width:32%" class="pic relative m-2">
            <img style="border:2px solid white" class="absolute rounded-circle bg-white border-white" width="90px" src="imgs\defaultusergh.png" alt="Profile">
          </div>
          <div class="name d-flex flex-column justify-content-center">
            <h2 class="card-title py-2">Ankit</h2>
            <div class="phone d-flex gap-2 text-danger align-items-center"> 8888888888 <a href=""><i class="fa-solid fa-phone rounded-circle shadow p-2 text-success fs-5"></i> </a><a href="#"><i class="fa-solid fs-5 rounded-circle shadow p-2 fa-brands fa-whatsapp text-success "></i></a></div>
          </div>
        </div>
        <hr class="m-2 mx-3 ">
        <div class="d-flex flex-column p-3">
          buttom
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>
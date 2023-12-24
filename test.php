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
      background: linear-gradient(0deg, rgba(34, 193, 195, 0) 52%, rgba(255, 0, 0, 1) 53%);
    }
  </style>
</head>


<body>
  <div class="container">
    <div class="row mt-3">
      <div class="card p-0 overflow-hidden" style="width: 18rem;">
        <div class="d-flex picbg">
          <div style="width:30%" class="pic relative m-2">
            <img class="absolute rounded-circle bg-white border-white" width="70px" src="imgs\defaultusergh.png" alt="Profile">
          </div>
          <div class="name">
            <h2 class="card-title">Ankit</h2>
            <div class="phone d-flex gap-3 text-danger"> 8888888888 <a href=""><i class="fa-solid fa-phone text-success fs-4"></i> </a><a href="#"><i class="fa-solid fs-3 fa-brands fa-whatsapp text-success "></i></a></div>
          </div>
        </div>
        <div class="d-flex flex-column">
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
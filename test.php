<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body {
      background: #f7e092;
    }

    * {
      box-sizing: border-box;
    }

    .picbg {
      background: rgb(34, 193, 195);
      background: linear-gradient(0deg, rgba(34, 193, 195, 0) 65%, rgba(255, 0, 0, 0.1) 35%);
    }

    .cardbox {
      transition: all 1s;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 500px));
      gap: 20px;
      /* grid-template-columns: repeat( auto-fill, minmax(300px, auto) ); */
      grid-template-columns: repeat(auto-fill, minmax(max-content, auto));
      justify-content: center;
      /* grid-template-columns: repeat(auto-fill, 40px);   */
    }

    .card {
      width: 100%;
      transition: all 1s;
    }

    .table td,
    .table {
      padding: 0;
      margin: 0;
    }

    .table {
      width: 100%;
    }
  </style>
</head>


<body>
  <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Profile</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-danger">Update</button>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row mt-3 cardbox">
      <!-- <div class="profile">

      </div> -->
      <div class="card p-0 overflow-hidden">
        <div class="d-flex picbg">
          <div style="width:25%" class="pic relative m-2">
            <img style="border:2px solid white" class="absolute rounded-circle bg-white border-white" width="100%"
              src="imgs\defaultusergh.png" alt="Profile">
            <p class="d-flex gap-2 flex-items-center justify-content-center px-2 m-0">
              <a href=""><i class="fa-solid fa-phone text-success fs-4"></i> </a>
              <a href="#"><i class="fa-solid fs-4  fa-brands fa-whatsapp text-success "></i></a>
              <a href="#"><i class="fa-solid fs-4   fa-envelope text-success "></i></a>
            </p>
          </div>
          <div style="width:67%" class="name d-flex flex-column justify-content-around">
            <h2 class="card-title m-0 p-0">Ankit</h2>
            <div class="phone d-flex flex-column-reverse text-danger  align-items-around">
              <table class="table">
                <tbody>
                  <tr>
                    <td>Samuh:</td>
                    <td>GIEO Gita</td>
                  </tr>
                  <tr>
                    <td>Phone:</td>
                    <td>8888888888</td>
                  </tr>
                  <tr>
                    <td>Email:</td>
                    <td>ankitbkana@outlook.com</td>
                  </tr>
                </tbody>
              </table>
              <!-- <p class="m-0">8888888888</p>
              <p class="m-0">ankitbkana@outlook.com</p> -->
            </div>
          </div>
        </div>
        <hr class="m-0 mx-3 ">
        <div class="d-flex gap-2 p-3">
          <div class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit</div>
          <div class="btn btn-danger">Delete</div>
        </div>
      </div>
      <div class="card p-0 overflow-hidden">
        <div class="d-flex picbg">
          <div style="width:25%" class="pic relative m-2">
            <img style="border:2px solid white" class="absolute rounded-circle bg-white border-white" width="100%"
              src="imgs\defaultusergh.png" alt="Profile">
            <p class="d-flex gap-2 flex-items-center justify-content-center px-2 m-0">
              <a href=""><i class="fa-solid fa-phone text-success fs-4"></i> </a>
              <a href="#"><i class="fa-solid fs-4  fa-brands fa-whatsapp text-success "></i></a>
              <a href="#"><i class="fa-solid fs-4   fa-envelope text-success "></i></a>
            </p>
          </div>
          <div style="width:67%" class="name d-flex flex-column justify-content-around">
            <h2 class="card-title m-0 p-0">Ankit</h2>
            <div class="phone d-flex flex-column-reverse text-danger  align-items-around">
              <table class="table">
                <tbody>
                  <tr>
                    <td>Samuh:</td>
                    <td>GIEO Gita</td>
                  </tr>
                  <tr>
                    <td>Phone:</td>
                    <td>8888888888</td>
                  </tr>
                  <tr>
                    <td>Email:</td>
                    <td>ankitbkana@outlook.com</td>
                  </tr>
                </tbody>
              </table>
              <!-- <p class="m-0">8888888888</p>
              <p class="m-0">ankitbkana@outlook.com</p> -->
            </div>
          </div>
        </div>
        <hr class="m-0 mx-3 ">
        <div class="d-flex gap-2 p-3">
          <div class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit</div>
          <div class="btn btn-danger">Delete</div>
        </div>
      </div>

      <div class="card p-0 overflow-hidden">
        <div class="d-flex picbg">
          <div style="width:25%" class="pic relative m-2">
            <img style="border:2px solid white" class="absolute rounded-circle bg-white border-white" width="100%"
              src="imgs\defaultusergh.png" alt="Profile">
            <p class="d-flex gap-2 flex-items-center justify-content-center px-2 m-0">
              <a href=""><i class="fa-solid fa-phone text-success fs-4"></i> </a>
              <a href="#"><i class="fa-solid fs-4  fa-brands fa-whatsapp text-success "></i></a>
              <a href="#"><i class="fa-solid fs-4   fa-envelope text-success "></i></a>
            </p>
          </div>
          <div style="width:67%" class="name d-flex flex-column justify-content-around">
            <h2 class="card-title m-0 p-0">Ankit</h2>
            <div class="phone d-flex flex-column-reverse text-danger  align-items-around">
              <table class="table text-muted">
                <tbody>
                  <tr>
                    <td>Samuh:</td>
                    <td>GIEO Gita</td>
                  </tr>
                  <tr>
                    <td>Phone:</td>
                    <td>8888888888</td>
                  </tr>
                  <tr>
                    <td>Email:</td>
                    <td>ankitbkana@outlook.com</td>
                  </tr>
                </tbody>
              </table>
              <!-- <p class="m-0">8888888888</p>
              <p class="m-0">ankitbkana@outlook.com</p> -->
            </div>
          </div>
        </div>
        <hr class="m-0 mx-3 ">
        <div class="d-flex gap-2 p-3">
          <div class="btn btn-danger"  data-bs-toggle="modal" data-bs-target="#staticBackdrop">Edit</div>
          <div class="btn btn-danger">Delete</div>
        </div>
      </div>

    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>

</html>
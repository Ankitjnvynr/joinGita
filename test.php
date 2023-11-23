<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <style>
    #lan-eng::selection~#main {
      background: red;
    }
  </style>
</head>

<body>
  <div class="container" id="main">
    <select width="50px" class="form-control" id="lang">
      <option value="ENG" selected>ENG</option>
      <option value="HIN">HIN</option>
    </select>
  </div>
  





<div class="container">
  <form id="joinForm" class="" style="padding-bottom: 1%;" method="POST" action="submit.php"></form>
  </div>











  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="js/formLang.js"></script>
  <script>
    
  </script>
</body>

</html>
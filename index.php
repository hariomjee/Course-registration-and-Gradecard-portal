<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="/online course registration system/global/css/bootstrap.min.css">
  <link rel="stylesheet" href="/online course registration system/global/css/font-awesome.min.css">

  <link rel="stylesheet" href="/online course registration system/index.css">
  <title>Student Login</title>
</head>
<br>
<body style="background-image: url('/online course registration system/back1.jpg');background-repeat: no-repeat;
  background-size: cover;background-size: 100% 100%;">

  <div class="container ">
    <div class="col-md-12 text-center mt-5">
      <!--  making items into centre -->
      <p class="  font-weight-normal text-info mt-5 display-4 ">TEZPUR UNIVERSITY</p>
      <p class=" font-weight-normal text-info">ONLINE PORTAL FOR COURSE REGISTRATION</p>

      <div class="button_login my-5">
        <button type="button" class="btn btn-info btn-circle btn-xl mx-5" id="student" onclick="slogin()">Student Login</button>
        <button type="button" class="btn btn-info btn-circle btn-xl mx-5" id="Admin" onclick="Alogin()">Admin/Faculty Login</button>
      </div>
    </div>
  </div>

  <script>
    function slogin() {
      window.location.replace("/online course registration system/slogin.php");
    }

    function Alogin(){
      window.location.replace("/online course registration system/Admin/Alogin.php");
    }
  </script>

  <!-- JS, Popper.js, and jQuery -->
  <script src="/online course registration system/global/js/jquery.min.js"></script>
  <script src="/online course registration system/global/js/popper.min.js"></script>
  <script src="/online course registration system/global/js/bootstrap.min.js"></script>
  <script src="/online course registration system/global/js/bootstrap.min.js"></script>
  <script src="/online course registration system/slogin.js"></script>
  </div>


</body>

</html>
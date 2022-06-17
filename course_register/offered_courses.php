

<!-- for getting Admin name from server we write below php code -->


<?php
session_start();
if (isset($_SESSION["userid"])) {

  $admin = $_SESSION["username"];
} else {
  echo "You are not a valid user";
  header("Location: http://online course registration system/slogin.php");
  exit();
}

?>


<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Offered Courses</title>
  <link rel="stylesheet" href="/online course registration system/global/css/bootstrap.min.css">
  <link rel="stylesheet" href="/online course registration system/global/css/font-awesome.min.css">
</head>
<body  style="background-image: url('/online course registration system/back2.jpg');background-repeat: no-repeat;
  background-size: cover;background-size: 100% 100%;">
<header>

<nav class="navbar navbar-expand-lg  navbar-dark bg-dark  justify-content-start ">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link " href="/online course registration system/Admin/AdminHome.php">Home <span class="sr-only">(current)</span></a>
          <a class="nav-link " href="/online course registration system/Admin/student_details.php">Add Students</a>
          <a class="nav-link " href="/online course registration system/course_register/master_course.php">Edit Master Course</a>
          <a class="nav-link active" href="/online course registration system/course_register/offered_courses.php">Edit Offered Course</a>
          <a class="nav-link " href="/online course registration system/Admin/courseRegistrationDetails.php">Course Registration Details</a>
          <a class="nav-link " href="/online course registration system/gradecard.php">Grade Cards</a>
          <a class="nav-link " href="/online course registration system/Admin/addfaculty.php">Add faculty</a>
          <a class="nav-link " href="#"> <span>
          <?php echo $admin; ?>

            </span></a>
            <a class="nav-link " href="/online course registration system/index.php">Logout</a>

        </div>
      </div>
    </nav>
</header>

  <div class="container">
    <div class="row mt-2">
      <div class="col d-flex justify-content-center text-uppercase mt-3">
        <h3>Offered Courses</h3>
      </div>
    </div>
    <div class="row">
      <div class="col d-flex justify-content-center mt-3 text-uppercase" id="depart">
    </div>
  </div>
    

  <div class="row">
    <div class="col d-flex justify-content-center mt-3 text-uppercase" id="program">

      <!-- program details -->
     </div>
  </div>

<div class="row">
  <div class="col d-flex justify-content-center mt-3">
      <div class="button" id="semester">

        <!-- semester buttons -->

      </div>
    </div>
  </div>
    


    <div class="row">
      <div class="col" id="getDiv"></div>

          <!-- All details -->

    </div>

  </div>
  </div>
  </div>


  </div>




  <!-- JS, Popper.js, and jQuery -->
  <script src="/online course registration system/global/js/jquery.min.js"></script>
  <script src="/online course registration system/global/js/popper.min.js"></script>
  <script src="/online course registration system/global/js/bootstrap.min.js"></script>
  <script src="/online course registration system/global/js/bootstrap.min.js"></script>
  <script src="/online course registration system/course_register/offered_courses.js"></script>


  </div>



</body>

</html>
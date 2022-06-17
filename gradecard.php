

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
  <title>Grade Card</title>
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
          <a class="nav-link " href="/online course registration system/course_register/offered_courses.php">Edit Offered Course</a>
          <a class="nav-link " href="/online course registration system/Admin/courseRegistrationDetails.php">Course Registration Details</a>
          <a class="nav-link active" href="/online course registration system/gradecard.php">Grade Cards</a>
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

    <div class="row">
      <div class="col d-flex justify-content-center mt-3">
        <h3>Grade Card</h3>
      </div>

    </div>


    <div class="row">
      <div class="col  mt-3  d-flex justify-content-center" id="session">

        <!-- session details -->
      </div>
    </div>

    <div class="row">
      <div class="col  mt-3  d-flex justify-content-center " id="program">

        <!-- program details -->
      </div>
    </div>

    <div class="row">
      <div class="col  mt-3 " id="program">

        <button type="button" class="btn btn-success float-right" id="btn-go">Go</button>
      </div>
    </div>


    <div class="row">
      <div class="col  mt-3 d-flex justify-content-center" id="gradecard">
        <!-- grade card details -->
        <!-- <iframe src="pdf.php" width="800" height="500" ></iframe> -->
        
      </div>
    </div>




  </div>








  <!-- JS, Popper.js, and jQuery -->
  <script src=" /online course registration system/global/js/jquery.min.js"></script>
  <script src="/online course registration system/global/js/popper.min.js"></script>
  <script src="/online course registration system/global/js/bootstrap.min.js"></script>
  <script src="/online course registration system/global/js/bootstrap.min.js"></script>
  <script src="/online course registration system/gradecard.js"></script>

  <input type="hidden" name="programId" id="programid" value="<?php echo  $program_id; ?>">
</body>

</html>


<?php
// session_start();
// if (isset($_SESSION["studentid"])) {
//     $name = $_SESSION["studentname"];
//     $current_sem = ($_SESSION["Current_session"] - $_SESSION["studentAdmitted"]) + 1;
//     $program_name =  $_SESSION["Program_name"];
//     $roll_no= $_SESSION["Roll_no"];
//     $depart_name= $_SESSION["Depart_name"];
// } else {
//     echo "You are not a valid user";
//     header("Location: http://online course registration system/slogin.php");
//     exit();
// }


?>
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
  <title>Student_detalis</title>
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
          <a class="nav-link active" href="/online course registration system/Admin/student_details.php">Add Students</a>
          <a class="nav-link " href="/online course registration system/course_register/master_course.php">Edit Master Course</a>
          <a class="nav-link " href="/online course registration system/course_register/offered_courses.php">Edit Offered Course</a>
          <a class="nav-link " href="/online course registration system/Admin/courseRegistrationDetails.php">Course Registration Details</a>
          <a class="nav-link " href="/online course registration system/gradecard.php">Grade Cards</a>
          <a class="nav-link " href="/online course registration system/Admin/addfaculty.php">Add faculty</a>
          <a class="nav-link " href="/online course registration system/index.php">Logout</a>
          <a class="nav-link " href="#"> <span>

              <?php echo $admin; ?>

            </span></a>
            
        </div>
      </div>
    </nav>
  </header>

  <div class="container">
    <div class="row mt-3 text-uppercase">
      <div class="col d-flex justify-content-center">
        <h3>Student detalis</h3>
      </div>
      <!-- <div class="col d-flex justify-content-end">
      </div> -->

    </div>
    <div class="row">
      <div class="col mt-3" id="session" >
        
        </div>
      <form id="upload_csv" action="/online course registration system/Admin/upload_csv.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
          <div class="col">
            <input type="file" name="file" id="csv_file" accept=".csv" style="margin-top:15px;" />
          </div>
          <div class="col">
            <button class="btn btn-info mt-3" type="submit" name="import">Import</button>
          </div>
          <div style="clear:both"></div>
        </div>
      </form>

    </div>
    
    <div class="container border border-info mt-3" id="stdDiv">
      <!-- student details -->
    </div>
  </div>


    <div>

      <!-- JS, Popper.js, and jQuery -->
      <script src="/online course registration system/global/js/jquery.min.js"></script>
      <script src="/online course registration system/global/js/popper.min.js"></script>
      <script src="/online course registration system/global/js/bootstrap.min.js"></script>
      <script src="/online course registration system/global/js/bootstrap.min.js"></script>
      <script src="/online course registration system/Admin/student_details.js"></script>
    </div>

    <!-- <input type="hidden" name="facultyId" id="facultyId" value="">
  <input type="hidden" name="term_type" id="termYear" value="SPRING SEMESTER">
  <input type="hidden" name="term_year" id="termType" value="2022">
  <input type="hidden" name="currentDeptId" id="currentDeptId" value="-2"> -->

</body>

</html>
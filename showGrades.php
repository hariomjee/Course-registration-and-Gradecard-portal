<?php
session_start();
if (isset($_SESSION["studentid"])) {

    $studentId=$_SESSION["studentid"];
    $name = $_SESSION["studentname"];
    $current_sem = ($_SESSION["Current_session"] - $_SESSION["studentAdmitted"]) + 1;
    $program_name =  $_SESSION["Program_name"];
    $roll_no= $_SESSION["Roll_no"];
    $depart_name= $_SESSION["Depart_name"];
    $no_of_sem= $_SESSION["No_of_sem"];
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
    <title>Show grade</title>
    <link rel="stylesheet" href="/online course registration system/global/css/bootstrap.min.css">
    <link rel="stylesheet" href="/online course registration system/global/css/font-awesome.min.css">
</head>


<body  style="background-image: url('/online course registration system/back2.jpg');background-repeat: no-repeat;
  background-size: cover;background-size: 100% 100%;">
    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
      <button type="button" class="btn btn-info btn-circle btn-sm" id="Home" style="width: 60px; height: 60px; padding: 7px 10px;
            border-radius: 30px; font-size: 13px; text-align: center;">HOME</button>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active addmarginsm my-2">
            <a class="btn btn-info mx-2 text-uppercase" style="font-size:13px;width:170px" href="/online course registration system/course_register/course_registration.php">Course Registration <span class="sr-only">(current)</span></a>
          </li>

          <li class="nav-item active addmarginsm my-2">
            <a class="btn btn-info mx-2 text-uppercase" style="font-size:13px;width:170px" href="/online course registration system/course_register/previous_sem.php">Previouse Semester</a>
          </li>

          <li class="nav-item active addmarginsm my-2">
                        <a class="btn btn-info mx-2 text-uppercase" style="font-size:13px;width:150px" id="showgrade" href="/online course registration system/showGrades.php">grade card <span class="sr-only">(current)</span>
                    </a>
                    </li>

          <li class="nav-item active addmarginsm my-2">
            <a class="btn btn-info mx-2 text-uppercase" style="font-size:13px;width:150px" href="/online course registration system/index.php">Logout <span class="sr-only">(current)</span></a>
          </li>

          <li>
            <a class="nav-link active float-right text-light text-uppercase" href="#"> <?php echo "Welcome:" . " " . $name; ?></a>
          </li>

        </ul>

      </div>
    </nav>
    </header>
    <br>

    <main class="mainContainer makefullscreen">
        <div class="container">
            <div class="row">
                <div class="col" id="showGrades"></div>
            </div>
        </div>
    </main>
    <!-- JS, Popper.js, and jQuery -->
    <script src="/online course registration system/global/js/jquery.min.js"></script>
    <script src="/online course registration system/global/js/popper.min.js"></script>
    <script src="/online course registration system/global/js/bootstrap.min.js"></script>
    <script src="/online course registration system/global/js/bootstrap.min.js"></script>
    <script src="/online course registration system/showGrades.js"></script>
    </div>
<input type="hidden" name="studentId" id="studentId" value=" <?php  echo $studentId    ?>      ">
<!-- <input type="hidden" name="term_type" id="termYear" value="SPRING SEMESTER">
<input type="hidden" name="term_year" id="termType" value="2022">
<input type="hidden" name="currentDeptId" id="currentDeptId" value="-2"> -->

</body>

</html>
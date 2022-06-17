<?php
$rootpath = $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/online course registration system/database/db_con.php";
$dbo = new DatabaseConnection();


session_start();
if (isset($_SESSION["studentid"])) {
  // $name = $_SESSION["studentname"];
  $name = $_SESSION["studentname"];                         // we put these value into session already in Home.php file. We again took that from session and in end of this file we put these session value into a id by that we can access into js file.
  $current_session = $_SESSION["Current_session"];
  $admitted_session = $_SESSION["studentAdmitted"];
  $no_of_sem = $_SESSION["No_of_sem"];
  $program_name =  $_SESSION["Program_name"];
  $program_id = $_SESSION["studentProgram"];
  $current_sem = ($_SESSION["Current_session"] - $_SESSION["studentAdmitted"]) + 1;
  $curr_Ses = "SELECT * from session_details WHERE s_id=:sid ";   // :sid is a vairiale we took
  $temp = $dbo->conn->prepare($curr_Ses);
  $temp->execute([":sid" => $current_session]);   // check curren_session value is = :pid or not

  if ($temp->rowCount() > 0) {

    $rv = $temp->fetchAll(PDO::FETCH_ASSOC);
    // print_r($rv);
    $term_year = $rv[0]['term_year'];
    $term_type = $rv[0]['term_type'];
  }

  $_SESSION["term_year"] = $term_year;
  $_SESSION["term_type"] = $term_type;
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
  <title>Course_registration</title>
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
            <a class="nav-link active float-right text-uppercase text-light" href="#"> <?php echo "Welcome" . " " . $name; ?></a>
          </li>

        </ul>

      </div>
    </nav>
  </header>
  <br>
  <div class="container">
    <div class="col d-flex justify-content-center">
      <h3 class="text-uppercase">Course_registration</h3>
    </div>
  </div>

  <div class="row">
    <div class="col d-flex justify-content-center mt-2">
      <label class="text-info text-uppercase"> Session: &nbsp;</label>
      <div class="dropdown text-uppercase" id="session">

      </div>
    </div>
  </div>


  <div class="row">
    <div class="col d-flex justify-content-center mt-2">
      <label class="text-info text-uppercase ">
        Program -
        <?php
        echo $program_name;
        ?>
      </label>
    </div>

  </div>





  <!-- Semester details -->
  <div class="row">
    <div class="col d-flex justify-content-center" id="semester">

    </div>
  </div>

  <div class="row">
    <div class="col mt-2" id="offered_courses">




    </div>
  </div>








  <!-- JS, Popper.js, and jQuery -->
  <script src="/online course registration system/global/js/jquery.min.js"></script>
  <script src="/online course registration system/global/js/popper.min.js"></script>
  <script src="/online course registration system/global/js/bootstrap.min.js"></script>
  <script src="/online course registration system/global/js/bootstrap.min.js"></script>
  <script src="/online course registration system/course_register/course_registration.js"></script>


  </div>

  <input type="hidden" name="facultyId" id="studentid" value="<?php echo $_SESSION["studentid"]; ?>">
  <input type="hidden" name="programId" id="programid" value="<?php echo  $program_id; ?>">
  <input type="hidden" name="currentSem" id="currentSem" value="<?php echo $current_sem; ?>">
  <input type="hidden" name="currentSession" id="currentSession" value="<?php echo $current_session; ?>">
  <input type="hidden" name="programId" id="admitSession" value="<?php echo $admitted_session; ?>">
    <input type="hidden" name="no_of_sem" id="no_of_sem" value="<?php echo $no_of_sem; ?>">
  <!-- we use this for storing session value in a id and  by this we can use it into .js file -->

</body>

</html>
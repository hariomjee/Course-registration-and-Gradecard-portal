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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Home</title>
  <link rel="stylesheet" href="/online course registration system/global/css/bootstrap.min.css">
  <link rel="stylesheet" href="/online course registration system/global/css/font-awesome.min.css">
</head>
<body  style="background-image: url('/online course registration system/back2.jpg');background-repeat: no-repeat;
  background-size: cover;background-size: 100% 116%;">
  <header>
    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark  justify-content-start ">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link active" href="/online course registration system/Admin/AdminHome.php">Home <span class="sr-only">(current)</span></a>
          <a class="nav-link " href="/online course registration system/Admin/student_details.php">Add Students</a>
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


  <div class="container float-right">

    <div class="row float-right ">

      <div class="" id="Add_students" style=" height: 200px; display: flex;
    align-items: center;
    width: 250px;
    justify-content: space-around; 
    border-radius: 50%;
    background: rgb(6, 184, 207);
    color: rgb(249, 255, 251);font-weight: bolder;
    padding: 1%;
    margin:50px;">
        <a href="/online course registration system/Admin/student_details.php"> Add Students </a>
      </div>


      <div class="" id="Master_course" style=" height: 200px; display: flex;
    align-items: center;
    width: 250px;
    justify-content: space-around; 
    border-radius: 50%;
    background: rgb(6, 184, 207);
    color: rgb(249, 255, 251);font-weight: bolder;
    padding: 1%;
    margin:50px;">
        <a href="/online course registration system/course_register/master_course.php">Edit Master Courses</a>
      </div>


      <div class="" id="offered_course" style=" height: 200px; display: flex;
    align-items: center;
    width: 250px;
    justify-content: space-around; 
    border-radius: 50%;
    background: rgb(6, 184, 207);
    color: rgb(249, 255, 251);font-weight: bolder;
    padding: 1%;
    margin:50px;">
        <a href="/online course registration system/course_register/offered_courses.php"> Edit offered Courses</a>
      </div>

      <div class="" id="Grade_cards" style=" height: 200px; display: flex;
    align-items: center;
    width: 250px;
    justify-content: space-around; 
    border-radius: 50%;
    background: rgb(6, 184, 207);
    color: rgb(249, 255, 251);font-weight: bolder;
    padding: 1%;
    margin:50px;">
        <a href="/online course registration system/Admin/addfaculty.php"> Add faculty </a>
      </div>

      <div class="" id="Course_registration" style=" height: 200px; display: flex;
    align-items: center;
    width: 250px;
    justify-content: space-around; 
    border-radius: 50%;
    background: rgb(6, 184, 207);
    color: rgb(249, 255, 251);font-weight: bolder;
    padding: 1%;
    margin:50px;">
        <a href="/online course registration system/Admin/courseRegistrationDetails.php"> Course_registration </a>
      </div>


      <div class="" id="Grade_cards" style=" height: 200px; display: flex;
    align-items: center;
    width: 250px;
    justify-content: space-around; 
    border-radius: 50%;
    background: rgb(6, 184, 207);
    color: rgb(249, 255, 251);font-weight: bolder;
    padding: 1%;
    margin:50px;">
        <a href="/online course registration system/gradecard.php"> Grade Cards </a>
      </div>

    

    </div>




  </div>














  <!-- JS, Popper.js, and jQuery -->
  <script src=" /online course registration system/global/js/jquery.min.js">
  </script>
  <script src="/online course registration system/global/js/popper.min.js"></script>
  <script src="/online course registration system/global/js/bootstrap.min.js"></script>
  <script src="/online course registration system/global/js/bootstrap.min.js"></script>
  <script src="/online course registration system/Admin/AdminHome.js"></script>
</body>

</html>
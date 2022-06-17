

<!-- for getting Admin name from server we write below php code -->

<?php

$rootpath = $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/online course registration system/database/db_con.php";
$dbo = new DatabaseConnection();
session_start();
if (isset($_SESSION["userid"])) {
  $id=$_SESSION["userid"];
  $factname= $_SESSION["f_name"];
  $designation= $_SESSION["designation"];
  $depart_id=$_SESSION["d_id"];

  $q="SELECT * FROM `department_details` WHERE d_id=:did";

  $templet1 = $dbo->conn->prepare($q);
  $templet1->execute([":did" => $depart_id]);

  if ($templet1->rowCount()>0){

   $rv1 = $templet1->fetchAll(PDO::FETCH_ASSOC);
  
   $department_name=$rv1[0]['d_name'];
     

  }
}
  ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter Grade</title>
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
          <a class="nav-link " href="/online course registration system/Admin/facultyHome.php">Home <span class="sr-only">(current)</span></a>
          <a class="nav-link active" href="/online course registration system/grades.php">Enter grades</a>
          <a class="nav-link " href="#"> <span>

          <?php echo $factname; ?>
            </span></a>
            <a class="nav-link " href="/online course registration system/index.php">Logout</a>
        </div>
      </div>
    </nav>
</header>
<div class="container">
<div class="row">
  <div class="col  d-flex justify-content-center mt-3 text-uppercase">
    <h3>Grade Entry</h3> 
  </div>

</div>
<div class="row">
  <div class="col  mt-3  d-flex justify-content-center text-uppercase" id="session">
 </div>
</div>

<div class="row d-flex justify-content-center text-uppercase">
  <div class="col mt-3 d-flex justify-content-center text-uppercase" id="course">
 </div>
</div>
  
 <!-- get list of courses from table -->
 <div class="row">
 <div class="col" id="table1">

 </div>
 </div>

 <div class="col d-flex justify-content-end  mt-3">
    <button class="btn btn-success" style="width: 100px;" id="btn-go">GO</button>
  </div>

  
 <!-- get list of students from table -->
 <div class="row">
 <div class="col mt-3" id="table2">

 </div>
 </div>


</div>


      <!-- JS, Popper.js, and jQuery -->
        <script src="/online course registration system/global/js/jquery.min.js"></script>
        <script src="/online course registration system/global/js/popper.min.js"></script>
        <script src="/online course registration system/global/js/bootstrap.min.js"></script>
        <script src="/online course registration system/global/js/bootstrap.min.js"></script>
        <script src="/online course registration system/grades.js"></script>

        <input type="hidden" name="factname" id="factname" value="<?php echo $factname; ?>">
   </body>

</html>
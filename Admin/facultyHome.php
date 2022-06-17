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

//   $role= $_SESSION["role"];
  //echo $role;
 // echo $department_name;
 
 // echo $id;

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
  <title>Faculty Home</title>
  <style>
  
        #btn {
            text-align: center;
            height: 90px;
            width: 120px;
            display: block;
            font-size: 1.5em;
            background: #68E73C;
        }
  
        #btn:hover {
            animation: effect 0.4s infinite;
        }
  
        @keyframes effect {
            0% {
                transform: translateX(0px) rotate(0deg);
            }
  
            20% {
                transform: translateX(-4px) rotate(-4deg);
            }
  
            40% {
                transform: translateX(-2px) rotate(-2deg);
            }
  
            60% {
                transform: translateX(4px) rotate(4deg);
            }
  
            80% {
                transform: translateX(2px) rotate(2deg);
            }
  
            100% {
                transform: translateX(0px) rotate(0deg);
            }
        }
    </style>
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
          <a class="nav-link active" href="/online course registration system/Admin/facultyHome.php">Home <span class="sr-only">(current)</span></a>
          <a class="nav-link " href="/online course registration system/grades.php">Enter grades</a>
          <a class="nav-link " href="#"> <span>

              <?php echo $factname; ?>

            </span></a>
            <a class="nav-link " href="/online course registration system/index.php">Logout</a>
        </div>
      </div>
    </nav>
  </header>

  
  <main class="mainContainer makefullscreen">
        <div class="container">

            <div class="row rowMargin">
                <div class="col-12 d-flex justify-content-center ">
                    <div class="container ">
                        <div class="row">
                            <div class="col-3 d-flex justify-content-left">
                                <div class="d-flex flex-column justify-content-center align-items-start">
                                    <div class="text-dark  mt-5">
                                        <?php echo  "<h5>Name-</h5>"; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 d-flex justify-content-center">
                                <div class="d-flex flex-column justify-content-center align-items-start">
                                    <div class="text-dark  mt-5">
                                        <?php echo  "<h2> $factname</h2>"; ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                        <div class="col-3 d-flex justify-content-left">
                                <div class="d-flex flex-column justify-content-center align-items-start">
                                    <div class="text-dark mt-3  ">
                                        <?php echo  "<h5> Designation-</h5>"; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 d-flex justify-content-center">
                                <div class="d-flex flex-column justify-content-center align-items-start">
                                    <div class="text-dark  ">
                                        <?php echo  "<h5>$designation</h5>"; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        <div class="row">
                        <div class="col-3 d-flex justify-content-left">
                                <div class="d-flex flex-column justify-content-center align-items-start">
                                    <div class="text-dark mt-3 ">
                                        <?php echo  "<h5> Department-</h5>"; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 d-flex justify-content-center">
                                <div class="d-flex flex-column justify-content-center align-items-start">
                                    <div class="text-dark text-uppercase ">
                                        <?php echo  "<h5>$department_name</h5>"; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                          <div class="col d-flex justify-content-center mt-5">
                          <button class="button btn-lg rounded-lg  mb-2 bg-warning text-dark" id="btn">Enter grades</button>
                          </div>
                        </div>

                       



    </main>



    <!-- JS, Popper.js, and jQuery -->
    <script src=" /online course registration system/global/js/jquery.min.js">
  </script>
  <script src="/online course registration system/global/js/popper.min.js"></script>
  <script src="/online course registration system/global/js/bootstrap.min.js"></script>
  <script src="/online course registration system/global/js/bootstrap.min.js"></script>
  <script src="/online course registration system/Admin/facultyHome.js"></script>

  <!-- storing value into a id and by using that we can access those values into next page -->

  <input type="hidden" name="factname" id="factname" value="<?php echo $factname; ?>">
  <input type="hidden" name="designation" id="designation" value="<?php echo $designation; ?>">
  <input type="hidden" name="department_name" id="department_name" value="<?php echo $department_name; ?>">
  <input type="hidden" name="role" id="role" value="<?php echo $role; ?>">
</body>

</html>
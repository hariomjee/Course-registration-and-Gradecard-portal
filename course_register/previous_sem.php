<?php
session_start();
if (isset($_SESSION["studentid"])) {
    $name = $_SESSION["studentname"];
    $current_session= $_SESSION["Current_session"]; 
    $admitted_session= $_SESSION["studentAdmitted"];
    $program_name = $_SESSION["Program_name"];
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
    <title>Previous Semester</title>
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
                    <a class="nav-link active float-right text-light text-uppercase" href="#"> <?php echo "Welcome :" . " " . $name; ?></a>
                    </li>

                </ul>

            </div>
        </nav>
    </header>
<br>

    <div class="container">
            <div class="col d-flex justify-content-center text-uppercase">
             <h3>Previous_Semester</h3>
            </div>
        </div>

        <!-- Session details -->

 
        <div class="row">
            <div class="col d-flex justify-content-center mt-2">
                <label class="text-info text-uppercase"> Session: &nbsp;</label>
                <div class="dropdown text-uppercase" id="session">
                  
                </div>
            </div>
        </div>
    

        <div class="row">
            <div class="col d-flex justify-content-center mt-2" id="preCourse">
               
                
            </div>
        </div>
    




        </div>
     












    <input type="hidden" name="facultyId" id="studentid" value="<?php echo $_SESSION["studentid"]; ?>">
    <input type="hidden" name="programId" id="admitSession" value="<?php echo $admitted_session; ?>">
    <input type="hidden" name="currentSem" id="currentSession" value="<?php echo $current_session; ?>">
    
    <!-- JS, Popper.js, and jQuery -->
    <script src="/online course registration system/global/js/jquery.min.js"></script>
    <script src="/online course registration system/global/js/popper.min.js"></script>
    <script src="/online course registration system/global/js/bootstrap.min.js"></script>
    <script src="/online course registration system/global/js/bootstrap.min.js"></script>
    <script src="/online course registration system/course_register/previous_sem.js"></script>


    </div>


</body>

</html>
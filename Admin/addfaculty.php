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
  <title>Add faculty</title>
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
          <a class="nav-link " href="/online course registration system/gradecard.php">Grade Cards</a>
          <a class="nav-link active" href="/online course registration system/Admin/addfaculty.php">Add faculty</a>
          <a class="nav-link " href="#"> <span>

              <?php echo $admin; ?>

            </span></a>
            <a class="nav-link " href="/online course registration system/index.php">Logout</a>
            
        </div>
      </div>
    </nav>

  </header>
  <div class="container">
    <div class="row  mt-4">
      <div class="col d-flex justify-content-center text-uppercase">
        <h3>faculty Details</h3>
      </div>
    </div>
    <div class="row">
      <div class="col d-flex justify-content-center mt-4">
        <!-- Button trigger modal for Add value -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
          Add New
        </button>

        <!-- Modal for add value single -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body ">

                <div class="row">
                  <div class="col">
                    <label class="text-uppercase">name:</label>
                    <input class="text-uppercase" type="text" name="name" id="name" required="true">
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <label class="text-uppercase">Designation:</label>
                    <input type="text" name="Designation" id="Designation" required="true" />
                  </div>
                </div>
                <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle text-uppercase" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    department
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="dept">

                  </div>
                </div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" id="add_btn">Save</button>
              </div>
            </div>
          </div>
        </div>
      </div>


    </div>

    <!-- get list of faculty from table -->

    <div class="row">
      <div class="col mt-2" id="courseList">
        <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Name</th>
              <th scope="col">Designation</th>
              <th scope="col">Department</th>
              <th scope="col"> </th>
            </tr>
          </thead>
          <tbody class="text-uppercase" id="getbody">
          </tbody>
        </table>
      </div>

      <!-- Edit button -->


      <!-- Button trigger modal for edit value -->
      <div class="modal fade" id="editmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body ">
              <div class="row">
                <div class="col">
                  <label class="text-uppercase">name:</label>
                  <input class="text-uppercase" type="text" name="name" id="fname" required="true">
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <label class="text-uppercase">Designation:</label>
                  <input type="text" name="Designation" id="fDesignation" required="true" />
                </div>
              </div>
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle text-uppercase" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  department
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="dept1">

                </div>
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" data-dismiss="modal" id="edit_btn2">Edit</button>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  </div>
  <div>

    <!-- JS, Popper.js, and jQuery -->
    <script src="/online course registration system/global/js/jquery.min.js"></script>
    <script src="/online course registration system/global/js/popper.min.js"></script>
    <script src="/online course registration system/global/js/bootstrap.min.js"></script>
    <script src="/online course registration system/global/js/bootstrap.min.js"></script>
    <script src="/online course registration system/Admin\/addfaculty.js"></script>

  </div>


</body>

</html>
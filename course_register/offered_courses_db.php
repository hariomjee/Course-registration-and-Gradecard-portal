<?php
$rootpath = $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/online course registration system/database/db_con.php";

$dbo = new DatabaseConnection;
$action = $_POST["action"];


//department

if ($action == "department") {

    $sql = "SELECT `d_id`,`d_code`, `d_name` FROM `department_details`";
    $stat = $dbo->conn->prepare($sql);
    $stat->execute();

    if ($stat->rowCount() > 0) {

        $rv = $stat->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode($rv);
    exit();
}




// program

if ($action == "program") {
    $id = $_POST['id'];

    $sql = "SELECT `p_id`,`p_code`, `p_name`,`d_id`,`no_of_sem` FROM `program_details`
   WHERE `d_id`={$id}";
    $stat = $dbo->conn->prepare($sql);
    $stat->execute();

    if ($stat->rowCount() > 0) {

        $rv = $stat->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode($rv);
    exit();
}



// semester

if ($action == "semester") {
    $id = $_POST['id'];

    $sql = "SELECT `p_id`,`p_code`, `p_name`,`d_id`,`no_of_sem` FROM `program_details`
   WHERE `p_id`={$id}";
    $stat = $dbo->conn->prepare($sql);
    $stat->execute();

    if ($stat->rowCount() > 0) {

        $rv = $stat->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode($rv);
    exit();
}


// semester_courses

if ($action == "semester_courses") {
    $sid = $_POST['id'];
    $pid = $_POST['pid'];

    $sql = "SELECT m.id,m.code,m.titile,m.l,m.t,m.p,m.cr,o.category FROM master_course_details m 
    INNER JOIN offered_courses o ON m.code=o.course_id WHERE o.sem=:sem AND o.program_id=:pid ";
    $stat = $dbo->conn->prepare($sql);
    $stat->execute([":sem" => $sid, ":pid" => $pid]);

    if ($stat->rowCount() > 0) {

        $rv = $stat->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode($rv);
    exit();
}


// All courses details
if ($action == "getCourse") {

    $c_id = $_POST['courseId'];
    $sql = "SELECT m.code,m.titile,m.l,m.t,m.p,m.cr FROM master_course_details m 
     WHERE id=:cid";
    $stat = $dbo->conn->prepare($sql);
    $stat->execute([":cid" => $c_id]);

    if ($stat->rowCount() > 0) {

        $rv = $stat->fetchAll(PDO::FETCH_ASSOC);
    }
    echo json_encode($rv);
    exit();
}

// update table
if ($action == "EditCourse") {
    $status = 0;
    $c_code = $_POST['c_code'];
    $category = $_POST['category'];
    $query = "UPDATE offered_courses o
         SET o.category=:category WHERE o.course_id=:id";

    $stat = $dbo->conn->prepare($query);
    if ($stat->execute([":category" => $category, ":id" => $c_code])) {
        $status = 1;
    }
    $rv = array("status" => $status);
    echo json_encode($rv);
    exit();
}


// Add course
if ($action == "AddCourse") {


    $c_code = $_POST["code"];
    $c_sem = $_POST["semester"];
    $c_program = $_POST["program_id"];
    $c_category = $_POST["cate"];
    $status = 0;

    // query for insert in course table
    $course = $dbo->conn->prepare("INSERT INTO offered_courses(sem,program_id,course_id,category)
    VAlUES (:sem,:program,:course,:category)");

    $course->bindParam(':sem', $c_sem);
    $course->bindParam(':program', $c_program);
    $course->bindParam(':course', $c_code);
    $course->bindParam(':category', $c_category);

    if ($course->execute()) {
        $status = 1;
    }
    $rv = array("status" => $status);
    echo json_encode($rv);
    exit();
}

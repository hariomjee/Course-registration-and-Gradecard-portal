<?php
$rootpath = $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/online course registration system/database/db_con.php";
$dbo = new DatabaseConnection;
$action=$_POST['action'];

if($action=="loadsession"){
    //$admitted= $_POST['admitted'];

    $sql="SELECT `s_id`,`term_year`, `term_type` FROM `session_details` ";
    $stat=$dbo->conn->prepare($sql);
    $stat->execute();
    
    if($stat->rowCount()>0){
    
        $rv=$stat->fetchAll(PDO::FETCH_ASSOC);
      
    }

    echo json_encode($rv);
    exit();
}


// semester
if ($action == "semester") {
    $id = $_POST['id'];

    $sql = "SELECT `no_of_sem` FROM `program_details` WHERE `p_id`=:pid";
    $stat = $dbo->conn->prepare($sql);
    $stat->execute([":pid"=>$id]);

    if ($stat->rowCount() > 0) {
        $rv = $stat->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode($rv);
    exit();
}

if ($action == "semester_courses") {
    $sid = $_POST['sid'];
    $pid = $_POST['pid'];

    $sql ="SELECT m.id,m.code,m.titile,m.l,m.t,m.p,m.cr,o.category FROM master_course_details m  
        INNER JOIN offered_courses o ON m.code=o.course_id WHERE o.sem=:sem AND o.program_id=:pid";
    
    $stat = $dbo->conn->prepare($sql);
    $stat->execute([":sem" => $sid, ":pid" => $pid]);

    if ($stat->rowCount() > 0) {
        $rv = $stat->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode($rv);
    exit();
}

if($action=="checked") {

    $id=$_POST['id'];
    $Session=$_POST['Session'];
    $category=$_POST['category'];
    $course_id=$_POST['course_id'];

    $sql= "INSERT into student_course_registration (std_id,s_id,course_id,category) VALUES (:id,:s_id,:course_id,:category)";

    $stat = $dbo->conn->prepare($sql);
    $stat->execute([":course_id" => $course_id, ":id" => $id,  ":s_id" => $Session,  ":category" => $category]);
    echo json_encode("Success");
    exit();

}


?> 


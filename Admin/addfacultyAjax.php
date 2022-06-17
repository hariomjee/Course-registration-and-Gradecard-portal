<?php
$rootpath = $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/online course registration system/database/db_con.php";

$dbo = new DatabaseConnection;
$action = $_POST["action"];


if ($action == "getDept") {

    $q = "SELECT * FROM `department_details`";
    $stat = $dbo->conn->prepare($q);
    $stat->execute();


    if ($stat->rowCount() > 0) {

        $rv = $stat->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode($rv);
    exit();
}



if ($action == "getfaculty") {


    $sql = "SELECT faculty_details.f_id, faculty_details.designation, faculty_details.f_name,department_details.d_name
         FROM faculty_details ,department_details  WHERE faculty_details.d_id= department_details.d_id ";
    $stat = $dbo->conn->prepare($sql);
    $stat->execute();

    if ($stat->rowCount() > 0) {

        $rv = $stat->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode($rv);
    exit();
}


if ($action == "facultyAdd") {

    $f_name = $_POST["name"];
    $f_designation = $_POST["designation"];
    $f_dept = $_POST["dept"];
    $status = 0;
    $query = $dbo->conn->prepare("INSERT INTO faculty_details(f_name, designation, d_id) 
        VALUES (:name,:designation,:dept)");
    $query->bindParam(':name', $f_name);
    $query->bindParam(':designation', $f_designation);
    $query->bindParam(':dept', $f_dept);
    if ($query->execute()) {
        $status = 1;
    }
    $rv = array("status" => $status);
    echo json_encode($rv);
    exit();
}


// getting faculty on press edit
if ($action == "factDisplay") {

    $id = $_POST["id"];

    $query = "SELECT  faculty_details.f_name ,faculty_details.designation,department_details.d_name FROM 
    faculty_details , department_details WHERE $id = faculty_details.f_id";
    $temp = $dbo->conn->prepare($query);
    $temp->execute();

    if ($temp->rowCount() > 0) {

        $rv = $temp->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode($rv);
   
 }


 // update faculty details

 if ($action == "Updatefaculty"){

    $f_id = $_POST["id"];
    $f_name = $_POST["name"];
    $f_designation=$_POST["designation"];
    $f_dept=$_POST["dept"];
    $status = 0;

    $sql="UPDATE faculty_details SET  faculty_details.f_name=:fname, faculty_details.designation=:designation,
     faculty_details.d_id=:dept
     WHERE faculty_details.f_id=:fid";
    $query = $dbo->conn->prepare($sql);
    $query->bindParam(':fid', $f_id);
    $query->bindParam(':fname', $f_name);
    $query->bindParam(':designation', $f_designation);
    $query->bindParam(':dept', $f_dept);
    if($query->execute()){
        $status = 1;
    }
    $rv = array("status" => $status);
    echo json_encode($rv);
    exit();
}

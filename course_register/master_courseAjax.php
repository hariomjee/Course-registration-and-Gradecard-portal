<?php
$rootpath = $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/online course registration system/database/db_con.php";

$dbo = new DatabaseConnection;
$action = $_POST["action"];

  // get department details

if ($action == "getDept") {

    $q = "SELECT `d_name` FROM `department_details`";
    $stat = $dbo->conn->prepare($q);
    $stat->execute();


    if ($stat->rowCount() > 0) {

        $rv = $stat->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode($rv);
    exit();
}


// Insert data into table

if ($action == "CourseHandler") {

    $c_code = $_POST["code"];
    $c_title = $_POST["c_name"];
    $c_L = $_POST["L"];
    $c_P = $_POST["P"];
    $c_T = $_POST["T"];
    $c_Cr = $_POST["Cr"];
    $c_dept = $_POST["dept"];
    $status = 0;
    $query = $dbo->conn->prepare("INSERT INTO master_course_details(code, titile, l, t, p, cr, offered_by_dept) 
    VALUES (:code,:title,:l,:t,:p,:cr,:dept)");
    $query->bindParam(':code', $c_code);
    $query->bindParam(':title', $c_title);
    $query->bindParam(':l', $c_L);
    $query->bindParam(':t', $c_T);
    $query->bindParam(':p', $c_P);
    $query->bindParam(':cr', $c_Cr);
    $query->bindParam(':dept', $c_dept);
    if ($query->execute()) {
        $status = 1;
    }
    $rv = array("status" => $status);
    echo json_encode($rv);
    exit();
}

// getting data from table

if ($action == "getHandler") {
    $sql = "SELECT `id`,`code`,`titile`,`l`,`t`,`p`,`cr`,`offered_by_dept` FROM `master_course_details`";
    $stat = $dbo->conn->prepare($sql);
    $stat->execute();
    if ($stat->rowCount() > 0) {

        $rv = $stat->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode($rv);
    exit();
}

// getting courses on press tab 

if ($action == "getCourse") {

    $c_code = $_POST["code"];

    $query = "SELECT * FROM master_course_details WHERE code=:code";
    $temp = $dbo->conn->prepare($query);
    $temp->execute([":code" => $c_code]);

    if ($temp->rowCount() > 0) {

        $rtable = $temp->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rtable);
        exit();
    }
}
//getting courses on press edit
if($action=="courseDisplay"){

    $id=$_POST["id"];

    $query ="SELECT * FROM master_course_details  WHERE id=:id";
    $temp = $dbo->conn->prepare($query);
    $temp->execute([":id"=>$id]);

    if ($temp->rowCount() > 0) {

        $rtable = $temp->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($rtable);
        exit();
    }

}

// edit 

if ($action == "Edit"){

    $c_code = $_POST["code"];
    $c_title = $_POST["title"];
    $c_L=$_POST["L"];
    $c_P=$_POST["P"];
    $c_T=$_POST["T"];
    $c_Cr=$_POST["Cr"];
    $c_dept=$_POST["dept"];
    $status = 0;

    $sql="UPDATE master_course_details m SET 
     m.code=:code,
     m.titile=:title,
     m.l=:l,
     m.t=:t,
     m.p=:p,
     m.cr=:cr,
     m.offered_by_dept=:dept
     WHERE m.code=:code";
    $query = $dbo->conn->prepare($sql);
    $query->bindParam(':code', $c_code);
    $query->bindParam(':title', $c_title);
    $query->bindParam(':l', $c_L);
    $query->bindParam(':t', $c_T);
    $query->bindParam(':p', $c_P);
    $query->bindParam(':cr', $c_Cr);
    $query->bindParam(':dept', $c_dept);
    if($query->execute()){
        $status = 1;
    }
    $rv = array("status" => $status);
    echo json_encode($rv);
    exit();
}
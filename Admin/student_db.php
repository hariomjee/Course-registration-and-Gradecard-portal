<?php
$rootpath=$_SERVER["DOCUMENT_ROOT"];
require_once $rootpath."/online course registration system/database/db_con.php";

$dbo=new DatabaseConnection;
$action=$_POST["action"];

if($action=="loadsession"){

    $sql="SELECT * FROM `session_details` ORDER BY `session_details`.`s_id` DESC";
    $stat=$dbo->conn->prepare($sql);
    $stat->execute();
    
    if($stat->rowCount()>0){
    
        $rv=$stat->fetchAll(PDO::FETCH_ASSOC);
      
    }

    echo json_encode($rv);
    exit();

}

if($action=="getStudentList"){

    $id=$_POST['id'];
    $sql="SELECT student_details.std_id, student_details.roll_no,student_details.s_name,program_details.p_code FROM student_details  INNER JOIN program_details ON student_details.p_id=program_details.p_id WHERE student_details.admitted_on=:id";
    $temp=$dbo->conn->prepare($sql);
    $temp->execute([":id"=>$id]);
    if($temp->rowCount()>0){
       
        $rtable=$temp->fetchAll(PDO::FETCH_ASSOC);
         echo json_encode($rtable);
        exit();
    }

}







?>
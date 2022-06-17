<?php
$rootpath=$_SERVER["DOCUMENT_ROOT"];
require_once $rootpath."/online course registration system/database/db_con.php";

$dbo=new DatabaseConnection;
$action=$_POST["action"];

if($action=="stdDetails"){

    $sid=$_POST["sid"];
    $cid=$_POST["cid"];
    
    $q ="SELECT s.std_id, s.roll_no, s.s_name, sc.category,sc.course_id FROM student_details s 
    INNER JOIN student_course_registration sc ON s.std_id=sc.std_id  WHERE sc.s_id=:s_id AND sc.course_id=:cid " ;
     $stat = $dbo->conn->prepare($q);
     $stat->execute(["s_id"=>$sid,":cid"=>$cid]);
    
     if($stat->rowCount()>0){
    
         $rv = $stat->fetchAll(PDO::FETCH_ASSOC);
    }
    
    echo json_encode($rv);
    exit();
    
    }





?>
<?php
$rootpath = $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/online course registration system/database/db_con.php";
session_start();
$dbo = new DatabaseConnection;
// $action = $_POST["action"];

 $prog_id=$_SESSION["studentProgram"];

 $sql="SELECT `p_name` FROM `program_details` where `p_id`=:pid";
    $stat=$dbo->conn->prepare($sql);
    $stat->execute([":pid"=>$prog_id]);
    
    if($stat->rowCount()>0){
    
        $rv=$stat->fetchAll(PDO::FETCH_ASSOC);
       // print_r($rv);
        $pro_name=$rv[0]['p_name'];
      
    }
    $_SESSION["studentProg_name"]=$pro_name;

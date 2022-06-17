<?php
$rootpath=$_SERVER["DOCUMENT_ROOT"];
require_once $rootpath."/online course registration system/database/DBStudentDetails.php";

$dbo=new DBStudentDetails();

$action=$_POST["action"];

// for students

 if($action == "loginHandler"){
     $un = $_POST["username"];
     $pwd = $_POST["pwd"];
     $status="";
     $id=$dbo->getId($un,$pwd);
     //$name=$dbo->getName($un,$pwd);
     if($id[0]==-1){
        $status="ERROR";
        session_start();
        session_destroy();
        }
     else{
         session_start();
         $_SESSION["studentid"]=$id[0];
         $_SESSION["studentname"]=$id[1];
         $_SESSION["studentAdmitted"]=$id[2];
         $_SESSION["studentProgram"]=$id[3];
         $_SESSION["Program_name"]=$id[4];
         $_SESSION["Current_session"]=$id[5];
         $_SESSION["Roll_no"]=$id[6];
         $_SESSION["Depart_name"]=$id[7];
         $_SESSION["No_of_sem"]=$id[8];
         $status="OK";
        }
    $rv=array("status"=>$status);

    echo json_encode($rv);
    exit();
 }

 
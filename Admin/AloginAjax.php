<?php
$rootpath=$_SERVER["DOCUMENT_ROOT"];
require_once $rootpath."/online course registration system/database/adminDeatils.php";

$dbo=new admindetails();


$action=$_POST["action"];

if($action=="AdminHandler"){

    $un = $_POST["username"];
    $pwd = $_POST["pwd"];
    $status="";
    $uid=$dbo->get_uid($un,$pwd);    //  Array value from DBStudentDetails.php we store it into $uid
    $role=$uid[2];

    if($uid[0]==-1){
        $status="ERROR";
        session_start();
        session_destroy();
        }
    else{
        session_start();
        $_SESSION["userid"]=$uid[0];
        $_SESSION["username"]=$uid[1];
        $_SESSION["f_name"]=$uid[4];
        $_SESSION["designation"]=$uid[5];
        $_SESSION["d_id"]=$uid[6];

        $status="OK";
    }
    $rv=array("status"=>$status,"role"=>$role);
      echo json_encode($rv);
        exit();
 }

?>
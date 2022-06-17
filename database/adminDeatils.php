<?php
$rootpath = $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/online course registration system/database/db_con.php";

class admindetails
{

    //query for getting user id  from Admin table
    public function get_uid($username, $password)
    {
        $uid = "-1";
        $dbo = new DatabaseConnection();
        $sql = "SELECT * FROM `admin_details` WHERE `uname` = :username AND `pwd` = :password";
        $templet = $dbo->conn->prepare($sql);
        $templet->execute([":username" => $username, ":password" => $password]);

        if ($templet->rowCount() > 0){

            $rtable = $templet->fetchAll(PDO::FETCH_ASSOC);
            $uid = $rtable[0]['uid'];
            $name = $rtable[0]['uname'];
            $role=$rtable[0]['role'];
        }

       $q1="SELECT * FROM `faculty_details` WHERE f_id=:fid ";
       $templet1 = $dbo->conn->prepare($q1);
       $templet1->execute([":fid"=>$uid]);

       if ($templet1->rowCount()>0){

        $rv1 = $templet1->fetchAll(PDO::FETCH_ASSOC);
       
        $f_id=$rv1[0]['f_id'];
        $f_name=$rv1[0]['f_name'];
        $f_designation=$rv1[0]['designation'];
        $f_did=$rv1[0]['d_id'];
          

       }
        return array($uid,$name,$role,$f_id,$f_name,$f_designation,$f_did);
    }
}

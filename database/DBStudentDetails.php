<?php
$rootpath = $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/online course registration system/database/db_con.php";

class DBStudentDetails
{

    // functions for students

    public function getId($rollno, $password)
    {
        $id = "-1";
        $dbo = new DatabaseConnection();

       //query for getting name, id, admitted,rollno and program id

        $cmd = "SELECT std_id,s_name,admitted_on,p_id,roll_no from student_details WHERE roll_no = :rollno AND password = :password ";
        $templet = $dbo->conn->prepare($cmd);

       
        $templet->execute([":rollno" => $rollno, ":password" => $password]);


        if ($templet->rowCount() > 0) {
            $rtable = $templet->fetchAll(PDO::FETCH_ASSOC);
            $id = $rtable[0]['std_id'];
            // echo "$id";

            $name = $rtable[0]['s_name'];
            $admitted = $rtable[0]['admitted_on'];
            $program = $rtable[0]['p_id'];
            $rollno=$rtable[0]['roll_no'];
        }

// query for getting Program Name

        $sql ="SELECT * FROM `program_details` where `p_id`=:pid";
        $stat = $dbo->conn->prepare($sql);
        $stat->execute([":pid" => $program]);

        if ($stat->rowCount() > 0) {

            $rv = $stat->fetchAll(PDO::FETCH_ASSOC);
            // print_r($rv);
            $pro_name = $rv[0]['p_name'];
            $dept_id= $rv[0]['d_id'];
            $no_of_sem= $rv[0]['no_of_sem'];
        }
// query for getting current semester

        $sem= "SELECT * FROM `session_details` ORDER BY `s_id` DESC LIMIT 1";
        $temp= $dbo->conn->prepare($sem);
        $temp->execute();

        if($temp->rowCount()>0){
            $current=  $temp->fetchAll(PDO::FETCH_ASSOC);
            $current_sem=$current[0]['s_id'];
        }

     // query for getting Department Name
     
     $dept= "SELECT `d_name` FROM `department_details` where `d_id`=:did";
     $dept_name = $dbo->conn->prepare($dept);
        $dept_name->execute([":did" => $dept_id]);

        if ($dept_name->rowCount() > 0) {

            $rv = $dept_name->fetchAll(PDO::FETCH_ASSOC);
            // print_r($rv);
            $depart_name = $rv[0]['d_name'];
        }

        return array($id, $name, $admitted, $program, $pro_name,$current_sem,$rollno,$depart_name,$no_of_sem);
    }


    //function to get  grade values

    public function GetCardValue($stdId){

        $dbo = new DatabaseConnection();


 $q1="SELECT * FROM `student_details` WHERE std_id=:stdid";
 $stat1 = $dbo->conn->prepare($q1);
 $stat1->execute([":stdid"=>$stdId]);

 if($stat1->rowCount()>0){

     $rv1 = $stat1->fetchAll(PDO::FETCH_ASSOC);
    //  print_r($rv1);
     $name = $rv1[0]['s_name'];
     $admitted = $rv1[0]['admitted_on'];
     $program = $rv1[0]['p_id'];
     $rollno=$rv1[0]['roll_no'];
    
 }
 //get program name
 $sql ="SELECT * FROM `program_details` where `p_id`=:pid";
$stat2 = $dbo->conn->prepare($sql);
$stat2->execute([":pid"=>$program]);

if ($stat2->rowCount() > 0) {

    $rv2 = $stat2->fetchAll(PDO::FETCH_ASSOC);
    $pro_name = $rv2[0]['p_name'];
    $dept_id= $rv2[0]['d_id'];
    $no_of_sem= $rv2[0]['no_of_sem'];
    
}
//get department
$dept= "SELECT `d_name` FROM `department_details` where `d_id`=:did";
$dept_name = $dbo->conn->prepare($dept);
$dept_name->execute([":did"=> $dept_id]);

   if ($dept_name->rowCount()>0) {

       $rv3 = $dept_name->fetchAll(PDO::FETCH_ASSOC);
       $depart_name = $rv3[0]['d_name'];
   }
   $q4="SELECT * FROM session_details";
   
   $st4 = $dbo->conn->prepare($q4);
   $st4->execute();
    if($st4->rowCount() > 0) {
       $rv4 = $st4->fetchAll(PDO::FETCH_ASSOC);
    
   }

    //get courses
    $q5="SELECT m.code,m.titile,m.l,m.t,m.p,m.cr, sr.s_id,sr.grade FROM master_course_details m
    INNER JOIN student_course_registration sr ON m.code=sr.course_id Where  sr.std_id=:stdid";
 
      $st5 = $dbo->conn->prepare($q5);
      $st5->execute([":stdid"=>$stdId]);
     if($st5->rowCount() > 0) {
 
         $rv5 = $st5->fetchAll(PDO::FETCH_ASSOC);
        //  print_r($rv5);
 
     }


      


return array($rv1,$rv2,$rv3,$rv4,$rv5);









    }
    

}

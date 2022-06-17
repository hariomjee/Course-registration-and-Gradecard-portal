<?php


$rootpath = $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/online course registration system/database/db_con.php";

class gradeStudentDetails{

    public function getValues($sid,$pid){


    $dbo = new DatabaseConnection();

   $q ="SELECT DISTINCT sr.std_id FROM student_details s
   INNER JOIN student_course_registration sr ON s.std_id=sr.std_id Where sr.s_id =:sid AND s.p_id=:pid";

$stat = $dbo->conn->prepare($q);
$stat->execute([":sid"=>$sid,":pid"=>$pid]);

if ($stat->rowCount() > 0) {

    $rv = $stat->fetchAll(PDO::FETCH_ASSOC);

    // print_r($rv);
    // $std_id= $rv[0]['std_id'];
    // echo "<br>";
    // echo  $std_id;
}
 
return $rv;

    }

public function getStdValue($sid,$pid,$stdId){

    $dbo = new DatabaseConnection();
//get department
  $q1 = "SELECT d.d_name FROM department_details d
       INNER JOIN program_details p ON d.d_id=p.d_id Where p.p_id=:pid";
    $stat1 = $dbo->conn->prepare($q1);
    $stat1->execute([":pid"=>$pid]);
    if ($stat1->rowCount() > 0){
        $rv1 = $stat1->fetchAll(PDO::FETCH_ASSOC);
     
         // print_r($rv0);
        //  $dname = $rv1[0]['d_name'];
     
     }


//get program
    
    $q2 = "SELECT p_name FROM program_details Where p_id =:pid";

    $st2 = $dbo->conn->prepare($q2);
    $st2->execute([":pid"=>$pid]);

    if($st2->rowCount()>0) {

      $rv2 = $st2->fetchAll(PDO::FETCH_ASSOC);

    // print_r($rv1);
    // $pname = $rv1[0]['p_name'];
    }
    
    // get student details

     $q3 = "SELECT roll_no,s_name,admitted_on FROM student_details 
         WHERE std_id=:stdid ";
        $st3 = $dbo->conn->prepare($q3);
        $st3->execute([":stdid"=>$stdId]);
        if ($st3->rowCount()>0){
            $rv3 = $st3->fetchAll(PDO::FETCH_ASSOC);
           }

       //get session    
    $q4="SELECT term_year,term_type FROM session_details WHERE s_id=:sid";
   
    $st4 = $dbo->conn->prepare($q4);
    $st4->execute([":sid"=>$sid]);
     if($st4->rowCount() > 0) {
        $rv4 = $st4->fetchAll(PDO::FETCH_ASSOC);
    }

    //get courses
    $q5="SELECT m.code,m.titile,m.l,m.t,m.p,m.cr,sr.grade FROM master_course_details m
    INNER JOIN student_course_registration sr ON m.code=sr.course_id Where sr.s_id=:sid AND sr.std_id=:stdid";
 
      $st5 = $dbo->conn->prepare($q5);
      $st5->execute([":sid"=>$sid,":stdid"=>$stdId]);
     if($st5->rowCount() > 0) {
 
         $rv5 = $st5->fetchAll(PDO::FETCH_ASSOC);
        //  print_r($rv5);
 
     }

     //get all course for particular student

     $q6="SELECT sr.course_id,sr.grade, sr.s_id, m.cr FROM student_course_registration sr INNER JOIN master_course_details m
      ON sr.course_id=m.code  WHERE std_id =:stdid";
     $st6 = $dbo->conn->prepare($q6);
     $st6->execute([":stdid"=>$stdId]);
     if($st6->rowCount()>0){
        $rv6=$st6->fetchAll(PDO::FETCH_ASSOC);
     }

return [$rv1,$rv2,$rv3,$rv4,$rv5,$rv6];



}






}


?>

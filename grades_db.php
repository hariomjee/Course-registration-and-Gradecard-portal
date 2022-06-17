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
if($action=="loadcourse"){

    $sql="SELECT `code`,`id` FROM `master_course_details` ORDER BY `master_course_details`.`id` ASC";
    $stat=$dbo->conn->prepare($sql);
    $stat->execute();
    
    if($stat->rowCount()>0){
    
        $rv=$stat->fetchAll(PDO::FETCH_ASSOC);
      
    }

    echo json_encode($rv);
    exit();

}

if($action =="getCourseList"){

    $course_code=$_POST["id"];

     $query="SELECT * FROM `master_course_details` WHERE `code`=:code";
     $temp=$dbo->conn->prepare($query);
     $temp->execute([":code"=>$course_code]);
     if($temp->rowCount()>0){
    
        $rv=$temp->fetchAll(PDO::FETCH_ASSOC);
      
    }

    echo json_encode($rv);
    exit();

}

if($action=="stdDetails"){

$sid=$_POST["sid"];
$cid=$_POST["cid"];

$q1 = "SELECT ";

$q ="SELECT s.std_id, s.roll_no, s.s_name, sc.category,sc.grade FROM student_details s 
INNER JOIN student_course_registration sc ON s.std_id=sc.std_id  WHERE sc.s_id=:s_id AND sc.course_id=:cid";
 $stat = $dbo->conn->prepare($q);
 $stat->execute(["s_id"=>$sid,":cid"=>$cid]);

 if($stat->rowCount()>0){

     $rv = $stat->fetchAll(PDO::FETCH_ASSOC);
     //$dbselected=$rv[ `grade`];
}

echo json_encode($rv);
exit();

}


if($action=="gradeHandle"){

    $sid=$_POST["sid"];
    $cid=$_POST["cid"];
    $std_id=$_POST["st_id"];
    $grade=$_POST["grades"];
    $graded_by=$_POST["grade_by"];
    $status = 0;

 $q=" UPDATE student_course_registration SET grade =:grades ,graded_by_faculty=:grededID WHERE student_course_registration.std_id =:st_id AND student_course_registration.s_id =:s_id AND student_course_registration.course_id =:cid";

   $stat = $dbo->conn->prepare($q);
   $stat->bindParam(':grades',$grade);
   $stat->bindParam(':st_id',$std_id);
   $stat->bindParam(':s_id', $sid);
   $stat->bindParam(':cid',$cid);
   $stat->bindParam(':grededID',$graded_by);
  if( $stat->execute()) {
    $status = 1;
  }
  $rv = array("status" => $status);
  echo json_encode($rv);
  exit();
    
    }

?>
<?php
$rootpath=$_SERVER["DOCUMENT_ROOT"];
require_once $rootpath."/online course registration system/database/db_con.php";

$dbo=new DatabaseConnection;
$action=$_POST["action"];

if($action=="loadsession"){
    $admitted=$_POST['admit'];

    $sql="SELECT `s_id`,`term_year`, `term_type` FROM `session_details`";
    $stat=$dbo->conn->prepare($sql);
    $stat->execute();
    
    if($stat->rowCount()>0){
    
        $rv=$stat->fetchAll(PDO::FETCH_ASSOC);
      
    }

    echo json_encode($rv);
    exit();

}
if($action=="semester_courses"){

$studentId=$_POST['std_id'];
$sessionId=$_POST['id'];

$query="SELECT m.id, m.code, m.titile, m.l, m.t, m.p, m.cr, c.category,c.grade FROM master_course_details m 
INNER JOIN student_course_registration c ON m.code=c.course_id WHERE c.std_id=:stdId AND c.s_id=:s_id";
$stat=$dbo->conn->prepare($query);
$stat->execute([":stdId"=>$studentId,":s_id"=>$sessionId]);

if($stat->rowCount()>0){

    $rv = $stat->fetchAll(PDO::FETCH_ASSOC);
}

echo json_encode($rv);
exit();

}






?>
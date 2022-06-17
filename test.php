<?php
$rootpath = $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/online course registration system/database/db_con.php";
$dbo = new DatabaseConnection;


$sql= "SELECT * FROM student_course_registration ";
$stat = $dbo->conn->prepare($sql);
$stat->execute();
    $rv = $stat->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($rv);

?>
<?php
$rootpath = $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/online course registration system/database/db_con.php";

$dbo = new DatabaseConnection;
$action = $_POST["action"];

// session

if ($action == "loadsession") {

    $sql = "SELECT * FROM `session_details` ORDER BY `session_details`.`s_id` DESC";
    $stat = $dbo->conn->prepare($sql);
    $stat->execute();

    if ($stat->rowCount() > 0) {

        $rv = $stat->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode($rv);
    exit();
}

// program

if ($action == "program") {
    // $id = $_POST['id'];

    $sql = "SELECT * FROM `program_details`";
    $stat = $dbo->conn->prepare($sql);
    $stat->execute();

    if ($stat->rowCount() > 0) {

        $rv = $stat->fetchAll(PDO::FETCH_ASSOC);
    }

    echo json_encode($rv);
    exit();
}


//grade handler

if ($action == "gradeHandle"){

    $sid=$_POST['sid'];
    $pid=$_POST['pid'];
    
    $q ="SELECT DISTINCT sr.std_id FROM student_details s
    INNER JOIN student_course_registration sr ON s.std_id=sr.std_id Where sr.s_id =  $sid AND s.p_id= ";
    
    $stat = $dbo->conn->prepare($q);
    $stat->execute();
    
    if ($stat->rowCount() > 0) {
    
        $rv = $stat->fetchAll(PDO::FETCH_ASSOC);
    
        print_r($rv);
        // $std_id= $rv[0]['std_id'];
        // echo "<br>";
        // echo  $std_id;
    }
    
    for($i=0;$i<sizeof($rv);$i++){
    
        $std_id=$rv[$i]['std_id'];
        $result=gradeCard($stdId,$sid,$pid);
    
        echo $result;
    
    }
    
    echo "<br>";
    
    //grade card
    function gradeCard($stdId,$sid,$pid){
    
     $dbo = new DatabaseConnection;
     $html="";
     $html=$html.'<div class="row">
     <div class="col"> Grade card</div></div>';
     $html=$html.'<div class="row"><div class="col-3">Department</div>';
      //get department name
    $q1 = "SELECT d.d_name FROM department_details d
    INNER JOIN program_details p ON d.d_id=p.d_id Where p.p_id=$pid";
    $stat = $dbo->conn->prepare($q1);
    $stat->execute();
    if ($stat->rowCount() > 0){
       $rv0 = $stat->fetchAll(PDO::FETCH_ASSOC);
    
        // print_r($rv0);
        $dname = $rv0[0]['d_name'];
        $html=$html.'<div class="col-3">'.$dname;
    
    }
    $html=$html.'</div><div class="col-6"></div>';
    
    $html=$html.'</div><div class="row"><div class="col-3">Program</div>';
    
      //get program name
    $q2 = "SELECT p_name FROM program_details Where p_id = $pid";
    
    $st2 = $dbo->conn->prepare($q2);
    $st2->execute();
    
    if ($st2->rowCount() > 0) {
    
        $rv1 = $st2->fetchAll(PDO::FETCH_ASSOC);
    
        // print_r($rv1);
        $pname = $rv1[0]['p_name'];
        $html=$html.'<div class="col-3">'.$pname;
        
    }
    $html=$html.'</div><div class="col-6"></div>';
    $html=$html.'</div><div class="row"><div class="col-3">Roll No</div>';
    
       //get roll no for the particular student
    
    $q3 = "SELECT roll_no,s_name,admitted_on FROM student_details 
             WHERE std_id= $stdId";
    
    $q4="SELECT term_year,term_type FROM session_details WHERE s_id= $sid";
    $st3 = $dbo->conn->prepare($q3);
    $st3->execute();
    $st4 = $dbo->conn->prepare($q4);
    $st4->execute();
    
    if ($st3->rowCount() > 0) {
     $rv2 = $st3->fetchAll(PDO::FETCH_ASSOC);
     }
     if($st4->rowCount() > 0) {
        $rv3 = $st4->fetchAll(PDO::FETCH_ASSOC);
        }
       
        $sroll = $rv2[0]['roll_no'];
        $html=$html.'<div class="col-3">'. $sroll; //roll no
        $html=$html.'</div><div class="col-2"></div><div class="col-2">Term :</div>';
        $term_year=$rv3[0][' term_year'];
        $term_type=$rv3[0]['term_type'];
        $html=$html.'<div class="col-2">'.$term_year.' '.$term_type; //term
        $sname=$rv2[0]['s_name'];
        $admit=$rv2[0]['admitted_on '];
        $sem=($sid- $admit)+1;
        $html=$html.'</div></div><div class="row"><div class="col-3">Name</div><div class="col-3">'.$sname; //student name
        $html=$html.'</div><div class="col-2"></div><div class="col-2">Semester</div>
        <div class="col-2">'.$sem; //current sem
        $html=$html.'</div>';
    
    
    $q6="SELECT m.code,m.titile,m.l,m.t,m.p,m.cr,sr.grade FROM master_course_details m
       INNER JOIN student_course_registration sr ON m.code=sr.course_id Where sr.s_id= $sid AND sr.std_id=$stdId";
    
         $st6 = $dbo->conn->prepare($q6);
         $st6->execute();
         echo "<br>";
        if ($st6->rowCount() > 0) {
    
            $rv6 = $st6->fetchAll(PDO::FETCH_ASSOC);
            print_r($rv6);
    
        }
        for($i = 0; $i < sizeof($rv6); $i++){
            $html=$html.'<div class="row"><div class="col-3">Course code</div>
            <div class="col-3">Course title</div><div class="col-1"></div>
            <div class="col-1">L</div><div class="col-1">T</div>
            <div class="col-1">P</div><div class="col-1">Cr</div>
            <div class="col-1">grades</div></div>';
             $code=$rv6[$i]['code'];
             $html=$html.'<div class="row"><div class="col-3">'.$code;
             $title=$rv6[$i]['titile'];
             $html=$html.'</div><div class="col-3">'.$title;
             $l=$rv6[$i]['l'];
             $html=$html.'</div><div class="col-1"></div><div class="col-1">'.$l;
             $t=$rv6[$i]['t'];
             $html=$html.'</div><div class="col-1">'.$t;
             $p=$rv6[$i]['p'];
             $html=$html.'</div><div class="col-1">'.$p;
             $cr=$rv6[$i]['cr'];
             $html=$html.'</div><div class="col-1">'.$cr;
             $grade=$rv6[$i]['grade'];
             $html=$html.'</div><div class="col-1">'.$grade;
             $html=$html.'</div></div>';
        }
    
    
    
    
    
    
        return $html;
    
    }
    
    }
    

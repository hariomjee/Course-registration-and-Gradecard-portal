<?php
$rootpath = $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/online course registration system/database/gradeStudentDetails.php";
require('fpdf/fpdf.php');
$dbo = new gradeStudentDetails();

$action = $_REQUEST['action'];

if (!empty($action)) {
  if ($action == "gradeHandle") {


    $sid = $_POST['sid'];
    $pid = $_POST['pid'];
    $rv = $dbo->getValues($sid, $pid);

    // New object created and constructor invoked
    $pdf = new FPDF('l', 'mm', 'A4');
    // loop for every student 
    for ($i = 0; $i < sizeof($rv); $i++) {

      $tempCredit = 0;
      $EarnGradePoint = 0;
      $sgpa = 0;
      $cgpa = 0;
      $admitted_on = $value[2][0]['admitted_on'];
      $totalCredit = 0;
      $totalGradepoint = 0;
      $std_id[$i] = $rv[$i]['std_id'];

      $value = $dbo->getStdValue($sid, $pid, $std_id[$i]);

      //for generation card

      $pdf->AddPage();

      //setting up font for the page
      $pdf->SetFont('Arial', 'B', 14);
      $pdf->Cell(270, 10, 'GRADE CARD', 0, 1, 'C');
      //creating blank spaces
      $pdf->Cell(130, 10, '', 0, 1, 'R');

      $pdf->SetFont('Courier', '', 14);

      $pdf->Cell(40, 10, 'Department', 0, 0);
      $pdf->Cell(130, 10, ": " . $value[0][0]['d_name'], 0, 1);

      $pdf->Cell(40, 10, 'Programme', 0, 0);
      $pdf->Cell(130, 10, ": " . $value[1][0]['p_name'], 0, 1);

      $pdf->Cell(40, 10, 'RollNo', 0, 0);
      $pdf->Cell(110, 10, ": " . $value[2][0]['roll_no'], 0, 0);

      $pdf->Cell(40, 10, 'TERM', 0, 0);
      $pdf->Cell(120, 10, ": " . $value[3][0]['term_year'] . " " . $value[3][0]['term_type'] . " SEMESTER", 0, 1);

      $pdf->Cell(40, 10, 'Name', 0, 0);
      $pdf->Cell(110, 10, ": " . $value[2][0]['s_name'], 0, 0);

      $pdf->Cell(40, 10, 'SEMESTER', 0, 0);
      $pdf->Cell(110, 10, ": " . ($value[2][0]['admitted_on']) + 1, 0, 1);

      //table header
      $pdf->SetFont('Courier', 'B', 14);
      $pdf->Line(10, 70, 270, 70);
      $pdf->Cell(40, 10, 'Course Code', 0, 0);
      $pdf->Cell(120, 10, 'Course Title', 0, 0);
      $pdf->Cell(15, 10, 'L', 0, 0);
      $pdf->Cell(15, 10, 'T', 0, 0);
      $pdf->Cell(15, 10, 'P', 0, 0);
      $pdf->Cell(15, 10, 'Cr', 0, 0);
      $pdf->Cell(15, 10, 'Grade Secured', 0, 1);
      $pdf->Line(10, 80, 270, 80);

      for ($j = 0; $j < sizeof($value[4]); $j++) {
        if ($value[4][$j]['grade'] == "NA") {
          $pdf->Cell(40, 10, 'RESULTS ARE NOT DECLARED YET', 0, 1);
          break;
        } else {
          $pdf->Cell(40, 10, $value[4][$j]['code'], 0, 0);
          $pdf->Cell(120, 10, $value[4][$j]['titile'], 0, 0);
          $pdf->Cell(15, 10, $value[4][$j]['l'], 0, 0);
          $pdf->Cell(15, 10, $value[4][$j]['t'], 0, 0);
          $pdf->Cell(15, 10, $value[4][$j]['p'], 0, 0);
          $pdf->Cell(15, 10, $value[4][$j]['cr'], 0, 0);

          $tempCredit += $value[4][$j]['cr'];

          $pdf->Cell(15, 10, $value[4][$j]['grade'], 0, 1);

          $grade = $value[4][$j]['grade'];
          if ($grade == 'O') {
            $gPoint = 10;
          } else if ($grade == 'A+') {
            $gPoint = 9;
          } else if ($grade == 'A') {
            $gPoint = 8;
          } else if ($grade == 'B+') {
            $gPoint = 7;
          } else if ($grade == 'B') {
            $gPoint = 6;
          } else if ($grade == 'C') {
            $gPoint = 5;
          } else if ($grade == 'P') {
            $gPoint = 4;
          }
          $EarnGradePoint += $gPoint * $value[4][$j]['cr'];
        }
      }
      if ($tempCredit != 0) {
        $sgpa = round(($EarnGradePoint / $tempCredit), 2);
      } else {
        $sgpa = 0;
      }

      //get cgpa
      for ($k = $admitted_on; $k <= $sid; $k++) {


        if ($value[5][$k]['grade'] == "NA") {
          $pdf->Cell(40, 10, 'RESULTS ARE NOT DECLARED YET', 0, 1);
          break;
        }
         else {

          $tgrade = $value[5][$k]['grade'];
          if ($tgrade == 'O') {
            $tgPoint = 10;
          } else if ($tgrade == 'A+') {
            $tgPoint = 9;
          } else if ($tgrade == 'A') {
            $tgPoint = 8;
          } else if ($tgrade == 'B+') {
            $tgPoint = 7;
          } else if ($tgrade == 'B') {
            $tgPoint = 6;
          } else if ($tgrade == 'C') {
            $tgPoint = 5;
          } else if ($tgrade == 'P') {
            $tgPoint = 4;
          }

          $totalGradepoint += $tgPoint * $value[5][$k]['cr'];
          $totalCredit += $value[5][$k]['cr'];
        }

        if ($admitted_on == $sid) {

          $cgpa = $sgpa;
        } else {

          $cgpa = round(($totalGradepoint / $totalCredit), 2);
        }
      }

      //footer
      $pdf->SetFont('Courier', 'B', 14);
      $pdf->Cell(15, 5, '', 0, 1);
      $pdf->cell(50, 10, 'Credit Counted: ', 0, 0);
      $pdf->cell(40, 10, $tempCredit, 0, 0);
      $pdf->cell(70, 10, 'Total GP Earned: ', 0, 0, 'R');
      $pdf->cell(40, 10, $EarnGradePoint, 0, 0);
      $pdf->cell(50, 10, 'SGPA: ', 0, 0, 'R');
      $pdf->cell(20, 10, $sgpa, 0, 1);
      $pdf->cell(50, 10, 'CGPA: ', 0, 0, 'R');
      $pdf->cell(20, 10, $cgpa, 0, 1);
    }

    $path = 'C:\xampp\htdocs\online course registration system\tempPDF\grade.pdf';
    //   $path = 'D:\TU\tempPDF\tempPDF.pdf';
    $pdf->Output('F', $path, true);
    //pdf ended


    $rv[0]['path'] = $path;
    echo json_encode($rv);
    exit();
  }
}

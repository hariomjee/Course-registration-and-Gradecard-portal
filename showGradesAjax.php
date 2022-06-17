<?php
$rootpath = $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/online course registration system/database/DBStudentDetails.php";
require('fpdf/fpdf.php');

$dbo = new DBStudentDetails();

$action = $_REQUEST['action'];

if (!empty($action)) {
    if ($action == "gradeHandle") {

        $studentId = $_POST['std_id'];

        $rv = $dbo->GetCardValue($studentId);

        $admitYear = $rv[0][0]['admitted_on'];
        $nos = $rv[1][0]['no_of_sem'];
        //For Generating the pdf
        $pdf = new fpdf('l', 'mm', 'A4');
        $count = 1;
        $paperPerSemesterCount = 0;
        $creditCompleted = 0;
        $totalGradePoint = 0;
        $cgpa = 0;
        for ($i = $admitYear; $i < ($admitYear + $nos); $i++) {
            $tempCredit = 0;
            $tempGradePoint = 0;
            $pdf->AddPage();

            //setting up font for the page
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->Cell(270, 10, 'GRADE CARD', 0, 1, 'C');

            //creating blank spaces
            $pdf->Cell(130, 10, '', 0, 1, 'R');

            //Header Details
            $pdf->SetFont('Courier', '', 14);


            $pdf->Cell(40, 10, 'Department', 0, 0);
            $pdf->Cell(130, 10, ": " . $rv[2][0]['d_name'], 0, 1);

            $pdf->Cell(40, 10, 'Programme', 0, 0);
            $pdf->Cell(130, 10, ": " . $rv[1][0]['p_name'], 0, 1);

            $pdf->Cell(40, 10, 'RollNo', 0, 0);
            $pdf->Cell(110, 10, ": " . $rv[0][0]['roll_no'], 0, 0);

            $pdf->Cell(40, 10, 'TERM', 0, 0);
            $pdf->Cell(120, 10, ": " . $rv[3][$i - 1]['term_year'] . " " . $rv[3][$i - 1]['term_type'] . " SEMESTER", 0, 1);

            $pdf->Cell(40, 10, 'Name', 0, 0);
            $pdf->Cell(110, 10, ": " . $rv[0][0]['s_name'], 0, 0);

            $pdf->Cell(40, 10, 'SEMESTER', 0, 0);
            $pdf->Cell(110, 10, ": " . $count, 0, 1);
            $count++;

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

            //For printing the semester subjects
            $pdf->SetFont('Courier', 'B', 14);

            if ($rv[4][$paperPerSemesterCount]['grade'] == "NA") {
                $pdf->Cell(40, 10, 'RESULTS ARE NOT DECLARED YET', 0, 1);
                break;
            } else {
                while ($rv[4][$paperPerSemesterCount]['s_id'] == $i) {

                    $pdf->Cell(40, 10, $rv[4][$paperPerSemesterCount]['code'], 0, 0);
                    $pdf->Cell(120, 10, $rv[4][$paperPerSemesterCount]['titile'], 0, 0);
                    $pdf->Cell(15, 10, $rv[4][$paperPerSemesterCount]['l'], 0, 0);
                    $pdf->Cell(15, 10, $rv[4][$paperPerSemesterCount]['t'], 0, 0);
                    $pdf->Cell(15, 10, $rv[4][$paperPerSemesterCount]['p'], 0, 0);
                    $pdf->Cell(15, 10, $rv[4][$paperPerSemesterCount]['cr'], 0, 0);

                    $tempCredit += $rv[4][$paperPerSemesterCount]['cr'];

                    $pdf->Cell(15, 10, $rv[4][$paperPerSemesterCount]['grade'], 0, 1);

                    $grade = $rv[4][$paperPerSemesterCount]['grade'];
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
                    $tempGradePoint += $gPoint * $rv[4][$paperPerSemesterCount]['cr'];
                    $paperPerSemesterCount++;
                }
                $creditCompleted = $creditCompleted + $tempCredit;
                $totalGradePoint = $totalGradePoint + $tempGradePoint;
                if($tempCredit!=0){
                    $sgpa = round(($tempGradePoint / $tempCredit), 2);
                }
                else{
                    $sgpa=0;
                }
                if($i==$admitYear)
                     {
                        $cgpa = $sgpa;
                     }
                    else
                     {
                         $cgpa = ($cgpa+$sgpa)/2;
                         $cgpa = round($cgpa,2);
                     }
            }

            //for printing the footer details
            $pdf->SetFont('Courier', 'B', 14);
            $pdf->Cell(15, 5, '', 0, 1);
            $pdf->cell(50, 10, 'Credit Counted: ', 0, 0);
            $pdf->cell(40, 10, $tempCredit, 0, 0);
            $pdf->cell(70, 10, 'Total GP Earned: ', 0, 0, 'R');
            $pdf->cell(40, 10, $tempGradePoint, 0, 0);
            $pdf->cell(50,10,'SGPA: ',0,0,'R');
            $pdf->cell(20,10,$sgpa,0,1);
            $pdf->Cell(15,5,'',0,1);
            $pdf->cell(50,10,'Credit Completed: ',0,0);
            $pdf->cell(40,10,$creditCompleted,0,0);
            $pdf->cell(70,10,'Total GP Earned: ',0,0,'R');
            $pdf->cell(40,10,$totalGradePoint,0,0);
            $pdf->cell(50,10,'CGPA: ',0,0,'R');
            $pdf->cell(20,10,$cgpa,0,1);

        }

        $path = 'C:\xampp\htdocs\online course registration system\GradeCard\gradeCard.pdf';
        //   $path = 'D:\TU\tempPDF\tempPDF.pdf';
        $pdf->Output('F', $path, true);
        //pdf ended


        $result[0]['path'] = $path;
        echo json_encode($result);
        exit();
    } else {
        echo json_encode($result);
        exit();
    }
}

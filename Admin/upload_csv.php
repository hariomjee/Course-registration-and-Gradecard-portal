<?php
$rootpath=$_SERVER["DOCUMENT_ROOT"];
require_once $rootpath."/online course registration system/database/db_con.php";
$dbo=new DatabaseConnection;
if(isset($_POST["import"]))
{
  $fileName=$_FILES["file"]["tmp_name"];
//   echo $fileName;

  if($_FILES["file"]["size"]>0)
{
    $file=fopen($fileName,"r");

    // Get the fields from the file
      $fields=array();
      $field_count=0;
  
      if(($data=fgetcsv($file))==FALSE)
    {
        echo "Cannot read Csv $file";
        die();
    } 
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES["file"]["tmp_name"], 'r');
            // Skip the first line
            fgetcsv($csvFile);
            while(($column=fgetcsv($file,10000,","))!=FALSE)
            {

               // print_r($column) ;
                //Get row data
                $roll_no=$column[0];
                $name=$column[1];
                $a_id=$column[2];
                $p_id= $column[3];
                
             $query=$dbo->conn->prepare("INSERT INTO student_details (roll_no, s_name, admitted_on,p_id)
             VALUES (:roll_no, :s_name, :id,:p_id)");
             $query->bindParam(':roll_no',$roll_no);
             $query->bindParam(':s_name', $name);
             $query->bindParam(':id', $a_id);
             $query->bindParam(':p_id',$p_id);
             $query->execute();
            

            }
            echo '<script>alert("Uploded")</script>';
            echo '<script>location.replace("/online course registration system/Admin/student_details.php")</script>';
            exit;
      }
        else{
             
           // header("Location: student_details.php");
            echo '<script>alert("Not Uploaded")</script>';
            echo '<script>location.replace("/online course registration system/Admin/student_details.php")</script>';
            exit;
        }
    }
     
?>
<?php
$rootpath = $_SERVER["DOCUMENT_ROOT"];
require_once $rootpath . "/online course registration system/database/db_con.php";

$dbo = new DatabaseConnection;

if(isset($_POST["upload"]))   // upload -> name of the upload button  
{
  $fileName=$_FILES["file"]["tmp_name"];
//   echo $fileName;

  if($_FILES["file"]["size"]>0)
{
    $file=fopen($fileName,"r");

    // // Get the fields from the file
    //   $fields=array();
    //   $field_count=0;
  
    //   if(($data=fgetcsv($file))==FALSE)
    // {
    //     echo "Cannot read Csv $file";
    //     die();
    // } 
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES["file"]["tmp_name"], 'r');
            // Skip the first line
            fgetcsv($csvFile);
            while(($column=fgetcsv($file,10000,","))!=FALSE)
            {

                // print_r($column) ;
                //Get row data
                $code=$column[0];
                $name=$column[1];
                $l=$column[2];
                $t= $column[3];
                $p= $column[4];
                $cr=$column[5];
                $dept=$column[6];
                
             $query=$dbo->conn->prepare("INSERT INTO `master_course_details` (`code`, `titile`, `l`, `t`, `p`, `cr`, `offered_by_dept`) 
             VALUES (:code,:c_name, :l, :t, :p, :cr, :c_dept)");
             $query->bindParam(':code',$code);
             $query->bindParam(':c_name', $name);
             $query->bindParam(':l', $l);
             $query->bindParam(':t',$t);
             $query->bindParam(':p',$p);
             $query->bindParam(':cr',$cr);
             $query->bindParam(':c_dept',$dept);
             $query->execute();
            

            }
            // header("/online course registration system/course_register/master_courseAjax.php");
            echo '<script>
            alert("Uploded")
            location.assign("/online course registration system/course_register/master_course.php")
            </script>';
          
      }
        else{
            
            echo "error";
        }
    }
 
?>


$(document).ready(function () {

   //  alert("hi");

   var studentId=$("#studentId").val();
  // alert(studentId);


//make an ajax

    $.ajax({
        url: "/online course registration system/showGradesAjax.php",
        type: "POST",
        dataType: "json",
        data: { std_id:studentId,action:"gradeHandle"},
        success:function (result) {
         // alert(JSON.stringify(result));
          //$("#overlay").fadeOut();
           if(result[0]['path']){
             var fn= result[0]['path'];
             //alert(fn);
             let x=``;
            // x=x+`<object   data="${fn}" style="width:100%; min-height: 85vh"></object>`;
            x=x+`<iframe src="GradeCard/gradeCard.pdf" width="1000px" height="1000px" ></iframe>`;
            $("#showGrades").html(x);
          }
           else{
            $("#showGrades").html(``);
          }
        },
          // let x=``;
          // x=x+JSON.stringify(result);
          //  x=x+`<iframe src="C:/xampp/htdocs/tempPDF/tempPDF.pdf"   width="800" height="500"></iframe>`;
  
          //  $("#gradecard").html(x);
        
        error: function (e) {
          console.error(e);
         // alert("Failed to send in table");
          let x=`<iframe src="GradeCard/gradeCard.pdf" width="1000px" height="1000px" ></iframe>`;
            // x=x+`<object   data="${fn}" style="width:100%; min-height: 85vh"></object>`;
          // x=x+`<iframe src="tempPDF/grade.pdf" width="800px" height="1000px" ></iframe>`;
            $("#showGrades").html(x);
        }
      });
    });
$(document).ready(function () {

  //ajax call for get session details
$.ajax({
  url: "/online course registration system/gradecard_db.php",
  type: "POST",
  dataType: "json",
  data: { action: "loadsession" },
  success: function (result) {

    let x = ``;
    x = x + `<select style=" background-color:PowderBlue; width:150px; padding:10px" class="sessionDetails border border-dark rounded">
        <option class="dropdown-item text-center" >SESSION</option>`;
    for (let i = 0; i < result.length; i++) {
      x = x + `<option class=" dropdown-item text-center" value="${result[i].s_id}">${result[i].term_year}` + ` ` + `${result[i].term_type}</option>`;
    }
    x = x + `</select>`;
    $("#session").html(x);
  },
  error: function () {
    alert("something went wrong");
    $("#overlay").fadeOut();
  },
});

// getting session id

$(document).on("change", ".sessionDetails", function () {
  var session_id = this.value;
 // alert("session id: "+session_id);
 sessionStorage.setItem('sessionID', session_id);    // storing session id into session
  
});

// program details

$.ajax({
  url: "/online course registration system/gradecard_db.php",
  type: "POST",
  dataType: "json",
  data: { action: "program" },
  success: function (result) {
    // alert(JSON.stringify(result));

    let x = ``;
    x = x + `<select style="background-color:PowderBlue; width:150px; padding:10px;" class="programDetails border border-dark rounded">
           <option class="dropdown-item text-center">Program</option>`;

    for (let i = 0; i < result.length; i++) {
      x = x + `<option class="dropdown-item text-center" value="${result[i].p_id}">${result[i].p_name}</option>`;
    }
    x = x + `</select>`;
    $("#program").html(x);

  },

  error: function (e) {
    console.error(e);

    alert(" No program");
    //window.location.reload();

  }
});

// getting program id

$(document).on("change", ".programDetails", function () {
  var  program_id = this.value;
//  alert("program id: "+program_id);
sessionStorage.setItem('programID', program_id);   // storing program id into session
  
});


$(document).on("click", "#btn-go", function () {
  let session_ID = sessionStorage.getItem('sessionID');   // getting session id from session
  let program_ID = sessionStorage.getItem('programID');

  // make ajax call
  // alert(session_ID);
  // alert(program_ID);

  $.ajax({
    url: "/online course registration system/pdf.php",
    type: "POST",
    dataType: "json",
    data: { sid:session_ID,pid:program_ID,action:"gradeHandle" },
    success:function (result) {
     // alert(JSON.stringify(result));
      //$("#overlay").fadeOut();
       if(result[0]['path']){
         var fn= result[0]['path'];
        // alert(fn);
         let x=``;
        // x=x+`<object   data="${fn}" style="width:100%; min-height: 85vh"></object>`;
        x=x+`<iframe src="tempPDF/grade.pdf" width="800px" height="1000px" ></iframe>`;
        $("#gradecard").html(x);
      }
       else{
        $("#gradecard").html(``);
      }
    },
      // let x=``;
      // x=x+JSON.stringify(result);
      //  x=x+`<iframe src="C:/xampp/htdocs/tempPDF/tempPDF.pdf"   width="800" height="500"></iframe>`;

      //  $("#gradecard").html(x);
    
    error: function (e) {
      console.error(e);
     // alert("Failed to send in table");
      let x=`<iframe src="tempPDF/grade.pdf" width="800px" height="1000px" ></iframe>`;
        // x=x+`<object   data="${fn}" style="width:100%; min-height: 85vh"></object>`;
      // x=x+`<iframe src="tempPDF/grade.pdf" width="800px" height="1000px" ></iframe>`;
        $("#gradecard").html(x);
    }
  });


  // let x=``;
  // x=x+`<iframe src="pdf.php" width="800" height="500" ></iframe>`;

  // $("#pdf").html(x);




  
});




});




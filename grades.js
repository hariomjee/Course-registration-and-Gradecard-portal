$(document).ready(function () {

  var factname = $("#factname").val();  // getting from grade.php file in hidden value
 //alert(factname);
  //ajax call for get session details
  $.ajax({
    url: "/online course registration system/grades_db.php",
    type: "POST",
    dataType: "json",
    data: { action: "loadsession" },
    success: function (result) {
      let x = ``;
      x = x + `<select style=" background-color:Light; width:150px; padding:10px" class="sessionSlt border border-dark rounded text-uppercase">
          <option class="dropdown-item text-center " >Session</option>`;
      for (let i = 0; i < result.length; i++) {
        x = x + `<option class=" dropdown-item text-uppercase text-center" value="${result[i].s_id}">${result[i].term_year}` + ` ` + `${result[i].term_type}</option>`;
      }
      x = x + `</select>`;
      $("#session").html(x);
    },
    error: function () {
      alert("something went wrong");
      $("#overlay").fadeOut();
    },
  });

  //ajax call for get course details
  $.ajax({
    url: "/online course registration system/grades_db.php",
    type: "POST",
    dataType: "json",
    data: { action: "loadcourse" },
    success: function (result) {
      // $("#overlay").fadeOut();
      //   alert(JSON.stringify(result));
      let x = ``;
      x = x + `<select style=" background-color:Light; width:150px; padding:10px" class="courseSlt border border-dark rounded text-uppercase">
      <option class="dropdown-item text-center text-uppercase" >COURSES</option>`;
      for (let i = 0; i < result.length; i++) {
        x = x + `<option class=" dropdown-item text-uppercase text-center" value="${result[i].code}">${result[i].code}</option>`;
      }
      x = x + `</select>`;
      $("#course").html(x);
    },
    error: function () {
      alert("something went wrong");
      $("#overlay").fadeOut();
    },
  });

  //select session
  $(document).on("change", ".sessionSlt", function () {

    let sessionid = this.value;
    //alert(sessionid);
    sessionStorage.setItem('s_id', sessionid);
    //    let x=getTable1();
    //    $("#table1").html(x);
    //     get_list(courseid);



  });


  //select course
  $(document).on("change", ".courseSlt", function () {

    let courseid = this.value;
    // alert(courseid);
    sessionStorage.setItem('c_id', courseid);
    let x = getTable1();  
    $("#table1").html(x);
    get_list(courseid);
  });

  // click go button
  $(document).on("click", "#btn-go", function () {

    let sid = sessionStorage.getItem('s_id');
    let cid = sessionStorage.getItem('c_id');
    // alert(sid);
    // alert(cid);
    x = getTable2();
    $("#table2").html(x);


    //ajax call for getting student details

    $.ajax({
      url: "/online course registration system/grades_db.php",
      type: "POST",
      dataType: "json",
      data: { sid: sid, cid: cid, action: "stdDetails" },
      success: function (result) {
       // alert(JSON.stringify(result));
        let y = ``;
        for (i = 0; i < result.length; i++) {
      
          y = y + `<tr>
        <th>${i + 1}</th>
        <td class="text-uppercase">${result[i].roll_no}</td>
        <td class="text-uppercase">${result[i].s_name}</td>
        <td class="text-uppercase">${result[i].category}</td>
        <td><select class="text-uppercase" name="grades[]" id="${result[i].std_id}">
        <option  class="dropdown-item text-center grade">${result[i].grade}</option>
        <option class="dropdown-item text-center box" value="O">O</option>
        <option class="dropdown-item text-center box" value="A+">A+</option>
        <option class="dropdown-item text-center box" value="A">A</option>
        <option class="dropdown-item text-center box" value="B+">B+</option>
        <option class="dropdown-item text-center box" value="B">B</option>
        <option class="dropdown-item text-center box" value="C+">C+</option>
        <option class="dropdown-item text-center box" value="C">C</option>
        <option class="dropdown-item text-center box" value="P">P</option>
        <option class="dropdown-item text-center box" value="S">S</option>
        </select>
        </td>
        </tr>
        `;
        }
        $("#getbody1").html(y);

      },
      error: function () {
        alert("No Students enroll");
      },

    });
  });



  //click Save button

  $(document).on("click", "#btn-save", function () {

    let sid = sessionStorage.getItem('s_id');
    let cid = sessionStorage.getItem('c_id');
    
  //alert(sid);
  //alert(cid);

    var grades = document.getElementsByName('grades[]');

    for (var grade of grades) {

      id = grade.id;
      var conceptName = $(`#${id} :selected`).text();
      // alert(conceptName);
      // // alert(factname);
      // alert(id);
      $.ajax({
        url: "/online course registration system/grades_db.php",
        type: "POST",
        dataType: "json",
        data: { sid: sid,
           cid: cid, 
           st_id: id, 
           grade_by:factname,
           grades: conceptName, action: "gradeHandle" },
        success: function (result) {
         // alert(result.status);
         
        },
        error: function (e) {
          console.error(e);
          alert("Failed to send in table");
        }
      });
    }
    alert("successful");

  })






});

// function for get course list

function get_list(id) {
  $.ajax({
    url: "/online course registration system/grades_db.php",
    type: "POST",
    dataType: "json",
    data: { id: id, action: "getCourseList" },
    beforeSend: function () {
      //  alert("about to send an ajax call");
    },
    success: function (result) {
      // alert(JSON.stringify(result));
      arr = result;
      let y = ``;
      for (i = 0; i < arr.length; i++) {
        y = y + `<tr>
               <th>${i + 1}</th>
               <td class="text-uppercase">${arr[i].code}</td>
               <td class="text-uppercase">${arr[i].titile}</td>
               <td class="text-uppercase">${arr[i].l}</td>
               <td class="text-uppercase">${arr[i].t}</td>
               <td class="text-uppercase">${arr[i].p}</td>
               <td class="text-uppercase">${arr[i].cr}</td>
               <td class="text-uppercase">${arr[i].offered_by_dept}</td>
               </tr>`;

      }
      $("#getbody").html(y);
    },
    error: function () {
      alert("error");
    },

  });
}

//function for get course table

function getTable1() {

  let x = ``;
  x = x + `<h3>Course Details</h3><div class="row">
 <div class="col mt-2" id="courseList">
   <table class="table">
     <thead class="thead-dark">
       <tr>
         <th scope="col">Id</th>
         <th scope="col">Code</th>
         <th scope="col">Name</th>
         <th scope="col">L</th>
         <th scope="col">T</th>
         <th scope="col">P</th>
         <th scope="col">CR</th>
         <th scope="col">Department</th>
       </tr>
     </thead>
     <tbody id="getbody">
     </tbody>
   </table>
 </div>
</div>`;

  return x;
}


// function for get students table

function getTable2() {

  let x = ``;
  x = x + `<h3>Student Details</h3>`;
  x = x + `<div class="row">
     <div class="col mt-2" id="courseList">
       <table class="table">
         <thead class="thead-dark">
           <tr>
             <th scope="col">Id</th>
             <th scope="col">Roll No</th>
             <th scope="col">Name</th>
             <th scope="col">Category</th>
             <th scope="col">Grade</th>
           </tr>
         </thead>
         <tbody id="getbody1">
         </tbody>
       </table>
     </div>
    </div>
    <button class="btn btn-success float-right" id="btn-save">Save</button>`
    ;

  return x;
}




$(document).ready(function () {


 $(document).on("click", "#Home", function () {
    window.location.replace("/online course registration system/Home.php");
  });


  
 var student_id = $("#studentid").val();
  var program_id = $("#programid").val();          // we store the program id into session and in course_registration.php file we store that value into a id by that we are accessing that.
  var currentSem = $("#currentSem").val();
  var currentSession = $("#currentSession").val();
  var no_of_sem = $("#no_of_sem").val();

 // let currentSession=$("#currentSession").val();
  let admitSession=$("#admitSession").val();
  let num1=Number(admitSession);
  let num2=Number( currentSession);
  let num3=Number(no_of_sem);
  //alert(typeof(num3));

//ajax for get session
$.ajax({
  url:'/online course registration system/course_register/course_registration_db.php',
  type: "POST",
  dataType: "json",
  data:{ action:'loadsession'},
  success: function (result) {
     //  alert(JSON.stringify(result));
     let x=`<select  class="ml-2 text-uppercase sessionId" >`;
     x =x+`
    <option class="dropdown-item">Session</option>`;
    for (let i=num2-1;i>=num1-1; i--) {
      x = x +`<option class="dropdown-item" value="${result[i].s_id}">${result[i].term_year}` + ` ` + `${result[i].term_type}</option>`;
    }
    x=x+`</select>`;
    $("#session").html(x);
    // alert("succcess");
  },
  error: function () {
    alert("error in loadsession");
    $("#overlay").fadeOut();
  },
});
//change session
$(document).on("change",".sessionId",function(){
  
  let sid=this.value;
  //  alert(sid);
   sessionStorage.setItem('session_id',sid ); 
    

});


  //make an ajax call for button semesters
  $.ajax({
    url: "/online course registration system/course_register/course_registration_db.php",
    type: "POST",
    dataType: "json",
    data: { id: program_id, action: "semester" },
    success: function (result) {
      // alert(JSON.stringify(result));
      let sem = `${result[0].no_of_sem}`;
      //alert(sem);
      let x = ``;
      for (let i = 1; i <= sem; i++) {
        x = x + `<button class="btn  btn-lg btn-success rounded-circle m-3 semester  " id="${i}">S${i}</button>`;
      }

      $("#semester").html(x);

    },

    error: function (e) {
      console.error(e);

      alert(" No semesters");


    }
  });

  $(document).on("click", ".semester", function () {

    let id = this.id;
    // alert("current sem" + id);
    // let sem = Number(currentSem);          // we have to convert it into no

      $.ajax({
        url: "/online course registration system/course_register/course_registration_db.php",
        type: "POST",
        dataType: "json",
        data: { sid:id, pid: program_id, action: "semester_courses" },
        
        success: function (result) {
          arr = result;
          let y = table(arr);
          $("#offered_courses").html(y);
        },

        error: function (e) {
          console.error(e);
          alert(" No semester_courses");
        }
      });
   



  });


  $(document).on("click", "#save", function () {
    //alert("ok");
    var checkboxes = document.getElementsByName('course[]');
    var s_id = 0, session_id = 0, course_id = "", category = "";
    for (var checkbox of checkboxes) {
      if (checkbox.checked) {
        s_id = Number(student_id);  // converting student_id into number
        session_id = sessionStorage.getItem('session_id');
        course_id = checkbox.value;  // getting course_id of course from  function table(arr) value="${arr[i].code}"
        category = checkbox.id     // getting category of course from  function table(arr) id="${arr[i].category}" 
      
      }
    

    $.ajax({
      url: "/online course registration system/course_register/course_registration_db.php",
      type: "POST",
      dataType: "json",
      data: { id: s_id, Session: session_id, category: category, course_id: course_id, action: "checked" },
      success: function (result) {
       // alert(result);
      },
      error: function (e) {
        console.error(e);
       // alert("Already selected");
      }
    });
    }
    alert("successfull");
  });
  



});


function table(arr) {
  x = ``;
  x = x + `<table class="table" id="courseTbl">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Code</th>
            <th scope="col">title</th>
            <th scope="col">L</th>
            <th scope="col">T</th>
            <th scope="col">P</th>
            <th scope="col">CR</th>
            <th scope="col">Category</th>
            <th scope="col">Select</th>
          </tr>
        </thead>`;
  x = x + `<tbody>`;
  for (i = 0; i < arr.length; i++) {
    x = x + `<tr>
            <th>${i + 1}</th>
            <td>${arr[i].code}</td>
            <td>${arr[i].titile}</td>
            <td>${arr[i].l}</td>
            <td>${arr[i].t}</td>
            <td>${arr[i].p}</td>
            <td>${arr[i].cr}</td>
            <td>${arr[i].category}</td>
            <td scope="col"><input class="form-check-input check" type="checkbox" id="${arr[i].category}"  name="course[]" value="${arr[i].code}" </td>
            </tr>`;

  }
  x = x + `</tbody></table><button class="btn btn-lg btn-success float-right" id="save">Save</button>`;

  return x;
}


function GetSelected() {



}

$(document).ready(function(){


  $(document).on("click", "#Home", function () {
    window.location.replace("/online course registration system/Home.php");
  });


      let currentSession=$("#currentSession").val();
      let admittedSession=$("#admitSession").val();
      let studentId=$("#studentid").val();
      //  alert(studentId);

      let num1=Number(admittedSession);
       let num2=Number( currentSession);

      
    //    alert(currentSession);
//        alert(adSession);
//   let num=8;

    $.ajax({
        url:'/online course registration system/course_register/previous_sem_db.php',
        type: "POST",
        dataType: "json",
        data:{admit:num1,
              action:'loadsession'},
        success: function (result) {
          $("#overlay").fadeOut();
           // alert(JSON.stringify(result));
           //  alert("ok");
    
          let x =`<select class="sessionId text-uppercase "><option>Session</option>`;
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

      $(document).on('change','.sessionId',function(){
        let value = this.value;
        //alert(value);
      //  let studentId=$("#studentid").val();
      //   alert(studentId);
      // alert(value);
    getCourse(value,studentId);


  });


 });

function getCourse(value,studentId){

 $.ajax({
    url:'/online course registration system/course_register/previous_sem_db.php',
    type: "POST",
    dataType:"json",
    data: {id:value,std_id:studentId,action:"semester_courses" },
    beforeSend: function(){
     // alert("about to send an ajax call");
    },
    success: function (result) {
     // alert(JSON.stringify(result));
       arr= result;
     
      let y= table(arr);
      $("#preCourse").html(y);
    },
    error:function (e) {
      console.error(e);
      alert(" No value available");
    }
    });



}

function table(arr){
  x=``;
  x=x+`<table class="table" id="courseTbl">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Code</th>
      <th scope="col">Title</th>
      <th scope="col">L</th>
      <th scope="col">T</th>
      <th scope="col">P</th>
      <th scope="col">CR</th>
      <th scope="col">Category</th>
      <th scope="col">Grade</th>
    </tr>
  </thead>`;
  x=x+`<tbody>`;
  for (i = 0; i < arr.length; i++){
      x=x+`<tr>
      <th>${i+1}</th>
      <td class="text-uppercase">${arr[i].code}</td>
      <td class="text-uppercase">${arr[i].titile}</td>
      <td class="text-uppercase">${arr[i].l}</td>
      <td class="text-uppercase">${arr[i].t}</td>
      <td class="text-uppercase">${arr[i].p}</td>
      <td class="text-uppercase">${arr[i].cr}</td>
      <td class="text-uppercase">${arr[i].category}</td>
      <td class="text-uppercase">${arr[i].grade}</td>
      </tr>`;
  
  }
  x=x+`</tbody></table>`;
  
  return x;
  }
  

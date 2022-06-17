$(document).ready(function(){
//   alert('hello');
    $.ajax({
        url:"/online course registration system/Admin/student_db.php",
        type: "POST",
        dataType:"json",
        data:{action:"loadsession" },
         beforeSend: function () {
        //   $("#overlay").fadeIn();
         //  alert("about to call")
        },
        success:function(result) {
        //  $("#overlay").fadeOut();
           //alert(JSON.stringify(result));
          let x=``;
          x=x+`<select style=" background-color:Light; width:150px; padding:10px" class="stdDetails border border-dark rounded text-uppercase">
          <option class="dropdown-item text-uppercase">Session</option>`;
          for(let i=0;i<result.length;i++){
            x=x+`<option class=" dropdown-item text-uppercase" value="${result[i].s_id}">${result[i].term_year}`+` `+`${result[i].term_type}</option>`;
          }
          x=x+`</select>`;
             $("#session").html(x);
        },
        error: function () {
          alert("something went wrong");
          $("#overlay").fadeOut();
        },
      });
//student list

      $(document).on("change",".stdDetails",function(){
        let value= this.value;
        // sessionStorage.setItem("id",id);
       // alert(value);
        getStudentList(value);
       
   });
    });
  
  //get student details
  
  function getStudentList(id){
    
    $.ajax({
        url:'/online course registration system/Admin/student_db.php',
        type: "POST",
        dataType:"json",
        data: {id:id,action: "getStudentList" },
        //  beforeSend: function () {
        //      alert("Lets see how its going!")
        //  },
        success: function (result) {
          let arr = result;
          let y=``;
          y=y+`<table class="table">
          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Program code</th>
              <th scope="col">Roll no</th>
              <th scope="col">Student Name</th>
            </tr>
          </thead><tbody>`;
          for (i = 0; i < arr.length; i++) {
           y = y +`<tr>
           <td>${i + 1}</td>
          <td>${arr[i].p_code}</td>
          <td class="col-3 text-uppercase">${arr[i].roll_no}</td>
          <td class="col-3 text-uppercase">${arr[i].s_name}</td></tr>`
          }
          y = y + `</tbody></table>`

          $("#stdDiv").html(y);
        
        },

        error: function (e) {
            console.error(e);

            alert("no data");
            window.location.reload();
          
        }
    });
    
}

 
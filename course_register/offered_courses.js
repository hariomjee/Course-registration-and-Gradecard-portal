$(document).ready(function(){

  //get department
      $.ajax({
          url:"/online course registration system/course_register/offered_courses_db.php",
          type: "POST",
          dataType:"json",
          data:{action:"department" },
          success:function(result) {
           // alert("oj");
            let x=``;
            x=x+`<select style="background-color:PowderBlue; width:150px; padding:10px;" class="departDetails border border-dark rounded ">`;
            x=x+`<option class="dropdown-item text-uppercase">Department</option>`;
            for(let i=0;i<result.length;i++){
              x=x+`<option class="dropdown-item text-uppercase" value="${result[i].d_id}">${result[i].d_name}</option>`;
            }
            x=x+`</select>`;
               $("#depart").html(x);
          },
          error: function () {
            alert("something went wrong");
            $("#overlay").fadeOut();
          },
        });
  
  // department button click
  
   $(document).on("change",".departDetails",function(){
          let id= this.value;
          //alert("Department id: "+id);
          program(id);
      });
  
  // program button click
   $(document).on("change",".programDetails",function(){
        let id = this.value;
       // alert("Program id: "+id);
        sessionStorage.setItem('p_id',id);   // storing program id into session
        semester(id);
     });
  
  // semester button click
  
  $(document).on("click",".semester",function(){
      let id = this.id;
      sessionStorage.setItem('sem',id);         // storing semester id into session
      let pid=sessionStorage.getItem('p_id');  // get program id from session storage
      //alert("Semester id: "+id);
      //alert("program id:"+pid);
      semester_courses(id);
      let x=getDiv();
      $("#getDiv").html(x);
  
      });
  
  //add course save button
  
      $(document).on("click","#btn-save",function(){
      let code=$("#c_code").val();
      let category=sessionStorage.getItem('category');      // getting category id from session
      let pid=sessionStorage.getItem('p_id');               // getting program id from session
      let sem_id=sessionStorage.getItem('sem');             // getting semester id from session
  
      //make an ajax call
  
  $.ajax({
    url:"/online course registration system/course_register/offered_courses_db.php",
    type:"POST",
    dataType:"json",
    data: {code:code,cate:category,program_id:pid,semester:sem_id, action:"AddCourse"},
    success:function(result){
    //alert(result.status);
    alert("Saved");
    // location.reload();
    },
    error:function(){
        alert("error");
    },
  
  });
        
   });
  
  //press tab add course button auto fill value
  
  $(document).on('keydown',"#c_code",function(e){
    if (e.keyCode == 9){
        e.preventDefault();
        alert('Auto fill');
    var c_code=$("#c_code").val();
        //alert(c_code);
        var c_len=c_code.length;
       // alert(c_len);
        if(c_len!==0){
  
       // make an ajax call
  
        $.ajax({
            url:"/online course registration system/course_register/offered_courses_db.php",
            type:"POST",
            dataType:"json",
            data: {code:c_code, action:"getCourse"},
            success:function(result){
           // alert(JSON.stringify(result));
             title=result[0].titile;
            l=result[0].l;
            t=result[0].t;
            p=result[0].p;
            cr=result[0].cr;
            category=result[0].category;
             $("#title").val(title);
            $("#l").val(l);
            $("#t").val(t);
            $("#p").val(p);
            $("#cr").val(cr);
            },
            error:function(){
                alert("no value exist");
                // alert("add new value");
                $("#l").val("");
                $("#t").val("");
                $("#p").val("");
                $("#cr").val("");
                let a=`<a class="dropdown-item" href="#" id="C">C</a>
                <a class="dropdown-item" href="#" id="E">E</a>
                <a class="dropdown-item" href="#" id="OE">OE</a>
                <a class="dropdown-item" href="#" id="A">A</a>`;
                $("#category").html(a);
            },
        
        });
  
        }
        else{
            $("#l").val("");
            $("#t").val("");
            $("#p").val("");
            $("#cr").val("");
            let a=`<a class="dropdown-item" href="#" id="C">C</a>
            <a class="dropdown-item" href="#" id="E">E</a>
            <a class="dropdown-item" href="#" id="OE">OE</a>
            <a class="dropdown-item" href="#" id="A">A</a>`;
            $("#category").html(a);
        }
    }
  });
  
  //press tab2 edit button auto fill value
// $(document).on('keydown',"#code",function(e){
//     if (e.keyCode == 9){
//         e.preventDefault();
//         alert('Auto fill');
//     var c_code=$("#code").val();
//        // alert(c_code);
//         var c_len=c_code.length;
//        // alert(c_len);
//         if(c_len!==0){
  
//        // make an ajax call
  
//         $.ajax({
//             url:"/online course registration system/course_register/offered_courses_db.php",
//             type:"POST",
//             dataType:"json",
//             data: {code:c_code, action:"getCourse"},
//             success:function(result){
//            // alert(JSON.stringify(result));
//             // title=result[0].titile;
//             l=result[0].l;
//             t=result[0].t;
//             p=result[0].p;
//             cr=result[0].cr;
//             category=result[0].category;
//             // $("#title").val(title);
//             $("#c_l").val(l);
//             $("#c_t").val(t);
//             $("#c_p").val(p);
//             $("#c_cr").val(cr);
//             },
//             error:function(){
//                 alert("no value exist");
//                 alert("add new value");
//                 $("#c_l").val("");
//                 $("#c_t").val("");
//                 $("#c_p").val("");
//                 $("#c_cr").val("");
//                 let a=`<a class="dropdown-item" href="#" id="C">C</a>
//                 <a class="dropdown-item" href="#" id="E">E</a>
//                 <a class="dropdown-item" href="#" id="OE">OE</a>
//                 <a class="dropdown-item" href="#" id="A">A</a>`;
//                 $("#category").html(a);
//             },
        
//         });
  
//         }
//         else{
//             $("#c_l").val("");
//             $("#c_t").val("");
//             $("#c_p").val("");
//             $("#c_cr").val("");
//             let a=`<a class="dropdown-item" href="#" id="C">C</a>
//             <a class="dropdown-item" href="#" id="E">E</a>
//             <a class="dropdown-item" href="#" id="OE">OE</a>
//             <a class="dropdown-item" href="#" id="A">A</a>`;
//             $("#category").html(a);
//         }
//     }
//   });
  
  //edit button click
  
  $(document).on("click",".btn-edit",function(){
  
    var course_id=this.id;
    alert(course_id);
    sessionStorage.setItem('courseId',course_id );      // store course id into session
  
  

    // make an ajax call

     $.ajax({
         url:"/online course registration system/course_register/offered_courses_db.php",
         type:"POST",
         dataType:"json",
         data: {courseId:course_id,action:"getCourse"},
         success:function(result){
        // alert(JSON.stringify(result));
         // title=result[0].titile;
         code=result[0].code;
         l=result[0].l;
         t=result[0].t;
         p=result[0].p;
         cr=result[0].cr;
         category=result[0].category;
         // $("#title").val(title);
         $("#code").val(code);
         $("#c_l").val(l);
         $("#c_t").val(t);
         $("#c_p").val(p);
         $("#c_cr").val(cr);
         },
         error:function(){
             alert("no value exist");
             alert("add new value");
             $("#c_l").val("");
             $("#c_t").val("");
             $("#c_p").val("");
             $("#c_cr").val("");
             let a=`<a class="dropdown-item" href="#" id="C">C</a>
             <a class="dropdown-item" href="#" id="E">E</a>
             <a class="dropdown-item" href="#" id="OE">OE</a>
             <a class="dropdown-item" href="#" id="A">A</a>`;
             $("#category").html(a);
         },
     
     });

     
});
  
  //category dropdown click
  
  $(document).on("change",".category",function(){
  
      var c_id=this.value;
    //  alert(c_id);
    sessionStorage.setItem('category', c_id);                 // store category id into session
  
  });
  
  //save change button click
  
  $(document).on("click","#btn-change",function(){
  
    var code=$("#code").val();
    var c_l=$("#c_l").val();
    var c_t=$("#c_t").val();
    var c_p=$("#c_p").val();
    var c_cr=$("#c_cr").val();
  
      let category=sessionStorage.getItem('category');
      let course_id=sessionStorage.getItem('courseId');
  
      //alert(code);
  // alert(c_l);
  // alert(c_t);
  // alert(c_p);
  // alert(c_cr);
  // alert(category);
  // alert(course_id);
  //ajax call
  $.ajax({
    url:"/online course registration system/course_register/offered_courses_db.php",
    type:"POST",
    dataType:"json",
    data: {c_code:code,category:category, action:"EditCourse"},
    success:function(result){
    //alert(result.status);
    // location.reload();
    window.close();
    },
    error:function(){
        alert("error");
    },
  
  });
  
  
  
  
  
  
  
  
  });
  
  
  
  
  
    });
  
  //  program details
  
  function program(id){
  
      $.ajax({
          url:"/online course registration system/course_register/offered_courses_db.php",
          type: "POST",
          dataType:"json",
          data: {id:id, action:"program" },
          success: function (result) {
             // alert(JSON.stringify(result));
             
              let x=``;
               x=x+`<select style="background-color:PowderBlue; width:150px; padding:10px;" class="programDetails border border-dark rounded">
               <option>Program</option>`;
  
            for(let i=0;i<result.length;i++){
              x=x+`<option class="dropdown-item " value="${result[i].p_id}">${result[i].p_name}</option>`;
            }
             x=x+`</select>`;
              $("#program").html(x);
          
          },
  
          error: function (e) {
              console.error(e);
  
              alert(" No program");
              window.location.reload();
            
          }
      });
  }
  
  
  
    //  semester details
  
  function semester(id){
  
    $.ajax({
        url:"/online course registration system/course_register/offered_courses_db.php",
        type: "POST",
        dataType:"json",
        data: {id:id,action: "semester" },
        success: function (result) {
           // alert(JSON.stringify(result));
           let sem= `${result[0].no_of_sem}`;
           //alert(sem);
            let x=``;
          for(let i=1;i<=sem;i++){
            x=x+`<button style="margin:30px;" type="button"  class="btn btn-success type  semester " id="${i} ">S${i}</button>`;
          }
  
            $("#semester").html(x);
        
        },
  
        error: function (e) {
            console.error(e);
  
            alert(" No semesters");
          
          
        }
    });
  }
  
  
  // courses in semester
  
  function semester_courses(sid){
    let pid=sessionStorage.getItem('p_id');     // getting program id from session
    $.ajax({
        url:"/online course registration system/course_register/offered_courses_db.php",
        type: "POST",
        dataType:"json",
        data: {id:sid,pid:pid,action:"semester_courses" },
        success: function (result) {
          // alert(JSON.stringify(result));
           arr= result;
           let y=`<thead class="thead-dark">
           <tr>
             <th scope="col">Id</th>
             <th scope="col">Code</th>
             <th scope="col">Name</th>
             <th scope="col">L</th>
             <th scope="col">T</th>
             <th scope="col">P</th>
             <th scope="col">CR</th>
             <th scope="col">Offer As</th>
             <th scope="col">  </th>
           </tr>
         </thead>
         <tbody>
        `;
            for (i = 0; i < arr.length; i++){
               y=y+`<tr>
               <th>${arr[i].id}</th>
               <td>${arr[i].code}</td>
               <td>${arr[i].titile}</td>
               <td>${arr[i].l}</td>
               <td>${arr[i].t}</td>
               <td>${arr[i].p}</td>
               <td>${arr[i].cr}</td>
               <td>${arr[i].category}</td>
               <td><button class="btn btn-primary btn-edit"data-toggle="modal"data-target="#exampleModal1" id="${arr[i].id}">Edit</button></td>
               </tr> </tbody>`;
            }
            $("#semester_courses").html(y);
        
        },
  
        error: function (e) {
            console.error(e);
  
            alert(" No semester_courses");
            
          
        }
    });
  }
  
  // Course details
  
  function getDiv(){
   let z=``;
  // Model for add course
  
   z=z+`<div class="container"><div class="row">
         <div class="col d-flex justify-content-center">
         <!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Add course
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body ">
       <div class="row">
           <div class="col">
               <label>course_code :</label>
               <input type="text" name="code" id="c_code" />
           </div>
       </div>
           <div class="row">
           <div class="col">
               <label>course_title:</label>
               <input type="text" name="title" id="title"/>
           </div>
          </div>
          <div class="row">
           <div class="col">
               <label>L:</label>
               <input type="text" name="l" id="l"/>
           </div>
          </div>
          <div class="row">
           <div class="col">
               <label>T:</label>
               <input type="text" name="t" id="t"/>
           </div>
          </div>
          <div class="row">
           <div class="col">
               <label>P:</label>
               <input type="text" name="p" id="p"/>
           </div>
          </div>
          <div class="row">
           <div class="col">
               <label>Cr:</label>
               <input type="text" name="cr" id="cr"/>
           </div>
          </div>
             <div class="dropdown">
  
    </div>
          <div class="dropdown mt-2">
          <select  class="category" id="category">
          <option class="dropdown-item" >category</option>
          <option class="dropdown-item" value="C">C</option>
          <option class="dropdown-item" value="E">E</option>
          <option class="dropdown-item" value="OE">OE</option>
          <option class="dropdown-item" value="A">A</option>
          </select>
  </div>
   </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn-save">Save</button>
        </div>
      </div>
    </div>
  </div>
        </div>      
   </div>`;
   //Modal 2 for edit course
  
   z=z+`<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
       <div class="row">
       <div class="col">
           <label>course_code:</label>
        <input type="text" name="code" id="code"/>
       </div>
   </div>
   <div class="row mb-1">
   <div class="col">
       <label>L:</label>
       <input type="text" name="l" id="c_l"/>
   </div>
  </div>
      <div class="row">
          <div class="col">
              <label>T:</label>
              <input type="text" name="t" id="c_t"/>
          </div>
         </div>
         <div class="row">
         <div class="col">
             <label>P:</label>
             <input type="text" name="p" id="c_p"/>
         </div>
        </div>
        <div class="row">
          <div class="col">
              <label>Cr:</label>
              <input type="text" name="cr" id="c_cr"/>
          </div>
         </div>
         <div class="dropdown">
         <select  class="category" id="category">
         <option class="dropdown-item" >Department</option>
         <option class="dropdown-item" value="C">C</option>
         <option class="dropdown-item" value="E">E</option>
         <option class="dropdown-item" value="OE">OE</option>
         <option class="dropdown-item" value="A">A</option>
          </select>
  </div>
  </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn-change">Save changes</button>
       </div>
     </div>
   </div>
  </div>`;
  z=z+`</div>`;
  z=z+`<div class="row">
  <div class="col mt-2" id="courseList">
  <table class="table" id="semester_courses">
  </table>
  </div>
  </div>`;
  
  return z;
  
  }
  
  
  
  
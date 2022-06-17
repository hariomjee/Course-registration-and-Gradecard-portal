$(document).ready(function(){

  //ajax call for get session details
  $.ajax({
    url:"/online course registration system/grades_db.php",
    type: "POST",
    dataType:"json",
    data:{action:"loadsession" },
    beforeSend: function () {
      $("#overlay").fadeIn();
      // alert("about to call")
    },
    success:function(result) {
      $("#overlay").fadeOut();
    //   alert(JSON.stringify(result));
      let x=``;
      x=x+`<select style=" background-color:Light; width:150px; padding:10px" class="sessionSlt border border-dark rounded text-center text-uppercase">
      <option class="dropdown-item text-center" >SESSION</option>`;
      for(let i=0;i<result.length;i++){
        x=x+`<option class=" dropdown-item " value="${result[i].s_id}">${result[i].term_year}`+` `+`${result[i].term_type}</option>`;
      }
      x=x+`</select>`;
         $("#session").html(x);
    },
    error: function () {
      alert("something went wrong");
      $("#overlay").fadeOut();
    },
  });


    //ajax call for get course details
    $.ajax({
        url:"/online course registration system/grades_db.php",
        type: "POST",
        dataType:"json",
        data:{action:"loadcourse" },
        beforeSend: function () {
          $("#overlay").fadeIn();
          // alert("about to call")
        },
        success:function(result) {
          $("#overlay").fadeOut();
        //   alert(JSON.stringify(result));
          let x=``;
          x=x+`<select style=" background-color:Light; width:150px; padding:10px" class="courseSlt border border-dark rounded text-center text-uppercase">
          <option class="dropdown-item text-center " >COURSES</option>`;
          for(let i=0;i<result.length;i++){
            x=x+`<option class=" dropdown-item text-center " value="${result[i].code}">${result[i].code}</option>`;
          }
          x=x+`</select>`;
             $("#course").html(x);
        },
        error: function () {
          alert("something went wrong");
          $("#overlay").fadeOut();
        },
      });
//select session
$(document).on("change",".sessionSlt",function(){

     let sid=this.value;

    //  alert( sid);
   sessionStorage.setItem('s_id',sid); 


});
 //select course
 $(document).on("change",".courseSlt",function(){
   
    let courseid=this.value;
    // alert(courseid);
    sessionStorage.setItem('c_id',courseid);   

});

$(document).on("click","#btn-go",function(){

    let sid=sessionStorage.getItem('s_id');
    let cid=sessionStorage.getItem('c_id');



    $.ajax({
        url:"/online course registration system/Admin/courseRegistrationAjax.php",
        type:"POST",
        dataType:"json",
        data: {
            sid:sid,
            cid:cid,
            action:"stdDetails"
        },
        success:function(result){
        //  alert(JSON.stringify(result));
         let y=``;
         for (i = 0; i <result.length; i++){
             y=y+`<tr>
             <td>${i+1}</td>
             <td>${result[i].roll_no}</td>
             <td>${result[i].s_name}</td>
             <td>${result[i].course_id }</td>
             <td>${result[i].category}</td>
             </tr>`;
            }
            $("#getbody1").html(y);
    
        },
        error:function(){
            alert("no value");
        },
      
      });

      let x=getTable1();

      $("#stdTable").html(x);




});
$(document).on("click","#download-btn",function(){

    // alert("hi");
    // var csv_data=$("#StdList").html();
    // var page="excel.php?data=" + csv_data;
    // window.location = page;

    // alert(csv_data);

var titles = [];
var data = [];

/*
* Get the table headers, this will be CSV headers
* The count of headers will be CSV string separator
*/
$('.StdList th').each(function() {
    titles.push($(this).text());
  });
  
  /*
   * Get the actual data, this will contain all the data, in 1 array
   */
  $('#getbody1 td').each(function() {
    data.push($(this).text());
  });
 
    /*
   * Convert our data to CSV string
   */
  var CSVString = prepCSVRow(titles, titles.length, '');
  CSVString = prepCSVRow(data, titles.length, CSVString);



  /*
   * Make CSV downloadable
   */
  var downloadLink = document.createElement("a");
  var blob = new Blob(["\ufeff", CSVString]);
  var url = URL.createObjectURL(blob);
  downloadLink.href = url;
  downloadLink.download = "data.csv";

  /*
   * Actually download CSV
   */
  document.body.appendChild(downloadLink);
  downloadLink.click();
  document.body.removeChild(downloadLink);

  

});

// $(document).on("click","#download-btn",function(){
//   // let x=``;
// //   x=x+`<iframe src="data.csv" width="800" height="500">
// //   </iframe>`;

// // $("#csv").html(x);

// });




});

function getTable1(){

    let x=``;
    x=x+`<h3>Student Details</h3>`;
     x=x+`<div class="row">
     <div class="col mt-2">
       <table class="table">
         <thead class="thead-dark StdList">
           <tr>
             <th scope="col">Id</th>
             <th scope="col">Roll No</th>
             <th scope="col">Name</th>
             <th scope="col">Course</th>
             <th scope="col">Category</th>
           </tr>
         </thead>
         <tbody id="getbody1">
         </tbody>
       </table>
     </div>
    </div>
    <div id="frame"></div>
    <div class="row">
    <div class="col">
    <button class="btn btn-success"id="download-btn">Download CSV</button>

    </div>
    
    </div>`;
    
    return x;
    }

    function prepCSVRow(arr, columnCount, initial) {
        var row = ''; // this will hold data
        var delimeter = ','; // data slice separator, in excel it's `;`, in usual CSv it's `,`
        var newLine = '\r\n'; // newline separator for CSV row
      
        /*
         * Convert [1,2,3,4] into [[1,2], [3,4]] while count is 2
         * @param _arr {Array} - the actual array to split
         * @param _count {Number} - the amount to split
         * return {Array} - splitted array
         */
        function splitArray(_arr, _count) {
          var splitted = [];
          var result = [];
          _arr.forEach(function(item, idx) {
            if ((idx + 1) % _count === 0) {
              splitted.push(item);
              result.push(splitted);
              splitted = [];
            } else {
              splitted.push(item);
            }
          });
          return result;
        }
        var plainArr = splitArray(arr, columnCount);
        // it converts `['a', 'b', 'c']` to `a,b,c` string
        plainArr.forEach(function(arrItem) {
          arrItem.forEach(function(item, idx) {
            row += item + ((idx + 1) === arrItem.length ? '' : delimeter);
          });
          row += newLine;
        });
        return initial + row;
      }
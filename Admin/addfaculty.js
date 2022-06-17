$(document).ready(function () {

  //alert("add faculty");
  get_list();

  get_dept();

  //get department id

  $(document).on("click", ".deptname", function () {
    let d_id = this.id;
   //  alert(d_id);
    sessionStorage.setItem('id', d_id);     // store department name into session

  });

  $(document).on("click", "#add_btn", function () {
    var f_name = $("#name").val();
    //alert(f_name);
    var f_designation = $("#Designation").val();

    let data = sessionStorage.getItem('id');             // getting department name from session
    //  alert(data);

    $.ajax({
      url: "/online course registration system/Admin/addfacultyAjax.php",
      type: "POST",
      dataType: "json",
      data: {
        name: f_name,
        designation: f_designation,
        dept: data,
        action: "facultyAdd"
      },
      beforeSend: function () {
       // alert("about to send an ajax call");
      },
      success: function (result) {
       // alert(JSON.stringify(result));
        alert("succesful")
        window.location.reload();
      },
      error: function () {
        alert("error add");
        window.location.reload();
      },

    });
  });

  // edit button 1

  $(document).on("click", ".edit_btn1", function () {

    let fid = this.id;
    // alert(fid);
    sessionStorage.setItem('fid', fid);

    $.ajax({
      url: "/online course registration system/Admin/addfacultyAjax.php",
      type: "POST",
      dataType: "json",
      data: { id: fid, action: "factDisplay" },
      success: function (result) {
         // alert(JSON.stringify(result));
        // alert(result);
        var name = result[0].f_name;
        //alert(name);
        var designation = result[0].designation;
        //alert(designation);
        var department = result[0].d_name;
        //    var dept=result[0].offered_by_dept;
        $("#fname").val(name);
        $("#fDesignation").val(designation);
        //$("#dept").val(offer_by_dept);
        get_dept1();
        // alert(result);
      },
      error: function () {
        alert("no input value");
        location.reload();
      },

    });
  });

  $(document).on("click", "#edit_btn2", function () {

    var f_name = $("#fname").val();
    //alert(f_name);
    var f_designation = $("#fDesignation").val();
    let depart = sessionStorage.getItem('id');
    let data = Number(depart);
    // alert(typeof(data));
    let fid = sessionStorage.getItem('fid');
    let f_id = Number(fid);
    //alert(typeof(f_id));
   // alert(f_id);
    //alert(data);
    // get_dept1();


    $.ajax({
      url: "/online course registration system/Admin/addfacultyAjax.php",
      type: "POST",
      dataType: "json",
      data: {
        id: f_id,
        name: f_name,
        designation: f_designation,
        dept: data,
        action: "Updatefaculty"
      },

      success: function (result) {
       // alert(JSON.stringify(result));
        // alert(result.status);
        alert("update successfully")
        location.reload();
      },
      error: function () {
        alert("error update edit");
      },

    });
  });

});


function get_list() {
  $.ajax({
    url: "/online course registration system/Admin/addfacultyAjax.php",
    type: "POST",
    dataType: "json",
    data: { action: "getfaculty" },
    beforeSend: function () {
      //  alert("about to send an ajax call");
    },
    success: function (result) {
      // alert(JSON.stringify(result));
      arr = result;
      let y = ``;
      for (i = 0; i < arr.length; i++) {
        // alert(JSON.stringify(result[i]));
        y = y + `<tr>
               <th>${i + 1}</th>
               <td>${arr[i][`f_name`]}</td>
               <td>${arr[i][`designation`]}</td>
               <td>${arr[i][`d_name`]}</td>
               <td><button type="button" class="btn btn-primary edit_btn1" data-toggle="modal" data-target="#editmodel" id="${arr[i][`f_id`]}">
               Edit
             </button></td>
               </tr>`;

      }

      $("#getbody").html(y);



    },
    error: function () {
      alert("error");
    },

  });
}



//get list of department name

function get_dept() {

  $.ajax({
    url: "/online course registration system/Admin/addfacultyAjax.php",
    type: "POST",
    dataType: "json",
    data: { action: "getDept" },
    beforeSend: function () {
      $("#overlay").fadeIn();
      //   alert("about to call")
    },
    success: function (result) {
      //   alert(JSON.stringify(result));
      let x = ``;
      for (let i = 0; i < result.length; i++) {
        x = x + `<a class="dropdown-item deptname" href="#" id="${result[i].d_id}">${result[i].d_name}</a>`;
      }
      $("#dept").html(x);
    },
    error: function () {
      alert("something went wrong");
      $("#overlay").fadeOut();
    },
  });
}





function get_dept1() {

  $.ajax({
    url: "/online course registration system/Admin/addfacultyAjax.php",
    type: "POST",
    dataType: "json",
    data: { action: "getDept" },
    beforeSend: function () {
      $("#overlay").fadeIn();
      //   alert("about to call")
    },
    success: function (result) {
      //   alert(JSON.stringify(result));
      let x = ``;
      for (let i = 0; i < result.length; i++) {
        x = x + `<a class="dropdown-item deptname" href="#" id="${result[i].d_id}" >${result[i].d_name}</a>`;
      }
      $("#dept1").html(x);
    },
    error: function () {
      alert("something went wrong");
      $("#overlay").fadeOut();
    },
  });
}
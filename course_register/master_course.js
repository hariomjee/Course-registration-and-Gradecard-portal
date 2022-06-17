$(document).ready(function(){
//get_list function
    get_list();

//get department value

   get_dept();
   
      //get department name

      $(document).on("click",".deptname",function(){
        let d_name = this.id;
        // alert(id);
        sessionStorage.setItem('id', d_name);     // store department name into session

      });

      //data insert for master course

  $(document).on("click","#add_btn",function(){
    var c_code=$("#code").val();
    var c_title=$("#title").val();
    var c_L=$("#l").val();
    var c_T=$("#t").val();
    var c_P=$("#p").val();
    var c_Cr=$("#cr").val();

    let data=sessionStorage.getItem('id');             // getting department name from session
    // alert(data);

 $.ajax({
    url:"/online course registration system/course_register/master_courseAjax.php",
    type:"POST",
    dataType:"json",
    data: {code:c_code,c_name:c_title,L:c_L,T:c_T,P:c_P,Cr:c_Cr,dept:data, action:"CourseHandler"},
    beforeSend: function(){
        //  alert("about to send an ajax call");
    },
    success:function(result){
    // alert(result);
    location.reload();
    },
    error:function(){
        alert("error add");
        window.location.reload();
    },

});
});

        // edit button 1

 $(document).on("click",".edit_btn1",function(){

    let id=this.id;

 $.ajax({
    url:"/online course registration system/course_register/master_courseAjax.php",
    type:"POST",
    dataType:"json",
    data: {id:id,action:"courseDisplay"},
    success:function(result){
      //  alert(JSON.stringify(result));
           var code=result[0].code
           var title=result[0].titile;
           var  l=result[0].l;
           var  t=result[0].t;
           var  p=result[0].p;
           var  cr=result[0].cr;
           var  offer_by_dept=result[0].offered_by_dept;
        //    var dept=result[0].offered_by_dept;
            $("#c_code").val(code);
            $("#c_title").val(title);
            $("#c_l").val(l);
            $("#c_t").val(t);
            $("#c_p").val(p);
            $("#c_cr").val(cr);
             //$("#dept").val(offer_by_dept);
            get_dept1();
    // alert(result);
    },
    error:function(){
        alert("error edit");
        location.reload();
    },
    
    });
});

//edit course button 2

$(document).on("click","#edit_btn2",function(){

    var c_code=$("#c_code").val();
    //alert(c_code);
    var c_title=$("#c_title").val();
   // alert(c_title);
    var c_L=$("#c_l").val();
  //  alert(c_L);
    var c_T=$("#c_t").val();
   // alert(c_T);
    var c_P=$("#c_p").val();
   // alert(c_P);
    var c_Cr=$("#c_cr").val();
   // alert(c_Cr);
 var data=sessionStorage.getItem('id'); // getting department name from session
   // alert(data);

 

 $.ajax({
    url:"/online course registration system/course_register/master_courseAjax.php",
    type:"POST",
    dataType:"json",
    data:{code:c_code,title:c_title,L:c_L,T:c_T,P:c_P,Cr:c_Cr,dept:data,action:"Edit"},
  
    success:function(result){
        // alert(JSON.stringify(result));
       // alert(result.status);
        alert("update successfully")
        location.reload();
    },
    error:function(){
        alert("error edit");
    },
    
    });
});
      //press tab for add single

$('#code').on('keydown', function(e) {
    //press tab
    if (e.keyCode == 9){
        e.preventDefault();
        // alert('tab');
        var c_code=$("#code").val();
        // alert(c_code);
        var c_len=c_code.length;
        // alert(c_len);
        if(c_len!==0){

        //make an ajax call

        $.ajax({
            url:"/online course registration system/course_register/master_courseAjax.php",
            type:"POST",
            dataType:"json",
            data: {code:c_code, action:"getCourse"},
            beforeSend: function(){
                //  alert("let see");
            },
            success:function(result){
            // alert(JSON.stringify(result));
            title=result[0].titile;
            l=result[0].l;
            t=result[0].t;
            p=result[0].p;
            cr=result[0].cr;
            dept=result[0].offered_by_dept;
            $("#title").val(title);
            $("#l").val(l);
            $("#t").val(t);
            $("#p").val(p);
            $("#cr").val(cr);
            $("#dept").html(dept);
            },
            error:function(){
                alert("no value exist");
                alert("add new value");
                $("#title").val("");
                $("#title").val("");
                $("#l").val("");
                $("#t").val("");
                $("#p").val("");
                $("#cr").val("");
                get_dept();
            },
        
        });

        }
        else{

            $("#title").val("");
            $("#title").val("");
            $("#l").val("");
            $("#t").val("");
            $("#p").val("");
            $("#cr").val("");
            get_dept();
        }


    }
});




});

//get list of course
function get_list(){
    $.ajax({
        url:"/online course registration system/course_register/master_courseAjax.php",
        type:"POST",
        dataType:"json",
        data: {action:"getHandler"},
        beforeSend:function(){
            //  alert("about to send an ajax call");
        },
        success:function(result){
            // alert(JSON.stringify(result));
           arr= result;
           let y=``;
            for (i = 0; i < arr.length; i++){
               y=y+`<tr>
               <th>${i+1}</th>
               <td>${arr[i].code}</td>
               <td>${arr[i].titile}</td>
               <td>${arr[i].l}</td>
               <td>${arr[i].t}</td>
               <td>${arr[i].p}</td>
               <td>${arr[i].cr}</td>
               <td>${arr[i].offered_by_dept}</td>
               <td><button type="button" class="btn btn-primary edit_btn1" data-toggle="modal" data-target="#editmodel" id="${arr[i].id}">
               Edit
             </button></td>
               </tr>`;

            }
            

          $("#getbody").html(y);



        },
        error:function(){
            alert("error");
        },
    
    });
}

//get list of department name

function get_dept(){

    $.ajax({
        url:"/online course registration system/course_register/master_courseAjax.php",
        type:"POST",
        dataType:"json",
        data:{action:"getDept" },
        beforeSend: function () {
          $("#overlay").fadeIn();
        //   alert("about to call")
        },
        success:function(result) {
        //   alert(JSON.stringify(result));
          let x=``;
          for(let i=0;i<result.length;i++){
            x=x+`<a class="dropdown-item deptname" href="#" id="${result[i].d_name}">${result[i].d_name}</a>`;
          }
             $("#dept").html(x);
        },
        error: function () {
          alert("something went wrong");
          $("#overlay").fadeOut();
        },
      });
}



function get_dept1(){

    $.ajax({
        url:"/online course registration system/course_register/master_courseAjax.php",
        type:"POST",
        dataType:"json",
        data:{action:"getDept" },
        beforeSend: function () {
          $("#overlay").fadeIn();
        //   alert("about to call")
        },
        success:function(result) {
        //   alert(JSON.stringify(result));
          let x=``;
          for(let i=0;i<result.length;i++){
            x=x+`<a class="dropdown-item deptname" href="#" id="${result[i].d_name}" >${result[i].d_name}</a>`;
          }
             $("#dept1").html(x);
        },
        error: function () {
          alert("something went wrong");
          $("#overlay").fadeOut();
        },
      });
}

// csv file upload

$(document).on("click","#Upload",function(){
    window.location.reload("/online course registration system/course_register/master_course.php");
  
});








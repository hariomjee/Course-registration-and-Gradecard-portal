 
$(document).ready(function(){
//Admin login
//  $(document).on("click","#AdminLogin",function(){
   
//     var un=$("#txtRollNo").val();
//     var pwd=$("#txtPwd").val();
//     var trimmedUn=un.trim();
//     var lun=trimmedUn.length;
//     var trimmedpwd=pwd.trim();
//     var lpw=trimmedpwd.length;  

//     if(lun!=0 && lpw!=0 ){
//         $("#lblErrorMessage").text("");
//         //make an ajax call
//         $.ajax({
//             url:"/online course registration system/sloginAjax.php",
//             type:"POST",
//             dataType:"json",
//             data: {username:trimmedUn,pwd:trimmedpwd, action:"AdminHandler"},
//             // beforeSend: function(){
//             //     alert("about to send an ajax call");
//             // },
//             success:function(result){
//               // alert(result.status);
//             //    alert(result.id);
//                    if(result.status=="OK"){
//                     $("#lblErrorMessage").text("VALID UN and pw");
//                      document.location.replace("/online course registration system/AdminHome.php");
//                    }
//                    else{
//                        $("#lblErrorMessage").text("INVALID UN and pw");
//                    }
//             },
//             error:function(){
//                 alert("error wrong");
//             },

//         });

//     }
//     else{
//        $("#lblErrorMessage").text("INVAILD INPUT");
//     }



// });


$(document).on("click","#btnLogin",function(){
    //      alert("clicked");
            var un=$("#txtRollNo").val();
            var pwd=$("#txtPwd").val();
            var trimmedUn=un.trim();
            var lun=trimmedUn.length;
            var trimmedpwd=pwd.trim();
            var lpw=trimmedpwd.length;
             if(lun!=0 && lpw!=0 ){
                 $("#lblErrorMessage").text("");
                 //make an ajax call
                 $.ajax({
                     url:"/online course registration system/sloginAjax.php",
                     type:"POST",
                     dataType:"json",
                     data: {username:trimmedUn,pwd:trimmedpwd, action:"loginHandler"},
                     beforeSend: function(){
                         // alert("about to send an ajax call");
                     },
                     success:function(result){
                        // alert(result.status);
                        // alert(result.id);
                            if(result.status=="OK"){
                               // $("#lblErrorMessage").text("VALID UN and pw");
                                document.location.replace("/online course registration system/Home.php");
                            }
                            else{
                                $("#lblErrorMessage").text("INVALID UN and pw");
                            }
                     },
                     error:function(){
                         alert("error wrong");
                     },
    
                 });
    
             }
             else{
                $("#lblErrorMessage").text("INVAILD INPUT");
             }
          
 });
    

 });
 
 


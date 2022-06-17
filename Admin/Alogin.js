
$(document).ready(function () {

    //Admin login
 $(document).on("click", "#AdminLogin", function () {

        var un = $("#txtRollNo").val();
        var pwd = $("#txtPwd").val();
        var trimmedUn = un.trim();
        var lun = trimmedUn.length;
        var trimmedpwd = pwd.trim();
        var lpw = trimmedpwd.length;

    if (lun != 0 && lpw != 0) {
            $("#lblErrorMessage").text("");
            //make an ajax call
       $.ajax({
                url: "/online course registration system/Admin/AloginAjax.php",
                type: "POST",
                dataType: "json",
                data: { username: trimmedUn, pwd: trimmedpwd, action: "AdminHandler" },
                success: function (result) {
                    //alert(result.status);
                      // alert(result.role);  
                 if (result.status == "OK" && result.role=="admin" ){
                    
                          // $("#lblErrorMessage").text("VALID UN and pw");
                        document.location.replace("/online course registration system/Admin/AdminHome.php");
                            }
                    else {
                        $("#lblErrorMessage").text("Sorry you are not a Admin");
                    }
                },
                error: function () {
                    alert("wrong Input");
                },

            });

        }
        else {
            $("#lblErrorMessage").text("INVAILD INPUT");
        }



    });


        // Faculty Login

        $(document).on("click", "#FacultyLogin", function () {

            var un = $("#txtRollNo").val();
            var pwd = $("#txtPwd").val();
            var trimmedUn = un.trim();
            var lun = trimmedUn.length;
            var trimmedpwd = pwd.trim();
            var lpw = trimmedpwd.length;
    
            if (lun != 0 && lpw != 0) {
                $("#lblErrorMessage").text("");
                //make an ajax call
                $.ajax({
                    url: "/online course registration system/Admin/AloginAjax.php",
                    type: "POST",
                    dataType: "json",
                    data: { username: trimmedUn, pwd: trimmedpwd, action: "AdminHandler" },
                    // beforeSend: function(){
                    //     alert("about to send an ajax call");
                    // },
                    success: function (result) {
                        // alert(result.status);
                        //    alert(result.id);
                       // alert("going to AloginAjax");
                        if (result.status == "OK"&& result.role=="faculty" ) {
                            //$("#lblErrorMessage").text("VALID UN and pw");
                            document.location.replace("/online course registration system/Admin/facultyHome.php");
                        }
                        else {
                            $("#lblErrorMessage").text("Sorry you are not a Faculty ");
                        }
                    },
                    error: function () {
                        alert("wrong Input");
                    },
    
                });
    
            }
            else {
                $("#lblErrorMessage").text("INVAILD INPUT");
            }
    
    
    
        });



});




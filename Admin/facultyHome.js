$(document).ready(function () {

    var fact_name = $("#factname").val();
    var designation = $("#designation").val();
    var department_name = $("#department_name").val();
    var role = $("#role").val();
   

    $(document).on("click", "#btn", function () {
        //alert("grade");
       // alert(fact_name);
        // alert(designation);
        // alert(department_name);
        // alert(role);

        window.location.replace("/online course registration system/grades.php");


    });

});
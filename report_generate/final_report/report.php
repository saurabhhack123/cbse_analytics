<?php

include_once "../models/subject_model.php";
include_once "../models/school_model.php";
include_once "../../../../../includes/includes.php";


$school_id = 40;



?>


<html>
<head>

    <script src="../../../../../resources/js/jquery-2.0.3.min.js"></script>

    <script src="../../../../../resources/js/bootstrap.min.js"></script>
    <script src="../../../../../resources/js/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="helper_functions.js"></script>
    <link href="../../../../../resources/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../../../../../resources/css/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet"/>

    <link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <script>
        $(document).ready(function () {

            var school_id =<?php echo $school_id?>;

            $("#school_logo").attr('src', "../../../schoolinfo/logo/S" + school_id + ".png");

            $.get("test_ajax.php", {Request: "GetSchoolData"}, function (data) {

                data = $.parseJSON(data);
                var school_name = data["school"]["SchoolName"];
                var school_address=data["school"]["Address"];

                $("#school_name").html(school_name);
                $("#school_address").html(school_address);
                fill_school_details(data);
                get_toppers_list(data);
                get_stream_toppers(data);
                fill_stream_topper_details(data,1);
                fill_stream_topper_details(data,2);





                $.get("test_ajax.php", {Request: "GetSubjectData"}, function (data2) {
                    data2 = $.parseJSON(data2);


                    subject_wise_marks_distribution_chart(data2);


                    $.get("test_ajax.php",{Request:"GetGroupData"},function(data3)
                    {
                        data3= $.parseJSON(data3);

                        populate_group_distribution(data3);
                    });


                });


            });
        });





    </script>
</head>
<?php include_once "../layout/page1.php" ?>
<?php include_once "../layout/page2.php" ?>
<?php include_once "../layout/page3.php" ?>
<?php //include_once "test2.php" ?>
<?php include_once "../layout/page4.php" ?>
<?php ////include_once "../layout/graph2.php" ?>
<?php include_once "../layout/page5.php" ?>
<?php //include_once "../layout/page6.php" ?>
<?php //include_once "../layout/graph3.php" ?>
</html>

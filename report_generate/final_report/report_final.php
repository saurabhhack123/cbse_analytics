<?php

include_once "../models/subject_model.php";
include_once "../models/school_model.php";
include_once "../../../../../includes/includes.php";


$school_id = 40;



?>
<html>
<head>

    <script src="../../../../../resources/js/jquery-2.0.3.min.js"></script>
    <script src="helper_functions.js" ></script>




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
                $.get("test_ajax.php", {Request: "GetSubjectData"}, function (data2) {
                    data2 = $.parseJSON(data2);


                    subject_wise_marks_distribution_chart(data2);
                    fill_subject_average_table(data2);
                    stream_wise_marks_distribution_chart(data);
                });

            });
        });
        </script>



</head>
<body >
<?php include_once "../layout/page1_new.php" ?>
<?php include_once "../layout/page2_new.php" ?>
<?php include_once "../layout/page3_new.php" ?>
<?php include_once "../layout/page4_new.php" ?>
<?php include_once "../layout/page5_new.php" ?>
<?php include_once "../layout/page6_new.php" ?>



</body>
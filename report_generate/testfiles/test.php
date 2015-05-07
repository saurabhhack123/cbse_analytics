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

    <link href="style.css" rel="stylesheet">
    <link href="tablestyle.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <script>
        $(document).ready(function () {

            var school_id =<?php echo $school_id?>;

            $("#school_logo").attr('src', "../../../schoolinfo/logo/S" + school_id + ".png");

            $.get("test_ajax.php", {Request: "GetSchoolData"}, function (data) {

                data = $.parseJSON(data);
                var school_name = data["school"]["SchoolName"];

                $("#schoolname_label").html(school_name);

                fill_table1(data);
                fill_table2(data);
                fill_table3(data);
                fill_table4(data);

                $.get("test_ajax.php", {Request: "GetSubjectData"}, function (data2) {
                    data2 = $.parseJSON(data2);


                    subject_wise_marks_distribution_chart(data2);


                    $.get("test_ajax.php",{Request:"GetGroupData"},function(data3)
                    {
                        data3= $.parseJSON(data3);
                        test(data3);
                        populate_group_distribution(data3);
                    });


                });


            });
        });


            function fill_table1(data) {
                var htmltext = "<tr><td></td><td>2012-13</td><td>2013-14</td><td>Change</td><tr>";
                htmltext += get_registered_html(data);
                htmltext += get_appeared_html(data);
                htmltext += get_pass_html(data);
                htmltext += get_distinction_html(data);
                htmltext += get_average_html(data);

                $("#general_info").html(htmltext);
            }

            function fill_table2(data) {

                var htmltext = "<tr><td>RegNo</td><td>Name</td><td>Marks(/1200)</td><td>Group</td>";
                htmltext += "<tr><td colspan='4'><b>2013-14</b></td></tr> ";
                htmltext += get_toppers_list(data, 0);
                htmltext += "<tr><td colspan='4'><b>2012-13</b></td></tr>";
                htmltext += get_toppers_list(data, 1);
                $("#school_topper_list").html(htmltext);
            }


            function fill_table3(data) {
                var htmltext = "<tr><td>Group Name</td><td>Reg No</td><td>Name</td><td>Marks</td></tr>";
                htmltext += "<tr><td colspan='4'><b>2013-14</b></td></tr> ";
                htmltext += get_broad_toppers(data, 0);
                htmltext += "<tr><td colspan='4'><b>2012-13</b></td></tr> ";
                htmltext += get_broad_toppers(data, 1);
                $("#group_toppers").html(htmltext);
            }




            function test(data) {
                console.log(data);
            }
    </script>
</head>
<?php include_once "../layout/page1.php" ?>
<?php include_once "../layout/page2.php" ?>
<?php include_once "../layout/page3.php" ?>
<?php include_once "test2.php" ?>
<?php include_once "../layout/page4.php" ?>
<?php include_once "../layout/graph2.php" ?>
<?php include_once "../layout/page5.php" ?>
<?php include_once "../layout/graph3.php" ?>
</html>

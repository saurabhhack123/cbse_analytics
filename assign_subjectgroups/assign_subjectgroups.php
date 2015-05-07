
<?php
include_once "../../../../includes/includes.php";
include_once "../../../../includes/dbconfig.php";
$school_id = $schoolid;
?>
<html>
<head>


    <script src="../../../../resources/js/jquery-2.0.3.min.js"></script>
    <script src="../../../../resources/js/chosen.jquery.min.js"></script>
    <script src="../../../../resources/js/bootstrap.min.js"></script>
    <script src="../../../../resources/js/jquery-ui-1.10.4.custom.min.js"></script>
    <link href="../../../../resources/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../../../../resources/css/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet"/>
    <link href="../../../../resources/css/chosen.min.css" rel="stylesheet"/>
    <link href="style.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <script>
        $(document).ready(function(){
            $.get("details_ajax.php",{Request:"SubjectGroups"},function(data){



                $("#group_list").html(data);

            });

        });
        function get_students()
        {
            var school_id=<?php echo $school_id?>;
            var group_id=$("#group_list").val();
            $.get("details_ajax.php",{Request:"GetStudents",SchoolId:school_id,GroupId:group_id},function(data)
            {
               $("#student_list").html(data);
                $("#student_list").chosen();
                $("#student_list").trigger("chosen:updated");
            });

        }


        function save_students()
        {
            var school_id=<?php echo $school_id?>;
            var group_id=$("#group_list").val();
            var student_ids=$("#student_list").chosen().val();
            $.get("details_ajax.php",{Request:"SaveStudents",GroupId:group_id,StudentIds:student_ids},function(data){
               get_students();


            });
        }
    </script>
    </head>
<body style="background:  #DCDDDF  url(../Blueish_Mac_Wallpaper.jpg)">
<div class="container">
    <div class="row-fluid">
        <label class="heading">Assign Students to Subject Groups</label>

    </div>
    <div class="row-fluid" style="margin-top: 5%">
            <div class="span2 offset1">
                <label class="labels">Group:</label>
            </div>
        <div class="span4">
            <select id="group_list" onchange="get_students()"></select>
        </div>

        </div>
    <div class="row-fluid" style="margin-top: 5%">
        <div class="span2 offset1">
            <label class="labels">Students</label>

        </div>
        <div class="span2">
            <select multiple id="student_list"></select>
        </div>
    </div>
    <div class="row-fluid" style="margin-top:5%;margin-left: 25.5%">
        <button type=submit onclick="save_students()">Save</button>
    </div>
    </div>
    </body>
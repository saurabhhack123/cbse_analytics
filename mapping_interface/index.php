<?php
include_once "../../../../includes/includes.php";
include_once "../../../../includes/dbconfig.php";
$school_id = 40;
?>
<html>
<head>
    <script src="../../../../resources/js/jquery-2.0.3.min.js"></script>

    <script src="../../../../resources/js/bootstrap.min.js"></script>
    <script src="../../../../resources/js/jquery-ui-1.10.4.custom.min.js"></script>
    <link href="../../../../resources/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../../../../resources/css/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet"/>

    <link href="style.css" rel="stylesheet">
    <link href="tablestyle.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
    <script>
        var final_student_list=[];
        $(document).ready(function(){
            $.get("data_ajax.php",{Request:"GetGroups"},function(data){

                $("#group_list").html(data);

            }) ;
        });
        function fetch_students()
        {   var school_id=<?php echo $school_id?>;
            var group_id=$("#group_list").val();
            $.get("data_ajax.php",{Request:"Students",SchoolId:school_id,GroupId:group_id},function(data){

                data= $.parseJSON(data);
                fill_table(data);

            });
        }

        function fill_table(data)
        {   var no_of_students=0;
            var htmltext="<tr><td>Section</td><td>Roll No</td><td>Name</td></tr>";
                final_student_list=[];
            for(var student_id in data)
            {   final_student_list.push(student_id);
                var section=data[student_id]["Section"];
                var rno=data[student_id]["RollNo"];
                var name=data[student_id]["Name"];
                htmltext+="<tr><td>"+section+"</td><td>"+rno+"</td><td>"+name+"</td></tr>";
                no_of_students+=1;

            }



            $("#students_list").html(htmltext);
            $("#no_of_students").html("Number of Students:"+no_of_students);


        }
        function transfer_students()
        {
            var school_id=<?php echo $school_id?>;
            var group_id=$("#group_list").val();
                console.log(final_student_list);
            $.get("data_ajax.php",{Request:"TransferStudents",SchoolId:school_id,GroupId:group_id,StudentList:final_student_list},function(data){




            });
        }
    </script>
</head>
<body style="background:  #DCDDDF  url(../Blueish_Mac_Wallpaper.jpg)">

<div class="container">
    <div class="row-fluid">
        <label class="heading">Subject-Group Mapping</label>
    </div>
    <div class="row-fluid" style="margin-top: 5%">
        <div class="span2">
            <label class="labels">Select Group:</label>
        </div>
        <div class="span2">
            <select id="group_list">

            </select>
        </div>
        <div class="span2 offset2">
            <button type="submit" onclick="fetch_students()" >Fetch Students</button>
        </div>
    </div>
    <div class="row-fluid" style="margin-top: 3%">
        <div class="span4">
        <label id="no_of_students" class="labels"></label>
        </div>
        <div class="span2 offset2">
            <button type="submit" onclick="transfer_students()">Transfer Students</button>
        </div>

    </div>
    <div class="row-fluid" style="margin-top: 5%">
        <table id="students_list" class="csstablegenerator"></table>
    </div>

</div>

</body>
</html>
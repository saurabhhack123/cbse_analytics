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
    <link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>


    <script>
        function download_excel()
        {
            var school_id=<?php echo $school_id?>;
            var url="download_student_excel.php?schoolid="+school_id;
            window.open(url);
        }


    </script>

</head>
<body style="background:  #DCDDDF  url(../Blueish_Mac_Wallpaper.jpg)">
<div class="container">
    <div class="row-fluid">
        <label class="heading">Upload Registration Numbers</label>

    </div>
    <div class="row-fluid" style="margin-top: 12%;margin-left: 47%" >
        <button type="submit" onclick="download_excel()" >Download Excel</button>
    </div>
    <div class="row-fluid" style="margin-top: 5%;margin-left: 47%" >
        <form action="excel_reader.php" method="post" enctype="multipart/form-data">
            <input name="upload_file" type="file" class="uploadbutton" >
            <br>
            <input type="submit" style="margin-top: 2%" value="upload">
            <br>
            <label id="message" style="margin-top: 2%"></label>
        </form>
        <?php $success=$_REQUEST["success"];
        if($success==1)
        {
            echo "<script>success()</script>";
        }?>
    </div>
    </div>
</body>
</html>
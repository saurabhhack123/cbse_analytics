<html>
<head>
    <meta charset="utf-8">
    <title>Subject Data</title>
    <link href="../css/main.css" rel="stylesheet" type="text/css">
    <link href="../css/fonts.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="content">
    <div class="header">
        <h1>Stream <span>Data</span></h1>
        <img src="../images/logo.png">
    </div>


    <table class="subject" id="stream_marks_distribution" style="width:50% !important;margin-left: -10px">
        <tr class="border">
            <td>Stream</td>
            <td class="min_width">1150-1200</td>
            <td class="min_width">1100-1149</td>
            <td class="min_width">1050-1099</td>
            <td class="min_width">1000-1049</td>
            <td class="min_width">900-999</td>
            <td class="min_width">800-899</td>
            <td class="min_width">700-799</td>
            <td class="min_width">0-699</td>
        </tr>




    </table>
    <div class="legend">
        <div class='width' style="width: 100% !important;"><div style="margin-left:60px;width:5%;float:left">30 </div><div style="width: 10%;float:left;margin-top:    -2%"><img src="../photos/large.png" style="width: 71%"></div>  <div style="width:70%;float:left;padding-top:    5px"> <p >Indicates the number of students in the current year who's scores are in the bracket</p></div></div>

        <div class='width' style="width: 100% !important;"><div style="margin-left:60px;width:5%;float:left">  <span class='g-percent percent data'>5</span> </div><div style="width: 10%;float:left;margin-top:    -2%"><img src="../photos/large.png" style="width: 71%"></div>  <div style="width:70%;float:left;padding-top:    5px"> <p >Indicates the % change from last year- <span style="color: green">Green</span>: Increase, <span style="color:#be1e2d">Red</span>: Decrease,<span style="color:cadetblue"> Blue</span>: No Change</p></div></div>


    </div>

    <div class="graph">
        <?php include_once "graph4.php"?>
    </div>

</div>
</body>
</html>

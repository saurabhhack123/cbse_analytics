<html>
<head>
    <meta charset="utf-8">
    <title>Subject Data</title>
    <link href="../css/main.css" rel="stylesheet" type="text/css">
    <link href="../css/fonts.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="content pg-brk-after">
    <div class="header">
        <h1>Subject <span>Data</span></h1>
        <img src="../images/logo.png">
    </div>


    <table class="subject" id="subject_marks_distribution">
        <tr class="border">
            <td>Subject</td>
            <td>190-200</td>
            <td>180-189</td>
            <td>170-179</td>
            <td>160-169</td>
            <td>150-159</td>
            <td>140-149</td>
            <td>130-139</td>
            <td>1-129</td>
        </tr>




    </table>
    <div class="legend">
        <div class='width' style="width: 100% !important;"><div style="margin-left:60px;width:5%;float:left">30 </div><div style="width: 10%;float:left;margin-top:    -2%"><img src="../photos/large.png" style="width: 71%"></div>  <div style="width:70%;float:left;padding-top:    5px"> <p >Indicates the number of students in the current year who's scores are in the bracket</p></div></div>
        <div class='width' style="width: 100% !important;"><div style="margin-left:60px;width:5%;float:left">  <span class='g-percent percent data'>5</span> </div><div style="width: 10%;float:left;margin-top:    -2%"><img src="../photos/large.png" style="width: 71%"></div>  <div style="width:70%;float:left;padding-top:    5px"> <p >Indicates the % change from last year- <span style="color: green">Green</span>: Increase, <span style="color:#be1e2d">Red</span>: Decrease,<span style="color:cadetblue"> Blue</span>: No Change</p></div></div>


    </div>


    <div class="graph">




            <?php include_once "graph2.php"?>
    </div>

</div>
</body>
</html>

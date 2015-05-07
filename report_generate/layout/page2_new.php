<html>
<head>
    <meta charset="utf-8">
    <title>Report Card2</title>
    <link href="../css/main.css" rel="stylesheet" type="text/css">
    <link href="../css/fonts.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="content pg-brk-after" style="page-break-after: always">
    <div class="header">
        <h1>Exam <span>Overview</span></h1>
        <img src="../images/logo.png">
    </div>

    <div class="overview">
        <div class="exam-overview">
            <p>Student Registered</p>
            <div class="data">
                <p>This Year</p>
                <h2 id="stud_reg_cur"></h2>
                <div id="register_change"></div>
            </div>
            <div class="data">
                <p>Last Year</p>
                <h2 id="stud_reg_prev"></h2>
            </div>
            <div class="clear"></div>
        </div>
        <div class="exam-overview">
            <p>Students Attended</p>
            <div class="data">
                <p>This Year</p>
                <h2 id="attended_cur"></h2>
            </div>
            <div class="data">
                <p>Last Year</p>
                <h2 id="attended_prev"></h2>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div class="exam-overview">
            <p>Students Passed</p>
            <div class="data">
                <p>This Year</p>
                <h2 id="cur_pass_percent"></h2>
                <div id="pass_percent_difference"></div>
            </div>
            <div class="data">
                <p>Last Year</p>
                <h2 id="prev_pass_percent"></h2>
            </div>
            <div class="clear"></div>
        </div>

    </div>
    <div class="clear"></div>
    <div class="top-performers">
        <h2 id="top_performers_heading">Top Performers </h2>
        <table id="top_performers_1">
            <tr>
                <th>#</th>
                <th>Year</th>
                <th>Student Name</th>
                <th>Group</th>
                <th>Mark</th>
            </tr>



        </table>


        <table id="top_performers_2" style="page-break-before: always">
            <tr>
                <th>#</th>
                <th>Year</th>
                <th style="width:43%">Student Name</th>
                <th>Group</th>
                <th>Mark</th>
            </tr>



        </table>





    </div>









</div>
</body>
</html>
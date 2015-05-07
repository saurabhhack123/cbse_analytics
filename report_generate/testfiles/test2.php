<html>
<head>
    <script src="../../../../../resources/js/jquery-2.0.3.min.js"></script>
    <script src="../../../../../resources/js/highcharts.js"></script>
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
            $.get("test_ajax.php", {Request: "GetSchoolData"}, function (data) {

                data = $.parseJSON(data);
                make_overall_chart(data);


            });
        });
            function make_overall_chart(data) {
            var cats=[];
            var nums_cur=[];
            var nums_prev=[];
            for(var i=1;i<9;i++)
            {   var from=data["marks_distribution"][i]["From"];
                var to=data["marks_distribution"][i]["To"];
                var amt=parseInt(data["marks_distribution"][i]["Students"]);
                var prev_amt=parseInt(data["prev_marks_distribution"][i]["Students"]);
                cats.push(to+"-"+from);
                nums_cur.push(amt);
                nums_prev.push(prev_amt);
            }
                console.log(cats);
                console.log(nums_cur);
                console.log(nums_prev);

            $('#test_div').highcharts({

                title: {
                    text: 'Marks Distribution'
                },
                xAxis: {
                    categories: cats
                },
                yAxis: {
                    title: {
                        text: 'Number of students'
                    }
                },
                series: [{
                    name: '2012-2013',
                    data: nums_prev
                }, {
                    name: '2013-2014',
                    data: nums_cur
                }]
            });


            }


    </script>
</head>
<body>
<div class="container">
<div id="test_div">

</div>
</div>
</body>
</html>
<head>
<!--    <script src="../../../../../resources/js/jquery-2.0.3.min.js"></script>-->
<!--    <script src="../../../../../resources/js/highcharts.js"></script>-->
<!--    <script src="../../../../../resources/js/bootstrap.min.js"></script>-->
<!--    <script src="../../../../../resources/js/jquery-ui-1.10.4.custom.min.js"></script>-->
<!---->
<!--    <link href="../../../../../resources/css/bootstrap.min.css" rel="stylesheet"/>-->
<!--    <link href="../../../../../resources/css/ui-lightness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet"/>-->
<!---->
<!---->
<!--    <link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>-->
    <script>
        $(document).ready(function(){


            $.get("../testfiles/test_ajax.php", {Request: "GetGroupData"}, function (data2) {
                data2 = $.parseJSON(data2);


                make_chart(data2)







            });

        });
        function make_chart(data)
        {   var cats=[];
            var nums_prev=[];
            var nums_cur=[];
            for(var group_id in data)
            {
                cats.push(data[group_id]["group_abbrev"]);
                var cur_avg=parseInt(data[group_id]["group_average"]);
                var prev_avg=parseInt(data[group_id]["prev_group_average"]);
                nums_prev.push(prev_avg);
                nums_cur.push(cur_avg);

            }
            $('#group_average_graph').highcharts({

                title: {
                    text: 'Group Averages'
                },
                xAxis: {
                    categories: cats
                },
                yAxis: {
                    title: {
                        text: 'Average'
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
    <div class="span12">
    <div id="group_average_graph">
    </div>

    </div>
</div>
</body>
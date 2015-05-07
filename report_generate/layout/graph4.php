<head>
    <script>
        $(document).ready(function(){


            $.get("../final_report/test_ajax.php", {Request: "GetSchoolData"}, function (data2) {
                data2 = $.parseJSON(data2);


                make_chart_graph3(data2)







            });

        });
        function make_chart_graph3(data)
        {   var cats=[];
            var nums_prev=[];
            var nums_cur=[];
            for(var stream_id in data["group_distribution"])
            {
                cats.push(data["group_distribution"][stream_id]["Name"]);
                var cur_avg=parseInt(data["group_distribution"][stream_id]["Average"]);
                var prev_avg=parseInt(data["prev_group_distribution"][stream_id]["Average"]);

                var m1=((prev_avg/1200)*100);
                var m2=((cur_avg/1200)*100);


                nums_prev.push(m1);
                nums_cur.push(m2);

            }
            $('#stream_average_graph').highcharts({

                title: {
                    text: 'Stream Averages'
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
<div id="stream_average_graph">

</div>
</body>
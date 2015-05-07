<head>


    <script src="../../../../../resources/js/highcharts.js"></script>

  
    <script>
        $(document).ready(function(){


    $.get("../final_report/test_ajax.php", {Request: "GetSubjectData"}, function (data2) {
data2 = $.parseJSON(data2);


        make_chart_graph2(data2)







});

        });
        function make_chart_graph2(data)
        {   var cats=[];
            var nums_prev=[];
            var nums_cur=[];
            for(var subject_id in data)
            {
                cats.push(data[subject_id]["subject_name"]);
                var cur_avg=parseInt(data[subject_id]["average"]);
                var prev_avg=parseInt(data[subject_id]["prev_average"]);
                nums_prev.push(prev_avg);
                nums_cur.push(cur_avg);

            }
            $('#average_graph').highcharts({

                title: {
                    text: 'Subject Averages'
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


    <div id="average_graph" >

    </div>




</body>
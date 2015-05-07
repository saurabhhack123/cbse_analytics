function chart1_render(id,data){
    //sample data =>{"xAxis-categories":["Tamil","English","Maths","Science","Commerce","Language","Social Studies"],"series":{"your_mark":["3","7","5","4","-","4","4"],"class_avg":["2","6","5","4","-","5","6"]}}

    data['series']['your_mark'] = $.map(data['series']['your_mark'],function(mark){ return parseInt(mark) ? parseInt(mark) : 0; });
    data['series']['class_avg'] = $.map(data['series']['class_avg'],function(mark){ return parseInt(mark) ? parseInt(mark) : 0; });

    $('#'+id).highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Subject Performance'
        },
        subtitle: {
            text: 'section-wise'
        },
        xAxis: {
            categories: data['xAxis-categories'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Grade Point'
                //align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            formatter: function() {
                return ''+
                    this.x +': '+ this.y ;
            }
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    //enabled: true
                }
            },
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 0,
            y: 0,
            floating: true,
            borderWidth: 1,
            backgroundColor: '#FFFFFF',
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [
            {
                name: 'Your Mark',
                data: data['series']['your_mark']
            },
            {
                name: 'Class Average',
                data: data['series']['class_avg']
            }],

        colors: ['#A5AB24','#3D96AE','#80699B','#3D96AE','#DB843D','#92A8CD','#A47D7C','#B5CA92'],
        exporting: {
            enabled: false
        }
    });
}
function chart2_render(id,data){
    //[{"name":"C2 (5) YOU","y":1,"sliced":true,"selected":true},["E1 (3)",2]] 

    $('#'+id).highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Grade distribution'
        },
        subtitle: {
            text: 'class-wise'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        colors: ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    color: '#000000',
                    connectorColor: '#000000',
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            type: 'pie',
            name: 'Grade',
            data: data
        }],
        exporting: {
            enabled: false
        }
    });
}

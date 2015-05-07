/**
 * Created with JetBrains PhpStorm.
 * User: MADHUR
 * Date: 21/3/14
 * Time: 3:43 PM
 * To change this template use File | Settings | File Templates.
 */
function get_registered_html(data)
{   var htmltext="<tr><td>Students registered</td><td>";
    var students_registered=parseInt(data["students_registered"]);
    var prev_students_registered=parseInt(data["prev_students_registered"]);
    htmltext+=prev_students_registered+"</td><td>"+students_registered+"</td><td>";
    var change_percentage=(((students_registered-prev_students_registered)/prev_students_registered)*100).toFixed(0);

    if(change_percentage<0)
    {   change_percentage=change_percentage*(-1);
        htmltext+="<div class='circle_diff_red'>"+change_percentage+"%</div></td></tr>";
    }
    else if(change_percentage>0)
    {
        htmltext+="<div class='circle_diff_green'>"+change_percentage+"%</div></td></tr>";
    }
    else
    {
        htmltext+="<div class='circle_diff_blue'>"+change_percentage+"%</div></td></tr>";
    }
    return htmltext;
}
function get_appeared_html(data)
{   var htmltext="<tr><td>Students appeared</td><td>";
    var students_registered=parseInt(data["appeared"]);
    var prev_students_registered=parseInt(data["prev_appeared"]);
    htmltext+=prev_students_registered+"</td><td>"+students_registered+"</td><td>";
    var change_percentage=(((students_registered-prev_students_registered)/prev_students_registered)*100).toFixed(0);

    if(change_percentage<0)
    {   change_percentage=change_percentage*(-1);
        htmltext+="<div class='circle_diff_red'>"+change_percentage+"%</div></td></tr>";
    }
    else if(change_percentage>0)
    {
        htmltext+="<div class='circle_diff_green'>"+change_percentage+"%</div></td></tr>";
    }
    else
    {
        htmltext+="<div class='circle_diff_blue'>"+change_percentage+"%</div></td></tr>";
    }
    return htmltext;
}
function get_pass_html(data)
{   var htmltext="<tr><td>Students passed</td><td>";
    var students_passed=parseInt(data["passed"]);
    var prev_students_passed=parseInt(data["prev_passed"]);
    htmltext+=prev_students_passed+"</td><td>"+students_passed+"</td><td>";
    var pass_percent=(students_passed/parseInt(data["appeared"]))*100;
    var prev_pass_percent=(prev_students_passed/parseInt(data["prev_appeared"]))*100;

    var change_percentage=(pass_percent-prev_pass_percent).toFixed(0);


    if(change_percentage<0)
    {   change_percentage=change_percentage*(-1);
        htmltext+="<div class='circle_diff_red'>"+change_percentage+"%</div></td></tr>";
    }
    else if(change_percentage>0)
    {
        htmltext+="<div class='circle_diff_green'>"+change_percentage+"%</div></td></tr>";
    }
    else
    {
        htmltext+="<div class='circle_diff_blue'>"+change_percentage+"%</div></td></tr>";
    }
    return htmltext;
}
function get_distinction_html(data)
{   var htmltext="<tr><td>Students with distinction</td><td>";
    var students_passed=parseInt(data["distinctions"]);
    var prev_students_passed=parseInt(data["prev_distinctions"]);
    htmltext+=prev_students_passed+"</td><td>"+students_passed+"</td><td>";
    var pass_percent=(students_passed/parseInt(data["appeared"]))*100;
    var prev_pass_percent=(prev_students_passed/parseInt(data["prev_appeared"]))*100;

    var change_percentage=(pass_percent-prev_pass_percent).toFixed(0);


    if(change_percentage<0)
    {   change_percentage=change_percentage*(-1);
        htmltext+="<div class='circle_diff_red'>"+change_percentage+"%</div></td></tr>";
    }
    else if(change_percentage>0)
    {
        htmltext+="<div class='circle_diff_green'>"+change_percentage+"%</div></td></tr>";
    }
    else
    {
        htmltext+="<div class='circle_diff_blue'>"+change_percentage+"%</div></td></tr>";
    }
    return htmltext;
}
function get_average_html(data)
{   var htmltext="<tr><td>Student Average</td><td>";
    var school_avg=data["school_avg"];
    var prev_school_avg=data["prev_school_avg"];
    htmltext+=prev_school_avg+"%</td><td>"+school_avg+"%</td><td>";
    var change_percentage=(school_avg-prev_school_avg).toFixed(0);


    if(change_percentage<0)
    {   change_percentage=change_percentage*(-1);
        htmltext+="<div class='circle_diff_red'>"+change_percentage+"%</div></td></tr>";
    }
    else if(change_percentage>0)
    {
        htmltext+="<div class='circle_diff_green'>"+change_percentage+"%</div></td></tr>";
    }
    else
    {
        htmltext+="<div class='circle_diff_blue'>"+change_percentage+"%</div></td></tr>";
    }
    return htmltext;
}
function get_toppers_list(data,year)
{var htmltext="";
    if(year==0)
    {
        for(var id in data["topper_list"])
        {
            var reg_no=data["topper_list"][id]["RegNo"];
            var name=data["topper_list"][id]["StudentName"];
            var marks=data["topper_list"][id]["Marks"];
            var abbrev=data["topper_list"][id]["Abbrev"];
            htmltext+="<tr><td>"+reg_no+"</td><td>"+name+"</td><td>"+marks+"</td><td>"+abbrev+"</td></tr>";
        }




    }
    else
    {
        for(var id in data["prev_topper_list"])
        {
            var reg_no=data["prev_topper_list"][id]["RegNo"];
            var name=data["prev_topper_list"][id]["StudentName"];
            var marks=data["prev_topper_list"][id]["Marks"];
            var abbrev=data["prev_topper_list"][id]["Abbrev"];
            htmltext+="<tr><td>"+reg_no+"</td><td>"+name+"</td><td>"+marks+"</td><td>"+abbrev+"</td></tr>";
        }
    }

    return htmltext;
}

function get_broad_toppers(data,year)
{   var htmltext="";
    if(year==0)
    {

        for(var id in data["group_toppers"])
        {
            var group_name=data["group_toppers"][id]["GroupName"];
            var regno=data["group_toppers"][id]["RegNo"];
            var name=data["group_toppers"][id]["StudentName"];
            var marks=data["group_toppers"][id]["Marks"];
            htmltext+="<tr><td>"+group_name+"</td><td>"+regno+"</td><td>"+name+"</td><td>"+marks+"</td></tr>";
        }

    }
    else
    {


        for(var id in data["prev_group_toppers"])
        {
            var group_name=data["prev_group_toppers"][id]["GroupName"];
            var regno=data["prev_group_toppers"][id]["RegNo"];
            var name=data["prev_group_toppers"][id]["StudentName"];
            var marks=data["prev_group_toppers"][id]["Marks"];
            htmltext+="<tr><td>"+group_name+"</td><td>"+regno+"</td><td>"+name+"</td><td>"+marks+"</td></tr>";
        }
    }
    return htmltext;
}




function populate_group_distribution(data)
{


    var htmltext = "<tr><td>Group</td>";


    for (var temp in data[1]["marks_distribution"]) {
        var from = data[1]["marks_distribution"][temp]["From"];
        var to = data[1]["marks_distribution"][temp]["To"];


        htmltext += "<td>" + from + "-" + to + "</td>";

    }
    htmltext += "</tr>";


    for (var i in data) {
        var group_name = data[i]["group_abbrev"];

        htmltext += "<tr><td>" + group_name + "</td>";
        for (var x in data[i]["marks_distribution"]) {

            var cur_students = parseInt(data[i]["marks_distribution"][x]["Students"]);
            var cur_total_num= parseInt(data[i]["no_of_students"]);
            var prev_total_num=parseInt(data[i]["prev_no_of_students"]);
            var prev_students=parseInt(data[i]["prev_marks_distribution"][x]["Students"]);

            if(cur_students==0 && prev_students==0)
            {   var percent_change=0;

            }
            else if (prev_students==0)
            {
                var percent_change=(cur_students/cur_total_num)*100;
                percent_change=percent_change.toFixed(0);

            }
            else if(cur_students==0)
            {
                var percent_change=-1*(prev_students/prev_total_num)*100;
                percent_change=percent_change.toFixed(0);
            }
            else
            {
                var percent_change=((cur_students/cur_total_num)-(prev_students/prev_total_num))*100;
                percent_change=percent_change.toFixed(0);
            }

            if(percent_change>0)
            {
                htmltext += "<td><p style='float: left'>" + cur_students + " <div class='circle_small_green  ' >"+percent_change+"</div></p></td>";
            }
            else if(percent_change<0)
            {   percent_change=percent_change*-1;
                htmltext += "<td><p style='float:left'>" + cur_students + " <div class='circle_small_red '>"+percent_change+"</div></p></td>";
            }
            else{ percent_change=percent_change*-1;
                htmltext += "<td><p style='float:left'>" + cur_students + " <div class='circle_small_blue'>"+percent_change+"</div></p></td>";
            }








        }
        htmltext += "</tr>";

    }
    $("#group_distribution").html(htmltext);

}
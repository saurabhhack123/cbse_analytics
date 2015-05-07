/**
 * Created with JetBrains PhpStorm.
 * User: MADHUR
 * Date: 21/3/14
 * Time: 3:43 PM
 * To change this template use File | Settings | File Templates.
 */

function fill_school_details(data)
{  var students_registered=parseInt(data["students_registered"]);
    $("#stud_reg_cur").html(students_registered);
    var prev_students_registered=parseInt(data["prev_students_registered"]);
    $("#stud_reg_prev").html(prev_students_registered);
    var change_percentage=(((students_registered-prev_students_registered)/prev_students_registered)*100).toFixed(0);
   // console.log(students_registered);
    //console.log(prev_students_registered);
    console.log(change_percentage);
    var change_html="";
    if(change_percentage<0)
    {   change_percentage=change_percentage*(-1);
        $("#register_change").addClass("percent r-percent");
    }
    else if(change_percentage>0)
    {
        $("#register_change").addClass("percent g-percent");
    }
    else
    {change_percentage=change_percentage*(-1);
        $("#register_change").addClass("percent b-percent");
    }
    $("#register_change").html(change_percentage+"%");




   $("#registered_cur").html(students_registered);
    $("#registered_prev").html(prev_students_registered);

    var student_appeared=parseInt(data["appeared"]);
    var prev_student_appeared=parseInt(data["prev_appeared"]);
    $("#attended_cur").html(student_appeared);
    $("#attended_prev").html(prev_student_appeared);


    var students_passed=parseInt(data["passed"]);
    var prev_students_passed=parseInt(data["prev_passed"]);
    var pass_percent=(students_passed/parseInt(data["appeared"]))*100;
    var prev_pass_percent=(prev_students_passed/parseInt(data["prev_appeared"]))*100;

    var change_percentage_3=(pass_percent-prev_pass_percent).toFixed(0);
        $("#cur_pass_percent").html(pass_percent.toFixed(0)+"%");
    $("#prev_pass_percent").html(prev_pass_percent.toFixed(0)+"%");

    var htmltext2;
    if(change_percentage_3<0)
    {   change_percentage_3=change_percentage_3*(-1);
        $("#pass_percent_difference").addClass("percent r-percent");
    }
    else if(change_percentage_3>0)
    {
        $("#pass_percent_difference").addClass("percent g-percent");
    }
    else
    {
        $("#pass_percent_difference").addClass("percent b-percent");
    }

    $("#pass_percent_difference").html(change_percentage_3+"%");

}


function get_toppers_list(data)
{var htmltext="";
    var htmltext2="";
    var flag=0;
    var count=1;

        for(var id in data["topper_list"])
        {




            var reg_no=data["topper_list"][id]["RegNo"];
            var name=data["topper_list"][id]["StudentName"];
            var marks=data["topper_list"][id]["Marks"];
            var abbrev=data["topper_list"][id]["Abbrev"];
            var year=data["topper_list"][id]["Batch"];
            var prev_year=data["prev_topper_list"][id]["Batch"];

            if(flag==0)
            {   $("#top_performers_heading").append(year+" vs "+prev_year);
                flag=1;
            }
            if(count<=7)
            {



            htmltext+=" <tr><td>"+id+"</td><td><p>"+year+"</p><p>"+prev_year+"</p></td>";}

            else
            {
                htmltext2+=" <tr><td>"+id+"</td><td><p>"+year+"</p><p>"+prev_year+"</p></td>";

            }





            var prev_reg_no=data["prev_topper_list"][id]["RegNo"];
            var prev_name=data["prev_topper_list"][id]["StudentName"];
            var prev_marks=data["prev_topper_list"][id]["Marks"];
            var prev_abbrev=data["prev_topper_list"][id]["Abbrev"];

            if(count<=7)
            {


            htmltext+="<td><p>"+name+"</p><p>"+prev_name+"</p></td>";
            htmltext+="<td><p>"+abbrev+"</p><p>"+prev_abbrev+"</p></td>";
            htmltext+="<td><p>"+marks+"</p><p>"+prev_marks+"</p></td>";
            htmltext+="</tr>";}
            else
            {      htmltext2+="<td><p>"+name+"</p><p>"+prev_name+"</p></td>";
                htmltext2+="<td><p>"+abbrev+"</p><p>"+prev_abbrev+"</p></td>";
                htmltext2+="<td><p>"+marks+"</p><p>"+prev_marks+"</p></td>";
                htmltext2+="</tr>";

            }
            count+=1;
        }
    //console.log(htmltext);
    $("#top_performers_1").append(htmltext);
    $("#top_performers_2").append(htmltext2);

}


function fill_stream_topper_details(data,option)
{   var htmltext="<tr><td><b>#</b></td><td><b>Year</b></td><td><b>Student Name</b></td><td><b>Section</b></td><td><b>Mark</b></td></tr>";
    //console.log(data);

    for(var id in data["stream_toppers"][option]["Toppers"])
    {
        var cur_name=data["stream_toppers"][option]["Toppers"][id]["Name"];
        var cur_marks=data["stream_toppers"][option]["Toppers"][id]["Marks"];
        var cur_section=data["stream_toppers"][option]["Toppers"][id]["Section"];
        var prev_name=data["prev_stream_toppers"][option]["Toppers"][id]["Name"];
        var prev_marks=data["prev_stream_toppers"][option]["Toppers"][id]["Marks"];
        var prev_section=data["prev_stream_toppers"][option]["Toppers"][id]["Section"];


        htmltext+="<tr><td rowspan='2'><b>"+id+"</b></td><td><b>2013</b></td><td><b>"+cur_name+"</b></td><td><b>"+cur_section+"</b></td><td><b>"+cur_marks+"</b></td></tr>";
        htmltext+="<tr><td>2012</td><td>"+prev_name+"</td><td>"+prev_section+"</td><td>"+prev_marks+"</td></tr>";

        if(option==1)
        {
            $("#science_topper_list").html(htmltext);
        }
        else
        {
            $("#commerce_topper_list").html(htmltext);
        }
    }


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
    var htmltext="";







    for (var i in data) {
        var group_name = data[i]["group_abbrev"];



        if(i%2!=0)
        {
            htmltext += "<tr class='background border'><td><b>" + group_name+ "</b></td>";
        }
        else
        {
            htmltext += "<tr class='background '><td><b>" + group_name + "</b></td>";
        }

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

                htmltext += "<td>"+cur_students+"<span class='g-percent data'>"+percent_change+"</span></td>";}




            else if(percent_change<0)
            {   percent_change=percent_change*-1;
                htmltext += "<td>"+cur_students+"<span class='r-percent data'>"+percent_change+"</span></td>";
            }
            else{ percent_change=percent_change*-1;



                htmltext += "<td>"+cur_students+"<span class='b-percent data'>"+percent_change+"</span></td>";
            }








        }








        }
        htmltext += "</tr>";



    $("#group_marks_distribution").append(htmltext);

}

function subject_wise_marks_distribution_chart(data) {
   var htmltext="";


    for (var i in data) {
        var subject_name = data[i]["subject_name"];
        if(i%2!=0)
        {
            htmltext += "<tr class='background border'><td><b>" + subject_name + "</b></td>";
        }
        else
        {
            htmltext += "<tr class='border '><td><b>" + subject_name + "</b></td>";
        }

        for (var x in data[i]["marks_distribution"]) {

            var cur_students = parseInt(data[i]["marks_distribution"][x]["Students"]);
            var cur_total_num= parseInt(data[i]["no_of_students"]);
            var prev_total_num=parseInt(data[i]["prev_no_of_students"]);
            var prev_students=parseInt(data[i]["prev_marks_distribution"][x]["Students"]);


            var percent_change=((cur_students/cur_total_num)-(prev_students/prev_total_num))*100;
            percent_change=percent_change.toFixed(0);
            var test=getlength(percent_change);

            if(percent_change>0)
            {

                htmltext += "<td><div class='width'>"+cur_students+"</div><div class='width'><span class='g-percent percent data'>"+percent_change+"%</span></div></td>";


            }
            else if(percent_change<0)
            {   percent_change=percent_change*-1;
                htmltext += "<td><div class='width'>"+cur_students+"</div><div class='width'><span class='r-percent percent data'>"+percent_change+"%</span></div></td>";
            }
            else{ percent_change=percent_change*-1;



                htmltext += "<td><div class='width'>"+cur_students+"</div><div class='width'><span class='b-percent percent data'>"+percent_change+"%</span></div></td>";
            }








        }
        htmltext += "</tr>";

    }
    $("#subject_marks_distribution").append(htmltext);
}
function fill_school_distribution(data) {
    var htmltext = "<tr><td></td><td>2013-14</td><td>2012-13</td></tr>";

    var cur_total_num= parseInt(data["appeared"]);
    var prev_total_num=parseInt(data["prev_appeared"]);
    for (var i = 1; i < 9; i++) {
        var from = data["marks_distribution"][i]["From"];
        var to = data["marks_distribution"][i]["To"];
        var amt = parseInt(data["marks_distribution"][i]["Students"]);
        var prev_amt = parseInt(data["prev_marks_distribution"][i]["Students"]);
        var percent_change=(((amt/cur_total_num)*100)-((prev_amt/prev_total_num)*100));
        if(percent_change>0)
        {
            htmltext += "<tr><td>" + from + "-" + to + "</td><td><p style='float: left'>" + amt + " <div class='circle_small_green  ' >"+percent_change+"</div></p></td><td>"+prev_amt+"</td></tr>";
        }
        else if(percent_change<0)
        {   percent_change=percent_change*-1;
            htmltext += "<tr><td>" + from + "-" + to + "</td><td><p style='float: left'>" + amt + " <div class='circle_small_red  ' >"+percent_change+"</div></p></td><td>"+prev_amt+"</td></tr>";
        }
        else{ percent_change=percent_change*-1;
            htmltext += "<tr><td>" + from + "-" + to + "</td><td><p style='float: left'>" + amt + " <div class='circle_small_blue  ' >"+percent_change+"</div></p></td><td>"+prev_amt+"</td></tr>";
        }


    }
    $("#marks_distribution_table").html(htmltext);
}
function get_stream_toppers(data)
{   var htmltext="";

   var pcmc_1_regno=data["group_toppers"][1]["Toppers"][1]["RegNo"];
    var pcmc_1_name=data["group_toppers"][1]["Toppers"][1]["StudentName"];
    var pcmc_1_mark=data["group_toppers"][1]["Toppers"][1]["Marks"];
    var prev_pcmc_1_regno=data["prev_group_toppers"][1]["Toppers"][1]["RegNo"];
    var prev_pcmc_1_name=data["prev_group_toppers"][1]["Toppers"][1]["StudentName"];
    var prev_pcmc_1_mark=data["prev_group_toppers"][1]["Toppers"][1]["Marks"];



    var pcmc_2_regno=data["group_toppers"][1]["Toppers"][2]["RegNo"];
    var pcmc_2_name=data["group_toppers"][1]["Toppers"][2]["StudentName"];
    var pcmc_2_mark=data["group_toppers"][1]["Toppers"][2]["Marks"];
    var prev_pcmc_2_regno=data["prev_group_toppers"][1]["Toppers"][2]["RegNo"];
    var prev_pcmc_2_name=data["prev_group_toppers"][1]["Toppers"][2]["StudentName"];
    var prev_pcmc_2_mark=data["prev_group_toppers"][1]["Toppers"][2]["Marks"];


    var pcmc_3_regno=data["group_toppers"][1]["Toppers"][3]["RegNo"];
    var pcmc_3_name=data["group_toppers"][1]["Toppers"][3]["StudentName"];
    var pcmc_3_mark=data["group_toppers"][1]["Toppers"][3]["Marks"];
    var prev_pcmc_3_regno=data["prev_group_toppers"][1]["Toppers"][3]["RegNo"];
    var prev_pcmc_3_name=data["prev_group_toppers"][1]["Toppers"][3]["StudentName"];
    var prev_pcmc_3_mark=data["prev_group_toppers"][1]["Toppers"][3]["Marks"];


    htmltext+="<tr><td><p>"+pcmc_1_regno+"</p><p>"+prev_pcmc_1_regno+"</p></td>";
    htmltext+="<td><p>"+pcmc_1_name+"</p><p>"+prev_pcmc_1_name+"</p></td>";
    htmltext+="<td><p>"+pcmc_1_mark+"</p><p>"+prev_pcmc_1_mark+"</p></td></tr>";


    htmltext+="<tr><td><p>"+pcmc_2_regno+"</p><p>"+prev_pcmc_2_regno+"</p></td>";
    htmltext+="<td><p>"+pcmc_2_name+"</p><p>"+prev_pcmc_2_name+"</p></td>";
    htmltext+="<td><p>"+pcmc_2_mark+"</p><p>"+prev_pcmc_2_mark+"</p></td></tr>";

    htmltext+="<tr><td><p>"+pcmc_3_regno+"</p><p>"+prev_pcmc_3_regno+"</p></td>";
    htmltext+="<td><p>"+pcmc_3_name+"</p><p>"+prev_pcmc_3_name+"</p></td>";
    htmltext+="<td><p>"+pcmc_3_mark+"</p><p>"+prev_pcmc_3_mark+"</p></td></tr>";
$("#sc_comp_toppers").append(htmltext);
    var htmltext_2="";



    var pcmb_1_regno=data["group_toppers"][2]["Toppers"][1]["RegNo"];
    var pcmb_1_name=data["group_toppers"][2]["Toppers"][1]["StudentName"];
    var pcmb_1_mark=data["group_toppers"][2]["Toppers"][1]["Marks"];
    var prev_pcmb_1_regno=data["prev_group_toppers"][2]["Toppers"][1]["RegNo"];
    var prev_pcmb_1_name=data["prev_group_toppers"][2]["Toppers"][1]["StudentName"];
    var prev_pcmb_1_mark=data["prev_group_toppers"][2]["Toppers"][1]["Marks"];



    var pcmb_2_regno=data["group_toppers"][2]["Toppers"][2]["RegNo"];
    var pcmb_2_name=data["group_toppers"][2]["Toppers"][2]["StudentName"];
    var pcmb_2_mark=data["group_toppers"][2]["Toppers"][2]["Marks"];
    var prev_pcmb_2_regno=data["prev_group_toppers"][2]["Toppers"][2]["RegNo"];
    var prev_pcmb_2_name=data["prev_group_toppers"][2]["Toppers"][2]["StudentName"];
    var prev_pcmb_2_mark=data["prev_group_toppers"][2]["Toppers"][2]["Marks"];



    var pcmb_3_regno=data["group_toppers"][2]["Toppers"][3]["RegNo"];
    var pcmb_3_name=data["group_toppers"][2]["Toppers"][3]["StudentName"];
    var pcmb_3_mark=data["group_toppers"][2]["Toppers"][3]["Marks"];
    var prev_pcmb_3_regno=data["prev_group_toppers"][2]["Toppers"][3]["RegNo"];
    var prev_pcmb_3_name=data["prev_group_toppers"][2]["Toppers"][3]["StudentName"];
    var prev_pcmb_3_mark=data["prev_group_toppers"][2]["Toppers"][3]["Marks"];


    htmltext_2+="<tr><td><p>"+pcmb_1_regno+"</p><p>"+prev_pcmb_1_regno+"</p></td>";
    htmltext_2+="<td><p>"+pcmb_1_name+"</p><p>"+prev_pcmb_1_name+"</p></td>";
    htmltext_2+="<td><p>"+pcmb_1_mark+"</p><p>"+prev_pcmb_1_mark+"</p></td></tr>";


    htmltext_2+="<tr><td><p>"+pcmb_2_regno+"</p><p>"+prev_pcmb_2_regno+"</p></td>";
    htmltext_2+="<td><p>"+pcmb_2_name+"</p><p>"+prev_pcmb_2_name+"</p></td>";
    htmltext_2+="<td><p>"+pcmb_2_mark+"</p><p>"+prev_pcmb_2_mark+"</p></td></tr>";

    htmltext_2+="<tr><td><p>"+pcmb_3_regno+"</p><p>"+prev_pcmb_3_regno+"</p></td>";
    htmltext_2+="<td><p>"+pcmb_3_name+"</p><p>"+prev_pcmb_3_name+"</p></td>";
    htmltext_2+="<td><p>"+pcmb_3_mark+"</p><p>"+prev_pcmb_3_mark+"</p></td></tr>";
    $("#sc_bio_toppers").append(htmltext_2);

    var htmltext_3="";

    var cwc_1_regno=data["group_toppers"][3]["Toppers"][1]["RegNo"];
    var cwc_1_name=data["group_toppers"][3]["Toppers"][1]["StudentName"];
    var cwc_1_mark=data["group_toppers"][3]["Toppers"][1]["Marks"];
    var prev_cwc_1_regno=data["prev_group_toppers"][3]["Toppers"][1]["RegNo"];
    var prev_cwc_1_name=data["prev_group_toppers"][3]["Toppers"][1]["StudentName"];
    var prev_cwc_1_mark=data["prev_group_toppers"][3]["Toppers"][1]["Marks"];



    var cwc_2_regno=data["group_toppers"][3]["Toppers"][2]["RegNo"];
    var cwc_2_name=data["group_toppers"][3]["Toppers"][2]["StudentName"];
    var cwc_2_mark=data["group_toppers"][3]["Toppers"][2]["Marks"];
    var prev_cwc_2_regno=data["prev_group_toppers"][3]["Toppers"][2]["RegNo"];
    var prev_cwc_2_name=data["prev_group_toppers"][3]["Toppers"][2]["StudentName"];
    var prev_cwc_2_mark=data["prev_group_toppers"][3]["Toppers"][2]["Marks"];


    var cwc_3_regno=data["group_toppers"][3]["Toppers"][3]["RegNo"];
    var cwc_3_name=data["group_toppers"][3]["Toppers"][3]["StudentName"];
    var cwc_3_mark=data["group_toppers"][3]["Toppers"][3]["Marks"];
    var prev_cwc_3_regno=data["prev_group_toppers"][3]["Toppers"][3]["RegNo"];
    var prev_cwc_3_name=data["prev_group_toppers"][3]["Toppers"][3]["StudentName"];
    var prev_cwc_3_mark=data["prev_group_toppers"][3]["Toppers"][3]["Marks"];

    htmltext_3+="<tr><td><p>"+cwc_1_regno+"</p><p>"+prev_cwc_1_regno+"</p></td>";
    htmltext_3+="<td><p>"+cwc_1_name+"</p><p>"+prev_cwc_1_name+"</p></td>";
    htmltext_3+="<td><p>"+cwc_1_mark+"</p><p>"+prev_cwc_1_mark+"</p></td></tr>";


    htmltext_3+="<tr><td><p>"+cwc_2_regno+"</p><p>"+prev_cwc_2_regno+"</p></td>";
    htmltext_3+="<td><p>"+cwc_2_name+"</p><p>"+prev_cwc_2_name+"</p></td>";
    htmltext_3+="<td><p>"+cwc_2_mark+"</p><p>"+prev_cwc_2_mark+"</p></td></tr>";


    htmltext_3+="<tr><td><p>"+cwc_3_regno+"</p><p>"+prev_cwc_3_regno+"</p></td>";
    htmltext_3+="<td><p>"+cwc_3_name+"</p><p>"+prev_cwc_3_name+"</p></td>";
    htmltext_3+="<td><p>"+cwc_3_mark+"</p><p>"+prev_cwc_3_mark+"</p></td></tr>";
    $("#com_comp_toppers").append(htmltext_3);


    var htmltext_4="";

    var cwb_1_regno=data["group_toppers"][4]["Toppers"][1]["RegNo"];
    var cwb_1_name=data["group_toppers"][4]["Toppers"][1]["StudentName"];
    var cwb_1_mark=data["group_toppers"][4]["Toppers"][1]["Marks"];
    var prev_cwb_1_regno=data["prev_group_toppers"][4]["Toppers"][1]["RegNo"];
    var prev_cwb_1_name=data["prev_group_toppers"][4]["Toppers"][1]["StudentName"];
    var prev_cwb_1_mark=data["prev_group_toppers"][4]["Toppers"][1]["Marks"];



    var cwb_2_regno=data["group_toppers"][4]["Toppers"][2]["RegNo"];
    var cwb_2_name=data["group_toppers"][4]["Toppers"][2]["StudentName"];
    var cwb_2_mark=data["group_toppers"][4]["Toppers"][2]["Marks"];
    var prev_cwb_2_regno=data["prev_group_toppers"][4]["Toppers"][2]["RegNo"];
    var prev_cwb_2_name=data["prev_group_toppers"][4]["Toppers"][2]["StudentName"];
    var prev_cwb_2_mark=data["prev_group_toppers"][4]["Toppers"][2]["Marks"];

    var cwb_3_regno=data["group_toppers"][4]["Toppers"][3]["RegNo"];
    var cwb_3_name=data["group_toppers"][4]["Toppers"][3]["StudentName"];
    var cwb_3_mark=data["group_toppers"][4]["Toppers"][3]["Marks"];
    var prev_cwb_3_regno=data["prev_group_toppers"][4]["Toppers"][3]["RegNo"];
    var prev_cwb_3_name=data["prev_group_toppers"][4]["Toppers"][3]["StudentName"];
    var prev_cwb_3_mark=data["prev_group_toppers"][4]["Toppers"][3]["Marks"];


    htmltext_4+="<tr><td><p>"+cwb_1_regno+"</p><p>"+prev_cwb_1_regno+"</p></td>";
    htmltext_4+="<td><p>"+cwb_1_name+"</p><p>"+prev_cwb_1_name+"</p></td>";
    htmltext_4+="<td><p>"+cwb_1_mark+"</p><p>"+prev_cwb_1_mark+"</p></td></tr>";


    htmltext_4+="<tr><td><p>"+cwb_2_regno+"</p><p>"+prev_cwb_2_regno+"</p></td>";
    htmltext_4+="<td><p>"+cwb_2_name+"</p><p>"+prev_cwb_2_name+"</p></td>";
    htmltext_4+="<td><p>"+cwb_2_mark+"</p><p>"+prev_cwb_2_mark+"</p></td></tr>";




    htmltext_4+="<tr><td><p>"+cwb_3_regno+"</p><p>"+prev_cwb_3_regno+"</p></td>";
    htmltext_4+="<td><p>"+cwb_3_name+"</p><p>"+prev_cwb_3_name+"</p></td>";
    htmltext_4+="<td><p>"+cwb_3_mark+"</p><p>"+prev_cwb_3_mark+"</p></td></tr>";
    $("#com_bst_toppers").append(htmltext_4);








}

function fill_subject_average_table(data)
{
    var htmltext="";


    for (var i in data) {
        var subject_name = data[i]["subject_name"];
        var average=parseFloat(data[i]["average"]);
        var prev_average=parseFloat(data[i]["prev_average"]);
        var progress_html;

        if(average>=prev_average)
        {
            progress_html="<div style='width:20%;float:left'><img src='../photos/up_arrow.png' style='width: 25%'></div>"
        }
        else
        {            progress_html="<div style='width:20%;float: left'><img src='../photos/down_arrow.png' style='width: 25%'></div>"


        }
    var average_div="<div style='width:30%;float:left'>"+average+"</div>";

        htmltext+="<tr><td>"+subject_name+"</td><td>"+average_div+progress_html+"</td><td>"+prev_average+"</td></tr>"

    }
    $("#subject_averages").append(htmltext);
}



function stream_wise_marks_distribution_chart(data) {
    var htmltext="";

    console.log(data);
    for (var i in data["group_distribution"]) {
        var stream_name = data["group_distribution"][i]["Name"];
        if(i%2!=0)
        {
            htmltext += "<tr class='background border'><td><b>" + stream_name + "</b></td>";
        }
        else
        {
            htmltext += "<tr class='border '><td><b>" + stream_name + "</b></td>";
        }
        var cur_total_num= parseInt(data["group_distribution"][i]["no_of_students"]);
        var prev_total_num=parseInt(data["prev_group_distribution"][i]["no_of_students"]);
        for (var x in data["group_distribution"][i]["MarksDistribution"]) {
            var percent_change;
            var cur_students = parseInt(data["group_distribution"][i]["MarksDistribution"][x]["Students"]);


            var prev_students=parseInt(data["prev_group_distribution"][i]["MarksDistribution"][x]["Students"]);



            if(cur_students ==0 && prev_students==0)
            {percent_change=0;

            }
            else if(cur_students==0 && prev_students!=0)
            {
                percent_change=(prev_students/prev_total_num)*100;
                percent_change*=-1;
            }
            else if(prev_students==0 && cur_students!=0)
            {
                percent_change=0;

            }
            else
            {
                percent_change=((cur_students/cur_total_num)-(prev_students/prev_total_num))*100;
            }



            console.log(percent_change);
            percent_change=percent_change.toFixed(0);


            if(percent_change>0)
            {

                htmltext += "<td><div class='width'>"+cur_students+"</div><div class='width'><span class='g-percent percent data'>"+percent_change+"%</span></div></td>";


            }
            else if(percent_change<0)
            {   percent_change=percent_change*-1;
                htmltext += "<td><div class='width'>"+cur_students+"</div><div class='width'><span class='r-percent percent data'>"+percent_change+"%</span></div></td>";
            }
            else{ percent_change=percent_change*-1;



                htmltext += "<td><div class='width'>"+cur_students+"</div><div class='width'><span class='b-percent percent data'>"+percent_change+"%</span></div></td>";
            }








        }
        htmltext += "</tr>";

    }
    $("#stream_marks_distribution").append(htmltext);
}




function getlength(number) {
    return number.toString().length;
}
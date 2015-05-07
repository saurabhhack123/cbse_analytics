<?php
include_once "../../../../../includes/includes.php";

function get_subject_details($subject_id)
{
    $sql="select SubjectName from cbse_subject where SubjectId='$subject_id'";

    $res=query_res($sql);

    $row=mysql_fetch_array($res);

    $result=$row["SubjectName"];
    
    return $result;

}

function get_nof_students($subject_id,$school_id,$batch_id=2)
{
    $sql="select * from cbse_marks where SubjectId='$subject_id' and SchoolId='$school_id' and RegNo in (Select RegNo from cbse_students where BatchId='$batch_id')";
    $res=query_res($sql);
    return mysql_num_rows($res);

}

function get_average_subject_marks($subject_id,$school_id,$no_of_students,$batch_id=2)
{   $total_mark=0;

    $sql="select * from cbse_marks where SubjectId='$subject_id' and SchoolId='$school_id' and RegNo in (Select RegNo from cbse_students where BatchId='$batch_id')";
    $res=query_res($sql);
    while($row=mysql_fetch_array($res))
    {
        $mark=$row["Marks"];

        $total_mark+=(int)($mark);
    }

    $avg=(($total_mark/$no_of_students)/200)*100;
    $avg=round($avg,2);
    return $avg;
}

function get_subject_centums($subject_id,$school_id,$batch_id=2)
{   $sql="select * from cbse_marks where SubjectId='$subject_id' and SchoolId='$school_id' and Marks=200 and RegNo in (Select RegNo from cbse_students where BatchId='$batch_id')";
    $res=query_res($sql);
    return mysql_num_rows($res);

}





function get_subject_marks_distribution($subject_id,$school_id,$batch_id=2)
{
    $marks_distribution=array();

    $sql="select RegNo,marks from cbse_marks  where schoolId='$school_id' and SubjectId='$subject_id' and Marks>=190 and RegNo in (Select RegNo from cbse_students where BatchId='$batch_id')";
    $res=query_res($sql);
    $marks_distribution[1]["From"]=190;
    $marks_distribution[1]["To"]=200;
    $marks_distribution[1]["Students"]=mysql_num_rows($res);

    $sql="select RegNo,marks from cbse_marks  where schoolId='$school_id' and SubjectId='$subject_id' and Marks>=180 and Marks<190 and RegNo in (Select RegNo from cbse_students where BatchId='$batch_id') ";
    $res=query_res($sql);
    $marks_distribution[2]["From"]=180;
    $marks_distribution[2]["To"]=189;
    $marks_distribution[2]["Students"]=mysql_num_rows($res);

    $sql="select RegNo,marks from cbse_marks  where schoolId='$school_id' and SubjectId='$subject_id' and Marks>=170 and Marks<180  and RegNo in (Select RegNo from cbse_students where BatchId='$batch_id')";
    $res=query_res($sql);
    $marks_distribution[3]["From"]=170;
    $marks_distribution[3]["To"]=179;
    $marks_distribution[3]["Students"]=mysql_num_rows($res);

    $sql="select RegNo,marks from cbse_marks  where schoolId='$school_id' and SubjectId='$subject_id' and Marks>=160 and Marks<170  and RegNo in (Select RegNo from cbse_students where BatchId='$batch_id') ";
    $res=query_res($sql);
    $marks_distribution[4]["From"]=160;
    $marks_distribution[4]["To"]=169;
    $marks_distribution[4]["Students"]=mysql_num_rows($res);

    $sql="select RegNo,marks from cbse_marks  where schoolId='$school_id' and SubjectId='$subject_id' and Marks>=150 and Marks<160   and RegNo in (Select RegNo from cbse_students where BatchId='$batch_id')";
    $res=query_res($sql);
    $marks_distribution[5]["From"]=150;
    $marks_distribution[5]["To"]=159;
    $marks_distribution[5]["Students"]=mysql_num_rows($res);

    $sql="select RegNo,marks from cbse_marks  where schoolId='$school_id' and SubjectId='$subject_id' and Marks>=140 and Marks<150   and RegNo in (Select RegNo from cbse_students where BatchId='$batch_id')";
    $res=query_res($sql);
    $marks_distribution[6]["From"]=140;
    $marks_distribution[6]["To"]=149;
    $marks_distribution[6]["Students"]=mysql_num_rows($res);

    $sql="select RegNo,marks from cbse_marks  where schoolId='$school_id' and SubjectId='$subject_id' and Marks>=130 and Marks<140  and RegNo in (Select RegNo from cbse_students where BatchId='$batch_id') ";
    $res=query_res($sql);
    $marks_distribution[7]["From"]=130;
    $marks_distribution[7]["To"]=139;
    $marks_distribution[7]["Students"]=mysql_num_rows($res);

    $sql="select RegNo,marks from cbse_marks  where schoolId='$school_id' and SubjectId='$subject_id' and Marks>=120 and Marks<130  and RegNo in (Select RegNo from cbse_students where BatchId='$batch_id') ";
    $res=query_res($sql);
    $marks_distribution[8]["From"]=120;
    $marks_distribution[8]["To"]=129;
    $marks_distribution[8]["Students"]=mysql_num_rows($res);


    $sql="select RegNo,marks from cbse_marks  where schoolId='$school_id' and SubjectId='$subject_id' and Marks>=1 and Marks<120 and RegNo in (Select RegNo from cbse_students where BatchId='$batch_id')  ";
    $res=query_res($sql);
    $marks_distribution[8]["From"]=0;
    $marks_distribution[8]["To"]=119;
    $marks_distribution[8]["Students"]=mysql_num_rows($res);


    return $marks_distribution;

}



function cbse_school_model($school_id)
{
    $school_model = array();

    $sql = "select * from school where SchoolId='$school_id'
           ";

    $res = query_res($sql);
    $row = mysql_fetch_array($res);

    $school_model['id']                  = $row['SchoolId'];
    $school_model['SchoolId']            = $row['SchoolId'];
    $school_model['SchoolName']          = $row['SchoolName'];
    $school_model['ShortenedSchoolName'] = $row['ShortenedSchoolName'];
    $school_model["Address"]             = $row["Address"];



    return $school_model;
}


function topper_model($school_id,$batch_id=2)
{
    $topper_model=array();

    $sql="select s.BatchId,s.GroupId, s.RegNo, s.StudentName ,sum(marks) as sum_marks from cbse_students as s , cbse_marks as m where s.Regno=m.Regno and BatchId='$batch_id' and s.SchoolId='$school_id' group by m.RegNo order by sum(m.marks) desc";

    $res=query_res($sql);
    $i=1;

    while(($row=mysql_fetch_array($res))&&$i<11)
    {
        $group_id=$row["GroupId"];
        $sql_group="select Abbreviation from cbse_groups where GroupId='$group_id'";
        $res_group=mysql_query($sql_group);
        $row_group=mysql_fetch_array($res_group);
        $abbrev=$row_group["Abbreviation"];



        $batch_id=$row["BatchId"];
        $batch_name=get_batch_name($batch_id);
        $topper_model[$i]["RegNo"]=$row["RegNo"];
        $topper_model[$i]["StudentName"]=$row["StudentName"];
        $topper_model[$i]["Marks"]=$row["sum_marks"];
        $topper_model[$i]["GroupId"]=$row["GroupId"];
        $topper_model[$i]["Batch"]=$batch_name;


        $topper_model[$i]["Abbrev"]=$abbrev;
        $i=$i+1;
    }

   return $topper_model;
}
function get_batch_name($batch_id)
{
    $sql="Select EndYear from cbse_batch where BatchId='$batch_id'";
    $res=mysql_query($sql);
    $row=mysql_fetch_array($res);
    return $row["EndYear"];
}
function get_school_avg($school_id,$batch_id=2)
{
    $school_avg=0;
    $sql="select RegNo, sum(Marks) as sum_marks from cbse_marks where SchoolId='$school_id' and RegNo not in  (select distinct Regno from cbse_marks where marks<80) and RegNo in (select Regno from cbse_students where BatchId='$batch_id' ) group by RegNo  ";

    $res=query_res($sql);

    while($row=mysql_fetch_array($res))
    {

        $school_avg+=(int)$row["sum_marks"];
    }

    $school_avg=$school_avg/mysql_num_rows($res);
    $school_avg=($school_avg/1200)*100;
    $school_avg=round($school_avg,2);
    return $school_avg;
}

function get_students_registered($school_id,$batch_id=2)
{
    $no_students=0;
    $sql="select count(RegNo) as CountRows from cbse_students where SchoolId='$school_id'and RegNo in (select regno from cbse_students where BatchId='$batch_id') ";
    $res=query_res($sql);
    $row=mysql_fetch_array($res);
    $no_students=$row["CountRows"];
   return $no_students;
}

function get_absentees($school_id,$batch_id=2)
{
    $sql="select distinct RegNo from cbse_marks where Marks=0 and SchoolId='$school_id' and RegNo in (select Regno from cbse_students where BatchId='$batch_id')";
    $res=query_res($sql);

return mysql_num_rows($res);
}

function get_pass_percent($school_id,$appeared,$batch_id=2)
{
    $pass_percent=0;

    $sql="select distinct RegNo from cbse_marks where Marks<80 and SchoolId='$school_id' and RegNo in (select RegNo from cbse_students where BatchId='$batch_id')";
    $res=query_res($sql);

    $fails=mysql_num_rows($res);
   $pass_percent=$appeared-$fails;
 return  $pass_percent;
}

function get_centums($school_id,$batch_id=2)
{
    $no_of_centums=0;
    $sql="select * from cbse_marks where SchoolId='$school_id' and marks=200 and RegNo in (Select RegNo from cbse_students where BatchId='$batch_id')";
    $res=query_res($sql);

    return mysql_num_rows($res);
}

function get_marks_distribution($school_id,$batch_id=2)
{
    $marks_distribution=array();

    $sql="select RegNo,sum(marks) from cbse_marks  where schoolId='$school_id'  and RegNo in (select RegNo from cbse_students where BatchId='$batch_id') group by RegNo having sum(Marks)>=1150";
    $res=query_res($sql);
    $marks_distribution[1]["From"]=1150;
    $marks_distribution[1]["To"]=1200;
    $marks_distribution[1]["Students"]=mysql_num_rows($res);

    $sql="select RegNo,sum(marks) from cbse_marks  where schoolId='$school_id' and RegNo in (select RegNo from cbse_students where BatchId='$batch_id')  group by RegNo having sum(Marks)>=1100 and sum(Marks)<1150 ";
    $res=query_res($sql);
    $marks_distribution[2]["From"]=1100;
    $marks_distribution[2]["To"]=1149;
    $marks_distribution[2]["Students"]=mysql_num_rows($res);

    $sql="select RegNo,sum(marks) from cbse_marks  where schoolId='$school_id' and RegNo in (select RegNo from cbse_students where BatchId='$batch_id') group by RegNo having sum(Marks)>=1050 and sum(Marks)<1100 ";
    $res=query_res($sql);
    $marks_distribution[3]["From"]=1050;
    $marks_distribution[3]["To"]=1099;
    $marks_distribution[3]["Students"]=mysql_num_rows($res);

    $sql="select RegNo,sum(marks) from cbse_marks  where schoolId='$school_id' and RegNo in (select RegNo from cbse_students where BatchId='$batch_id') group by RegNo having sum(Marks)>=1000 and sum(Marks)<1049 ";
    $res=query_res($sql);
    $marks_distribution[4]["From"]=1000;
    $marks_distribution[4]["To"]=1049;
    $marks_distribution[4]["Students"]=mysql_num_rows($res);

    $sql="select RegNo,sum(marks) from cbse_marks  where schoolId='$school_id' and RegNo in (select RegNo from cbse_students where BatchId='$batch_id') group by RegNo having sum(Marks)>=900 and sum(Marks)<999 ";
    $res=query_res($sql);
    $marks_distribution[5]["From"]=900;
    $marks_distribution[5]["To"]=999;
    $marks_distribution[5]["Students"]=mysql_num_rows($res);

    $sql="select RegNo,sum(marks) from cbse_marks  where schoolId='$school_id' and RegNo in (select RegNo from cbse_students where BatchId='$batch_id') group by RegNo having sum(Marks)>=800 and sum(Marks)<899 ";
    $res=query_res($sql);
    $marks_distribution[6]["From"]=800;
    $marks_distribution[6]["To"]=899;
    $marks_distribution[6]["Students"]=mysql_num_rows($res);

    $sql="select RegNo,sum(marks) from cbse_marks  where schoolId='$school_id' and RegNo in (select RegNo from cbse_students where BatchId='$batch_id') group by RegNo having sum(Marks)>=700 and sum(Marks)<799 ";
    $res=query_res($sql);
    $marks_distribution[7]["From"]=700;
    $marks_distribution[7]["To"]=799;
    $marks_distribution[7]["Students"]=mysql_num_rows($res);

    $sql="select RegNo,sum(marks) from cbse_marks  where schoolId='$school_id' and RegNo in (select RegNo from cbse_students where BatchId='$batch_id') group by RegNo having sum(Marks)>=600 and sum(Marks)<699 ";
    $res=query_res($sql);
    $marks_distribution[8]["From"]=600;
    $marks_distribution[8]["To"]=699;
    $marks_distribution[8]["Students"]=mysql_num_rows($res);


    $sql="select RegNo,sum(marks) from cbse_marks  where schoolId='$school_id' and RegNo in (select RegNo from cbse_students where BatchId='$batch_id') group by RegNo having sum(Marks)<600  ";
    $res=query_res($sql);
    $marks_distribution[8]["From"]=0;
    $marks_distribution[8]["To"]=599;
    $marks_distribution[8]["Students"]=mysql_num_rows($res);


  return $marks_distribution;

}



function get_distinctions($school_id,$batch_id=2)
{



    $sql="select RegNo from cbse_marks  where schoolId='$school_id' and RegNo in (select RegNo from cbse_students where BatchId='$batch_id') and RegNo not in (Select distinct RegNo from cbse_marks where marks<80) group by RegNo having sum(Marks)>=840  ";
    $res=query_res($sql);
    $no_of_distinctions=mysql_num_rows($res);



 return $no_of_distinctions;


}



function get_group_name($group_id)
{   $result_arr=array();
    $sql="select SubjectIds from cbse_groups where GroupId='$group_id'";
    $res=query_res($sql);
    while($row=mysql_fetch_array($res))
    {
        $subject_list=explode(",",$row["SubjectIds"]);
        foreach($subject_list as $subject_id)
        {
            array_push($result_arr,get_subject_details($subject_id));
        }

    }
    $result=implode(",",$result_arr);
    return $result;
}
function get_group_abbrev($group_id)
{
    $sql="select Abbreviation from cbse_groups where GroupId='$group_id' ";
    $res=query_res($sql);
    $row=mysql_fetch_array($res);
    return $row["Abbreviation"];
}


function get_group_average($group_id,$school_id,$batch_id=2)
{
    $average=0;


        $sql_2="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and GroupId='$group_id' and s.RegNo=m.RegNo group by s.Regno";

        $res_2=query_res($sql_2);
        $num=mysql_num_rows($res_2);
        while($row_2=mysql_fetch_array($res_2))
        {
            $average+=(int)$row_2["sum_mark"];

        }
        $average=$average/$num;
        $average=round($average,2);
        return $average;



}

function get_group_students($group_id,$school_id,$batch_id=2)
{



    $sql_2="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and GroupId='$group_id' and s.RegNo=m.RegNo group by s.Regno";

    $res_2=query_res($sql_2);
    $num=mysql_num_rows($res_2);

    return $num;



}


function get_group_marks_distribution($group_id,$school_id,$batch_id=2)
{

    $marks_distribution=array();

    $sql="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and GroupId='$group_id' and s.RegNo=m.RegNo group by s.Regno having sum(Marks)>=1150";
    $res=query_res($sql);
    $marks_distribution[1]["From"]=1150;
    $marks_distribution[1]["To"]=1200;
    $marks_distribution[1]["Students"]=mysql_num_rows($res);

    $sql="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and GroupId='$group_id' and s.RegNo=m.RegNo group by s.Regno having sum(Marks)>=1100 and sum(Marks)<1150 ";
    $res=query_res($sql);
    $marks_distribution[2]["From"]=1100;
    $marks_distribution[2]["To"]=1149;
    $marks_distribution[2]["Students"]=mysql_num_rows($res);

    $sql="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and GroupId='$group_id' and s.RegNo=m.RegNo group by s.Regno having sum(Marks)>=1050 and sum(Marks)<1100 ";
    $res=query_res($sql);
    $marks_distribution[3]["From"]=1050;
    $marks_distribution[3]["To"]=1099;
    $marks_distribution[3]["Students"]=mysql_num_rows($res);

    $sql="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and GroupId='$group_id' and s.RegNo=m.RegNo group by s.Regno having sum(Marks)>=1000 and sum(Marks)<1049 ";
    $res=query_res($sql);
    $marks_distribution[4]["From"]=1000;
    $marks_distribution[4]["To"]=1049;
    $marks_distribution[4]["Students"]=mysql_num_rows($res);

    $sql="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and GroupId='$group_id' and s.RegNo=m.RegNo group by s.Regno having sum(Marks)>=900 and sum(Marks)<999 ";
    $res=query_res($sql);
    $marks_distribution[5]["From"]=900;
    $marks_distribution[5]["To"]=999;
    $marks_distribution[5]["Students"]=mysql_num_rows($res);

    $sql="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and GroupId='$group_id' and s.RegNo=m.RegNo group by s.Regno having sum(Marks)>=800 and sum(Marks)<899 ";
    $res=query_res($sql);
    $marks_distribution[6]["From"]=800;
    $marks_distribution[6]["To"]=899;
    $marks_distribution[6]["Students"]=mysql_num_rows($res);

    $sql="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and GroupId='$group_id' and s.RegNo=m.RegNo group by s.Regno having sum(Marks)>=700 and sum(Marks)<799 ";
    $res=query_res($sql);
    $marks_distribution[7]["From"]=700;
    $marks_distribution[7]["To"]=799;
    $marks_distribution[7]["Students"]=mysql_num_rows($res);

    $sql="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and GroupId='$group_id' and s.RegNo=m.RegNo group by s.Regno having sum(Marks)>=600 and sum(Marks)<699 ";
    $res=query_res($sql);
    $marks_distribution[8]["From"]=600;
    $marks_distribution[8]["To"]=699;
    $marks_distribution[8]["Students"]=mysql_num_rows($res);


    $sql="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and GroupId='$group_id' and s.RegNo=m.RegNo group by s.Regno having sum(Marks)<600  ";
    $res=query_res($sql);
    $marks_distribution[8]["From"]=0;
    $marks_distribution[8]["To"]=599;
    $marks_distribution[8]["Students"]=mysql_num_rows($res);


    return $marks_distribution;

}

function get_group_toppers($school_id,$batch_id=2)
{
    $result=array();
    $sql_pcmc="select RegNo,sum(marks) as sum_marks from cbse_marks where RegNo in(Select Regno from cbse_students where BatchId='$batch_id' and (GroupId=1 or GroupId=2 or GroupId=3 or GroupId=4) and SchoolId='$school_id') and SchoolId='$school_id' group by RegNo order by sum(marks) desc ";


    $res_pcmc=mysql_query($sql_pcmc);
    $row_pcmc=mysql_fetch_array($res_pcmc);
    $reg_pcmc=$row_pcmc["RegNo"];
    $marks_pcmc=$row_pcmc["sum_marks"];
    $name_pcmc=get_student_name($reg_pcmc);
    $result[1]["GroupName"]="Science with Computers";
    $result[1]["Toppers"][1]["RegNo"]=$reg_pcmc;
    $result[1]["Toppers"][1]["Marks"]=$marks_pcmc;
    $result[1]["Toppers"][1]["StudentName"]=$name_pcmc;

    $row_pcmc=mysql_fetch_array($res_pcmc);
    $reg_pcmc=$row_pcmc["RegNo"];
    $marks_pcmc=$row_pcmc["sum_marks"];
    $name_pcmc=get_student_name($reg_pcmc);
    $result[1]["GroupName"]="Science with Computers";
    $result[1]["Toppers"][2]["RegNo"]=$reg_pcmc;
    $result[1]["Toppers"][2]["Marks"]=$marks_pcmc;
    $result[1]["Toppers"][2]["StudentName"]=$name_pcmc;



    $row_pcmc=mysql_fetch_array($res_pcmc);
    $reg_pcmc=$row_pcmc["RegNo"];
    $marks_pcmc=$row_pcmc["sum_marks"];
    $name_pcmc=get_student_name($reg_pcmc);
    $result[1]["GroupName"]="Science with Computers";
    $result[1]["Toppers"][3]["RegNo"]=$reg_pcmc;
    $result[1]["Toppers"][3]["Marks"]=$marks_pcmc;
    $result[1]["Toppers"][3]["StudentName"]=$name_pcmc;






    $sql_pcmb="select RegNo,sum(marks) as sum_marks from cbse_marks where RegNo in(Select Regno from cbse_students where BatchId='$batch_id' and (GroupId=5 or GroupId=6 or GroupId=7 or GroupId=8) and SchoolId='$school_id') and SchoolId='$school_id' group by RegNo order by sum(marks) desc ";
    $res_pcmb=mysql_query($sql_pcmb);
    $row_pcmb=mysql_fetch_array($res_pcmb);
    $reg_pcmb=$row_pcmb["RegNo"];
    $marks_pcmb=$row_pcmb["sum_marks"];
    $name_pcmb=get_student_name($reg_pcmb);
    $result[2]["GroupName"]="Science with Biology";
    $result[2]["Toppers"][1]["RegNo"]=$reg_pcmb;
    $result[2]["Toppers"][1]["Marks"]=$marks_pcmb;
    $result[2]["Toppers"][1]["StudentName"]=$name_pcmb;


    $row_pcmb=mysql_fetch_array($res_pcmb);
    $reg_pcmb=$row_pcmb["RegNo"];
    $marks_pcmb=$row_pcmb["sum_marks"];
    $name_pcmb=get_student_name($reg_pcmb);
    $result[2]["GroupName"]="Science with Biology";
    $result[2]["Toppers"][2]["RegNo"]=$reg_pcmb;
    $result[2]["Toppers"][2]["Marks"]=$marks_pcmb;
    $result[2]["Toppers"][2]["StudentName"]=$name_pcmb;

    $row_pcmb=mysql_fetch_array($res_pcmb);
    $reg_pcmb=$row_pcmb["RegNo"];
    $marks_pcmb=$row_pcmb["sum_marks"];
    $name_pcmb=get_student_name($reg_pcmb);
    $result[2]["GroupName"]="Science with Biology";
    $result[2]["Toppers"][3]["RegNo"]=$reg_pcmb;
    $result[2]["Toppers"][3]["Marks"]=$marks_pcmb;
    $result[2]["Toppers"][3]["StudentName"]=$name_pcmb;







    $sql_cwc="select RegNo,sum(marks) as sum_marks from cbse_marks where RegNo in(Select Regno from cbse_students where BatchId='$batch_id' and (GroupId=9 or GroupId=10 or GroupId=11 or GroupId=12) and SchoolId='$school_id') and SchoolId='$school_id' group by RegNo order by sum(marks) desc ";
    $res_cwc=mysql_query($sql_cwc);
    $row_cwc=mysql_fetch_array($res_cwc);
    $reg_cwc=$row_cwc["RegNo"];
    $marks_cwc=$row_cwc["sum_marks"];
    $name_cwc=get_student_name($reg_cwc);
    $result[3]["GroupName"]="Commerce with Computers";
    $result[3]["Toppers"][1]["RegNo"]=$reg_cwc;
    $result[3]["Toppers"][1]["Marks"]=$marks_cwc;
    $result[3]["Toppers"][1]["StudentName"]=$name_cwc;

    $row_cwc=mysql_fetch_array($res_cwc);
    $reg_cwc=$row_cwc["RegNo"];
    $marks_cwc=$row_cwc["sum_marks"];
    $name_cwc=get_student_name($reg_cwc);
    $result[3]["GroupName"]="Commerce with Computers";
    $result[3]["Toppers"][2]["RegNo"]=$reg_cwc;
    $result[3]["Toppers"][2]["Marks"]=$marks_cwc;
    $result[3]["Toppers"][2]["StudentName"]=$name_cwc;
    $row_cwc=mysql_fetch_array($res_cwc);
    $reg_cwc=$row_cwc["RegNo"];
    $marks_cwc=$row_cwc["sum_marks"];
    $name_cwc=get_student_name($reg_cwc);
    $result[3]["GroupName"]="Commerce with Computers";
    $result[3]["Toppers"][3]["RegNo"]=$reg_cwc;
    $result[3]["Toppers"][3]["Marks"]=$marks_cwc;
    $result[3]["Toppers"][3]["StudentName"]=$name_cwc;






    $sql_cwb="select RegNo,sum(marks) as sum_marks from cbse_marks where RegNo in(Select Regno from cbse_students where BatchId='$batch_id' and (GroupId=13 or GroupId=14 or GroupId=15 or GroupId=16) and SchoolId='$school_id') and SchoolId='$school_id' group by RegNo order by sum(marks) desc ";
    //var_dump($sql_cwb);
    $res_cwb=mysql_query($sql_cwb);
    $row_cwb=mysql_fetch_array($res_cwb);
    $reg_cwb=$row_cwb["RegNo"];
    $marks_cwb=$row_cwb["sum_marks"];
    $name_cwb=get_student_name($reg_cwb);
    $result[4]["GroupName"]="Commerce with Business Studies";
    $result[4]["Toppers"][1]["RegNo"]=$reg_cwb;
    $result[4]["Toppers"][1]["Marks"]=$marks_cwb;
    $result[4]["Toppers"][1]["StudentName"]=$name_cwb;

    $row_cwb=mysql_fetch_array($res_cwb);
    $reg_cwb=$row_cwb["RegNo"];
    $marks_cwb=$row_cwb["sum_marks"];
    $name_cwb=get_student_name($reg_cwb);
    $result[4]["GroupName"]="Commerce with Business Studies";
    $result[4]["Toppers"][2]["RegNo"]=$reg_cwb;
    $result[4]["Toppers"][2]["Marks"]=$marks_cwb;
    $result[4]["Toppers"][2]["StudentName"]=$name_cwb;

    $row_cwb=mysql_fetch_array($res_cwb);
    $reg_cwb=$row_cwb["RegNo"];
    $marks_cwb=$row_cwb["sum_marks"];
    $name_cwb=get_student_name($reg_cwb);
    $result[4]["GroupName"]="Commerce with Business Studies";
    $result[4]["Toppers"][3]["RegNo"]=$reg_cwb;
    $result[4]["Toppers"][3]["Marks"]=$marks_cwb;
    $result[4]["Toppers"][3]["StudentName"]=$name_cwb;






    return $result;


}


function get_stream_toppers($school_id,$batch_id=2)
{
    $result=array();
    $sql_pcmc="select RegNo,sum(marks) as sum_marks from cbse_marks where RegNo in(Select Regno from cbse_students where BatchId='$batch_id' and (GroupId=1 or GroupId=2 or GroupId=3 or GroupId=4 or GroupId=5 or GroupId=6 or GroupId=7 or GroupId=8) and SchoolId='$school_id') and SchoolId='$school_id' group by RegNo order by sum(marks) desc ";


    $res_pcmc=mysql_query($sql_pcmc);
    $result[1]["GroupName"]="Science";
    $count=1;
    while(($row_pcmc=mysql_fetch_array($res_pcmc)) && $count<11)
    {
        $reg_pcmc=$row_pcmc["RegNo"];

        $marks_pcmc=$row_pcmc["sum_marks"];
        $name_pcmc=get_student_name($reg_pcmc);
        $section_pcmc=get_student_section($reg_pcmc);
        $result[1]["Toppers"][$count]["RegNo"]=$reg_pcmc;
        $result[1]["Toppers"][$count]["Marks"]=$marks_pcmc;
        $result[1]["Toppers"][$count]["Name"]=$name_pcmc;
        $result[1]["Toppers"][$count]["Section"]=$section_pcmc;
        $count+=1;
    }











    $sql_cwc="select RegNo,sum(marks) as sum_marks from cbse_marks where RegNo in(Select Regno from cbse_students where BatchId='$batch_id' and (GroupId=9 or GroupId=10 or GroupId=11 or GroupId=12 or GroupId=13 or GroupId=14 or GroupId=15 or GroupId=16) and SchoolId='$school_id') and SchoolId='$school_id' group by RegNo order by sum(marks) desc ";
    $res_cwc=mysql_query($sql_cwc);
    $row_cwc=mysql_fetch_array($res_cwc);
    $reg_cwc=$row_cwc["RegNo"];
    $marks_cwc=$row_cwc["sum_marks"];
    $name_cwc=get_student_name($reg_cwc);
    $result[2]["GroupName"]="Commerce";
    $count=1;
    while(($row_cwc=mysql_fetch_array($res_cwc)) && $count<11)
    {
        $reg_cwc=$row_cwc["RegNo"];
        $marks_cwc=$row_cwc["sum_marks"];
        $name_cwc=get_student_name($reg_cwc);
        $section_cwc=get_student_section($reg_cwc);
        $result[2]["Toppers"][$count]["RegNo"]=$reg_cwc;
        $result[2]["Toppers"][$count]["Marks"]=$marks_cwc;
        $result[2]["Toppers"][$count]["Name"]=$name_cwc;
        $result[2]["Toppers"][$count]["Section"]=$section_cwc;
        $count+=1;
    }













    return $result;
}



function get_student_name($reg_no)
{
    $sql="select StudentName from cbse_students where RegNo='$reg_no'";
    $res=query_res($sql);
    $row=mysql_fetch_array($res);
    return $row["StudentName"];
}
function get_student_section($reg_no)
{
    $sql="select Section from cbse_students where RegNo='$reg_no'";
    $res=query_res($sql);
    $row=mysql_fetch_array($res);
    return $row["Section"];
}



function get_group_distribution($school_id,$batch_id=2)
{
    $result=array();
    $result[1]["Name"]="Science w Computers";
    $result[2]["Name"]="Science w Biology";
    $result[3]["Name"]="Commerce w Computers";
    $result[4]["Name"]="Commerce w BusinessStudies";
    $result[1]["MarksDistribution"]=stream_marks_distribution($school_id,$batch_id,1,2,3,4);
    $result[2]["MarksDistribution"]=stream_marks_distribution($school_id,$batch_id,5,6,7,8);
    $result[3]["MarksDistribution"]=stream_marks_distribution($school_id,$batch_id,9,10,11,12);
    $result[4]["MarksDistribution"]=stream_marks_distribution($school_id,$batch_id,13,14,15,16);
    $result[1]["Average"]=stream_average($school_id,$batch_id ,1,2,3,4);
    $result[2]["Average"]=stream_average($school_id,$batch_id,5,6,7,8);
    $result[3]["Average"]=stream_average($school_id,$batch_id,9,10,11,12);
    $result[4]["Average"]=stream_average($school_id,$batch_id,13,14,15,16);

    $result[1]["no_of_students"]=count_students($school_id,$batch_id,1,2,3,4);
    $result[2]["no_of_students"]=count_students($school_id,$batch_id,5,6,7,8);
    $result[3]["no_of_students"]=count_students($school_id,$batch_id,9,10,11,12);
    $result[4]["no_of_students"]=count_students($school_id,$batch_id,13,14,15,16);


return $result;



}


function stream_marks_distribution($school_id,$batch_id,$group_1,$group_2,$group_3,$group_4)
{
    $marks_distribution=array();

    $sql="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and (GroupId='$group_1' or GroupId='$group_2' or GroupId='$group_3' or GroupId='$group_4') and s.RegNo=m.RegNo group by s.Regno having sum(Marks)>=1150";
    $res=query_res($sql);
    $marks_distribution[1]["From"]=1150;
    $marks_distribution[1]["To"]=1200;
    $marks_distribution[1]["Students"]=mysql_num_rows($res);

    $sql="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and (GroupId='$group_1' or GroupId='$group_2' or GroupId='$group_3' or GroupId='$group_4') and s.RegNo=m.RegNo group by s.Regno having sum(Marks)>=1100 and sum(Marks)<1150 ";
    $res=query_res($sql);
    $marks_distribution[2]["From"]=1100;
    $marks_distribution[2]["To"]=1149;
    $marks_distribution[2]["Students"]=mysql_num_rows($res);

    $sql="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and (GroupId='$group_1' or GroupId='$group_2' or GroupId='$group_3' or GroupId='$group_4') and s.RegNo=m.RegNo group by s.Regno having sum(Marks)>=1050 and sum(Marks)<1100 ";
    $res=query_res($sql);
    $marks_distribution[3]["From"]=1050;
    $marks_distribution[3]["To"]=1099;
    $marks_distribution[3]["Students"]=mysql_num_rows($res);

    $sql="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and (GroupId='$group_1' or GroupId='$group_2' or GroupId='$group_3' or GroupId='$group_4') and s.RegNo=m.RegNo group by s.Regno having sum(Marks)>=1000 and sum(Marks)<1049 ";
    $res=query_res($sql);
    $marks_distribution[4]["From"]=1000;
    $marks_distribution[4]["To"]=1049;
    $marks_distribution[4]["Students"]=mysql_num_rows($res);

    $sql="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and (GroupId='$group_1' or GroupId='$group_2' or GroupId='$group_3' or GroupId='$group_4') and s.RegNo=m.RegNo group by s.Regno having sum(Marks)>=900 and sum(Marks)<999 ";
    $res=query_res($sql);
    $marks_distribution[5]["From"]=900;
    $marks_distribution[5]["To"]=999;
    $marks_distribution[5]["Students"]=mysql_num_rows($res);

    $sql="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and (GroupId='$group_1' or GroupId='$group_2' or GroupId='$group_3' or GroupId='$group_4')and s.RegNo=m.RegNo group by s.Regno having sum(Marks)>=800 and sum(Marks)<899 ";
    $res=query_res($sql);
    $marks_distribution[6]["From"]=800;
    $marks_distribution[6]["To"]=899;
    $marks_distribution[6]["Students"]=mysql_num_rows($res);

    $sql="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and (GroupId='$group_1' or GroupId='$group_2' or GroupId='$group_3' or GroupId='$group_4') and s.RegNo=m.RegNo group by s.Regno having sum(Marks)>=700 and sum(Marks)<799 ";
    $res=query_res($sql);
    $marks_distribution[7]["From"]=700;
    $marks_distribution[7]["To"]=799;
    $marks_distribution[7]["Students"]=mysql_num_rows($res);

    $sql="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and (GroupId='$group_1' or GroupId='$group_2' or GroupId='$group_3' or GroupId='$group_4') and s.RegNo=m.RegNo group by s.Regno having sum(Marks)>=600 and sum(Marks)<699 ";
    $res=query_res($sql);
    $marks_distribution[8]["From"]=600;
    $marks_distribution[8]["To"]=699;
    $marks_distribution[8]["Students"]=mysql_num_rows($res);


    $sql="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and (GroupId='$group_1' or GroupId='$group_2' or GroupId='$group_3' or GroupId='$group_4') and s.RegNo=m.RegNo group by s.Regno having sum(Marks)<600  ";
    $res=query_res($sql);
    $marks_distribution[8]["From"]=0;
    $marks_distribution[8]["To"]=599;
    $marks_distribution[8]["Students"]=mysql_num_rows($res);


    return $marks_distribution;

}
function stream_average($school_id,$batch_id,$group_1,$group_2,$group_3,$group_4)
{
    $average=0;
    $sql_2="select sum(marks) as sum_mark from cbse_students as s,cbse_marks as m where m.SchoolId='$school_id' and BatchId='$batch_id' and (GroupId='$group_1' or GroupId='$group_2' or GroupId='$group_3' or GroupId='$group_4') and s.RegNo=m.RegNo group by s.Regno";

    $res_2=query_res($sql_2);
    $num=mysql_num_rows($res_2);
    while($row_2=mysql_fetch_array($res_2))
    {
        $average+=(int)$row_2["sum_mark"];

    }
    $average=$average/$num;
    $average=round($average,2);
    return $average;
}


function count_students($school_id,$batch_id,$group_1,$group_2,$group_3,$group_4)
{
    $sql="select * from cbse_students where SchoolId='$school_id' and BatchId='$batch_id' and (GroupId='$group_1' or GroupId='$group_2' or GroupId='$group_3' or GroupId='$group_4')";

    $res=query_res($sql);
    $num=mysql_num_rows($res);
    return $num;
}


function query_res($sql,$err_msg=''){
    //static $i = 1;    echo $i++.'.. '.$sql."<br><br>";

    $res = mysql_query($sql) or die("<br><br>$err_msg  Sql: $sql, Error: ".mysql_error());
    return $res;
}
?>
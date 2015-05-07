<?php
include_once "../../../../includes/helper.php";
include_once "../../../../includes/includes.php";
$request=$_REQUEST['Request'];

if($request=="SubjectGroups")
{
   SubjectGroups();

}

if($request=="GetStudents")
{
    $school_id=$_REQUEST["SchoolId"];
   $group_id=$_REQUEST["GroupId"];
    GetStudents($school_id,$group_id);
}

if($request=="SaveStudents")
{
    $group_id=$_REQUEST["GroupId"];
    $students=$_REQUEST["StudentIds"];
    SaveStudents($group_id,$students);
}



function SubjectGroups()
{   $result="<option value=-1>Select Group</option>";
    $sql="Select * from cbse_groups";
    $res=mysql_query($sql)or die($sql . " Error fetching Classes: " . mysql_error());
    $subject_array=array();
    $sql_subject="select * from cbse_subject ";
    $res_subject=mysql_query($sql_subject)or die($sql_subject . " Error fetching Classes: " . mysql_error());
    while($row_subject=mysql_fetch_array($res_subject))
    {   $id=$row_subject["SubjectId"];
        $name=$row_subject["SubjectName"];
        $subject_array[$id]=$name;
    }

    while($row=mysql_fetch_array($res))
    {
        $group_id=$row["GroupId"];
        $subject_id_list=$row["SubjectIds"];
        $subject_id_array=array();
        $subject_id_array=explode(",",$subject_id_list);
        $subject_string="";
        for($i=0;$i<count($subject_id_array);++$i)
        {
            $id=$subject_id_array[$i];
            $subject_name=$subject_array[$id];
            if($i==0)
            {
                $subject_string.=$subject_name;
            }
            else{
                $subject_string.=",".$subject_name;
            }


        }
        $result.="<option value=".$group_id.">".$subject_string."</option>";



    }
    echo $result;
}

function GetStudents($school_id,$group_id)
{   $result="";

    $sql="select * from cbse_students where SchoolId='$school_id' and GroupId=0 or GroupId='$group_id' and BatchId=2";

    $res=mysql_query($sql)or die($sql . " Error fetching Classes: " . mysql_error());
    while($row=mysql_fetch_array($res))
    {
        $group_id=$row["GroupId"];
        $student_id=$row["StudentId"];
        $student_name=$row["StudentName"];
        if($group_id!=0)
        {
            $result.="<option value=".$student_id." selected='selected'>".$student_name."</option>";
        }
        else{
            $result.="<option value=".$student_id.">".$student_name."</option>";
        }
    }

    echo $result;


}
function SaveStudents($group_id,$students)
{
    $sql_test="select * from cbse_students where GroupId='$group_id' and BatchId=2";
    $res_test=mysql_query($sql_test)or die($sql_test . " Error fetching Classes: " . mysql_error());
    $original_list=array();
    while($row=mysql_fetch_array($res_test))
    {
        $id=$row["StudentId"];
        array_push($original_list,$id);
    }
    $difference_array=array();
    $difference_array=array_diff($original_list,$students);
    foreach($students as $student_id)
    {
        $sql="update cbse_students set GroupId='$group_id' where StudentId='$student_id'";
        $res=mysql_query($sql)or die($sql . " Error fetching Classes: " . mysql_error());
    }
    foreach($difference_array as $student_id)
    {
        $sql="update cbse_students set GroupId=0 where StudentId='$student_id'";
        $res=mysql_query($sql)or die($sql . " Error fetching Classes: " . mysql_error());
    }
}
<?php
include_once "../models/subject_model.php";
include_once "../models/school_model.php";
include_once "../models/group_model.php";

include_once "../../../../../includes/includes.php";


$school_id=40;
$school_data=new SchoolReport2($school_id);


$request=$_REQUEST["Request"];

if($request=="GetSchoolData")
{  //var_dump($school_data);
    $school_data=json_encode($school_data);

    echo $school_data;
}
if($request=="GetSubjectData")
{
    get_subject_data($school_id);
}
if($request=="GetGroupData")
{
    get_group_data($school_id);
}

function get_subject_data($school_id)
{   $result=array();
    $sql="select * from cbse_subject ";
    $res=mysql_query($sql);
    while($row=mysql_fetch_array($res))
    {
        $subject_id=$row["SubjectId"];
        $result[$subject_id]=new SubjectReport($subject_id,$school_id);
    }
    $result=json_encode($result);
    echo $result;
}

function get_group_data($school_id)
{
    $result=array();
    $sql="select * from cbse_groups ";
    $res=mysql_query($sql);
    while($row=mysql_fetch_array($res))
    {
        $group_id=$row["GroupId"];
        $result[$group_id]=new GroupReport($group_id,$school_id);
    }

    $result=json_encode($result);
    echo $result;
}
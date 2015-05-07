<?php
//include_once "../../../../includes/includes.php";
//$school_id=40;
//
//
//$sql="Select * from cbse_subject";
//$res=mysql_query($sql);
//$subjectid_array=array();
//while($row=mysql_fetch_array($res))
//{
//    $cbse_subject_id=$row["SubjectId"];
//    $cbse_subject_abrev=substr($row["SubjectName"],0,4);
//    $sql_2="select * from SubjectGroup where NewSubjectName like '%$cbse_subject_abrev%' and SchoolId=40 and ClassId=386";
//    $res_2=mysql_query($sql_2);
//    $subjectid_array=[];
//    while($row_2=mysql_fetch_array($res_2))
//    {
//        array_push($subjectid_array,$row_2["Id"]);
//    }
//    $subjectids_string=implode(",",$subjectid_array);
//    $sql_insert="insert into cbse_subject_mappings(CbseSubjectId,SubjectIds,SchoolId) values ('$cbse_subject_id','$subjectids_string','$school_id')";
//    $res_insert=mysql_query($sql_insert);
//
//}
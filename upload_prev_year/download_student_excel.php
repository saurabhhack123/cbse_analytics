<?php
include_once "../../../../includes/helper.php";
include_once "../../../../includes/dbconfig.php";

$school_id = $_REQUEST['schoolid'];

$schoolname = get_school_name($school_id);
$file_name = 'Student_Details_' . $schoolname . '.xls';
$file_name = str_replace('/', '-', $file_name);
$tab_separated_values[] = "SchoolName:    \t$schoolname\t     \t     \t";
$headings="Board RegNo\tName\t";
$sql_subject="select * from cbse_subject";
$res_subject=mysql_query($sql_subject)or die($sql_subject . " Error fetching Classes: ". mysql_error()) ;
$subject_list=array();
while($row=mysql_fetch_array($res_subject))
{
    $headings.=$row["SubjectName"]."\t";
    $subject_list[$row["SubjectId"]]=$row["SubjectName"];
}
$tab_separated_values[] = $headings;


$sql_fetch_students="select * from cbse_students where  GroupId!=0 and RegNo is not null  and BatchId=3 and SchoolId='$school_id' order by RegNo";


$res_fetch_students=mysql_query($sql_fetch_students)or die($sql_fetch_students . " Error fetching Classes: ". mysql_error()) ;
while($row=mysql_fetch_array($res_fetch_students))
{
    $reg_no=$row["RegNo"];
    $student_name=$row["StudentName"];
    $group_id=$row["GroupId"];
    $paste_text=$reg_no."\t".$student_name."\t";

    foreach($subject_list as $subject_id=>$subject_name)
    {
        $test=isgroupid($group_id,$subject_id);

        if($test==true)
        {
            $paste_text.="\t";
        }
        else{
            $paste_text.="-\t";
        }
    }


    $tab_separated_values[]=$paste_text;

}


function isgroupid($group_id,$subject_id)
{
    $sql="select SubjectIds from cbse_groups where GroupId='$group_id'";
    $res=mysql_query($sql)or die($sql . " Error fetching Classes: " . mysql_error());
    $row=mysql_fetch_array($res);
    $subject_list=$row["SubjectIds"];

    $subject_array=array();
    $subject_array=explode(",",$subject_list);


    $result=in_array($subject_id,$subject_array);
    return $result;

}



$tab_separated_values = implode("\n", $tab_separated_values);
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");

echo $tab_separated_values;?>
<?php
include_once "../../../../includes/helper.php";
include_once "../../../../includes/dbconfig.php";

$school_id = $_REQUEST['schoolid'];

$schoolname = get_school_name($school_id);
$file_name = 'Student_Details_' . $schoolname . '.xls';
$file_name = str_replace('/', '-', $file_name);
$tab_separated_values[] = "SchoolName:    \t$schoolname\t     \t     \t";
$tab_separated_values[] = "SchoolComId\tName\tRegNo";


$sql_fetch_students="select * from students where ClassId in (Select ClassId from Class where ClassName='XII' and SchoolId='$school_id')";
//$sql_fetch_students="select * from cbse_students where BatchId=2";
$res_fetch_students=mysql_query($sql_fetch_students)or die($sql_fetch_students . " Error fetching Classes: ". mysql_error()) ;


while($row_student=mysql_fetch_array($res_fetch_students))
{
    $student_id=$row_student["StudentId"];
    $student_name=$row_student["Name"];
    $tab_separated_values[]="$student_id\t$student_name\t";
}
$tab_separated_values = implode("\n", $tab_separated_values);
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file_name");

echo $tab_separated_values;

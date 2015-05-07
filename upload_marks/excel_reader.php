<?php

include_once "../../../../includes/includes.php";
include_once "../../../../includes/helper.php";
include_once "../../../../includes/dbconfig.php";
$school_id = 40;

require_once 'Excel/reader.php';

$input_file_name = "upload_file";

$dirname = "Temp_excel/" . $_FILES[$input_file_name]["name"];
move_uploaded_file($_FILES[$input_file_name]["tmp_name"], $dirname); // move temp file to specific folder
$filename = "Temp_excel/" . $_FILES[$input_file_name]["name"];

$data = new Spreadsheet_Excel_Reader();
$data->setOutputEncoding('CP1251');
$data->read("$filename");
error_reporting(E_ALL ^ E_NOTICE);

$total_excel_rows = $data->sheets[0]['numRows'];
$total_excel_cols = $data->sheets[0]['numCols'];


$schoolname=trim($data->sheets[0]['cells'][1][2]);




$sql_subject="select * from cbse_subject";
$res_subject=mysql_query($sql_subject)or die($sql_subject . " Error fetching Classes: ". mysql_error()) ;
$subject_list=array();
while($row=mysql_fetch_array($res_subject))
{   array_push($subject_list,$row["SubjectId"]);


}


$i=3;


while($i<=$total_excel_rows)
{   $student_rno=trim($data->sheets[0]['cells'][$i][1]);
    $student_name=trim($data->sheets[0]['cells'][$i][2]);
    $j=3;
    while($j<=$total_excel_cols)
    {
        $subject_id=$subject_list[$j-3];

        $mark=trim($data->sheets[0]['cells'][$i][$j]);
        if($mark!="-" && $mark !=null)
        {

            $sql="select * from cbse_marks where RegNo='$student_rno' and SubjectId='$subject_id'";
            $res=mysql_query($sql)or die($sql . " Error fetching subjects: ". mysql_error()) ;
            if(mysql_num_rows($res)>0)
            {
                $sql_update="update cbse_marks set Marks='$mark' where RegNo='$student_rno' and SubjectId='$subject_id'";
                $res_update=mysql_query($sql_update)or die($sql_update . " Error updating marks: ". mysql_error()) ;
            }
            else{
                $sql_insert="insert into cbse_marks(RegNo,SubjectId,Marks,SchoolId) values ('$student_rno','$subject_id','$mark','$school_id')";
                $res_insert=mysql_query($sql_insert)or die($sql_insert . " Error fetching Classes: ". mysql_error()) ;


            }

        }
        $j=$j+1;
    }



$i=$i+1;

}

header("Location:upload_marks.php?success=1");

function v($data){
    var_dump($data);
    echo "<br>";
}

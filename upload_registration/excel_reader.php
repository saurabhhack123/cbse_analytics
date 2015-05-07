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







$i=3;


while($i<=$total_excel_rows)
{   $student_id=trim($data->sheets[0]['cells'][$i][1]);
    $student_name=trim($data->sheets[0]['cells'][$i][2]);
    $student_rno=trim($data->sheets[0]['cells'][$i][3]);
    if($student_rno)
    {   $sql_section="select SectionName from Section where SectionId in (Select SectionId from Students where StudentId='$student_id' )";
       $res_section=mysql_query($sql_section)or die($sql_section . " Error fetching Classes: ". mysql_error()) ;
        $row_section=mysql_fetch_array($res_section);
      $section_name=$row_section["SectionName"];

        $sql_test="select * from cbse_students where StudentId='$student_id'";
        $res_test=mysql_query($sql_test);
        if(mysql_num_rows($res_test)>0)
        {
            $sql_update="update cbse_students set RegNo='$student_rno' where StudentId='$student_id'";
            $res_update=mysql_query($sql_update);

        }
//        else
//        {  $sql="insert into cbse_students(StudentId,SchoolId,BatchId,Section,GroupId,StudentName,RegNo) values('$student_id','$school_id',2,'$section_name',0,'$student_name','$student_rno')";
//            //$sql="update cbse_students set RegNo='$student_rno' where StudentId='$student_id'";
//            $res=mysql_query($sql)or die($sql . " Error fetching Classes: ". mysql_error()) ;
//
//        }




    }


    $i+=1;
}

header("Location:student_regno.php?success=1");

function v($data){
    var_dump($data);
    echo "<br>";
}

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

$i=2;
while($i<=$total_excel_rows)
<<<<<<< HEAD
{   $sub_ids=array();
   $name=trim($data->sheets[0]['cells'][$i][2]);
=======
{   
    $sub_ids=array();
    $name=trim($data->sheets[0]['cells'][$i][2]);
>>>>>>> 6a5d05b2fc1e617ea619a77f7e184d8652cc85eb

    $roll_no=trim($data->sheets[0]['cells'][$i][3]);
    $section=trim($data->sheets[0]['cells'][$i][5]);
    $stud_id=trim($data->sheets[0]['cells'][$i][6]);
    $lang=trim($data->sheets[0]['cells'][$i][7]);

    $lang_id=get_lang_id($lang);
    $lang_mark=trim($data->sheets[0]['cells'][$i][8]);

    insert_marks($lang_id,$lang_mark,$roll_no,40);




    array_push($sub_ids,(int)$lang_id);
    //array_push($sub_ids,10);

    $j=9;

    while($j<=18)    {
        if(trim($data->sheets[0]['cells'][$i][$j])!=null)
        {   $mark=trim($data->sheets[0]['cells'][$i][$j]);
            $sub_name=trim($data->sheets[0]['cells'][1][$j]);
            $sub_id=get_lang_id($sub_name);

            array_push($sub_ids,(int)$sub_id);
            insert_marks($sub_id,$mark,$roll_no,40);

        }
        $j+=1;
    }
      sort($sub_ids);
    $subjects_string=implode(',',$sub_ids);
   // var_dump($subjects_string);
    $group_id=get_group_id($subjects_string);
   // var_dump($group_id);

    insert_student($stud_id,$roll_no,$section,$group_id,$name);

    $i+=1;
}
var_dump("done");

function insert_student($stud_id,$reg_no,$section,$group_id,$name)
{
<<<<<<< HEAD
    $sql="insert into cbse_students(StudentId,SchoolId,BatchId,Section,GroupId,StudentName,RegNo) values('$stud_id',40,1,'$section','$group_id','$name','$reg_no')";
  // var_dump($sql);
=======
    $sql="insert into cbse_students(StudentId,SchoolId,BatchId,Section,GroupId,StudentName,RegNo) values('$stud_id',40,3,'$section','$group_id','$name','$reg_no')";
  var_dump($sql);
>>>>>>> 6a5d05b2fc1e617ea619a77f7e184d8652cc85eb
    $res=mysql_query($sql);
}


function get_group_id($subjects_string)
<<<<<<< HEAD
{ $sql="select GroupId from cbse_groups where SubjectIds='$subjects_string'";
   // var_dump($sql);
=======
{   $sql="select GroupId from cbse_groups where SubjectIds='$subjects_string'";
    var_dump($sql);
>>>>>>> 6a5d05b2fc1e617ea619a77f7e184d8652cc85eb
    $res=mysql_query($sql);
    $row=mysql_fetch_array($res);
    $group_id=$row["GroupId"];
    return $group_id;
}
function insert_marks($sub_id,$mark,$reg_no,$school_id)
{
    $sql="insert into cbse_marks(SchoolId,RegNo,SubjectId,Marks) values ('$school_id','$reg_no','$sub_id','$mark')";
<<<<<<< HEAD
   // var_dump($sql);
   $res=mysql_query($sql);
=======
    var_dump($sql);
    $res=mysql_query($sql);
>>>>>>> 6a5d05b2fc1e617ea619a77f7e184d8652cc85eb

}

function get_lang_id($lang)
{   $sql="select SubjectId from cbse_subject where SubjectName like '%$lang%'";
<<<<<<< HEAD
   // var_dump($sql);
    $res=mysql_query($sql);
    $row=mysql_fetch_array($res);
    $lang_id=$row["SubjectId"];
   // var_dump($lang_id);
=======
    var_dump($sql);
    $res=mysql_query($sql);
    $row=mysql_fetch_array($res);
    $lang_id=$row["SubjectId"];
    var_dump($lang_id);
>>>>>>> 6a5d05b2fc1e617ea619a77f7e184d8652cc85eb
    return $lang_id;

}

die();

header("Location:upload_marks.php?success=1");

function v($data){
    var_dump($data);
    echo "<br>";
<<<<<<< HEAD
}
=======
}
>>>>>>> 6a5d05b2fc1e617ea619a77f7e184d8652cc85eb

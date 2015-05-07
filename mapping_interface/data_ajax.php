<?php
//include_once "../../../../includes/helper.php";




include_once "../../../../includes/includes.php";



$request = $_REQUEST['Request'];
if ($request == "GetGroups") {

    getgroups();

}

if ($request == "Students") {
    $school_id = $_REQUEST["SchoolId"];
    $group_id = $_REQUEST["GroupId"];
    //var_dump("Reached1");
    FetchStudents($school_id, $group_id);
}


if ($request == "TransferStudents") {
    $school_id = $_REQUEST["SchoolId"];
    $group_id = $_REQUEST["GroupId"];

    $student_list = $_REQUEST["StudentList"];

    TransferStudents($school_id, $group_id, $student_list);
}


function getgroups()
{
    $result = "";
    $sql = "SELECT * FROM cbse_groups ";
    $res = mysql_query($sql);

    while ($row = mysql_fetch_array($res)) {
        $group_id = $row["GroupId"];
        $subjectids = $row["SubjectIds"];
        $subject_array = array();
        $subject_array = explode(',', $subjectids);

        $subject_name_array = array();
        foreach ($subject_array as $subject_id) {
            $sql_name = "SELECT SubjectName FROM cbse_subject WHERE SubjectId='$subject_id'";
            $res_name = mysql_query($sql_name);
            $row = mysql_fetch_array($res_name);
            $subject_name = $row["SubjectName"];

            array_push($subject_name_array, $subject_name);

        }

    //var_dump($subject_name_array);
        $subject_string = implode(",", $subject_name_array);
       // var_dump($subject_string);
        $var="<option value=" . $group_id . ">" . $subject_string . "</option>";
       // var_dump($var);
       $result .=$var;
      //  var_dump($result);
    }

 //   var_dump($result);
    echo $result;

}


function FetchStudents($school_id, $group_id)
{//var_dump("Reached");
    $result = array();

    $sql = "SELECT * FROM cbse_groups WHERE GroupId='$group_id' ";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    $subjectids = $row["SubjectIds"];
   // var_dump($subjectids);
    $subject_array = array();
    $subject_array = explode(',', $subjectids);
    if (($key = array_search("10", $subject_array)) !== false) {
        unset($subject_array[$key]);
    }

    $temp1 = array();
    $temp2 = array();
    $map_array = array();
    $student_array = array();
   // var_dump("reached");

    for ($i = 0; $i <= count($subject_array); $i++) {
        $cbse_subject_id = $subject_array[$i];
        $sql_subject = "SELECT * FROM cbse_subject_mappings WHERE CbseSubjectId='$cbse_subject_id'";
        $res_subject = mysql_query($sql_subject);
        $row_subject = mysql_fetch_array($res_subject);
        $map_ids = $row_subject["SubjectIds"];

            $map_array = explode(',', $map_ids);
     //   var_dump($map_array);

        if ($i == 0) {
            foreach ($map_array as $map_id) {
                $sql_fetch_students = "SELECT * FROM subjectGroup WHERE Id='$map_id'";
                $res_fetch_students = mysql_query($sql_fetch_students);
                $row_fetch_students = mysql_fetch_array($res_fetch_students);
                $student_string = $row_fetch_students["StudentIDs"];
                $student_array = array_unique(array_merge(explode(",", $student_string), $student_array));

            }

       //     var_dump($student_array);

        } else {

            $temp1 = array();
            if ($cbse_subject_id != null) {

                foreach ($map_array as $map_id) {
                    $sql_fetch_students = "SELECT * FROM subjectGroup WHERE Id='$map_id'";
                    $res_fetch_students = mysql_query($sql_fetch_students);
                    $row_fetch_students = mysql_fetch_array($res_fetch_students);
                    $student_string = $row_fetch_students["StudentIDs"];

                    $temp1 = array_unique(array_merge(explode(",", $student_string), $temp1));


                }

                $student_array = array_intersect($student_array, $temp1);
            }


        }

    }
   // var_dump($student_array);
    foreach ($student_array as $student_id) {
        $sql_details = "SELECT * FROM students WHERE StudentId='$student_id'";
        $res_details = mysql_query($sql_details);
        $row_details = mysql_fetch_array($res_details);
        $student_name = $row_details["Name"];
        $section_id = $row_details["SectionId"];
        $roll_no = $row_details["RollNoInClass"];

        $sql_section = "SELECT SectionName FROM Section WHERE SectionId='$section_id'";
        $res_section = mysql_query($sql_section);
        $row_section = mysql_fetch_array($res_section);
        $section_name = $row_section["SectionName"];
        $result[$student_id]["Section"] = $section_name;
        $result[$student_id]["Name"] = $student_name;
        $result[$student_id]["RollNo"] = $roll_no;
    }

//    var_dump($result);
    $result = json_encode($result);
    echo $result;

}


function get_subject_details($subject_id)
{
    $sql = "SELECT SubjectName FROM cbse_subject WHERE SubjectId='$subject_id'";

    $res = query_res($sql);

    $row = mysql_fetch_array($res);


    $result = $row["SubjectName"];


    return $result;

}

function  TransferStudents($school_id, $group_id, $student_list)
{
    $sample_student = $student_list[0];

    foreach ($student_list as $student_id) {


        $sql_section = "SELECT SectionName FROM Section WHERE SectionId IN( SELECT SectionId FROM Students WHERE StudentId= '$sample_student' )";

        $res_section = mysql_query($sql_section);
        $row_section = mysql_fetch_array($res_section);
        $section_name=$row_section["SectionName"];



        $sql_name="select Name from Students where StudentId='$student_id'";
        $res_name=mysql_query($sql_name);
        $row_name=mysql_fetch_array($res_name);
        $student_name=$row_name["Name"];



        $sql_test="select * from cbse_students where StudentId ='$student_id'";
        $res_test=mysql_query($sql_test);
        if(mysql_num_rows($res_test)>0)
        {
            $sql_update="update cbse_students set GroupId='$group_id ' where StudentId='$student_id'";
            $res_update=mysql_query($sql_update);

        }
        else
        {
            $sql_insert="insert into cbse_students(StudentId,SchoolId,BatchId,Section,GroupId,StudentName,Regno) values ('$student_id','$school_id',2,'$section_name','$group_id','$student_name',0)";
            $res_insert=mysql_query($sql_insert);
        }


    }



}
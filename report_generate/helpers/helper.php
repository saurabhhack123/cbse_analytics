<?php
//this helper cannot be used with includes/helper.php --conflict with function names

function e($data){   echo $data."<br>";  }
function p($data){   ?><pre> <?print_r($data)?> </pre><?  }
function j($data){   echo json_encode($data)."<br>";  }
function v($data){   var_dump($data);  }
function s($data){
    static $i = 1;
    $data = json_encode($data);
    echo "<script>t$i = $.parseJSON('$data');</script>";
}

function query_res($sql,$err_msg=''){
    //static $i = 1;    echo $i++.'.. '.$sql."<br><br>";

    $res = mysql_query($sql) or die("<br><br>$err_msg  Sql: $sql, Error: ".mysql_error());
    return $res;
}
function correct_hash($hash_temp){
    $new_hash = array();
    foreach($hash_temp as $key=>$val) $new_hash[$key]=$val;
    return $new_hash;
}
function ucwords_lwr($string){
    return ucwords(strtolower($string));
}

function school_name($school_id){
    $sql = "select SchoolName from school where SchoolId='$school_id'";
    $res = query_res($sql);
    $row = mysql_fetch_array($res);
    return $row['SchoolName'];
}
function school_name_short($school_id){
    $sql = "select ShortenedSchoolName from school where SchoolId='$school_id'";
    $res = query_res($sql);
    $row = mysql_fetch_array($res);
    return $row['ShortenedSchoolName'];
}
function class_name($class_id){
    $sql = "select ClassName from class where ClassId='$class_id'";
    $res = query_res($sql);
    $row = mysql_fetch_array($res);
    return $row['ClassName'];
}
function section_name($section_id){
    $sql = "select SectionName from section where SectionId='$section_id'";
    $res = query_res($sql);
    $row = mysql_fetch_array($res);
    return $row['SectionName'];
}
function student_name($student_id){
    $sql = "select Name from Students where StudentId='$student_id'";
    $res = query_res($sql);
    $row = mysql_fetch_array($res);
    $name = $row['Name'];
    return $name;
}
function exam_name($exam_id){
    $sql = "select ExamName from exams where ExamId='$exam_id'";
    $res = query_res($sql);
    $row = mysql_fetch_array($res);
    return $row['ExamName'];
}

function subject_name($subject_id){
    $sql = "select SubjectName from subjects where SubjectId='$subject_id'";
    $res = query_res($sql);
    $row = mysql_fetch_array($res);
    return $row['SubjectName'];
}
function subject_max_mark($exam_id,$subject_id){
    $sql = "select * from subjectExams where ExamId='$exam_id' and SubjectId='$subject_id'";
    $res = query_res($sql);
    $row = mysql_fetch_array($res);
    return $row['MaximumMark'];
}
function new_subject_name($subject_group_id){
    $sql = "select NewSubjectName from subjectGroup where Id='$subject_group_id'";
    $res = query_res($sql);
    $row = mysql_fetch_array($res);
    return $row['NewSubjectName'];
}
function activity_name($activity_id){
    $sql = "select ActivityName from activity where ActivityId='$activity_id'";
    $res = query_res($sql);
    $row = mysql_fetch_array($res);
    return $row['ActivityName'];
}
function sub_activity_name($sub_activity_id){
    $sql = "select SubActivityName from subActivity where SubActivityId='$sub_activity_id'";
    $res = query_res($sql);
    $row = mysql_fetch_array($res);
    return $row['SubActivityName'];
}

function students($school_id,$class_id='',$section_id=''){
    $students = array();

    $sql = "select StudentId,Name from students where SchoolId='$school_id' and ClassId='$class_id' and SectionId='$section_id' order by RollNoInClass";
    if($class_id=='')        $sql = "select StudentId,Name from students where SchoolId='$school_id' order by RollNoInClass";
    else if($section_id=='') $sql = "select StudentId,Name from students where SchoolId='$school_id' and ClassId='$class_id' order by RollNoInClass";

    $res = query_res($sql);
    while($row = mysql_fetch_array($res)){
        $student_id   = $row['StudentId'];
        $student_name = $row['Name'];

        $students[$student_id]=$student_name;
    }
    return $students;
}
function schools(){
    $schools = array();
    $sql = "select SchoolId,SchoolName from school order by SchoolName";
    $res = query_res($sql);
    while($row = mysql_fetch_array($res)){
        $school_id   = $row['SchoolId'];
        $school_name = $row['SchoolName'];

        $schools[$school_id] = $school_name;
    }
    return $schools;
}
function classes($school_id){
    $classes = array();
    $sql = "select ClassId,ClassName from class where SchoolId='$school_id' order by ClassId";
    $res = query_res($sql);
    while($row = mysql_fetch_array($res)){
        $class_id   = $row['ClassId'];
        $class_name = $row['ClassName'];

        $classes[$class_id]=$class_name;
    }
    return $classes;
}
function sections($class_id){
    $sections = array();
    $sql="select SectionId,SectionName from section where ClassId='$class_id' order by SectionName";
    $res=query_res($sql);
    while($row = mysql_fetch_array($res)){
        $section_id   = $row['SectionId'];
        $section_name = $row['SectionName'];

        $sections[$section_id]=$section_name;
    }
    return $sections;
}
function exams($class_id){
    $exams = array();
    $sql = "select ExamId,ExamName from exams where ClassId='$class_id'";
    $res = query_res($sql);
    while($row = mysql_fetch_array($res)){
        $exam_id    = $row['ExamId'];
        $exam_name  = $row['ExamName'];

        $exams[$exam_id]=$exam_name;
    }
    return $exams;
}
function exam_ids_by_class($class_id){
    $exam_ids = array();
    $sql = "select ExamId from exams where ClassId='$class_id'";
    $res = query_res($sql);
    while($row = mysql_fetch_array($res)){
        $exam_ids[] = $row['ExamId'];
    }
    return $exam_ids;
}
function exam_ids_by_terms($class_id,$terms){
    $term_exams = array();
    $terms = implode(',',$terms);

    $sql = "select Term,ExamId,ExamName from exams where ClassId='$class_id' and Term in ($terms)";
    $res = query_res($sql);
    while($row = mysql_fetch_array($res)){
            $term      = $row['Term'];
            $exam_id   = $row['ExamId'];
            if(!in_array($exam_id,$term_exams[$term]))  $term_exams[$term][] = $exam_id;
    }
    return $term_exams;
}
function activities($section_id,$exam_id,$subject_id){
    $activities = array();
    $sql = "select ActivityId,ActivityName from activity where SectionId='$section_id' and ExamId='$exam_id' and SubjectId='$subject_id'";
    $res = query_res($sql);
    while($row = mysql_fetch_array($res)){
        $activity_id   = $row['ActivityId'];
        $activity_name = $row['ActivityName'];

        $activities[$activity_id]=$activity_name;
    }
    return $activities;
}
function class_terms($class_id){
    $terms = array();
    $sql = "select distinct term from exams where ClassId='$class_id'";
    $res = query_res($sql);
    while($row = mysql_fetch_array($res)){
        $terms[] = $row['term'];
    }
    return $terms;
}
function sub_activities($school_id,$class_id,$section_id,$exam_id,$subject_id,$activity_id){
    $sub_activities = array();
    $sql = "select SubActivityId,SubActivityName from subActivity where SchoolId='$school_id' and ClassId='$class_id' and SectionId='$section_id' and
                ExamId='$exam_id' and SubjectId='$subject_id' and ActivityId='$activity_id'";
    $res = query_res($sql);
    while($row1=mysql_fetch_array($res)){
        $sub_activity_id    = $row1['SubActivityId'];
        $sub_activity_name  = $row1['SubActivityName'];

        $sub_activities[$sub_activity_id]=$sub_activity_name;
    }
    return $sub_activities;
}

function subjects_by_exams($exam_ids){
    $exam_subjects    = array();
    $exam_subject_ids = array();

    $exam_ids = implode(',',$exam_ids);
    $sql = "select SubjectIDs from exams where ExamId in ($exam_ids)";
    $res = query_res($sql);

    while($row = mysql_fetch_array($res)){
        $subject_ids      = explode(',',$row['SubjectIDs']);
        $exam_subject_ids = array_merge($exam_subject_ids,$subject_ids);
    }
    $subject_models = subject_models($exam_subject_ids);

    foreach($exam_subject_ids as $subject_id)
        $exam_subjects[$subject_id] = $subject_models[$subject_id]['SubjectName'];

    return $exam_subjects;
}
function cce_subjects($class_id){
    $cce_subjects = array();
    $sql = "select SubjectIDs from cceSubjects where ClassId='$class_id'";
    $res = query_res($sql);
    $row = mysql_fetch_array($res);

    $subject_ids    = explode(',',$row['SubjectIDs']);
    $subject_models = subject_models($subject_ids,$class_id);

    foreach($subject_models as $subject_id=>$subject_data)
        $cce_subjects[$subject_id] = $subject_data['SubjectName'];
    return $cce_subjects;
}
function class_section_subjects($school_id,$class_id,$section_id){
    $subjects = array();
    $sql = "select SubjectId from subjectTeachers where SchoolId='$school_id' and ClassId='$class_id' and SectionId='$section_id'";
    $res = query_res($sql);

    while($row = mysql_fetch_array($res)){
        $subject_id = $row['SubjectId'];
        $subjects[$subject_id] = subject_name($subject_id);
    }
    return $subjects;
}
function subjects($school_id,$class_id,$exam_ids=null){
    $exam_ids = $exam_ids ? $exam_ids : exam_ids_by_class($class_id);
    return cce_or_state($school_id)=='CCE'? cce_subjects($class_id):subjects_by_exams($exam_ids); //class_section_subjects($school_id,$class_id,$section_id);
}

function subject_group_names($class_id,$subject_id){
    $subject_group_names = array();
    $sql = "select Id,NewSubjectName from subjectGroup where ClassId='$class_id' and SubjectId='$subject_id'";
    $res = query_res($sql);
    while($row = mysql_fetch_array($res)){
        $new_subject_id   = $row['Id'];
        $new_subject_name = $row['NewSubjectName'];

        $subject_group_names[$new_subject_id] = $new_subject_name;
    }
    return $subject_group_names;
}
function subject_data_with_group($school_id,$class_id,$section_id){
    $subject_new_subjects = array();
    $subjects = subjects($school_id,$class_id,$section_id);

    foreach($subjects as $subject_id=>$subject_name){
        $subject_new_subjects[$subject_id]['name'] = $subject_name;
        $subject_new_subjects[$subject_id]['subject_groups'] = array();

        $subject_group_names = subject_group_names($class_id,$subject_id);
        foreach($subject_group_names as $new_subject_id=>$new_subject_name){
            $subject_new_subjects[$subject_id]['subject_groups'][$new_subject_id] = $new_subject_name;
        }
    }
    return $subject_new_subjects;
}
function subject_subject_grp_name($school_id,$class_id){
    $sub_subGrp_name= array();
    $subjects       = subjects($school_id,$class_id);
    $subject_models = subject_models(array_keys($subjects),$class_id,1);

    foreach($subject_models as $sub_id=>$subject_data){
        $sub_name   = $subject_data['SubjectName'];
        $sub_groups = $subject_data['SubjectGroup'];

        if(!$sub_groups)    $sub_subGrp_name[$sub_id.'_0'] = $sub_name;
        else{
            foreach($sub_groups as $sub_grp_id=>$sub_grp_data){
                $sub_grp_name = $sub_grp_data['name'];
                $sub_subGrp_name[$sub_id.'_'.$sub_grp_id] = $sub_grp_name;
            }
        }
    }
    return $sub_subGrp_name;
}

function cce_or_state($school_id){
    $sql = "select syllabus from school where SchoolId='$school_id'";
    $res = query_res($sql);
    $row = mysql_fetch_array($res);
    return $row['syllabus']=='CBSE' ? 'CCE':'STATE';
}

function school_model($school_id){
    $school_model = array();

    $sql = "select s.SchoolId,s.SchoolName,s.ShortenedSchoolName,s.Syllabus,s.Address,s.PrincipalTeacherId,s.Syllabus,
                   t.Name as PrincipalName, t.Mobile as PrincipalMobile
            from school as s, teacher as t where s.SchoolId='$school_id' and t.TeacherId=s.PrincipalTeacherId
           ";
    $res = query_res($sql);
    $row = mysql_fetch_array($res);

    $school_model['id']                  = $row['SchoolId'];
    $school_model['SchoolId']            = $row['SchoolId'];
    $school_model['SchoolName']          = $row['SchoolName'];
    $school_model['ShortenedSchoolName'] = $row['ShortenedSchoolName'];
    $school_model['Address']             = $row['Address'];
    $school_model['PrincipalTeacherId']  = $row['PrincipalTeacherId'];
    $school_model['Syllabus']            = $row['Syllabus'];
    $school_model['PrincipalName']       = $row['PrincipalName'];
    $school_model['PrincipalMobile']     = $row['PrincipalMobile'];

    $school_model['CCE']                 = $school_model['Syllabus']=='CBSE'?true:false;

    return $school_model;
}
function class_model($class_id){
    $class_model = array();

    $sql = "select SchoolId,ClassId,ClassName from class where ClassId='$class_id'";
    $res = query_res($sql);
    $row = mysql_fetch_array($res);

    $class_model['id']        = $row['ClassId'];
    $class_model['SchoolId']  = $row['SchoolId'];
    $class_model['ClassId']   = $row['ClassId'];
    $class_model['ClassName'] = $row['ClassName'];

    return $class_model;
}
function section_model($section_id){
    $section_model = array();
    $sql = "select s.SchoolId,s.ClassId,s.SectionId,s.SectionName,
                   t.Name as ClassTeacherName, t.Mobile as ClassTeacherMobile
            from section s left outer join teacher t on s.ClassTeacherId=t.TeacherId
            where SectionId='$section_id'";
    $res = query_res($sql);
    $row = mysql_fetch_array($res);

    $section_model['id']                = $row['SectionId'];
    $section_model['SchoolId']          = $row['SchoolId'];
    $section_model['ClassId']           = $row['ClassId'];
    $section_model['SectionId']         = $row['SectionId'];
    $section_model['SectionName']       = $row['SectionName'];
    $section_model['ClassTeacherName']  = $row['ClassTeacherName'];
    $section_model['ClassTeacherMobile']= $row['ClassTeacherMobile'];

    return $section_model;
}
function exam_models($exam_ids){
    $exams_model = array();
    $exam_ids = implode(',',$exam_ids);

    $sql = "select ExamId,ExamName,SubjectIDs,Percentage,Term,MarkUploaded from exams where ExamId in ($exam_ids)";
    $res = query_res($sql);
    while($row = mysql_fetch_array($res)){
        $exam_id = $row['ExamId'];

        $exams_model[$exam_id]['id']         = $exam_id;
        $exams_model[$exam_id]['ExamId']     = $exam_id;
        $exams_model[$exam_id]['ExamName']   = $row['ExamName'];
        $exams_model[$exam_id]['SubjectIDs'] = $row['SubjectIDs'];
        $exams_model[$exam_id]['Percentage'] = $row['Percentage'];
        $exams_model[$exam_id]['Percentage'] = $row['Percentage'];
        $exams_model[$exam_id]['MarkUploaded']= $row['MarkUploaded'];

        $exams_model[$exam_id]['max_mark']   = exam_max_mark_all_subjects($exam_id,$row['SubjectIDs']);
    }

    return $exams_model;
}
function school_exams($school_id){
    $school_exams = array();

    $sql = "select ExamName from exams where SchoolId='$school_id'";
    $res = query_res($sql);
    while($row = mysql_fetch_array($res)){
        $exam_name = $row['ExamName'];
        if(!in_array($exam_name,$school_exams))    $school_exams[] = $exam_name;
    }
    return $school_exams;
}
function exam_max_mark_all_subjects($exam_id,$exam_subject_ids_str){
    $sql = "select sum(MaximumMark) as exam_max_mark from SubjectExams where ExamId='$exam_id' and SubjectId in ($exam_subject_ids_str)";
    $res = query_res($sql);
    $row = mysql_fetch_array($res);
    return $row['exam_max_mark'];
}

function exam_model($exam_id){
    $exam_model = array();

    $sql = "select ExamId,ExamName,SubjectIDs,Percentage,Term,MarkUploaded from exams where ExamId='$exam_id'";
    $res = query_res($sql);
    $row = mysql_fetch_array($res);

    $exam_model['id']         = $row['ExamId'];
    $exam_model['ExamId']     = $row['ExamId'];
    $exam_model['ExamName']   = $row['ExamName'];
    $exam_model['SubjectIDs'] = explode(',',$row['SubjectIDs']);
    $exam_model['Percentage'] = $row['Percentage'];
    $exam_model['Term']       = $row['Term'];
    $exam_model['MarkUploaded']= $row['MarkUploaded'];

    return $exam_model;
}
function student_models($student_ids){
    $student_models = array();
    $gen_remarks    = general_remarks($student_ids);

    $student_ids = implode(',',$student_ids);
    $sql   = "select s.StudentId,s.StudentId,s.SchoolId,s.ClassId,s.SectionId,s.Name,s.FatherName,s.MotherName,s.Mobile1,s.Address,s.RollNoInClass,s.Gender,s.DateOfBirth,s.AdmissionNo,
                     csp.HealthStatus,csp.BloodGroup,csp.Height,csp.Weight,csp.DaysAttended1,csp.TotalDays1,csp.DaysAttended2,csp.TotalDays2,csp.DaysAttended3,csp.TotalDays3
              from students s
              left outer join cceStudentProfile csp on s.StudentId=csp.StudentId
              where s.StudentId in ($student_ids)";
    $res   = query_res($sql);
    while($row = mysql_fetch_array($res)){
        $id   = $row['StudentId'];

        $student_models[$id]['id']              = $row['StudentId'];
        $student_models[$id]['StudentId']       = $row['StudentId'];
        $student_models[$id]['SchoolId']        = $row['SchoolId'];
        $student_models[$id]['ClassId']         = $row['ClassId'];
        $student_models[$id]['SectionId']       = $row['SectionId'];

        $student_models[$id]['Name']            = $row['Name'];
        $student_models[$id]['FatherName']      = $row['FatherName'];
        $student_models[$id]['MotherName']      = $row['MotherName'];
        $student_models[$id]['Mobile1']         = $row['Mobile1'];
        $student_models[$id]['Address']         = $row['Address'];
        $student_models[$id]['RollNoInClass']   = $row['RollNoInClass'];
        $student_models[$id]['Gender']          = $row['Gender'];
        $student_models[$id]['DateOfBirth']     = $row['DateOfBirth'];
        $student_models[$id]['AdmissionNo']     = $row['AdmissionNo'];

        $student_models[$id]['HealthStatus']    = $row['HealthStatus'];
        $student_models[$id]['BloodGroup']      = $row['BloodGroup'];
        $student_models[$id]['Height']          = $row['Height'];
        $student_models[$id]['Weight']          = $row['Weight'];

        $student_models[$id]['DaysAttended1']   = $row["DaysAttended1"];
        $student_models[$id]['DaysAttended2']   = $row["DaysAttended2"];
        $student_models[$id]['DaysAttended3']   = $row["DaysAttended3"];
        $student_models[$id]['TotalDays1']      = $row["TotalDays1"];
        $student_models[$id]['TotalDays2']      = $row["TotalDays2"];
        $student_models[$id]['TotalDays3']      = $row["TotalDays3"];

        $student_models[$id]['gen_remark']      = $gen_remarks['students'][$id];
    }
    return $student_models;
}
function general_remarks($student_ids){
    $gen_remarks = array();
    $student_ids = implode(',',$student_ids);

    $sql = "select StudentId,Term,Remark from term_remark where StudentId in ($student_ids)";
    $res = query_res($sql);
    while($row = mysql_fetch_array($res)){
        $student_id = $row['StudentId'];
        $term       = $row['Term'];
        $remark     = $row['Remark'];

        $gen_remarks['students'][$student_id]['Terms'][$term] = $remark;
    }
    return $gen_remarks;
}
function subject_models($subject_ids,$class_id = 0,$subject_groups = 0){
    $subject_models     = array();
    $subject_group_data = $subject_groups? subject_group_data($subject_ids,$class_id):null;
    $subject_ids        = implode(',',$subject_ids);

    $sql = "select SubjectId,SubjectName from subjects where SubjectId in ($subject_ids)";
    $res = query_res($sql);
    while($row = mysql_fetch_array($res)){
        $subject_id     = $row['SubjectId'];
        $subject_name   = $row['SubjectName'];

//        $subject_models[$subject_id]['id']              = $subject_id;
//        $subject_models[$subject_id]['SubjectId']       = $subject_id;
        $subject_models[$subject_id]['SubjectName']     = $subject_name;

        if($subject_groups)     $subject_models[$subject_id]['SubjectGroup'] = $subject_group_data['subject'][$subject_id]['group'];
    }
    return $subject_models;
}
function subject_group_data($subject_ids,$class_id){
    $subject_group = array();
    foreach($subject_ids as $subject_id)    $subject_group['subject'][$subject_id]['group'] = null;

    $subject_ids = implode(',',$subject_ids);
    $sql = "select SubjectId,Id as NewSubjectId,NewSubjectName,StudentIDs from subjectGroup where SubjectId in ($subject_ids) and ClassId='$class_id'";
    $res = query_res($sql);
    if(mysql_num_rows($res)==0)     return null;

    while($row = mysql_fetch_array($res)){
        $subject_id = $row['SubjectId'];
        $group_id   = $row['NewSubjectId'];
        $group_name = $row['NewSubjectName'];

        $subject_group['subject'][$subject_id]['group'][$group_id]['name']              = $group_name;
//        $subject_group['subject'][$subject_id]['group'][$group_id]['NewSubjectName']    = $group_name;
//        $subject_group['subject'][$subject_id]['group'][$group_id]['NewSubjectId']      = $group_id;
        $subject_group['subject'][$subject_id]['group'][$group_id]['section_students']  = array();

        $student_ids = $row['StudentIDs'];
        if($student_ids!=''){
            $sql_1 = "select StudentId,SectionId from students where StudentId in ($student_ids)";
            $res_1 = query_res($sql_1);
            while($row_1 = mysql_fetch_array($res_1)){
                $student_id = $row_1['StudentId'];
                $section_id = $row_1['SectionId'];
                $subject_group['subject'][$subject_id]['group'][$group_id]['section_names'][$section_id]      = section_name($section_id);
                $subject_group['subject'][$subject_id]['group'][$group_id]['section_students'][$section_id][] = $student_id;
                $subject_group['subject'][$subject_id]['group'][$group_id]['student_ids'][]                   = $student_id;
            }
        }
    }
    return $subject_group;
}

function grades_class_wise_map($class_id){
    $grades_map = array();

    $sql = "select MarkFrom,MarkTo,Grade,GradePoint from gradesClassWise where ClassId='$class_id' order by MarkTo asc";
    $res = query_res($sql);

    while($row = mysql_fetch_array($res)){
        $mark_to    = $row['MarkTo'];
        $grade      = $row['Grade'];
        if(!$grade or !$mark_to)    return -1;

        $grades_map[$grade]['MarkTo']       = $row['MarkTo'];
        $grades_map[$grade]['MarkFrom']     = $row['MarkFrom'];
//        $grades_map[$grade]['Grade']        = $grade;
        $grades_map[$grade]['GradePoint']   = $row['GradePoint'];
    }
    return $grades_map;
}
function grades_subject_wise_map($class_id,$subject_ids){   //todo check
    $grades_map = array();
    $subject_ids = implode(',',$subject_ids);

    $sql = "select SubjectId,MarkFrom,MarkTo,Grade,GradePoint from grades_subject_wise where ClassId='$class_id' and SubjectId in ($subject_ids) order by MarkTo asc";
    $res = query_res($sql);

    while($row = mysql_fetch_array($res)){
        $subject_id = $row['SubjectId'];
        $mark_to    = $row['MarkTo'];
        $grade      = $row['Grade'];
        if(!$grade or !$mark_to)    return -1;

        $grades_map['subjects'][$subject_id][$grade]['MarkTo']       = $row['MarkTo'];
        $grades_map['subjects'][$subject_id][$grade]['MarkFrom']     = $row['MarkFrom'];
//        $grades_map['subjects'][$subject_id][$grade]['Grade']        = $grade;
        $grades_map['subjects'][$subject_id][$grade]['GradePoint']   = $row['GradePoint'];

    }
    return $grades_map;
}
function grades_exam_wise_map($class_id,$exam_ids){
    return null;  //todo import table
    $grades_map = array();
    $exam_ids   = implode(',',$exam_ids);

    $sql = "select ExamId,MarkFrom,MarkTo,Grade,GradePoint from grades_exam_wise where ClassId='$class_id' and ExamId in ($exam_ids) order by MarkTo asc";
    $res = query_res($sql);

    while($row = mysql_fetch_array($res)){
        $exam_id    = $row['ExamId'];
        $mark_to    = $row['MarkTo'];
        $grade      = $row['Grade'];
        if(!$grade or !$mark_to)    return -1;

        $grades_map['exams'][$exam_id][$grade]['MarkTo']       = $row['MarkTo'];
        $grades_map['exams'][$exam_id][$grade]['MarkFrom']     = $row['MarkFrom'];
//        $grades_map['exams'][$exam_id][$grade]['Grade']        = $grade;
        $grades_map['exams'][$exam_id][$grade]['GradePoint']   = $row['GradePoint'];
    }
    return $grades_map;
}

function activity_models($section_id,$subject_ids,$exam_ids, $modify_name_id=1){
    $activity_models     = array();
    $sub_activity_models = sub_activity_models($section_id,$subject_ids,$exam_ids,$modify_name_id);

    $subject_ids = implode(',',$subject_ids);
    $exam_ids    = implode(',',$exam_ids);

    $sql = "select SubjectId,ExamId,ActivityId,ActivityName,MaximumMark,Weightage from activity where SectionId='$section_id'
                    and ExamId in ($exam_ids) and SubjectId in ($subject_ids)";
    $res = query_res($sql);
    while($row = mysql_fetch_array($res)){
        $subject_id    = $row['SubjectId'];
        $exam_id       = $row['ExamId'];
        $activity_id   = $row['ActivityId'];
        $activity_name = $row['ActivityName'];

        $act_name_id = $modify_name_id ? strtolower(trim($activity_name)) : $activity_name;

        $activity_models['subjects'][$subject_id]['activities'][$act_name_id]['name']            = $activity_name;
        $activity_models['subjects'][$subject_id]['activities'][$act_name_id]['max_mark']        = $row['MaximumMark'];
        //$activity_models['subjects'][$subject_id]['activities'][$act_name_id]['weightage']     = $row['Weightage'];
        $activity_models['subjects'][$subject_id]['activities'][$act_name_id]['exam_ids'][]      = $exam_id;

        $activity_models['subjects'][$subject_id]['activities'][$act_name_id]['exam_act_id'][$exam_id] = $activity_id;

        $activity_models['subjects'][$subject_id]['activities'][$act_name_id]['sub_activities'] = $sub_activity_models['subjects'][$subject_id]['activities'][$act_name_id]['sub_activities'];
    }
    return $activity_models;
}
function sub_activity_models($section_id,$subject_ids,$exam_ids,$modify_name_id=1){
    $sub_activity_models = array();

    $subject_ids = implode(',',$subject_ids);
    $exam_ids = implode(',',$exam_ids);
    $sql = "select sa.SubjectId,sa.ActivityId,sa.ExamId,sa.SubActivityId,sa.SubActivityName,sa.MaximumMark,sa.Weightage,
                    a.ActivityName
                from subActivity sa
                    join activity a on sa.ActivityId=a.ActivityId
                where sa.SectionId='$section_id' and sa.SubjectId in ($subject_ids) and sa.ExamId in ($exam_ids)";
    $res = query_res($sql);
    while($row=mysql_fetch_array($res)){
        $sub_activity_id    = $row['SubActivityId'];
        //$activity_id        = $row['ActivityId'];
        $sub_activity_name  = $row['SubActivityName'];
        $act_name           = $row['ActivityName'];
        $subject_id         = $row['SubjectId'];
        $exam_id            = $row['ExamId'];

        $act_name_id        = $modify_name_id ? strtolower(trim($act_name)) : $act_name;
        $sub_act_name_id    = $modify_name_id ? strtolower(trim($sub_activity_name)) : $sub_activity_name;

        $sub_activity_models['subjects'][$subject_id]['activities'][$act_name_id]['sub_activities'][$sub_act_name_id]['name']        = $sub_activity_name;
        $sub_activity_models['subjects'][$subject_id]['activities'][$act_name_id]['sub_activities'][$sub_act_name_id]['max_mark']    = $row['MaximumMark'];
        //$sub_activity_models['subjects'][$subject_id]['activities'][$act_name_id]['sub_activities'][$sub_act_name_id]['weightage']      = $row['Weihtage'];

        $sub_activity_models['subjects'][$subject_id]['activities'][$act_name_id]['sub_activities'][$sub_act_name_id]['exam_ids'][]     = $exam_id;
        $sub_activity_models['subjects'][$subject_id]['activities'][$act_name_id]['sub_activities'][$sub_act_name_id]['exam_subAct_id'][$exam_id] = $sub_activity_id;
    }
    return $sub_activity_models;
}

function act_exam_marks($student_id,$exam_ids,$subject_ids){
    $act_exam_marks = array();

    $exam_ids    = implode(',',$exam_ids);
    $subject_ids = implode(',',$subject_ids);

    $sql = "select ExamId,SubjectId,ActivityId,Mark from activityMark
                where StudentId='$student_id' and ExamId in ($exam_ids) and SubjectId in ($subject_ids)";
    $res = query_res($sql);
    while($row = mysql_fetch_array($res)){
        $exam_id     = $row['ExamId'];
        $subject_id  = $row['SubjectId'];
        $activity_id = $row['ActivityId'];

        $act_exam_marks['subjects'][$subject_id]['activities'][$activity_id]['exams'][$exam_id] = $row['Mark'];
    }
    return $act_exam_marks;
}
function sub_act_exam_marks($student_id,$exam_ids,$subject_ids){
    $sub_act_exam_marks = array();

    $exam_ids    = implode(',',$exam_ids);
    $subject_ids = implode(',',$subject_ids);

    $sql = "select ExamId,SubjectId,ActivityId,SubActivityId,Mark from subActivityMark
                where StudentId='$student_id' and ExamId in ($exam_ids) and SubjectId in ($subject_ids)";
    $res = query_res($sql);

    while($row = mysql_fetch_array($res)){
        $exam_id     = $row['ExamId'];
        $subject_id  = $row['SubjectId'];
        $activity_id = $row['ActivityId'];
        $sub_act_id  = $row['SubActivityId'];

        $sub_act_exam_marks['subjects'][$subject_id]['activities'][$activity_id]['sub_activities'][$sub_act_id]['exams'][$exam_id] = $row['Mark'];
    }
    return $sub_act_exam_marks;
}

function class_section_students($class_id,$section_id=-1){
    $class_section_students = array();

    $sql = "select SectionId,StudentId from students where ClassId='$class_id'";
    $res = query_res($sql);

    while($row = mysql_fetch_array($res)){
        $section_id = $row['SectionId'];
        $student_id = $row['StudentId'];

        $class_section_students[$section_id][]    = $student_id;
        $class_section_students['all_sections'][] = $student_id;
    }
    return $class_section_students;
}

function co_scholastic_data_sec_topic_aspect($class_id){
    $co_scholastic_data = array();

    $co_scholastic_id= co_scholastic_id_for_class($class_id);

    $sql = "select sh.SectionHeadingId,sh.SectionName as SecHeadingName,
                    t.TopicId,t.TopicName,t.Evaluation,
                    a.AspectId,a.AspectName
            from cceSectionHeading sh
                left outer join cceTopicPrimary t on t.SectionHeadingId=sh.SectionHeadingId
                left outer join cceAspectPrimary a on a.TopicId=t.TopicId
            where sh.CoScholasticId='$co_scholastic_id'";
    $res =query_res($sql);

    $topic_grade_map = topic_grade_map($co_scholastic_id);
    while($row = mysql_fetch_array($res)){
        $sec_heading_id     = $row['SectionHeadingId'];
        $sec_heading_name   = $row['SecHeadingName'];
        $topic_id           = $row['TopicId'];
        $topic_name         = $row['TopicName'];
        $topic_evaluation   = $row['Evaluation'];
        $aspect_id          = $row['AspectId'];
        $aspect_name        = $row['AspectName'];

        if($sec_heading_id) $co_scholastic_data['sec_headings'][$sec_heading_id]['name']                                            = $sec_heading_name;
        if($topic_id)       $co_scholastic_data['sec_headings'][$sec_heading_id]['topics'][$topic_id]['name']                       = $topic_name;
        if($topic_id)       $co_scholastic_data['sec_headings'][$sec_heading_id]['topics'][$topic_id]['evaluation']                 = $topic_evaluation;
        if($topic_id)       $co_scholastic_data['sec_headings'][$sec_heading_id]['topics'][$topic_id]['grade_data']                 = $topic_grade_map[$topic_id]['grade_data'];
        if($aspect_id)      $co_scholastic_data['sec_headings'][$sec_heading_id]['topics'][$topic_id]['aspects'][$aspect_id]['name']= $aspect_name;
    }
    return $co_scholastic_data;
}
function co_scholastic_id_for_class($class_id){
    $co_scholastic_id = null;
    $sql = "select coScholasticId,Name,ClassIDs from cceCoScholastic";
    $res = query_res($sql);
    while ($row = mysql_fetch_array($res)) {
        $class_ids = explode(',', $row['ClassIDs']);
        $co_scho_id = $row['coScholasticId'];
        $co_scho_name = $row['Name'];

        if (in_array($class_id, $class_ids)) $co_scholastic_id = $co_scho_id;
    }
    return $co_scholastic_id;
}
function topic_grade_map($co_scholastic_id){
    $topic_grade_map = array();

    $sql = "select TopicId,Grade,Value from cceTopicGrade where CoScholasticId='$co_scholastic_id'";
    $res = query_res($sql);

    while($row = mysql_fetch_array($res)){
        $topic_id = $row['TopicId'];
        $grade    = $row['Grade'];
        $value    = $row['Value'];

        $topic_grade_map[$topic_id]['grade_data'][$value] = $grade;
    }
    return $topic_grade_map;
}
function aspect_grade($student_ids){
    $aspect_grade = array();

    $student_ids = implode(',',$student_ids);
    $sql = "select StudentId,Term,Type,AspectId,Grade,Description from cceCoScholasticGrade where StudentId in ($student_ids)";
    $res = query_res($sql);
    while($row = mysql_fetch_array($res)){
        $eval_type  = $row['Type'];
        $term_exam  = $row['Term'];
        $aspect_id  = $row['AspectId'];
        $student_id = $row['StudentId'];

        $aspect_grade['students'][$student_id]['aspects'][$aspect_id]['eval_type'][$eval_type]['term_exam'][$term_exam]['grade_value'] = $row['Grade'];
        $aspect_grade['students'][$student_id]['aspects'][$aspect_id]['eval_type'][$eval_type]['term_exam'][$term_exam]['description'] = $row['Description'];
    }
    return $aspect_grade;
}

function school_class_section(){
    $school_class_section = array();

    $sql = "select s.SchoolId,s.SchoolName,c.ClassId,c.ClassName,sec.SectionId,sec.SectionName
                from school s
                left outer join class   c   on c.SchoolId  = s.SchoolId
                left outer join section sec on sec.ClassId = c.ClassId";
    $res = query_res($sql);

    while($row = mysql_fetch_array($res)){
        $school_id   = $row['SchoolId'];
        $school_name = $row['SchoolName'];
        $class_id    = $row['ClassId'];
        $class_name  = $row['ClassName'];
        $section_id  = $row['SectionId'];
        $section_name= $row['SectionName'];

        $school_class_section[$school_id]['name']                                                = $school_name;
        $school_class_section[$school_id]['classes'][$class_id]['name']                          = $class_name;
        $school_class_section[$school_id]['classes'][$class_id]['sections'][$section_id]['name'] = $section_name;
    }
    return $school_class_section;
}

function subject_models_for_verification($subject_ids,$exam_ids,$class_id = 0,$subject_groups = 0){
    $subject_models     = array();
    $subject_group_data = $subject_groups? subject_group_data($subject_ids,$class_id):null;
    $subject_ids        = implode(',',$subject_ids);
    $exam_ids           = implode(',',$exam_ids);

    $sql = "select s.SubjectId,s.SubjectName,
                  se.ExamId,se.MaximumMark,se.FailMark
                from subjects s
                left outer join subjectExams se on se.SubjectId=s.SubjectId
                where s.SubjectId in ($subject_ids) and se.ExamId in ($exam_ids)";
    $res = query_res($sql);
    while($row = mysql_fetch_array($res)){
        $subject_id     = $row['SubjectId'];
        $subject_name   = $row['SubjectName'];
        $exam_id        = $row['ExamId'];
        $exam_max_mark  = $row['MaximumMark'];
        $exam_fail_mark = $row['FailMark'];

//        $subject_models[$subject_id]['id']              = $subject_id;
//        $subject_models[$subject_id]['SubjectId']       = $subject_id;
        $subject_models[$subject_id]['SubjectName']                     = $subject_name;

        $exam_model = exam_model($exam_id);
        if(in_array($subject_id,$exam_model['SubjectIDs'])){
            $subject_models[$subject_id]['exam_data'][$exam_id]['name']      = $exam_model['ExamName'];
            $subject_models[$subject_id]['exam_data'][$exam_id]['max_mark']  = $exam_max_mark;
            $subject_models[$subject_id]['exam_data'][$exam_id]['fail_mark'] = $exam_fail_mark;
        }
        if($subject_groups)     $subject_models[$subject_id]['SubjectGroup'] = $subject_group_data['subject'][$subject_id]['group'];
    }
    return $subject_models;
}
function activity_models_for_verification($section_id,$subject_ids,$exam_ids,$modify_name_id=0){
    $activity_models     = array();
    $sub_activity_models = sub_activity_models_for_verification($section_id,$subject_ids,$exam_ids,$modify_name_id);

    $subject_ids = implode(',',$subject_ids);
    $exam_ids    = implode(',',$exam_ids);

    $sql = "select SubjectId,ExamId,ActivityId,ActivityName,MaximumMark,Weightage from activity where SectionId='$section_id'
                    and ExamId in ($exam_ids) and SubjectId in ($subject_ids)";
    $res = query_res($sql);
    while($row = mysql_fetch_array($res)){
        $subject_id    = $row['SubjectId'];
        $exam_id       = $row['ExamId'];
        $activity_id   = $row['ActivityId'];
        $activity_name = $row['ActivityName'];
        $exam_model    = exam_model($exam_id);

        $act_name_id = $modify_name_id ? strtolower(trim($activity_name)) : $activity_name;

        $activity_models['subjects'][$subject_id]['activities'][$act_name_id]['name']            = $activity_name;
        $activity_models['subjects'][$subject_id]['activities'][$act_name_id]['exam_data'][$exam_id]['name']     = $exam_model['ExamName'];
        $activity_models['subjects'][$subject_id]['activities'][$act_name_id]['exam_data'][$exam_id]['act_id']   = $activity_id;
        $activity_models['subjects'][$subject_id]['activities'][$act_name_id]['exam_data'][$exam_id]['max_mark'] = $row['MaximumMark'];

        //$activity_models['subjects'][$subject_id]['activities'][$act_name_id]['max_mark']        = $row['MaximumMark'];
        //$activity_models['subjects'][$subject_id]['activities'][$act_name_id]['weightage']     = $row['Weightage'];
        //$activity_models['subjects'][$subject_id]['activities'][$act_name_id]['exam_ids'][]      = $exam_id;
        //$activity_models['subjects'][$subject_id]['activities'][$act_name_id]['exam_act_id'][$exam_id]       = $activity_id;
        //$activity_models['subjects'][$subject_id]['activities'][$act_name_id]['exam_max_mark'][$exam_id] = $row['MaximumMark'];

        $activity_models['subjects'][$subject_id]['activities'][$act_name_id]['sub_activities'] = $sub_activity_models['subjects'][$subject_id]['activities'][$act_name_id]['sub_activities'];
    }
    return $activity_models;
}
function sub_activity_models_for_verification($section_id,$subject_ids,$exam_ids,$modify_name_id=0){
    $sub_activity_models = array();

    $subject_ids = implode(',',$subject_ids);
    $exam_ids = implode(',',$exam_ids);
    $sql = "select sa.SubjectId,sa.ActivityId,sa.ExamId,sa.SubActivityId,sa.SubActivityName,sa.MaximumMark,sa.Weightage,
                    a.ActivityName
                from subActivity sa
                    join activity a on sa.ActivityId=a.ActivityId
                where sa.SectionId='$section_id' and sa.SubjectId in ($subject_ids) and sa.ExamId in ($exam_ids)";
    $res = query_res($sql);
    while($row=mysql_fetch_array($res)){
        $sub_activity_id    = $row['SubActivityId'];
        //$activity_id        = $row['ActivityId'];
        $sub_activity_name  = $row['SubActivityName'];
        $act_name           = $row['ActivityName'];
        $subject_id         = $row['SubjectId'];
        $exam_id            = $row['ExamId'];
        $exam_model         = exam_model($exam_id);

        $act_name_id        = $modify_name_id ? strtolower(trim($act_name)) : $act_name;
        $sub_act_name_id    = $modify_name_id ? strtolower(trim($sub_activity_name)) : $sub_activity_name;

        $sub_activity_models['subjects'][$subject_id]['activities'][$act_name_id]['sub_activities'][$sub_act_name_id]['name']                             = $sub_activity_name;
        $sub_activity_models['subjects'][$subject_id]['activities'][$act_name_id]['sub_activities'][$sub_act_name_id]['exam_data'][$exam_id]['name']      = $exam_model['ExamName'];
        $sub_activity_models['subjects'][$subject_id]['activities'][$act_name_id]['sub_activities'][$sub_act_name_id]['exam_data'][$exam_id]['max_mark']  = $row['MaximumMark'];
        $sub_activity_models['subjects'][$subject_id]['activities'][$act_name_id]['sub_activities'][$sub_act_name_id]['exam_data'][$exam_id]['sub_act_id']= $sub_activity_id;

        //$sub_activity_models['subjects'][$subject_id]['activities'][$act_name_id]['sub_activities'][$sub_act_name_id]['weightage']      = $row['Weihtage'];
        //$sub_activity_models['subjects'][$subject_id]['activities'][$act_name_id]['sub_activities'][$sub_act_name_id]['exam_ids'][]     = $exam_id;
        //$sub_activity_models['subjects'][$subject_id]['activities'][$act_name_id]['sub_activities'][$sub_act_name_id]['exam_subAct_id'][$exam_id] = $sub_activity_id;
        //$sub_activity_models['subjects'][$subject_id]['activities'][$act_name_id]['sub_activities'][$sub_act_name_id]['exam_max_mark'][$exam_id]  = $row['MaximumMark'];
    }
    return $sub_activity_models;
}


function filter_map($array_assoc,$array_keys){
    $new_arr = array();
    foreach($array_assoc as $key=>$val){
        if(in_array($key,$array_keys))  $new_arr[$key]=$val;
    }
    return $new_arr;
}

function get_grade($mark,$total_mark,$all_grades){
    if($mark=='-')  return '-';

    $max_mark = max_MarkTo($all_grades);
    $max_gp   = max_grade_point($all_grades);
    $mark     = ($mark*$max_mark)/$total_mark;
    $mark     = ceil($mark);

    foreach($all_grades as $grade=>$grade_data){
        $mark_to    = $grade_data['MarkTo'];
        $mark_from  = $grade_data['MarkFrom'];

        if($mark_from<=$mark && $mark<=$mark_to){
            return array('grade'=>$grade,'grade_point'=>$grade_data['GradePoint'],'max_gp'=>$max_gp);
        }
    }
    return -1;
}
function max_grade_point($all_grades){
    $max_gp = 0;
    foreach($all_grades as $grade=>$grade_data){
        $max_gp = $max_gp<$grade_data['GradePoint'] ? $grade_data['GradePoint'] : $max_gp;
    }
    return $max_gp;
}
function max_MarkTo($all_grades){
    $max_mark = 0;
    foreach($all_grades as $grade=>$grade_data){
        $max_mark = $max_mark<$grade_data['MarkTo'] ? $grade_data['MarkTo'] : $max_mark;
    }
    return $max_mark;
}

function class_subject_teachers($class_id){
    $class_subject_teachers = array();

    $sql = "select st.SectionId,st.SubjectId,st.TeacherId,st.SubjectGroupId,
                    t.Name
                from subjectTeachers st
                join teacher t on t.TeacherId = st.TeacherId
                where st.ClassId='$class_id'
                    and st.SectionId in (select SectionId from section where ClassId='$class_id')";
    $res = query_res($sql);

    while($row = mysql_fetch_array($res)){
        $section_id         = $row['SectionId'];
        $subject_id         = $row['SubjectId'];
        $subject_group_id   = $row['SubjectGroupId'];
        $teacher_id         = $row['TeacherId'];
        $teacher_name       = $row['Name'];

        $class_subject_teachers[$teacher_id]['name']                    = $teacher_name;
        $class_subject_teachers[$teacher_id]['list_section_subject'][]  = array(
            'section_id'        =>  $section_id,
            'subject_id'        =>  $subject_id,
            'subject_group_id'  =>  $subject_group_id
        );
    }
    return $class_subject_teachers;
}


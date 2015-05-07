<?php
include_once "../../../../includes/includes.php";
include_once "../helpers/helper.php";

$action = $_REQUEST['action'];
$result = array();

if($action=='get_class_exams')        $result = get_class_exams();
if($action=='get_school_exams')       $result = get_school_exams();

echo json_encode($result);
//======================================== functions

function get_class_exams(){
    $class_id       = $_REQUEST['class_id'];

    $exams          = exams($class_id);
    $exam_models    = exam_models(array_keys($exams));
    return $exam_models;
}
function get_school_exams(){
    $school_id      = $_REQUEST['school_id'];

    $exams          = school_exams($school_id);
    return $exams;
}
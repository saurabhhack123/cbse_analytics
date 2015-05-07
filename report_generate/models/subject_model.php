<?php
include_once "../localhelper/localhelper.php";

class SubjectReport
{
    public $subject_name;
    public $average;
    public $centums;
    public $marks_distribution;
    public $no_of_students;
    public $prev_average;
    public $prev_centums;
    public $prev_marks_distribution;
    public $prev_no_of_students;

    function __construct($subject_id, $school_id)
    {
        $this->subject_name = get_subject_details($subject_id);
        $this->no_of_students = get_nof_students($subject_id, $school_id);
        $this->average=get_average_subject_marks($subject_id,$school_id,$this->no_of_students);
        $this->centums=get_subject_centums($subject_id,$school_id);
        $this->marks_distribution=get_subject_marks_distribution($subject_id,$school_id);
        $this->prev_no_of_students = get_nof_students($subject_id, $school_id,2);
        $this->prev_average=get_average_subject_marks($subject_id,$school_id,$this->prev_no_of_students,2);
        $this->prev_centums=get_subject_centums($subject_id,$school_id,2);
        $this->prev_marks_distribution=get_subject_marks_distribution($subject_id,$school_id,2);

    }


}


?>
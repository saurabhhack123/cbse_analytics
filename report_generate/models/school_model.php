<?php
include_once "../localhelper/localhelper.php";

class SchoolReport2
{   public $school;
    public $topper_list;
    public $school_avg;
    public $prev_school_avg;
    public $students_registered;
    public $absentees;
    public $appeared;
    public $passed;
    public $no_of_centums;
    public $distinctions;
    public $marks_distribution;
    public $prev_topper_list;
    public $prev_students_registered;
    public $prev_absentees;
    public $prev_appeared;
    public $prev_passed;
    public $prev_no_of_centums;
    public $prev_distinctions;
    public $prev_marks_distribution;
    public $group_toppers;
    public $prev_group_toppers;
    public $stream_toppers;
    public $prev_stream_toppers;
    public $group_distribution;
    public $prev_group_distribution;


    function __construct($school_id)
    {$this->school=cbse_school_model($school_id);
        $this->topper_list=topper_model($school_id);
        $this->school_avg=get_school_avg($school_id);
        $this->students_registered=get_students_registered($school_id);
        $this->absentees=get_absentees($school_id);
        $this->appeared=$this->students_registered-$this->absentees;
        $this->passed=get_pass_percent($school_id,$this->appeared);
        $this->no_of_centums=get_centums($school_id);
        $this->marks_distribution=get_marks_distribution($school_id);
        $this->distinctions=get_distinctions($school_id);
        $this->group_toppers=get_group_toppers($school_id);
        $this->stream_toppers=get_stream_toppers($school_id);
        $this->group_distribution=get_group_distribution($school_id);


        $this->prev_topper_list=topper_model($school_id,2);
        $this->prev_school_avg=get_school_avg($school_id,2);
        $this->prev_students_registered=get_students_registered($school_id,2);
        $this->prev_absentees=get_absentees($school_id,2);
        $this->prev_appeared=$this->prev_students_registered-$this->prev_absentees;
        $this->prev_passed=get_pass_percent($school_id,$this->prev_appeared,2);
        $this->prev_no_of_centums=get_centums($school_id,2);
        $this->prev_marks_distribution=get_marks_distribution($school_id,2);
        $this->prev_distinctions=get_distinctions($school_id,2);
        $this->prev_group_toppers=get_group_toppers($school_id,2);
        $this->prev_stream_toppers=get_stream_toppers($school_id,2);
        $this->prev_group_distribution=get_group_distribution($school_id,2);
    }





}
?>
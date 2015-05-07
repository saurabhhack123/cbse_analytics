<?php
include_once "../localhelper/localhelper.php";


class GroupReport
{
    public $group_name;
    public $group_average;
    public $prev_group_average;
    public $no_of_students;
    public $prev_no_of_students;
    public $marks_distribution;
    public $prev_marks_distribution;
    public $group_abbrev;

    function __construct($group_id,$school_id)
    {
        $this->group_name=get_group_name($group_id);
        $this->group_abbrev=get_group_abbrev($group_id);
        $this->group_average=get_group_average($group_id,$school_id);
<<<<<<< HEAD
        $this->prev_group_average=get_group_average($group_id,$school_id,2);
        $this->no_of_students=get_group_students($group_id,$school_id);
        $this->prev_no_of_students=get_group_students($group_id,$school_id,2);
        $this->marks_distribution=get_group_marks_distribution($group_id,$school_id);
        $this->prev_marks_distribution=get_group_marks_distribution($group_id,$school_id,2);
=======
        $this->prev_group_average=get_group_average($group_id,$school_id,1);
        $this->no_of_students=get_group_students($group_id,$school_id);
        $this->prev_no_of_students=get_group_students($group_id,$school_id,1);
        $this->marks_distribution=get_group_marks_distribution($group_id,$school_id);
        $this->prev_marks_distribution=get_group_marks_distribution($group_id,$school_id,1);
>>>>>>> 6a5d05b2fc1e617ea619a77f7e184d8652cc85eb

    }

}
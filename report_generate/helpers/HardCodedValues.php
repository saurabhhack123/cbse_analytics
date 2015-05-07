<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Prajit24
 * Date: 6/3/14
 * Time: 1:07 PM
 * To change this template use File | Settings | File Templates.
 */

class HardCodedValues {

    function section_report_cmr_get_short_subject_name($normal_value,$subject_id){
        if($subject_id==51)     $normal_value = 'CS';

        return $normal_value;
    }
}
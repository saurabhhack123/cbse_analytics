<?php

class IndexHelper {
    public $PathSchoolAdmin;
    public $SchoolClassSectionMap;

    function __construct($school_id,$all_schools){
        $this->PathSchoolAdmin = '../../../schooladmin/';
        $this->setSchoolClassSectionMap($school_id,$all_schools);
    }
    function setSchoolClassSectionMap($school_id,$all_schools){
        $this->SchoolClassSectionMap = school_class_section();

        if(!$all_schools){
            $temp_data                    = array();
            $temp_data[$school_id]        = $this->SchoolClassSectionMap[$school_id];
            $this->SchoolClassSectionMap  = $temp_data;
        }
    }
    function getSchoolClassSectionMap(){
        return $this->SchoolClassSectionMap;
    }

    function SchoolComLogo(){
        return 'resources/img/logo1.png';
    }
    function SchoolComMainUrl(){
        return 'http://schoolcom.in';
    }

    function pathSchoolAdmin(){
        return $this->PathSchoolAdmin;
    }
    function pathSchoolAdminHome(){
        return $this->PathSchoolAdmin . 'views/home/';
    }
    function pathSectionController(){
        return 'controllers/section_report_controller.php';
    }
    function pathClassController(){
        return 'controllers/class_report_controller.php';
    }
    function pathTeacherController(){
        return 'controllers/teacher_controller.php';
    }
    function pathSchoolTeacherController(){
        return 'controllers/school_teacher_controller.php';
    }
    function pathReportCardVerification(){
        return $this->PathSchoolAdmin . 'views/reportCard_verification/index.php';
    }

    function Logout(){
        return $this->PathSchoolAdmin . '../login/logout.php';
    }

}
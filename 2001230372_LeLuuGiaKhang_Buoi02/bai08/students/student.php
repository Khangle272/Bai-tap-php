<?php
namespace students;

class student extends person
{
    private $studentID;

    public function __construct($name, $age, $studentID)
    {
        parent::__construct($name, $age);
        $this->studentID = $studentID;
    }
    
    public function getStudentInfo() {
        $basicInfo = parent::getInfo();
        return "{$basicInfo} - Mã SV: {$this->studentID}";
    }
}
?>
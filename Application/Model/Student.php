<?php
require_once (realpath(dirname( __FILE__ )) . '/../../Config.php');
use Config as Conf;    

require_once (Conf::getApplicationUtilsPath() . 'Validations.php');
use Validations as MyValidations;

class Student {
    
    private $studentID;
    private $studentName;
    private $courseID;
    
    public function getStudentID(){
        return $this->studentID;
    }
    
    public function getStudentName(){
        return $this->studentName;
    }    
    
    public function getCourseID(){
        return $this->courseID;
    }    
    
    public function setStudentID($value){
        if (!MyValidations::isString($value)){
            throw new Exception ('tem que ser uma String...');
        }        
        
        $this->studentID = $value;        
    }
    
    public function setStudentName($value){
        if (!MyValidations::isString($value)){
            throw new Exception ('tem que ser uma String...');
        }
        
        $this->studentName = $value;
    }
    
    public function setCourseID($value){
        if (!MyValidations::isString($value)){
            throw new Exception ('tem que ser uma String...');
        }
        
        $this->courseID = $value;
    }    
    

    
    public function convertObjectToArray(){
        $data = array(  'studentID' => $this->getStudentID(), 
                        'studentName' => $this->getStudentName(),
                        'courseID' => $this->getCourseID());        
        
        return $data;
    }
    
    public static function convertArrayToObject(Array &$data){
        return self::createObject($data['studentID'], $data['studentName'], $data['courseID']);
    }    
    
    public static function createObject($studentID, $studentName, $courseID){
        $student = new Student();
        $student->setStudentID($studentID);
        $student->setStudentName($studentName);
        $student->setCourseID($courseID);
     
        
        return $student;
    }
}

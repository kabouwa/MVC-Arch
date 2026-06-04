<?php
//Functions
function validateStudent() : array{
    global $students_db;
    try{
       $data = [
            "errors" => [],
            "firstname" => trim((string) filter_input(INPUT_POST,'firstname',FILTER_SANITIZE_SPECIAL_CHARS)),
            "lastname" => trim((string) filter_input(INPUT_POST,'lastname',FILTER_SANITIZE_SPECIAL_CHARS)),
            "city" => trim((string) filter_input(INPUT_POST,'city',FILTER_SANITIZE_SPECIAL_CHARS)),
            "group" => trim((string) filter_input(INPUT_POST,'group',FILTER_SANITIZE_SPECIAL_CHARS)),
            "age" => (int) filter_input(INPUT_POST,'age',FILTER_VALIDATE_INT),
        ]; 
    }catch(Exception $e){
        $data['errors'][] = "All fields are required. Please complete the form.";
        return $data;
    }
    foreach($data as $col => $val){
        if(empty($val) && $col!=="errors"){
            $data['errors'][] = "All fields are required. Please complete the form.";
            return $data;
        }
    }
    if($data['age'] < 0 || $data['age'] > 100){
        $data['errors'][] = "Invalid age.";
    }
    if( $students_db->isExist([
            "firstNameStud" => $data['firstname'],
            "lastNameStud" =>$data['lastname']
        ]) ){
        $data['errors'][] = "Student already exists.";
    }
    return $data;
}
?>
<?php
//Router :
function ctrl($filename){return "../Controllers/" . $filename . ".php";}
require(ctrl("StudentController"));

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
switch($request){
    case "/":
        students();
        break;
    case "/create-student": 
        createStudent();
        break;
    case "/update-student": 
        updateStudent();
        break;
    case "/delete-student": 
        deleteStudent();
        break;
    case "/picture-student": 
        picturesStudent();
        break;

    default :
        notFound();
}
?>
<?php
require(__DIR__."/../config/ConnectDB.php");
require(__DIR__."/../Models/Student.php");
require(__DIR__."/../Services/StudentService.php");
function view($filename){return "../Views/students/" . $filename . ".php";}
$students_db = new StudentDB($conn);

//Controllers
function students(){
    global $students_db;
    $students =  $students_db->getAll("idStud");
    $pictures = "/picture-student?id=";
    $success = [];
    $errors = [];
    if(isset($_GET['del'])){
        switch($_GET['del']){
            case "202":
                $success[] = "Student deleted successfully !";
                break;
            case "404":
                $errors[] = "Failed to delete the student. Please try again.";
        }
    }
    if(isset($_GET['cr'])){
        switch($_GET['cr']){
            case "202":
                $success[] = "Student created successfully !";
                break;
            case "406":
                $errors[] = "Failed to create the student. Please try again.";
        }
    }

    if(isset($_GET['upd'])){
        switch($_GET['upd']){
            case "202":
                $success[] = "Student updated successfully !";
                break;
            case "404":
                $errors[] = "Failed to update the student. Please try again.";
        }
    }
    require(view('students'));
}

function createStudent(){
    global $students_db;
    $errors = [];
    if($_SERVER['REQUEST_METHOD']==="GET"){
        require(view('create-student'));
        return;
    }
    if($_SERVER['REQUEST_METHOD']!=="POST"){
        header("Location:/");
        return;
    } 

    $newStud = validateStudent();
    if(!empty($newStud['errors'])){
        $errors = $newStud['errors'];
        require(view('create-student'));
        return;
    }
    
    
    $lastId = $students_db->create([
        "firstNameStud" => $newStud["firstname"],
        "lastNameStud" => $newStud["lastname"],
        "ageStud" => $newStud["age"],
        "cityStud" => $newStud["city"],
        "groupStud" => $newStud["group"],
    ]);
    if($lastId){
        $status = 202;
        move_uploaded_file(
            $_FILES['profile']['tmp_name'],
            __DIR__ . "/../private/uploads/students/student_id$lastId.png"
        );
    }else{
        $status = 406;
    }
    header("Location:/?cr=$status");
}

function deleteStudent(){
    global $students_db;
    if(!isset($_GET['id']) && !isset($_POST['id'])){
        header("Location:/");
    }else{
        $student_id = $_GET['id'] ?? $_POST['id'];
    }
    if($_SERVER['REQUEST_METHOD']=="GET"){
        require(view('delete-student'));
    }else if($_SERVER['REQUEST_METHOD']=="POST") {
        $status = $students_db->delete($student_id) ? 202 : 404;
        header("Location:/?del=$status");
    }else{
        header("Location:/");
    }
}

function updateStudent(){
    global $students_db;
    $pictures = "/picture-student?id=";
    $errors = [];
    if(!isset($_GET['id']) && !isset($_POST['id'])){
        header("Location:/");
    }

    $student_id = $_GET['id'] ?? $_POST['id'];
    $std =$students_db->get($student_id);
    require(view('update-student'));
    
    if($_SERVER['REQUEST_METHOD'] !== "POST") return;
    $updStud = validateStudent();
    $result = $students_db->update($student_id,[
        "ageStud" => $updStud["age"],
        "cityStud" => $updStud["city"],
        "groupStud" => $updStud["group"],
    ]);
    $status = $result ? 202 : 404;
    header("Location:/?upd=$status");
}

function picturesStudent(){
    //Check Autorization
    ///////////////////
    $path = __DIR__ . "/../private/uploads/students/default_profile.png";
    if(isset($_GET['id'])){
        $pic_id = $_GET['id'];
        $imgPath = __DIR__ . "/../private/uploads/students/student_id$pic_id.png";
        if(file_exists($imgPath)) $path = $imgPath;
    }
    header('Content-Type: image/png');
    readfile($path);
    exit;
}

function notFound(){
    require(view('not-found'));
}
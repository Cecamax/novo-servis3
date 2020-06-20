<?php
include "connection.php";
$db = new Database();
$connection = $db->getConnection();

$request_method = $_SERVER['REQUEST_METHOD'];

switch($request_method){
    case 'GET':
        if(!empty($_GET['id'])){
            $id = intval($_GET['id']);
            get_employers($id);
        }else{
            get_employers();
        }

    break;
    case 'POST':
        insert_employers();

    break;
    case 'PUT':
        $id = intval($_GET['id']);
        update_employers($id);

    break;
    case 'DELETE':
        $id = intval($_GET['id']);
        delete_employers($id);

    break;
    default:
        header("HTTP/1.0 405 Method Not Allowed");
    break;
}

function get_employers($id =0){
    global $connection;
    $query = 'SELECT * FROM employers';
    if ($id != 0){
        $query .= ' WHERE id= ' . $id . 'LIMIT 1';
    }
    $response = array();
    $result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result)){
        $response[] = $row;
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function insert_employers(){
    global $connection;
    $data = json_decode(file_get_contents('php://input'), true);
    $employers_name =$data['employers_name'];
    $employers_salary =$data['employers_salary'];
    $employers_age =$data ['employers_age'];
$query = "INSERT INTO employers SET name = '{employers_name}', salary = '{employers_salary}',
age = '{employers_age}'";

if(mysqli_query($connection, $query)){
    $response = array(
        'status' => 1,
        'status_message' => 'Employers Add Successfully'
    );
}else{
    $response = array(
        'status' =>2,
        'status_message' => 'Employers Addition Faild'
    );
}

header('Content-Type: application/json');
echo json_decode($response);
}



function update_employers($id){
    global $connection;
    $data = json_decode(file_get_contents('php://input'), true);
    $employers_name =$data['employers_name'];
    $employers_salary =$data['employers_salary'];
    $employers_age =$data ['employers_age'];
$query = "UPDATE employers SET name = '{employers_name}', salary = '{employers_salary}',
age = '{employers_age}' WHERE id = {$id}";

if(mysqli_query($connection, $query)){
    $response = array(
        'status' => 1,
        'status_message' => 'Employers Updated Successfully'
    );
}else{
    $response = array(
        'status' =>2,
        'status_message' => 'Employers Update Faild'
    );
}

header('Content-Type: application/json');
echo json_encode($response);
}

function delite_employers($id){
    global $connection;
    $query = "DELETE FROM employers WHERE id ={$id}";

    if (mysqli_query($connection, $query)){
    $response = array(
        'status' => 1,
        'status_message' => 'Employers Delited Successfully'
    );
}else{
    $response = array(
        'status' => 2,
        'status_message' => 'Employers Delited Faild'

    );
header('Content-Type: application/json');
echo json_encode($response);
}



?>
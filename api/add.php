<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
include("../backend/todoItem.php");

// start the session
session_start();


$response = [
    "result" => false,
    "message" => "",
    "todo-list" => null
];

$result = false;
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json_params = file_get_contents("php://input");
    $decoded_params = json_decode($json_params);
    $title = $decoded_params->title;

    $item = new todoItem($title);

    if (isset($_SESSION["todoList"]) && is_array($_SESSION["todoList"])){
        $todoList = $_SESSION["todoList"];
    } else {
        $todoList = array();
    }
    
    array_push($todoList, $item);
    $_SESSION["todoList"] = $todoList;

    $response["result"] = true;
    $response["message"] = "add item successful";
    $response["todo-list"] = $_SESSION["todoList"];

} else {
    $response["message"] = "unexptected http action - " . $_SERVER["REQUEST_METHOD"];
}

echo json_encode($response);
?>
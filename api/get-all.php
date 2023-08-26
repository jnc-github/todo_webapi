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
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_SESSION["todoList"]) && is_array($_SESSION["todoList"])){
        $response["result"] = true;
        $response["message"] = "get-all successful";
        $response["todo-list"] = $_SESSION["todoList"];
    } else {
        $response["message"] = "todo list does not exist";
    }
} else {
    $response["message"] = "unexptected http action - " . $_SERVER["REQUEST_METHOD"];
}

echo json_encode($response);
?>

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
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    $json_params = file_get_contents("php://input");
    $decoded_params = json_decode($json_params);
    $index = $decoded_params->index;
    $title = $decoded_params->title;
    $status = $decoded_params->status;

    if (isset($_SESSION["todoList"]) && is_array($_SESSION["todoList"])){
        if(array_key_exists($index, $_SESSION["todoList"])){
            $_SESSION["todoList"][$index]->title = $title;
            $_SESSION["todoList"][$index]->status = $status;
            $response["result"] = true;
            $response["message"] = "update one by id (" . $index . ") successful";
            $response["todo-list"] = $_SESSION["todoList"];
        } else {
            $response["message"] = "index " . $index. " does not exit";
        }
    } else {
        $response["message"] = "todo list does not exit";
    }

} else {
    $response["message"] = "unexptected http action - " . $_SERVER["REQUEST_METHOD"];
}

echo json_encode($response);
?>
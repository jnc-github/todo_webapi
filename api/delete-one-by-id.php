<?php include("../backend/todoItem.php");?>
<?php
// start the session
session_start();
?>

<?php
$response = [
    "result" => false,
    "message" => "",
    "todo-list" => null
];

$result = false;
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $json_params = file_get_contents("php://input");
    $decoded_params = json_decode($json_params);
    $index = $decoded_params->index;


    if (isset($_SESSION["todoList"]) && is_array($_SESSION["todoList"])){
        if(array_key_exists($index, $_SESSION["todoList"])){
            unset($_SESSION["todoList"][$index]);
            $response["result"] = true;
            $response["message"] = "delete one by id (" . $index . ") successful";
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
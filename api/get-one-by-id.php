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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json_params = file_get_contents("php://input");
    $decoded_params = json_decode($json_params);
    $index = $decoded_params->index;


    if (isset($_SESSION["todoList"]) && is_array($_SESSION["todoList"])){
        if(array_key_exists($index, $_SESSION["todoList"])){
            $response["result"] = true;
            $response["message"] = "get one by id (" . $index . ") successful";
            $response["todo-list"] = [
                $index => $_SESSION["todoList"][$index]
            ];
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
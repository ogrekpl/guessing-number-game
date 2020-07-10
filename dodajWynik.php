<?php
include_once "Database.php";

$query = "INSERT INTO scores SET name=:nazwa, wynik=:wynik";
$handler = new Database();
$db = $handler->GetConnection();
$stmt = $db->prepare($query);
$stmt->bindParam(":nazwa", $_POST['name']);
$stmt->bindParam(":wynik", intval($_POST['score']));
$truth = $stmt->execute();

echo json_encode(array("success"=>2));

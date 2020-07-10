<?php
include_once "Database.php";
$site =
    '<h2>Zgadywanie liczb</h2>
        <br>
        Podaj nazwę gracza:&nbsp
        <input type="text" id="playerName">
        <br>
        <br>
        <br>
        <button id="startGame" class="btn btn-success btn-lg" onclick="BeginGame()">Rozpocznij grę</button>
        <br>
        <br>';

echo $site;

$query = "SELECT * FROM scores ORDER BY wynik desc limit 3";
$dataBase = new Database();
$db = $dataBase->GetConnection();
$stmt = $db->prepare($query);
$stmt->execute();

echo "<h2>Najlepsza trójka!</h2>";

while($row = $stmt->fetch(PDO::FETCH_ASSOC))
{
    echo "<hr/>";
    echo "<center>";
    echo "<table>";
    echo "<tr>";
    echo "<td>";
    echo "Nazwa gracza:&nbsp&nbsp&nbsp&nbsp";
    echo "</td>";
    echo "<td>";
    echo "<b>";
    echo $row['name'];
    echo "<b>";
    echo "</td>";
    echo "</tr>";

    echo "<tr>";
    echo "<td>";
    echo "Wynik:&nbsp&nbsp&nbsp&nbsp";
    echo "</td>";
    echo "<td>";
    echo "<b>";
    echo $row['wynik'];
    echo "<b>";
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    echo "</center>";
}
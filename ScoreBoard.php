<?php
include_once "Database.php";

$site =
    '
    <h4>Twój wynik to:</h4>
    <br>
    <br>
    <div id="scoreBoardPlayer">
    </div>
    <br>
    <br>';

echo $site;

    $query = "SELECT * FROM scores ORDER BY wynik desc limit 10";
    $dataBase = new Database();
    $db = $dataBase->GetConnection();
    $stmt = $db->prepare($query);
    $stmt->execute();

    echo "<h2>Najlepsze wyniki</h2>";

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

echo "</br>";
echo "</br>";
echo "</br>";

echo "<button onclick='LoadMainSite()' class='btn btn-primary btn-lg'>Jeszcze raz!</button>";
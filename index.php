<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="index.css">
    <title>Exo complet lecture SQL.</title>
</head>
<body>

<?php

require "./Classes/DB.php";
$conn = DB::getInstance();

$clients = $conn->prepare("SELECT firstName, lastName FROM exo_197.clients");
$clients->execute();

echo "<div id='client'>";
echo "<p class='sousTitre'>Les clients</p>";
foreach ($clients->fetchAll() as $client) {
    echo "<p>".$client["firstName"] . ", ". $client["lastName"] . "</p>";
}
echo "</div>";

$showType = $conn->prepare("SELECT type FROM exo_197.showtypes");
$showType->execute();

echo "<div id='type'>";
echo "<p class='sousTitre'>Les different type de spectacle</p>";
foreach ($showType->fetchAll() as $type){
    echo "<p>".$type["type"]."</p>";
}
echo "</div>";

$clients = $conn->prepare("SELECT firstName, lastName FROM exo_197.clients LIMIT 20");
$clients->execute();

echo "<div id='client20'>";
echo "<p class='sousTitre'>Les 20 premier clients</p>";
foreach ($clients->fetchAll() as $client) {
    echo "<p>".$client["firstName"] . ", ". $client["lastName"] . "</p>";
}
echo "</div>";

$clientsF = $conn->prepare("SELECT firstName, lastName FROM exo_197.clients WHERE card = 1");
$clientsF->execute();

echo "<div id='clientF'>";
echo "<p class='sousTitre'>Les clients avec une carte de fidelité </p>";
foreach ($clientsF->fetchAll() as $clientF) {
    echo "<p>".$clientF["firstName"] . ", ". $clientF["lastName"] . "</p>";
}
echo "</div>";

$clientsM = $conn->prepare("SELECT firstName, lastName FROM exo_197.clients WHERE lastName LIKE 'M%' ORDER BY lastName ASC");
$clientsM->execute();

echo "<div id='clientM'>";
echo "<p class='sousTitre'>Les clients avec une carte de fidelité</p>";
foreach ($clientsM->fetchAll() as $clientM) {
    echo "<p><span>Nom: </span>".$clientM["lastName"] . "<br><span>Prénom: </span>" . $clientM["firstName"] . "</p>";
}
echo "</div>";
$spectacle = $conn->prepare("SELECT * FROM exo_197.shows");
$spectacle->execute();

echo "<div id='spectacle'>";
echo "<p class='sousTitre'>Les spectacles</p>";
foreach ($spectacle->fetchAll() as $info){
    echo "<p>".$info["title"]." par ".$info["performer"].", le ".$info["date"]." à ".$info["startTime"]."</p>";
}
echo "</div>";

$clients = $conn->prepare("SELECT * FROM exo_197.clients");
$clients->execute();

echo "<div id='clientPLUS'>";
echo "<p class='sousTitre'>Les clients AVEC PLUS D'INFO</p>";
foreach ($clients->fetchAll() as $client) {
    echo "<div class='border'>";
    echo "<p><span>Nom: </span>".$client["lastName"]."</p>";
    echo "<p><span>Prénom: </span>".$client["firstName"]."</p>";
    echo "<p><span>Date de naissance: </span>".$client["birthDate"]."</p>";

    if ($client["card"] == 1){
        echo "<p><span>Carte de fidélité: </span>Oui</p>";
        echo "<p><span>Numero de carte: </span>".$client["cardNumber"]."</p>";
    }
    else{
        echo "<p><span>Carte de fidélité: </span>Non</p>";
    }

    echo "</div>";
}
echo "</div>";

?>
</body>
</html>

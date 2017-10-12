<?php

require_once("includes/database.php");
$theTeam = filter_input(INPUT_POST, "team_id");
$thePlayer = filter_input(INPUT_POST, "player_id");



if ($theTeam == NULL || $thePlayer == NULL) {
    include("index.php");
    exit();
} else {
    $query = "DELETE FROM players where playerID = :player_id";
    $statement1 = $db->prepare($query);
    $statement1->bindValue(':player_id', $thePlayer);
    $statement1->execute();   // no fetch as no results back
    $statement1->closeCursor();
    include("index.php");
    exit();
}
   
<?php

require_once("includes/database.php");
$theTeam = filter_input(INPUT_POST, "team_id");
$thePlayer = filter_input(INPUT_POST, "player_id");

if ($theTeam == NULL) {
    include("index.php");
    exit();
} else {
    //$query = "delete from players where teamID = :player_id";
    //$statement = $db->prepare($query);
    //$statement->bindValue(':player_id', $thePlayer);
    //$statement->execute();   // no fetch as no results back
    //$statement->closeCursor();


    $query2 = "DELETE FROM team where teamID = :team_id";
    $statement1 = $db->prepare($query2);
    $statement1->bindValue(':team_id', $theTeam);
    $statement1->execute();   // no fetch as no results back
    $statement1->closeCursor();

    include("index.php");
    exit();
}
include("index.php");
exit();

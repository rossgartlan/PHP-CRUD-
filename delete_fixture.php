<?php

require_once("includes/database.php");
$theTeam = filter_input(INPUT_POST, "team_id");
$theFixture = filter_input(INPUT_POST, "fixture_id");



if ($theFixture== NULL) {
    include("index.php");
    exit();
} else {
    $query = "DELETE FROM fixtures where fixtureID = :fixture_id";
    $statement1 = $db->prepare($query);
    $statement1->bindValue(':fixture_id', $theFixture);
    $statement1->execute();   // no fetch as no results back
    $statement1->closeCursor();
    include("index.php");
    exit();
}
   
<?php
require_once 'includes/database.php';
$fixId = filter_input(INPUT_POST,"fixture_id",FILTER_VALIDATE_INT);
$teamId = filter_input(INPUT_POST,"team_id",FILTER_VALIDATE_INT);
$opID = filter_input(INPUT_POST,"opposition_id",FILTER_VALIDATE_INT);
$opName = filter_input(INPUT_POST, "opposition_name",FILTER_SANITIZE_STRING);
$homeAway = filter_input(INPUT_POST, "home_away",FILTER_SANITIZE_STRING);
$theDate = filter_input(INPUT_POST, "date");


if($fixId == NULL || $opID  == NULL || $opName == NULL || $homeAway  == NULL || $theDate == NULL )
{
$error = "Please enter valid data";
include("update_fixtures_form.php");
exit();
}

$query ="UPDATE fixtures SET teamID = :team_id, oppostion = :opposition_name, home = :home_away, date = :date, oppositionID = :opposition_id where fixtureID = :fixture_id";

$statement =$db->prepare($query);
$statement->bindValue(":team_id",$teamId);
$statement->bindValue(":opposition_name",$opName);
$statement->bindValue(":home_away",$homeAway);
$statement->bindValue(":date",$theDate);
$statement->bindValue(":opposition_id",$opID);
$statement->bindValue(":fixture_id",$fixId);
$statement->execute();
$statement->closeCursor();
include ("admin.php");
exit();

?>

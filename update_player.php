<?php
require_once 'includes/database.php';
$playerID = filter_input(INPUT_POST,"player_id",FILTER_VALIDATE_INT);
$thePlayerName = filter_input(INPUT_POST, "player_name",FILTER_SANITIZE_STRING);
$thePositionTeam = filter_input(INPUT_POST, "position",FILTER_SANITIZE_STRING);
$thePos = filter_input(INPUT_POST, "pos",FILTER_SANITIZE_STRING);
$theTeamID = filter_input(INPUT_POST, "team_id",FILTER_VALIDATE_INT);
$theDOB = filter_input(INPUT_POST, "d_o_b",FILTER_SANITIZE_STRING);
$theHeight = filter_input(INPUT_POST, "height",FILTER_SANITIZE_STRING);
$theWeight= filter_input(INPUT_POST, "weight",FILTER_VALIDATE_FLOAT);
$theClub = filter_input(INPUT_POST, "club",FILTER_SANITIZE_STRING);

if($thePlayerName == NULL || $thePositionTeam == NULL || $thePos  == NULL || $theTeamID == NULL ||$theDOB == NULL || $theHeight== NULL || $theWeight == NULL || $theClub == NULL)
{
$error = "Please enter valid data";
include("update_player_form.php");
exit();
}

$query ="UPDATE players SET playerName = :player_name, positionTeam=:position, pos=:pos, teamID = :team_id, dob = :d_o_b, height = :height , weight = :weight, club = :club where playerID = :player_id";

$statement =$db->prepare($query);
$statement->bindValue(":player_name",$thePlayerName);
$statement->bindValue(":position",$thePositionTeam);
$statement->bindValue(":pos",$thePos);
$statement->bindValue(":team_id",$theTeamID);
$statement->bindValue(":d_o_b",$theDOB);
$statement->bindValue(":weight",$theWeight);
$statement->bindValue(":height",$theHeight);
$statement->bindValue(":club",$theClub);
$statement->bindValue(":player_id",$playerID);
$statement->execute();
$statement->closeCursor();
include ("admin.php");
exit();

?>
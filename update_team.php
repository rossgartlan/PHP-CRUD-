<?php
require_once 'includes/database.php';
//require_once 'includes/authorisation.php';

$teamID = filter_input(INPUT_POST,"team_id",FILTER_VALIDATE_INT);
$teamName = filter_input(INPUT_POST,"team");
$world = filter_input(INPUT_POST, "world",FILTER_SANITIZE_STRING);
$manager = filter_input(INPUT_POST, "manager",FILTER_SANITIZE_STRING);


if($teamID == NULL || $teamName == NULL || $world == NULL || $manager  == NULL || $manager==null)
{
$error = "Please enter valid data";
include("update_team_form.php");
exit();
}

$query ="UPDATE team SET teamName = :team, worldRank = :world, manager = :manager where teamID = :team_id";

$statement =$db->prepare($query);
$statement->bindValue(":team_id",$teamID);
$statement->bindValue(":team",$teamName);
$statement->bindValue(":world",$world);
$statement->bindValue(":manager",$manager);

$statement->execute();
$statement->closeCursor();
include ("admin.php");
exit();

?>
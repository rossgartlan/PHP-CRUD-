<?php
require_once("includes/database.php");
//require_once("includes/authorisation.php");
$theTeamName = filter_input(INPUT_POST, "team_name",FILTER_SANITIZE_STRING);
$theWorldRank = filter_input(INPUT_POST, "world_rank",FILTER_VALIDATE_INT);
$theManager = filter_input(INPUT_POST, "manager_team",FILTER_SANITIZE_STRING);


if($theTeamName  == NULL || $theWorldRank == NULL || $theManager  == NULL)
{
include("add_team_form.php");
exit();
}

else{

$query = "INSERT INTO team (teamName, worldRank, manager) VALUES (:team_name, :world_rank, :manager_team)";
$statement1 = $db->prepare($query);
$statement1->bindValue(':team_name', $theTeamName );
$statement1->bindValue(':world_rank', $theWorldRank );
$statement1->bindValue(':manager_team', $theManager);
// using where clause
$statement1->execute();   // no fetch as no results back
$statement1->closeCursor();
include("admin.php");
exit();
}
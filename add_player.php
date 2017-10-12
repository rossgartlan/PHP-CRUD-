<?php
require_once("includes/database.php");
$thePlayerName = filter_input(INPUT_POST, "player_name", FILTER_SANITIZE_STRING);
$thePositionTeam = filter_input(INPUT_POST, "position_team", FILTER_SANITIZE_STRING);
$thePos = filter_input(INPUT_POST, "pos_t", FILTER_SANITIZE_STRING);
$theTeamID = filter_input(INPUT_POST, "team_id", FILTER_VALIDATE_INT);
$theDOB = filter_input(INPUT_POST, "d_o_b", FILTER_SANITIZE_STRING);
$theHeight = filter_input(INPUT_POST, "height_player", FILTER_VALIDATE_INT);
$theWeight = filter_input(INPUT_POST, "weight_player", FILTER_VALIDATE_FLOAT);
$theClub = filter_input(INPUT_POST, "club_player", FILTER_SANITIZE_STRING);
$theImage = filter_input(INPUT_POST, "image");


//if (isset($theImage['image']) && $theImage['image']['size'] > 0) {
//    
//    $tmpName = $_FILES['image']['tmp_name'];
//    $fp = fopen($tmpName, 'rb');
//    
// 
//}
//
//try {
//    
//    $query = "INSERT INTO players (pic) VALUES (:fp)";
//    $statement = $db->prepare($query);
//    $statement->bindParam(1, $fp, PDO::PARAM_LOB);
//    $statement->execute();
//    $statement->closeCursor();
//    
//} catch (PDOException $e) {
//    
//    'Error : ' . $e->getMessage();
//}


if ($thePlayerName == NULL || $thePositionTeam == NULL || $thePos == NULL || $theTeamID == NULL || $theDOB == NULL || $theHeight == NULL || $theWeight == NULL || $theClub == NULL) {
    include("add_player_form.php");
    exit();
} else {

    $query = "INSERT INTO players (playerName, positionTeam, pos, teamID, dob, height, weight, club) VALUES (:thePlayerName , :thePositionTeam, :thePos, :theTeamID, :theDOB, :theHeight, :theWeight, :theClub)";
    $statement1 = $db->prepare($query);
    $statement1->bindValue(':thePlayerName', $thePlayerName);
    $statement1->bindValue(':thePositionTeam', $thePositionTeam);
    $statement1->bindValue(':thePos', $thePos);
    $statement1->bindValue(':theTeamID', $theTeamID);
    $statement1->bindValue(':theDOB', $theDOB);
    $statement1->bindValue(':theHeight', $theHeight);
    $statement1->bindValue(':theWeight', $theWeight);
    $statement1->bindValue(':theClub', $theClub); // using where clause
    $statement1->execute();   // no fetch as no results back
    $statement1->closeCursor();
    include("admin.php");
    exit();
}
?>
<br/>
<link href="css/common.css" rel="stylesheet" type="text/css"/>
<input type="button" onclick="window.location.href = 'index.php'" value ="home"/>
<br/>

</body>
</html>
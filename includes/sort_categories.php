<?php
require_once("database.php");

$query = 'SELECT * FROM team ORDER BY teamName desc';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();

$result = "";
foreach($categories as $category) :
$result .=   '<li><a href=".?team_id=' . $category["teamID"] . '">' . $category["teamName"] . '</a></li>';
endforeach;

echo $result;
//echo "123";
//echo "123";
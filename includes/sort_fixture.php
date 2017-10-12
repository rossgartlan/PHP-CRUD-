<?php
require_once("database.php");

$query = 'SELECT date,oppostion FROM fixtures ORDER BY ABS( DATEDIFF(date,NOW()))LIMIT 1';
$statement = $db->prepare($query);
$statement->execute();
$fixtures = $statement->fetchAll();
$statement->closeCursor();

$result = "";
foreach($fixtures as $fixture) :
$result .=   '<li><a href=".?fixture_id=' . $fixture["oppostion"] . '">' . $fixture["date"] . '</a></li>';
endforeach;

echo $result;
//echo "123";
//echo "123";
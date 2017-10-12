<?php

//require_once 'includes/authorisation.php';
// get all categories to populate the <select> list
require_once 'includes/database.php';
$query = 'Select * FROM team ORDER BY teamID';
$statement = $db->prepare($query);
$statement->execute();
$teams = $statement->fetchAll();
$statement->closeCursor();

$team_id = filter_input(INPUT_POST, "team_id");
$player_id = filter_input(INPUT_POST, "player_id");


if ($team_id == null || $player_id == null) {
    $error = "please enter valid data";
    include"index.php";
    exit();
}

$queryPlayer = "select * from players where playerID = :player_id";
$statement2 = $db->prepare($queryPlayer);
$statement2->bindValue(":player_id", $player_id);
$statement2->execute();
$player = $statement2->fetch();
$statement2->closeCursor();
?>
<html>
    <head>
        <link href="css/common.css" rel="stylesheet" type="text/css"/>
        <link href="css/addplayer.css" rel="stylesheet" type="text/css"/>
        <link href="css/mainpage.css" rel="stylesheet" type="text/css"/>
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    </head>
    <style>
        body
        {
            background-image: url("images/download (1).png");

        }
    </style>
    <body>
        <div class ="social">
            <img id = "mask" src = "images/collagerugby.jpg">
        </div>

        <main>
            <div class="social">
                <a href="https://twitter.com/IrishRugby?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><i id="twitter" class="icon-twitter"></i></a>
                <i id="code" class="icon-code"></i>
                <i id="plus" class="icon-google-plus-sign"></i>
                <i id="mail" class="icon-envelope"></i> 
            </div>
            <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

            <script src="js/index.js"></script>

            <nav id="nav-1">
                <a class="link-1" href="index.php">Home</a>
                <a class="link-1" href="#">About</a>
                <a class="link-1" href="#">Contact</a>
                <a class="link-1" href="register.php">Register/Login</a>
            </nav>

            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>

            <table>
                <tr>
                    <th> <header><h1>Update Player</h1></header></th>
                <section></section>
                <form action ="update_player.php" method ="post" id="update_player">
                    <input type="hidden" name="player_id" value="<?php echo $player_id; ?>"/>



                    <th> <label>Player Name</label>
                        <input type ="text" pattern="[a-zA-Z]+[ ][a-zA-Z]+" name="player_name" value="<?php echo htmlspecialchars($player["playerName"],ENT_QUOTES); ?>"/><br></th>
                    <th><label>Position Team</label>
                        <input type ="text" name="position"value="<?php echo htmlspecialchars($player["positionTeam"],ENT_QUOTES); ?>"/><br></th>
                    <th> <label>Back/Forward</label>
                        <input type ="text" name="pos"value="<?php echo htmlspecialchars($player["pos"],ENT_QUOTES); ?>"/><br>
                    <th> <label>Team ID</label>
                        <input type ="text" name="team_id" pattern="^[0-9]{1,3}$" value="<?php echo htmlspecialchars($player["teamID"],ENT_QUOTES); ?>"/><br></th>
                    <th> <label>D.O.B</label>
                        <input type ="text" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" name="d_o_b"value="<?php echo htmlspecialchars($player["dob"],ENT_QUOTES); ?>"/><br></th>
                    <th> <label>Height</label>
                        <input type ="text" pattern="^[0-9]{1,3}$" name="height"value="<?php echo htmlspecialchars($player["height"],ENT_QUOTES); ?>"/><br></th>
                    <th> <label>Weight</label>
                        <input type ="text" pattern= "^[1-9]\d*(\.\d+)?$" name="weight"value="<?php echo htmlspecialchars($player["weight"],ENT_QUOTES); ?>"/><br></th>
                    <th> <label>Club</label>
                        <input type ="text" name="club" value="<?php echo htmlspecialchars($player["club"],ENT_QUOTES); ?>"/><br></th>
                    <th> <button type="update">
                            <img src="" alt=""/> 
                            <img src="images/button_update.png" alt=""/>
                        </button></th>
                </form>
                </tr>
            </table>
          

        </section>



    </main>
</body>
<footer><?php require_once("includes/footer.php"); ?></footer>
</html>
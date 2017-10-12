<?php
require_once 'includes/database.php';
//require_once 'includes/authorisation.php';

//$tmpName  = $_FILES['image']['tmp_name'];  
//$fp = fopen($tmpName, 'rb');
////$fb = base64_encode($fb);
//$query1 = "INSERT INTO players (pic) VALUES (:fp)";
//$statement1 = $db->prepare($query1);
//$statement1->bindParam(1, $fp, PDO::PARAM_LOB);
//$statement1->execute();
//$statement1->closeCursor();

$query = 'Select * FROM team ORDER BY teamID';
$statement = $db->prepare($query);
$statement->execute();
$teams = $statement->fetchAll();
$statement->closeCursor();
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
                <a href="http://twitter.com/bphillips201"><i id="twitter" class="icon-twitter"></i></a>
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
                <a class="link-1" href="register.php">Login/Register</a>
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
                    <th> <header><h1>Player Manager</h1></header></th>
            <section>
                <form action ="add_player.php" method ="post" id="add_player_form">
                    <th>  <label>Team</label>
                   <select name="team_id">  
                        <?php foreach ($teams as $team) : ?>
                            <option value="<?php echo $team["teamID"]; ?>">
                                <?php echo $team["teamName"]; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    </th><br>
                     
                    <th> <label>Player Name</label>
                    <input autofocus pattern="[a-zA-Z]+[ ][a-zA-Z]+" required placeholder="E.g John Doe" type ="text" name="player_name"/><br></th>
                    <th><label>Position Team</label>
                    <input type ="text" required placeholder="Fly Half/ Out Half etc."name="position_team"/><br></th>
                    <th><label>Back/Forward</label>
                    <input type ="text" required placeholder="Back/forward" name="pos_t"/><br></th>
                    <th><label>Date of birth</label>
                    <input type ="text" name="d_o_b" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])"required placeholder="yyyy-mm-dd"/><br></th>
                    <th><label>Height</label>
                    <input type ="text" name="height_player" pattern="^[0-9]{1,3}$" maxlength="3" required placeholder="Height in cms"/><br></th>
                    <th><label>Weight Kg</label>
                    <input type ="text" name="weight_player" pattern= "^[1-9]\d*(\.\d+)?$" required placeholder="Weight in Kgs"/><br></th>
                    <th><label>Club</label>
                    <input type ="text"  name="club_player"/><br>
                    <th><label>Choose Photo</label>
                        <input type="file" name="image" class="upload" type="submit" value="Upload" method="post"/>
                    </th>
                    <th><button type="update">
                            <img src="" alt=""/> 
                            <img src="images/button_add-player.png" alt=""/>
                        </button></th></th>
                </form>
                </tr>
                </table>
                <a href="index.php">View Players</a>
                <br>
                <a href="index.php">View Players List</a>
              
            </section>



        </main>
    </body>
    <footer><footer><?php require_once("includes/footer.php"); ?></footer></footer>
</html>

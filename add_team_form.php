<?php
require_once 'includes/database.php';
//require_once 'includes/authorisation.php';

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
                <a class="link-1" href="register.php">Shop</a>
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
                    <th> <header><h1>Team Manager</h1></header></th>
            <section>
                <form action ="add_team.php" method ="post" id="add_team_form">
                    
                    
                    </th><br>
                    
                     
                    <th> <label>Team Name</label></th>
                    <th><input autofocus  required  type ="text" name="team_name"/><br></th>
                    <th><label>World Rank</label></th>
                    <th><input type ="text" pattern="^[0-9]{1,2}$" name="world_rank"/><br></th>
                    <th><label>Manager</label></th>
                    <th><input type ="text" pattern="[a-zA-Z]+[ ][a-zA-Z]+"  name="manager_team"/><br></th>
                    
                    <th><input type="submit" value="Add Team"/></th>
                </form>
                </tr>
                </table>
                
              
            </section>



        </main>
    </body>
    <footer><footer><?php require_once("includes/footer.php"); ?></footer></footer>
</html>
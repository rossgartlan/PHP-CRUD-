<?php
// get all categories to populate the <select> list
require_once 'includes/database.php';
//require_once 'includes/authorisation.php';

//if(isset($_SESSION['usertype'])==0)
//{
//    header("Location: index.php");
//}
 

$query = 'Select * FROM team ORDER BY teamID';
$statement =$db->prepare($query);
$statement->execute();
$teams = $statement->fetchAll();
$statement->closeCursor();

$team_id = filter_input(INPUT_POST,"team_id",FILTER_VALIDATE_INT);

//  query get one product by product id(to populate the form)

if($team_id ==null)
{
    $error = "please enter valid data";
    include"index.php";
    exit();
}

$queryPlayer = "select * from team where teamID = :team_id";
$statement2 = $db->prepare($queryPlayer);
$statement2->bindValue(":team_id",$team_id);
$statement2->execute();
$team = $statement2->fetch();
$statement2-> closeCursor();
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
                    <th> <header><h1>Update Team</h1></header></th>
                <section></section>
                <form action ="update_team.php" method ="post" id="update_player">
                    <input type="hidden" name="team_id" value="<?php echo $team_id;?>"/>
                    <th><label>Team</label></th>
                    
                    
                  
                    <th> <label>Team Name</label>
                    <input type ="text" pattern="[a-zA-Z]+[ ][a-zA-Z]+" name="team" value="<?php echo htmlspecialchars($team["teamName"],ENT_QUOTES);?>"/><br></th>
                    <th><label>World Rank</label>
                      <input type ="text" name="world"value="<?php echo htmlspecialchars($team["worldRank"],ENT_QUOTES);?>"/><br></th>
                    <th> <label>Manager</label>
                     <input type ="text" name="manager"value="<?php echo htmlspecialchars($team["manager"],ENT_QUOTES);?>"/><br>
                    
                    <th> <input type="submit" value="Update Team"/>
                </form>
                </tr>
                </table>
                
                
            </section>
            
            
            
        </main>
    </body>
    <footer><?php require_once("includes/footer.php"); ?></footer>
</html>
<?php
// get all categories to populate the <select> list
require_once 'includes/database.php';
//require_once 'includes/authorisation.php';


$team_id = filter_input(INPUT_POST, "team_id");
$fixture_id = filter_input(INPUT_POST, "fixture_id");


if ($team_id == null || $fixture_id == null) {
    $error = "please enter valid data";
    include"index.php";
    exit();
}

$queryFixture = "select * from fixtures where fixtureID = :fixture_id";
$statement2 = $db->prepare($queryFixture);
$statement2->bindValue(":fixture_id", $fixture_id);
$statement2->execute();
$fixture = $statement2->fetch();
$statement2->closeCursor();

//print_r("<pre>");
//print_r($fixture);  //for trouble shooting showing results are correct
//print_r("<pre>");
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
                    <th> <header><h1>Update Fixtures</h1></header></th>
                <section></section>
                <form action ="update_fixture.php" method ="post" id="update_fixture">
                    <input type="hidden" name="fixture_id" value="<?php echo $fixture_id; ?>"/>
                    <input type="hidden" name="team_id" value="<?php echo $team_id; ?>"/>
                    <th><label>Fixture</label></th>
                    
                                                                                        
                    <th> <label>Opposition</label>                           
                        <input type ="text"  name="opposition_name" value="<?php echo htmlspecialchars($fixture["oppostion"],ENT_QUOTES); ?>"/><br></th>
                    <th><label>Home/Away</label>                  
                        <input type ="text" name="home_away"value="<?php echo htmlspecialchars($fixture["home"],ENT_QUOTES); ?>"/><br></th>
                    <th> <label>Date</label>             
                        <input type ="text" name="date" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" value="<?php echo $fixture["date"]; ?>"/><br>
                    <th> <label>Opposition ID</label>
                        <select>
                            <option value="1">1 = New Zealand</option>
                            <option value="2">2 = England</option>
                            <option value="3">3 = Wales</option>
                            <option value="4">4 = Scotland</option>
                            <option value="5">6 = Italy</option>
                            <option value="6">7 = France</option>

                            <input type ="text" pattern="^[0-9]{1,3}$" name="opposition_id" value="<?php echo htmlspecialchars($fixture["oppositionID"],ENT_QUOTES); ?>"/><br></th>
                        </select>
                    <th> <input type="submit" value="Update fixture"/></th>
                </form>
                </tr>
            </table>
            <a href="index.php">View Fixtures</a>


        </section>



    </main>
</body>
<footer><?php require_once("includes/footer.php"); ?></footer>
</html>
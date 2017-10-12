<?php 

require_once("includes/database.php");
//require_once("includes/authorisation.php");
session_start();
echo ($_SESSION['usertype']);
if(isset($_SESSION['usertype'])=='0')
{
    header('Location: index.php');
}



$query = 'SELECT * FROM team ORDER BY teamID';
$statement = $db->prepare($query);  //setting up statement
$statement->execute();                //executing statement results stored in statemntes variable
$teams = $statement->fetchALL();   // expecting mutiple 3d array values use fetch all
$statement->closeCursor();

if (!isset($team_id)) {
    $team_id = filter_input(INPUT_GET, 'team_id', FILTER_VALIDATE_INT);
    if ($team_id == NULL || $team_id == false) {
        $team_id = 2;   // settign default cat idea
    }
}
$queryTeams = "Select * FROM team WHERE teamID = :team_id";
$statement1 = $db->prepare($queryTeams);
$statement1->bindValue(":team_id", $team_id);
$statement1->execute();
$teams2 = $statement1->fetchAll();  //array of players fetching all
$statement1->closeCursor();

$queryPlayers = "Select * FROM players WHERE teamID = :team_id";
$statement2 = $db->prepare($queryPlayers);
$statement2->bindValue(":team_id", $team_id);
$statement2->execute();
$players = $statement2->fetchAll();  //array of players fetching all
$statement2->closeCursor();

$queryFixtures = "Select * FROM fixtures WHERE teamID = :team_id";
$statement3 = $db->prepare($queryFixtures);
$statement3->bindValue(":team_id", $team_id);
$statement3->execute();
$fixtures = $statement3->fetchAll();  //array of fixturesfetching all
$statement3->closeCursor();

$queryAge = "SELECT AVG(TIMESTAMPDIFF(YEAR, DOB, CURDATE())) AS `Average` FROM players WHERE teamID = :team_id";
$statement4 = $db->prepare($queryAge);
$statement4->bindValue(":team_id", $team_id);
$statement4->execute();
$age = $statement4->fetch();  //array of fixturesfetching all
$statement4->closeCursor();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <link href="../login/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="css/mainpage.css">
        <link href="css/common.css" rel="stylesheet" type="text/css"/>
        <link href="jquery/new.js"/>
        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script language="JavaScript" type="text/javascript">
            $(document).ready(function () {
                $("a.delete").click(function (e) {
                    if (!confirm('Are you sure?')) {
                        e.preventDefault();
                        return false;
                    }
                    return true;
                });
            });
        </script>
        <script language="JavaScript" type="text/javascript">
            $(document).ready(function () {
                $("a.deletet").click(function (e) {
                    if (!confirm('Deleting a team will delete all players and fixtures from that team, Are you sure you want to proceed?')) {
                        e.preventDefault();
                        return false;
                    }
                    return true;
                });
            });
        </script>
    </head>
    <style>
        body
        {
            background-image: url("images/download (1).png");

        }
    </style>
    <body>

        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right" >
                <?php if (isset($_SESSION['id'])) { ?>
                    <li><p class="navbar-text">Signed in as <?php echo $_SESSION['email']; ?></p></li>
                    <li><a href="logout.php">Log Out</a></li>
                <?php } else { ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Sign Up</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>


<div class ="social">
    <img id = "mask" src = "images/collagerugby.jpg">
</div>

<div class="social">
    <a href="https://twitter.com/IrishRugby?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><i id="twitter" class="icon-twitter"></i></a>
    <i id="code" class="icon-code"></i>
    <i id="plus" class="icon-google-plus-sign"></i>
    <i id="mail" class="icon-envelope"></i> 
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="JS/new.js" type="text/javascript"></script>
<script src="JS/index.js" type="text/javascript"></script>

<nav id="nav-1">

    <a class="link-1" href="index.php">Home</a>
    <a class="link-1" href="#">About</a>
    <a class="link-1" a href="#chapter4">Fixtures</a>
    <a class="link-1" href="register.php">Login/Register</a>
</nav>


<main>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>




    <table id="table">
        <?php foreach ($teams as $team) : ?> <!-- multi dimensional array to one dimensional array can access variables now -->
        <td><a href = "admin.php.?team_id=<?php echo $team['teamID']; ?>"> 
                    <?php echo $team['teamName'];
                    ?>       
                </a></td>

        <?php endforeach; ?>
    </table>
    <br>






    <aside>
        <!--list all categories-->


        <td> <a href="add_team.php"><img src="images/button_add-team (1).png" alt=""/></a></td>
        <table id="table"><!-- multi dimensional array to one dimensional array can access -->

            <tr>
                <th>Team</th>     <!-- rows once outside the loop -->
                <th>World Rank</th>
                <th>Coach</th>                     
                <th>Average Weight</th>
                <th>Average Height</th>
                <th>Average Age</th>
                <th>Update</th>
                <th>Delete</th>
            <ul>
                <?php foreach ($teams2 as $team2) : ?>
                    </tr>
                    <!-- multi dimensional array to one dimensional array can access variables now -->
                    <td>
                        <?php echo $team2['teamName'];
                        ?>   </td>    

                    </td>
                    <td><?php echo $team2['worldRank']; ?></td> 
                    <td><?php echo $team2['manager']; ?></td>


                    <td>
                        <?php
                        $sum = 0;
                        $total = 0;
                        foreach ($players as $key => $value) {
                            $sum+= $value["weight"];
                            $total = $sum / count($players);
                        }
                        $total_f = number_format($total, 1);
                        echo $total_f;
                        ;
                        ?>
                        Kgs  
                    </td>
                    <td>
                        <?php
                        $sumHeight = 0;
                        $totalh = 0;
                        foreach ($players as $key => $value) {
                            $sumHeight+= $value["height"];
                            $totalh = $sumHeight / count($players);
                        }
                        $totalh_f = number_format($totalh, 1);
                        echo $totalh_f;
                        ;
                        ?>
                        Cms  
                    </td>
                    <td>
                        <?php
                        $tot = $age["Average"];
                        echo round($tot);
                        ?>

                    </td>
                    <td>
                        <form action="update_team_form.php" method="POST">
                            <input type="hidden" name="team_id" value ="<?php echo $team["teamID"]; ?>"/>
                            <button type="update">
                                <img src="" alt=""/> 
                                <img src="images/button_update.png" alt=""/>
                            </button>
                        </form>
                    </td>
                    <td>
                        <form action="delete_team.php" method ="POST">
                            <input type="hidden" name="team_id" value ="<?php echo $team["teamID"]; ?>"/>
                            <input type="hidden" name="player_id" value ="<?php echo $player["teamID"]; ?>"/>
                            <button type="delete">
                                <a href="deletelink" class="deletet"><img src="images/button_delete (2).png"  </a>
                            </button>
                        </form>
                    </td>

                <?php endforeach; ?>

            </ul>

            </table>




                </aside>
                <section id ="section">



                    <table id="table">
                        <tr>
                            <th>Name</th>     <!-- rows once outside the loop -->
                            <th>Position</th>
                            <th>Back/Forward</th>
                            <th>D.O.B</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>Club</th>
                            <th></th>
                            <th></th>
                            <th>Update</th>
                            <th>Delete</th>

                        </tr>
                        <?php foreach ($players as $player) : ?>
                            <tr>     
                                <td><?php echo $player['playerName']; ?></td> 
                                <td><?php echo $player['positionTeam']; ?></td>
                                <td><?php echo $player['pos']; ?></td>
                                <td><?php echo $player['dob']; ?></td>
                                <td><?php echo $player['height']; ?></td>
                                <td><?php echo $player['weight']; ?> Kgs</td>
                                <td><?php echo $player['club']; ?></td>
                                <td>  <?php   echo '<img src="data:image/jpg;base64,'.base64_encode( $player['pic'] ).'"/>';?></td>
<!--                                <td><img src="images/<?php echo $player['playerID']; ?>.jpg" alt=""></td>-->

                                <td>
                                <td>

                                    <form action="update_player_form.php" method="POST">
                                        <input type="hidden" name="team_id" value ="<?php echo $player["teamID"]; ?>"/>
                                        <input type="hidden" name="player_id" value ="<?php echo $player["playerID"]; ?>"/>
                                        <button type="update">
                                            <img src="" alt=""/> 
                                            <img src="images/button_update.png" alt=""/>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="delete_player.php" method ="POST">
                                        <input type="hidden" name="team_id" value ="<?php echo $player["teamID"]; ?>"/>
                                        <input type="hidden" name="player_id" value ="<?php echo $player["playerID"]; ?>"/>
                                        <button type="delete">
                                            <a href="deletelink" class="delete"><img src="images/button_delete (2).png"  </a>

                                        </button>
                                    </form>
                                </td>

                            </tr>

                        <?php endforeach; ?>  
                        <td> <a href="add_player.php"><img src="images/button_add-player.png" alt=""/> </a></td>

                    </table>

                    <br>
                    <br>
                    <table>



                        <a name="chapter4"></a>
                        </aside>
                        <section id ="section">
                            <table id="table">
                                <td>Upcoming Fixtures</td>
                                <?php foreach ($teams as $team) : ?> <!-- multi dimensional array to one dimensional array can access variables now -->
                                    <td><a href = ".?team_id=<?php echo $team['teamID']; ?>"> 
                                            <?php echo $team['teamName'];
                                            ?>       
                                        </a></td>

                                <?php endforeach; ?>
                            </table>


                            <table id="table">
                                <tr>
                                    <th>Opposition</th>     <!-- rows once outside the loop -->
                                    <th>Home/Away</th>
                                    <th>Date</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>


                                </tr>
                                <?php foreach ($fixtures as $fixture) : ?>
                                    <tr>     
                                        <td><?php echo $fixture['oppostion']; ?></td> 
                                        <td><?php echo $fixture['home']; ?></td>
                                        <td><?php echo $fixture['date']; ?></td>
                                        <td><img src="images/<?php echo $fixture['oppositionID']; ?>.png" alt=""></td>
                                        <td>
                                            <form action="update_fixtures_form.php" method="POST">
                                                <input type="hidden" name="team_id" value ="<?php echo $fixture["teamID"]; ?>"/>
                                                <input type="hidden" name="fixture_id" value ="<?php echo $fixture["fixtureID"]; ?>"/>
                                                <button type="update">
                                                    <img src="" alt=""/> 
                                                    <img src="images/button_update.png" alt=""/>
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                        <form action="delete_fixture.php" method ="POST">
                                        <input type="hidden" name="team_id" value ="<?php echo $fixture["teamID"]; ?>"/>
                                        <input type="hidden" name="player_id" value ="<?php echo $fixture["fixxtureID"]; ?>"/>
                                        <button type="delete">
                                            <a href="deletelink" class="delete"><img src="images/button_delete (2).png"  </a>

                                        </button>
                                        </td>
                                    </form>
                                       




                                        <?php endforeach; ?>  


                            </table>

                        </section>
                        </body>
                        <footer><?php require_once("includes/footer.php"); ?></footer>
                        
                        </html>




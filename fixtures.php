<?php
require_once("includes/database.php");

$query = 'SELECT * FROM team ORDER BY teamID';
$statement = $db->prepare($query);  //setting up statement
$statement->execute();                //executing statement results stored in statemntes variable
$teams = $statement->fetchALL();   // expecting mutiple diff values use fetch all
$statement->closeCursor();

if (!isset($team_id)) {
    $team_id = filter_input(INPUT_GET, 'team_id', FILTER_VALIDATE_INT);
    if ($team_id == NULL || $team_id == false) {
        $team_id = 2;   // settign default cat idea
    }
}


$queryFixtures = "Select * FROM fixtures WHERE teamID = :team_id";
$statement2 = $db->prepare($queryFixtures);
$statement2->bindValue(":team_id", $team_id);
$statement2->execute();
$fixtures = $statement2->fetchAll();  //array of fixturesfetching all
$statement2->closeCursor();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="css/mainpage.css">
        <link href="css/common.css" rel="stylesheet" type="text/css"/>
        <link href="jquery/new.js"/>
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
            <a class="link-1" href="fixtures.php">Fixtures</a>
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
                <td><a href = ".?team_id=<?php echo $team['teamID']; ?>"> 
                            <?php echo $team['teamName'];
                            ?>       
                        </a></td>

                <?php endforeach; ?>
            </table>
            <br>



                    <table>
                       



                        </aside>
                        <section id ="section">



                            <table id="table">
                                <tr>
                                    <th>Opposition</th>     <!-- rows once outside the loop -->
                                    <th>Home/Away</th>
                                    <th>Date</th>
                                    

                                </tr>
<?php foreach ($fixtures as $fixture) : ?>
                                    <tr>     
                                        <td><?php echo $fixture['oppostion']; ?></td> 
                                        <td><?php echo $fixture['home']; ?></td>
                                        <td><?php echo $fixture['date']; ?></td>
                                        
                                 

                                        

<?php endforeach; ?>  
                               

                            </table>

                            <br>
                            <br>

                        </section>
                        </body>
                        <footer><?php require_once("includes/footer.php"); ?></footer>
                        </html>

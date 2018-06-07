<?php
	session_start();
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
 </head>
 <body>
 <style>
 /* body {background: url("notatka.jpg") no-repeat fixed center;  opacity: 0.9;} */
 #busun,#bodczytaj,#baktualizuj {  width: 12vw; height: 3em;}
 </style>
    <div class="container">
            <div class="row">
                <h4><?php echo "<p>Witaj ".$_SESSION['user'].'! [ <a href="logout.php">Wyloguj się!</a> ]</p>';?></h4>
            
			</div>
            <div class="row">
			<p>
                    <a href="create.php" class="btn btn-success">Utwórz notatkę</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Temat</th>
                      <th>Treść</th>
                      <th>Data</th>
					  <th>Funkcje</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
				   //$sql = 'SELECT * FROM customers ORDER BY id DESC';
				   $user = $_SESSION['user']; //aktualny użytkownik
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = "SELECT notatki.temat,notatki.tresc,notatki.data,notatki.id FROM notatki INNER JOIN student ON student.id=notatki.user_id WHERE student.nick='".$user."'";
                   $pdo->query("SET CHARSET utf8");
				   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['temat'] . '</td>';
                            echo '<td>'. $row['tresc'] . '</td>';
                            echo '<td>'. $row['data'] . '</td>';

							echo '<td width=250>';
							
                                echo '<a id="bodczytaj" class="btn btn-info" href="read.php?id='.$row['id'].'">Odczytaj</a>';
                                echo '<a id="baktualizuj" class="btn btn-success" href="update.php?id='.$row['id'].'">Aktualizuj</a>';
                                echo ' ';
                                echo '<a id="busun" class="btn btn-danger" href="delete.php?id='.$row['id'].'">Usuń</a>';
                                echo '</td>';
                               
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  </tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>

</html>

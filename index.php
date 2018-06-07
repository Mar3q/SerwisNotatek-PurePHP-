<?php
	session_start();
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: PanelNotatek.php');
		exit();
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<title>Serwis</title>
	<link rel="stylesheet" type="text/css" href="styl.css">
	<script src="akcje.js"></script> 
</head>

<body>
	<div class="container" id="naglowek">
		<div class="jumbotron">
			<h1>Serwis Notatek</h1>      
			<div class="container" id="panelLogowania">
				<div class="row">
					<div class="col" id="kolumna1">
							<div class="wrapper">
								<button class="btn btn-info"  onclick="pokazFormularzLogowania()" id="przyciskLogowania">Logowanie</button>
							</div>
						<form action="zaloguj.php" method="post" id="logowanie">
								<label class="sr-only">Podaj Login:</label>
								<input type="text" name="login" class="form-control" placeholder="Login" value="testowe@wp.pl" required autofocus>
								<label class="sr-only">Podaj Hasło</label>
								 <input type="password" name="haslo" class="form-control" placeholder="Hasło" value="testowe" required autofocus>
								<button class="btn btn-lg btn-primary btn-block" type="submit">Zaloguj</button>	
						</form>
						<?php if(isset($_SESSION['bladLogowania']))	echo $_SESSION['bladLogowania']; ?>
					</div>
				
				<div class="col" id="kolumna2">
					<div class="wrapper">
						<button class="btn btn-info"  onclick="pokazFormularzRejstracji()" id="przyciskRejstracji">Rejstracja</button><br>
					</div>
						<form  action="zarejstruj.php" method="post" id="rejstracja" >
								<label class="sr-only">Podaj Nick:</label>
								<input type="text" name="nickRejstracja" class="form-control" placeholder="Login" required autofocus>
								<label class="sr-only">Podaj Hasło:</label>
								<input type="password" name="hasloRejstracja" class="form-control" placeholder="Hasło" required autofocus>
								<button class="btn btn-lg btn-primary btn-block" type="submit">Zarejstruj</button>
						</form>
						
						<div style="color:red; font-size : 1.5vw;" >
						<?php if(isset($_SESSION['bladRejstracji']))	echo $_SESSION['bladRejstracji']; ?>
						</div>
						
						<div style="color:green; font-size : 1.5vw;" >
						<?php if(isset($_SESSION['udanaRejstracja']))	echo $_SESSION['udanaRejstracja']; ?>
						</div>
				</div>
			  </div>
			</div>
		</div>   
	</div>
	
</body>
</html>